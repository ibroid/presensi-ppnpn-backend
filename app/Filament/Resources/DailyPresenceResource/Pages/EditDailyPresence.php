<?php

namespace App\Filament\Resources\DailyPresenceResource\Pages;

use App\Filament\Resources\DailyPresenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyPresence extends EditRecord
{
    protected static string $resource = DailyPresenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
