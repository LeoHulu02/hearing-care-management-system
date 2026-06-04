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
            Stat::make('Total Customers', (string) User::query()->where('role', User::ROLE_CUSTOMER)->count())
                ->description('Registered customers')
                ->color('info'),
            Stat::make('Total Products', (string) Product::query()->count())
                ->description('Products in catalog')
                ->color('primary'),
            Stat::make('Total Orders', (string) Order::query()->count())
                ->description('All customer orders')
                ->color('warning'),
            Stat::make('Completed Orders', (string) Order::query()->where('status', Order::STATUS_COMPLETED)->count())
                ->description('Fulfilled orders')
                ->color('success'),
        ];
    }
}
