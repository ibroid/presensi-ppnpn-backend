<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'All' => Tab::make('All')
                ->badge($this->getModel()::count()),
            'Pimpinan' => Tab::make('Pimpinan')
                ->badge($this->getModel()::where("employee_level_id", "<", 5)->count())->modifyQueryUsing(
                    fn (Builder $query) => $query->where("employee_level_id", "<", 5)
                ),
            'PPNPN' => Tab::make('PPNPN')
                ->badge($this->getModel()::where("employee_level_id", ">", 5)->count())->modifyQueryUsing(fn (Builder $query) => $query->where("employee_level_id", ">", 5)),
        ];

        return $tabs;
    }
}
