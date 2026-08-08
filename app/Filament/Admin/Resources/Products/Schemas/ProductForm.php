<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product information')
                    ->description('Use clear names and helpful descriptions so customers can choose the right product.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Premium Digital Hearing Aid'),
                        FileUpload::make('image')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->directory('products')
                            ->disk('public')
                            ->helperText('Recommended ratio: 4:3. Accepted formats: JPG, PNG, WebP.'),
                        Textarea::make('description')
                            ->default(null)
                            ->rows(4)
                            ->placeholder('Summarize product benefits, fit, and usage notes.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Pricing and inventory')
                    ->description('These values affect customer ordering and stock availability badges.')
                    ->schema([
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Rp')
                            ->helperText('Stored as Indonesian Rupiah.'),
                        TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->default(0)
                            ->helperText('Products with zero stock are shown as out of stock.'),
                    ])
                    ->columns(2),
            ]);
    }
}
