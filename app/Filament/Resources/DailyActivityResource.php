<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyActivityResource\Pages;
use App\Filament\Resources\DailyActivityResource\RelationManagers;
use App\Models\DailyActivity;
use App\Models\Employee;
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

class DailyActivityResource extends Resource
{
    protected static ?string $navigationGroup = 'Monitor';

    protected static ?string $model = DailyActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("employee_id")
                    ->label("Pilih Pegawai")
                    ->required()
                    ->options(Employee::where("employee_level_id", ">", 5)->pluck("fullname", "id")),
                TextInput::make("doing")
                    ->label("Kegiatan Yang Dilakukan")
                    ->required()->datalist([
                        "Mengepel Ruangan",
                        "Menyapu Ruangan",
                        "Membuang Sampah",
                        "Mengisi Galon",
                        "Mematikan Alat Elektronik",
                    ]),
                TimePicker::make("doing_time")
                    ->label("Waktu Kegiatan")
                    ->required()
                    ->timezone('Asia/Jakarta')
                    ->native(false)
                    ->default(now()),
                DatePicker::make("doing_date")
                    ->required()
                    ->format("Y-m-d")
                    ->label("Tanggal Kegiatan")
                    ->native(false)
                    ->default(now()),
                Textarea::make("note")
                    ->label("Catatan")
                    ->placeholder("Tulis catatan apabila terjadi sesuatu hal. Contoh : Keran Bocor, Lampu Mati, dll.")
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("employee.fullname")->searchable()->label("Pegawai"),
                TextColumn::make("doing_date")->date()->label("Tanggal Kegiatan"),
                TextColumn::make("doing")->label("Kegiatan Yang Dilakukan"),
                TextColumn::make("doing_time")->time()->label("Waktu Kegiatan"),

            ])
            ->filters([])
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
            'index' => Pages\ListDailyActivities::route('/'),
            'create' => Pages\CreateDailyActivity::route('/create'),
            'edit' => Pages\EditDailyActivity::route('/{record}/edit'),
        ];
    }
}
