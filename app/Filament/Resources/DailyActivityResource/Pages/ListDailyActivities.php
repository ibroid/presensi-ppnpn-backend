<?php

namespace App\Filament\Resources\DailyActivityResource\Pages;

use App\Filament\Resources\DailyActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyActivities extends ListRecords
{
    protected static string $resource = DailyActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
