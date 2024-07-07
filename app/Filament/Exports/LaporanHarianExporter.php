<?php

namespace App\Filament\Exports;

use App\Models\Employee;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class LaporanHarianExporter extends Exporter
{
    protected static ?string $model = Employee::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('No')->rowIndex(),
            ExportColumn::make('fullname')->label('Nama Lengkap'),
            ExportColumn::make('masuk')->badge()->color(fn ($state) => $state == "Belum Absen" ? "danger" : "success")->default("Belum Absen"),
            ExportColumn::make('pulang')->badge()->color(fn ($state) => $state == "Belum Absen" ? "warning" : "info")->default("Belum Absen"),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your laporan harian export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
