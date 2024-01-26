<?php

namespace App\Filament\Resources\EmployeeLevelResource\Pages;

use App\Filament\Resources\EmployeeLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployeeLevels extends ListRecords
{
    protected static string $resource = EmployeeLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
