<?php

namespace App\Filament\Resources\DailyPresenceResource\Pages;

use App\Filament\Resources\DailyPresenceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDailyPresence extends CreateRecord
{
    protected static string $resource = DailyPresenceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['present_date'] = date("Y-m-d");
        $data['location'] = "-6.1299253 106.9093767";
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
