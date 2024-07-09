<?php

namespace App\Filament\Pages;

use App\Livewire\LaporanHarianWidget;
use App\Models\Employee;
use App\Report\PresenceReport;
use Filament\Pages\Page;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class LaporanHarian extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan_harian.page';

    protected static ?string $navigationLabel = 'Harian';

    protected static ?string $navigationGroup = 'Laporan';

    /**
     * Get the view data for the page.
     * @return array
     */
    public function getViewData(): array
    {
        return [
            "presence" => PresenceReport::data(request('date') ?? date('Y-m-d'))
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            LaporanHarianWidget::class
        ];
    }

    public function getFooterWidgetsColumns(): int | array
    {
        return 1;
    }

    public function export(Request $request)
    {
        $data = Employee::with("employee_level")->with(
            ["daily_present" => function (Builder $q) use ($request) {
                $q->whereDate("present_date", $request->tanggal);
            }]
        )->where("employee_level_id", ">", 5)->get();

        $template = new TemplateProcessor(
            Storage::disk('templ')->path("doc/template_laporan_harian.docx")
        );

        $template->setValue("tanggal", Date::parse($request->tanggal)->format("d F Y"));

        $datamapping = $data->map(function ($item, int $i) {
            return [
                "no" => $i + 1,
                "nama_lengkap" => $item->fullname,
                "jabatan" => $item->employee_level->level_name,
                "masuk" => $item->daily_present[0]->present_time ?? null,
                "pulang" => $item->daily_present[1]->present_time ?? null,
                "total" => (function () use ($item) {
                    if (isset($item->daily_present[1]->present_time)) {
                        $start = Date::parse($item->daily_present[0]->present_date . " " . $item->daily_present[0]->present_time);

                        $end = Date::parse($item->daily_present[1]->present_date . " " . $item->daily_present[1]->present_time);

                        return $start->diff($end)->format("%h Jam, %I menit");
                    }
                })(),
                "ket" => "",
            ];
        })->all();

        $template->cloneRowAndSetValues('no', $datamapping);

        $filename = "Laporan_Harian_" . str_replace("-", "_", $request->tanggal) . ".docx";
        $fullpath = Storage::disk("templ")->path($filename);
        $template->saveAs($fullpath);

        return response()->download($fullpath)->deleteFileAfterSend(true);
    }
}
