<?php

namespace App\Filament\Resources\EmployeeLevelResource\Pages;

use App\Filament\Resources\EmployeeLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeLevel extends EditRecord
{
    protected static string $resource = EmployeeLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
