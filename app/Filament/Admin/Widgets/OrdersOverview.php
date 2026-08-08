<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrdersOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Customers', (string) User::query()->where('role', User::ROLE_CUSTOMER)->count())
                ->icon('heroicon-o-users')
                ->description('Registered customer accounts')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Products', (string) Product::query()->count())
                ->icon('heroicon-o-cube')
                ->description('Active catalog items')
                ->color('primary'),

            Stat::make('Orders', (string) Order::query()->count())
                ->icon('heroicon-o-shopping-bag')
                ->description('All customer orders')
                ->color('info'),

            Stat::make('Completed', (string) Order::query()->where('status', Order::STATUS_COMPLETED)->count())
                ->icon('heroicon-o-check-circle')
                ->description('Successfully fulfilled')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([2, 5, 8, 4, 10, 15, 12]),
        ];
    }
}
