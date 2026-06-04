<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('image')
                    ->image()
                    ->directory('products')
                    ->disk('public'),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('Rp'),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->default(0),
                Textarea::make('description')
                    ->default(null)
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}
