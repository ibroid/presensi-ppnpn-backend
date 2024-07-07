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
use Termwind\Enums\Color;

class LaporanHarianWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $selectRaw = "(select present_time from daily_present where date(present_date) = ? and session = ? and daily_present.employee_id = employees.id)";

                $masuk = Str::replaceArray('?', [date("Y-m-d"), 1], $selectRaw);
                $pulang = Str::replaceArray('?', [date("Y-m-d"), 2], $selectRaw);

                return Employee::select('employees.*')
                    ->selectRaw("$masuk as masuk, $pulang as pulang")
                    ->orderBy('masuk', 'asc')
                    ->where('employee_level_id', '>', 5);
            })
            ->columns([
                TextColumn::make('no')->rowIndex()->default('#'),
                ImageColumn::make('photos')->label("Foto"),
                TextColumn::make('fullname')->label('Nama Lengkap'),
                TextColumn::make('masuk')->badge()->color(fn ($state) => $state == "Belum Absen" ? "danger" : "success")->default("Belum Absen"),
                TextColumn::make('pulang')->badge()->color(fn ($state) => $state == "Belum Absen" ? "warning" : "info")->default("Belum Absen"),
            ])
            ->heading("Tanggal " . Date::now()->format("d F Y"))
            ->filters([
                Filter::make('Tanggal Presensi')->form([
                    DatePicker::make('selected_present_date')
                ])->baseQuery(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['selected_present_date'],
                            function (Builder $query, $date): Builder {
                                $selectRaw = "(select present_time from daily_present where date(present_date) = date('$date') and session = ? and daily_present.employee_id = employees.id)";

                                $masuk = Str::replace('?', 1, $selectRaw);
                                $pulang = Str::replace('?', 2, $selectRaw);

                                return $query->select('employees.*')->selectRaw("$masuk as masuk, $pulang as pulang")
                                    ->orderBy('masuk', 'asc')
                                    ->where('employee_level_id', '>', 5);
                            },
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
