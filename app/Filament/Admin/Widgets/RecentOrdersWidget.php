<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Widgets\Widget;

class RecentOrdersWidget extends Widget
{
    protected static bool $isDiscovered = false;

    protected static ?int $sort = 10;

    protected int | string | array $columnSpan = [
        'default' => 'full',
        'lg' => 8,
    ];

    protected string $view = 'filament.admin.widgets.recent-orders';

    protected function getViewData(): array
    {
        return [
            'ordersUrl' => OrderResource::getUrl('index'),
            'recentOrders' => Order::query()
                ->with(['user', 'orderItems.product'])
                ->latest()
                ->limit(6)
                ->get(),
            'statusFilters' => [
                'All' => Order::query()->count(),
                'Pending' => Order::query()->where('status', Order::STATUS_PENDING)->count(),
                'Processing' => Order::query()->where('status', Order::STATUS_PROCESSING)->count(),
                'Completed' => Order::query()->where('status', Order::STATUS_COMPLETED)->count(),
            ],
        ];
    }
}
