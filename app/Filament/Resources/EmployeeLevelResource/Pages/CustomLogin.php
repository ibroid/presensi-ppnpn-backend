<?php

use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseAuth;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;

class CustomLogin extends BaseAuth
{
  public function form(Form $form): Form
  {
    return $form
      ->schema([
        // $this->getEmailFormComponent(),
        $this->getLoginFormComponent(),
        $this->getPasswordFormComponent(),
        $this->getRememberFormComponent(),
      ])
      ->statePath('data');
  }

  protected function getLoginFormComponent(): Component
  {
    return TextInput::make('login')
      ->label('Phone')
      ->required()
      ->autocomplete()
      ->autofocus();
  }

  public function getCredentialsFromFormData(array $data): array
  {
    return [
      'identifier' => $data['login'],
      'password'  => $data['password'],
    ];
  }
}
