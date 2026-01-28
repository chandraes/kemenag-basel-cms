<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    // 1. Ubah Form agar meminta Username, bukan Email
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getUsernameFormComponent(), // Panggil fungsi custom di bawah
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    // 2. Definisi Input Username
    protected function getUsernameFormComponent(): Component
    {
        return TextInput::make('username')
            ->label('Username / NIP') // Label yang tampil
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    // 3. Override Logika Autentikasi
    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'username' => $data['username'], // Cek ke kolom username db
            'password' => $data['password'],
        ];
    }
    
    // 4. Override Validasi Error
    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.username' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}