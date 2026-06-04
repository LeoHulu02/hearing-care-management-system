<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use App\Models\Order;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Placeholder::make('order_code')
                    ->label('Order Code')
                    ->content(fn (?Order $record): string => $record?->order_code ?? '-'),
                Placeholder::make('customer')
                    ->label('Customer')
                    ->content(fn (?Order $record): string => $record?->user?->name ?? '-'),
                Placeholder::make('total_price')
                    ->label('Total Price')
                    ->content(fn (?Order $record): string => $record ? ('Rp '.number_format((float) $record->total_price, 0, ',', '.')) : '-'),
                Placeholder::make('items')
                    ->label('Products & Qty')
                    ->content(function (?Order $record): string {
                        if (! $record) {
                            return '-';
                        }

                        $items = $record->orderItems
                            ->map(fn ($item): string => "{$item->product?->name} ({$item->quantity})")
                            ->implode(', ');

                        return $items ?: '-';
                    }),
                Select::make('status')
                    ->options([
                        Order::STATUS_PENDING => 'Pending',
                        Order::STATUS_PROCESSING => 'Processing',
                        Order::STATUS_COMPLETED => 'Completed',
                        Order::STATUS_CANCELLED => 'Cancelled',
                    ])
                    ->required(),
            ]);
    }
}
