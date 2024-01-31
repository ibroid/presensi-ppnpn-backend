<?php

namespace App\Filament\Resources\DailyRecordResource\Pages;

use App\Filament\Resources\DailyRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyRecords extends ListRecords
{
    protected static string $resource = DailyRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
