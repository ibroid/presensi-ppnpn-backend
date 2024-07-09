<?php

namespace App\Filament\Pages;

use App\Models\Employee;
use Filament\Pages\Page;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class LaporanBulanan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-bulanan';

    protected static ?string $navigationLabel = 'Bulanan';

    protected static ?string $navigationGroup = 'Laporan';

    public function getViewData(): array
    {
        return [
            "employee" => Employee::where("employee_level_id", ">", 5)->get()
        ];
    }

    public function export(Request $request)
    {
        $dateRange = Collection::make();
        $firstDate = date("Y-m-01", strtotime($request->tahun . "-" . $request->bulan . "-01"));

        $lastDate = date("Y-m-t", strtotime($request->tahun . "-" . $request->bulan . "-01"));

        $current = $firstDate;
        while ($current <= $lastDate) {
            $dateRange->push(Date::parse($current));
            $current = date("Y-m-d", strtotime("+1 day", strtotime($current)));
        }

        $data = Employee::with("employee_level")
            ->with(["daily_present" => function (Builder $q) use ($request) {
                $q
                    ->whereMonth("present_date", $request->bulan)
                    ->whereYear("present_date", $request->tahun);
            }])
            ->find($request->employee_id);

        $template = new TemplateProcessor(Storage::disk("templ")->path("doc/template_laporan_bulanan.docx"));

        $template->setValues([
            "bulan" => $dateRange[0]->monthName,
            "tahun" => $dateRange[0]->format("Y"),
            "nama" => $data->fullname,
            "jabatan" => $data->employee_level->level_name,
        ]);

        $totalMinutes = 0;

        $template->cloneRowAndSetValues("no", $dateRange->map(function ($item, int $y) use ($data, &$totalMinutes) {
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
                "ket" => ""
            ];
        })->all());
        $totalHours = floor($totalMinutes / 60); // Menghitung total jam
        $remainingMinutes = $totalMinutes % 60; // Menghitung sisa menit setelah diubah ke jam

        $template->setValue("total_in", "{$totalHours} Jam {$remainingMinutes} Menit");


        $filename = "LPB_" . $dateRange[0]->monthName . "_" . $dateRange[0]->format("Y") . str_replace(" ", "_", $data->fullname)  . ".docx";

        $fullpath = Storage::disk("templ")->path($filename);
        $template->saveAs($fullpath);

        return response()->download($fullpath)->deleteFileAfterSend(true);
    }
}
