<?php

namespace App\Filament\Resources\DailyPresenceResource\Pages;

use App\Filament\Resources\DailyPresenceResource;
use Filament\Actions;
use Filament\Actions\StaticAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Filament\Infolists\Components\Tabs;
use Filament\Resources\Components\Tab;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;

class ListDailyPresences extends ListRecords
{
    protected static string $resource = DailyPresenceResource::class;

    public static $searchedByDate = false;
    public static $targetDate = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            // Actions\Action::make("Cari Berdasarkan Tanggal")
            //     ->color(Color::Blue)
            //     ->icon('heroicon-o-magnifying-glass')
            //     ->form([
            //         DatePicker::make('present_date')
            //             ->label('Tanggal Presensi')
            //             ->required()
            //             ->native(false),
            //     ])->query(function (Builder $query, array $data): Builder {
            //         return $query->where("present_date", $data["present_date"]);
            //     })

        ];
    }

    // public function getTabs(): array
    // {
    //     $queryDatangHariIni = $this->getModel()::where('present_date', request("tableFilters.present_date.present_date_target") ?? date("Y-m-d"))->where("session", 1);
    //     $queryPulangHariIni = $this->getModel()::where('present_date', request("tableFilters.present_date.present_date_target") ?? date("Y-m-d"))->where("session", 2);
    //     $queryAbsenHariIni = $this->getModel()::where('present_date', request("tableFilters.present_date.present_date_target") ?? date("Y-m-d"))->where("status", 2);
    //     return [
    //         'Datang' => Tab::make()
    //             ->modifyQueryUsing(fn () => $queryDatangHariIni)
    //             ->icon('heroicon-o-sun')
    //             ->badge($queryDatangHariIni->count()),
    //         'Pulang' => Tab::make()
    //             ->modifyQueryUsing(fn () => $queryPulangHariIni)
    //             ->icon('heroicon-o-moon')
    //             ->badge($queryPulangHariIni->count()),
    //         'Absen' => Tab::make()
    //             ->modifyQueryUsing(fn () => $queryAbsenHariIni)
    //             ->icon('heroicon-o-bell-slash')
    //             ->badge($queryAbsenHariIni->count()),
    //     ];
    // }

    public static function getEloquentQuery(): Builder
    {
        if (request()->has('present_date')) {
            return parent::getEloquentQuery()->where('present_date', request()->get('present_date'));
        }
        return parent::getEloquentQuery()->where('present_day', date("Y-m-d"));
    }

    // public function getDefaultActiveTab(): string | int | null
    // {
    //     return 'Datang';
    // }
}
