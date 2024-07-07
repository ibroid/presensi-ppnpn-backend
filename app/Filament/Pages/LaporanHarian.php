<?php

namespace App\Filament\Pages;

use App\Filament\Exports\LaporanHarianExporter;
use App\Livewire\LaporanHarianWidget;
use App\Report\PresenceReport;
use Filament\Pages\Page;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

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


    protected function getHeaderActions(): array
    {
        return [

            // ->columnMapping(false)
            // ->modifyQueryUsing(function (Builder $query) {
            //     $selectRaw = "(select present_time from daily_present where date(present_date) = date('2024-07-01') and session = ? and daily_present.employee_id = employees.id)";

            //     $masuk = Str::replace('?', 1, $selectRaw);
            //     $pulang = Str::replace('?', 2, $selectRaw);

            //     return $query->select('employees.*')->selectRaw("$masuk as masuk, $pulang as pulang")
            //         ->orderBy('masuk', 'asc')
            //         ->where('employee_level_id', '>', 5);
            // })
            // ->fileName(fn (): string => "test.csv"),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LaporanHarianWidget::class
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 1;
    }
}
