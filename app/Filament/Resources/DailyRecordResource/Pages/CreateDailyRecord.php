<?php

namespace App\Filament\Resources\DailyRecordResource\Pages;

use App\Filament\Resources\DailyRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDailyRecord extends CreateRecord
{
    protected static string $resource = DailyRecordResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
