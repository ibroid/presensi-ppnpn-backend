<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DailyPresence;
use App\Report\ActivityReport;
use App\Report\PresenceReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class LaporanController extends Controller
{
    public function periode(Request $request)
    {
        try {
            $data = PresenceReport::monthlyData(
                $request->bulan ?? date("m"),
                $request->tahun ?? date("Y"),
                $request->employee_id ?? $request->user()->employee->id
            );

            $dateRange = PresenceReport::dateRangeMonth(
                $request->bulan ?? date("m"),
                $request->tahun ?? date("Y"),
            );

            $mappedData = $dateRange->map(function ($item, int $y) use ($data, &$totalMinutes) {
                $presensi = $data->daily_present->where("present_date", "=", $item->format("Y-m-d"));

                $masuk = $presensi->where("session", "=", 1)->first();
                $pulang = $presensi->where("session", "=", 2)->first();

                if ($pulang && $masuk) {
                    $start = Date::parse($item->format("Y-m-d") . " " . $masuk->present_time);

                    $end = Date::parse($item->format("Y-m-d") . " " . $pulang->present_time);

                    $diff = explode("-", $start->diff($end)->format("%h-%I"));
                    $totalMinutes += (intval($diff[0] * 60)) + intval($diff[1]);
                    $diffStr = $diff[0] . " Jam," . $diff[1] . " Menit";
                }

                return [
                    "no" => $y + 1,
                    "tanggal" => $item->format("d F Y"),
                    "hari" => $item->dayName,
                    "masuk" => $masuk->present_time ?? null,
                    "pulang" => $pulang->present_time ?? null,
                    "total" => $diffStr ?? null,
                    "ket" => DailyPresence::keteranganList($masuk->status ?? 0)
                ];
            })->all();

            return response()->json($mappedData);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                "stack" => $_ENV['APP_DEBUG'] == "true" ? $th->getTrace() : null
            ], 500);
        }
    }

    public function export(Request $request)
    {
        return PresenceReport::export($request);
    }

    public function activity(Request $request)
    {
        $report = new ActivityReport(
            employeeId: $request->employee_id ?? $request->user()->employee->id,
            month: $request->bulan,
            year: $request->tahun,
            fullDate: date("Y-m-d", strtotime("{$request->tahun}-{$request->month}-d"))
        );

        $data = $report->getDataInMonthAndYear();

        $dates =  $report->getDateRange();
        $n = 1;

        $mappedData = $dates->map(function ($d, $n) use ($data) {
            return [
                "no" => $n + 1,
                "hari" => $d->dayName,
                "keterangan" => "",
                "tanggal" => $d->format("d") . " {$d->monthName} " . $d->format("Y"),
                "kegiatan" =>  $data->daily_activity->where("doing_date", $d->format("Y-m-d"))->values()->toArray()
            ];
        });

        return response()->json($mappedData);
    }

    public function export_activity(Request $request)
    {
        $report = new ActivityReport(
            $request->employee_id ?? $request->user()->employee->id,
            month: $request->bulan,
            year: $request->tahun,
            fullDate: date("Y-m-d", strtotime("{$request->tahun}-{$request->month}-d"))
        );

        $data = $report->getDataInMonthAndYear();

        $template = new TemplateProcessor(Storage::disk("templ")->path("doc/template_laporan_aktivitas.docx"));

        $dates =  $report->getDateRange();
        $template->cloneRow("no", $dates->count());
        $n = 1;

        $template->setValues([
            "bulan" => $dates[0]->monthName,
            "tahun" => $request->tahun,
            "nama" => $data->fullname,
            "jabatan" => $data->employee_level->level_name,
        ]);

        $template->setImageValue("foto", [
            "path" => $data->photos,
            "width" => 100,
            "height" => 100
        ]);

        foreach ($dates as $d) {
            $template->setValue("no#{$n}", $n);
            $template->setValue("hari#{$n}", $d->dayName);
            $template->setValue("ket#{$n}", "");
            $template->setValue("tanggal#{$n}", $d->format("d") . " {$d->monthName} " . $d->format("Y"));

            $activity = $data->daily_activity->where("doing_date", $d->format("Y-m-d"));

            if ($activity->count() > 0) {
                $template->setValue("kegiatan#$n", $activity->implode("doing", "<w:br/>"));
                $template->setValue("waktu#$n", $activity->implode("doing_time", "<w:br/>"));
                $template->setValue("catatan#$n", $activity->implode("note", "<w:br/>"));
            } else {
                $template->setValues([
                    "kegiatan#$n" => "",
                    "waktu#$n" => "",
                    "catatan#$n" => "",
                ]);
            }

            $n++;
        }


        $filename = "LK_" . $dates[0]->monthName . "_" . $dates[0]->format("Y") . str_replace(" ", "_", $data->fullname)  . ".docx";

        $fullpath = Storage::disk("templ")->path($filename);
        $template->saveAs($fullpath);

        return response()->download($fullpath)->deleteFileAfterSend(true);
    }
}
