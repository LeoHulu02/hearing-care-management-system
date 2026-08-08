<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\DashboardWelcomeHeader;
use App\Filament\Admin\Widgets\InventorySnapshotWidget;
use App\Filament\Admin\Widgets\OrderOperationsWidget;
use App\Filament\Admin\Widgets\OrdersOverview;
use App\Filament\Admin\Widgets\RecentOrdersWidget;
use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = -2;

    public function getColumns(): int|array
    {
        return [
            'default' => 1,
            'lg' => 12,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }

    public function getHeading(): string|Htmlable|null
    {
        return null;
    }

    public function getSubheading(): string|Htmlable|null
    {
        return null;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            DashboardWelcomeHeader::class,
        ];
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            OrdersOverview::class,
            RecentOrdersWidget::class,
            OrderOperationsWidget::class,
            InventorySnapshotWidget::class,
        ];
    }
}
