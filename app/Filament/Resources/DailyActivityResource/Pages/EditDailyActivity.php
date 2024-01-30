<?php

namespace App\Filament\Resources\DailyActivityResource\Pages;

use App\Filament\Resources\DailyActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyActivity extends EditRecord
{
    protected static string $resource = DailyActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
