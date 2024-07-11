<?php

namespace App\Filament\Pages;

use App\Models\Employee;
use App\Report\ActivityReport;
use Filament\Pages\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class LaporanAktivitas extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-aktivitas';

    protected static ?string $navigationLabel = 'Aktivitas';

    protected static ?string $navigationGroup = 'Laporan';


    public function getViewData(): array
    {
        return [
            "employee" => Employee::where("employee_level_id", ">", 5)->get()
        ];
    }

    public function export(Request $request)
    {
        $report = new ActivityReport(
            $request->employee_id,
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
