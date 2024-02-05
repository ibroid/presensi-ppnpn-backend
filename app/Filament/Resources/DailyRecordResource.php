<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyRecordResource\Pages;
use App\Filament\Resources\DailyRecordResource\RelationManagers;
use App\Models\DailyRecord;
use App\Models\Employee;
use Filament\Tables\Filters\Filter;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailyRecordResource extends Resource
{
    protected static ?string $navigationGroup = 'Monitor';

    protected static ?string $model = DailyRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("employee_id")
                    ->label("Pilih Pegawai")
                    ->required()
                    ->options(Employee::where("employee_level_id", "=", 8)->pluck("fullname", "id")),
                Textarea::make("note")->label("Catatan Security")->required()->placeholder("Apa saja yang terjadi ..."),
                TimePicker::make("record_time")->default(now())->label("Waktu Kejadian")->required(),
                DatePicker::make("record_date")->default(now())->label("Tanggal Kejadian")->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("employee.fullname")->label("Security")->searchable(),
                TextColumn::make("record_time")->label("Waktu Kejadian")->time(),
                TextColumn::make("record_date")->label("Tanggal Kejadian")->date(),
                TextColumn::make("note")->label("Catatan Security"),
            ])
            ->filters([
                Filter::make('record_date_filter')
                    ->form([
                        DatePicker::make('record_date')->native(false)->default(now()->format("Y-m-d 00:00:00"))->label('Tanggal Kejadian')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['record_date'],
                                fn (Builder $query, $date): Builder => $query->whereDate('record_date', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyRecords::route('/'),
            'create' => Pages\CreateDailyRecord::route('/create'),
            'edit' => Pages\EditDailyRecord::route('/{record}/edit'),
        ];
    }
}
