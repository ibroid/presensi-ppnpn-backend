<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyPresenceResource\Pages;
use App\Filament\Resources\DailyPresenceResource\RelationManagers;
use App\Models\DailyPresence;
use App\Models\Employee;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Tabs;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;

class DailyPresenceResource extends Resource
{
	protected static ?string $navigationGroup = 'Monitor';

	protected static ?string $model = DailyPresence::class;

	protected static ?string $navigationIcon = 'heroicon-o-map-pin';

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Select::make("employee_id")
					->label("Pilih Pegawai")
					->required()
					->options(Employee::where("employee_level_id", ">", 5)->pluck("fullname", "id"))
					->searchable(),
				Select::make("session")
					->label("Sesi Presensi")
					->required()
					->options([
						1 => "Masuk", 2 => "Pulang"
					]),
				TimePicker::make("present_time")
					->label("Waktu Presensi")
					->native(false)
					->default(now())
					->required()
					->timezone('Asia/Jakarta'),
				DatePicker::make("present_date")
					->label("Tanggal Presensi")
					->required()
					->default(now())
					// ->dateFormat('Y-m-d')
					->native(false),
				Select::make("status")
					->label("Status Presensi")
					->required()
					->options([1 => "Hadir", 2 => "Cuti", 3 => "Tidak Ada Keterangan"]),

			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\TextColumn::make('present_date')->date(),
				Tables\Columns\TextColumn::make('employee.fullname')->searchable(),
				Tables\Columns\IconColumn::make('session')->icon(fn ($record) => $record->session == 1 ? 'heroicon-o-sun' : 'heroicon-o-moon')->color(fn ($record) => $record->session == 1 ? Color::Amber : Color::Violet),
				Tables\Columns\TextColumn::make('present_time')->time(),
				Tables\Columns\TextColumn::make('status')
					->badge()
					->color(fn ($record) => $record->status == 1 ? Color::Green : ($record->status == 2 ? Color::Blue : Color::Rose))
					->formatStateUsing(fn ($record) => $record->status == 1 ? "Hadir" : ($record->status == 2 ? "Cuti" : "Tidak Ada Keterangan")),
			])
			->filters([
				SelectFilter::make("session")->options([
					1 => "Masuk", 2 => "Pulang"
				]),
				SelectFilter::make("status")->options([
					1 => "Hadir", 2 => "Cuti", 3 => "Tidak Ada Keterangan"
				]),
				Filter::make("present_date")->form([
					DatePicker::make('present_date_target')->format('Y-m-d')->default(now()),
				])
					// ->indicateUsing(fn () => "Tampilan Hari Ini")
					->query(function (Builder $query, array $data): Builder {
						$query
							->when(
								$data['present_date_target'],
								fn (Builder $query, $date): Builder => $query->whereDate('present_date', "=", $date),
							);
						return $query;
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
		return [];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListDailyPresences::route('/'),
			'create' => Pages\CreateDailyPresence::route('/create'),
			'edit' => Pages\EditDailyPresence::route('/{record}/edit'),
		];
	}
}
