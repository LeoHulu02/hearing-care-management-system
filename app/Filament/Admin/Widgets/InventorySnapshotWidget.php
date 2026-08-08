<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\Customers\CustomerResource;
use App\Filament\Admin\Resources\Products\ProductResource;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\Widget;

class InventorySnapshotWidget extends Widget
{
    protected static bool $isDiscovered = false;

    protected static ?int $sort = 30;

    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.admin.widgets.inventory-snapshot';

    protected function getViewData(): array
    {
        return [
            'productsUrl' => ProductResource::getUrl('index'),
            'customersUrl' => CustomerResource::getUrl('index'),
            'totalStock' => Product::query()->sum('stock'),
            'productsInStock' => Product::query()->where('stock', '>', 0)->count(),
            'outOfStockProducts' => Product::query()->where('stock', '<=', 0)->count(),
            'lowStockProducts' => Product::query()
                ->where('stock', '>', 0)
                ->where('stock', '<=', 5)
                ->orderBy('stock')
                ->limit(5)
                ->get(),
            'latestCustomers' => User::query()
                ->where('role', User::ROLE_CUSTOMER)
                ->latest()
                ->limit(4)
                ->get(),
        ];
    }
}
