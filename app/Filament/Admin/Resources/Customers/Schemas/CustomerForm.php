<?php

namespace App\Filament\Admin\Resources\Customers\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('phone')
                    ->maxLength(20),
                Select::make('role')
                    ->options([
                        User::ROLE_CUSTOMER => 'Customer',
                        User::ROLE_ADMIN => 'Admin',
                    ])
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->minLength(8)
                    ->rule(Password::min(8))
                    ->dehydrateStateUsing(fn (?string $state): ?string => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
            ]);
    }
}
