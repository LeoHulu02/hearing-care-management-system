<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\Customers\CustomerResource;
use App\Filament\Admin\Resources\Orders\OrderResource;
use App\Filament\Admin\Resources\Products\ProductResource;
use App\Models\Order;
use Filament\Widgets\Widget;

class DashboardWelcomeHeader extends Widget
{
    protected static bool $isDiscovered = false;

    protected static ?int $sort = -10;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.admin.widgets.dashboard-welcome-header';

    protected function getViewData(): array
    {
        return [
            'userName' => auth()->user()?->name ?? 'Admin',
            'pendingOrders' => Order::query()->where('status', Order::STATUS_PENDING)->count(),
            'processingOrders' => Order::query()->where('status', Order::STATUS_PROCESSING)->count(),
            'quickLinks' => [
                [
                    'label' => 'Orders',
                    'url' => OrderResource::getUrl('index'),
                    'icon' => 'heroicon-o-clipboard-document-list',
                    'description' => 'Kelola pesanan',
                ],
                [
                    'label' => 'Products',
                    'url' => ProductResource::getUrl('index'),
                    'icon' => 'heroicon-o-cube',
                    'description' => 'Katalog produk',
                ],
                [
                    'label' => 'Customers',
                    'url' => CustomerResource::getUrl('index'),
                    'icon' => 'heroicon-o-users',
                    'description' => 'Data pelanggan',
                ],
            ],
        ];
    }
}
