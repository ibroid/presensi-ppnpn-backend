<?php

namespace App\Filament\Resources\DailyRecordResource\Pages;

use App\Filament\Resources\DailyRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyRecord extends EditRecord
{
    protected static string $resource = DailyRecordResource::class;

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
