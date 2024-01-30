<?php

namespace App\Filament\Resources\DailyActivityResource\Pages;

use App\Filament\Resources\DailyActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDailyActivity extends CreateRecord
{
    protected static string $resource = DailyActivityResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data["note"] == null) {
            $data["note"] = "Tidak ada catatan";
        }

        return $data;
    }
}
