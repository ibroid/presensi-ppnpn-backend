<?php

namespace App\Livewire;

use App\Models\Employee;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class LaporanHarianWidget extends BaseWidget
{
    protected static ?string $model = Employee::class;

    public function table(Table $table): Table
    {
        return $table
            ->query(function (Builder $query) {
                return Employee::query()->with(["daily_present" => function ($q) {
                    $q->whereDate("present_date", today());
                }])->where("employee_level_id", ">", 5);
            })
            ->columns([
                TextColumn::make('no')->rowIndex()->default('#'),
                ImageColumn::make('photos')->label("Foto"),
                TextColumn::make('fullname')->label('Nama Lengkap'),
                TextColumn::make('masuk')
                    ->getStateUsing(function ($record) {
                        return $record->daily_present[0]->present_time ?? "Belum Absen";
                    })
                    ->badge()
                    ->color(fn ($state) => $state == "Belum Absen" ? "danger" : "success"),
                TextColumn::make('pulang')
                    ->getStateUsing(function ($record) {
                        return $record->daily_present[1]->present_time ?? "Belum Absen";
                    })
                    ->badge()
                    ->color(fn ($state) => $state == "Belum Absen" ? "warning" : "info"),
                TextColumn::make('lokasi')->view("filament.pages.laporan_harian.column-lokasi")
            ])
            ->heading("Tanggal " . Date::now()->format("d F Y"))
            ->filters([
                Filter::make('Tanggal Presensi')->form([
                    DatePicker::make('selected_present_date')
                ])->modifyBaseQueryUsing(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['selected_present_date'],
                            function (Builder $query, $date) {
                                $query->with(["daily_present" => function ($q) use ($date) {
                                    $q->whereDate("present_date", $date);
                                }])->where("employee_level_id", ">", 5);
                            }
                        );
                })
            ])
            ->headerActions(
                [
                    ExportAction::make('Print')
                        ->icon('heroicon-o-printer')
                        ->exports([
                            ExcelExport::make('Print')
                                ->withFilename("laporan_presensi_harian")
                                ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                                ->fromTable()
                                ->except(["no", "photos"])
                        ]),
                ]
            )
            ->paginated(false);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_active', true);
    }
}
