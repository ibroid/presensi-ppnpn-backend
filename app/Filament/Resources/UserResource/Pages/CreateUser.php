<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\UserEmployee;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): \App\Models\User
    {
        $employee_id = $data["employee_id"];
        unset($data["employee_id"]);
        $user = static::getModel()::create($data + ["salt" => random_int(3, 5)]);

        UserEmployee::create([
            "user_id" => $user->id,
            "employee_id" => $employee_id,
        ]);

        return $user;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
