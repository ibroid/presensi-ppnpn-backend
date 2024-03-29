<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserChangePassword extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Change Password';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Change User Password")->schema([
                    TextInput::make('old_password')
                        ->password()
                        ->required()
                        ->label("Old Password")
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->revealable()
                        ->rule(function () {
                            return function ($attribute, $value, $fail) {
                                if (!Hash::check($value, auth()->user()->password)) {
                                    $fail("The is not the old password.");
                                }
                            };
                        }),
                    TextInput::make('new_password')
                        ->password()
                        ->required()
                        ->label("New Password")
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->revealable()
                        ->rule(Password::default()),
                    TextInput::make('retype_password')
                        ->password()
                        ->required()
                        ->label("Retype Password Again")
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->revealable()
                        ->same("new_password"),
                ])
            ]);
    }

    public function getBreadcrumb(): string
    {
        return "Change Password";
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['password'] = $data['new_password'];

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        $user = Auth::user();
        $user->password = $data['password'];
        $user->save();

        Auth::login($user);

        return $record;
    }
}
