<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Widgets\Widget;

class OrderOperationsWidget extends Widget
{
    protected static bool $isDiscovered = false;

    protected static ?int $sort = 20;

    protected int | string | array $columnSpan = [
        'default' => 'full',
        'lg' => 4,
    ];

    protected string $view = 'filament.admin.widgets.order-operations';

    protected function getViewData(): array
    {
        $totalOrders = Order::query()->count();
        $completedOrders = Order::query()
            ->where('status', Order::STATUS_COMPLETED)
            ->count();
        $pendingOrders = Order::query()
            ->where('status', Order::STATUS_PENDING)
            ->count();
        $processingOrders = Order::query()
            ->where('status', Order::STATUS_PROCESSING)
            ->count();

        return [
            'activeOrders' => $pendingOrders + $processingOrders,
            'completionRate' => $totalOrders > 0
                ? round(($completedOrders / $totalOrders) * 100)
                : 0,
            'todayOrders' => Order::query()
                ->whereDate('created_at', today())
                ->count(),
            'totalRevenue' => Order::query()
                ->where('status', Order::STATUS_COMPLETED)
                ->sum('total_price'),
            'statusFilters' => [
                [
                    'label' => 'Pending',
                    'count' => $pendingOrders,
                    'icon' => 'heroicon-m-clock',
                    'url' => OrderResource::getUrl('index'),
                ],
                [
                    'label' => 'Processing',
                    'count' => $processingOrders,
                    'icon' => 'heroicon-m-arrow-path',
                    'url' => OrderResource::getUrl('index'),
                ],
                [
                    'label' => 'Completed',
                    'count' => $completedOrders,
                    'icon' => 'heroicon-m-check-circle',
                    'url' => OrderResource::getUrl('index'),
                ],
                [
                    'label' => 'Cancelled',
                    'count' => Order::query()
                        ->where('status', Order::STATUS_CANCELLED)
                        ->count(),
                    'icon' => 'heroicon-m-x-circle',
                    'url' => OrderResource::getUrl('index'),
                ],
            ],
        ];
    }
}
