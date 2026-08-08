<x-filament-widgets::widget>
    <section class="hc-dashboard-card">
        <div class="hc-dashboard-card__header">
            <div>
                <p class="hc-dashboard-card__kicker">Operations</p>
                <h2 class="hc-dashboard-card__title">Today Focus</h2>
            </div>
        </div>

        <div class="hc-dashboard-metrics">
            <div class="hc-dashboard-metric">
                <span>Active Orders</span>
                <strong>{{ $activeOrders }}</strong>
            </div>
            <div class="hc-dashboard-metric">
                <span>Today</span>
                <strong>{{ $todayOrders }}</strong>
            </div>
            <div class="hc-dashboard-metric">
                <span>Completion</span>
                <strong>{{ $completionRate }}%</strong>
            </div>
            <div class="hc-dashboard-metric">
                <span>Fulfilled Revenue</span>
                <strong>Rp {{ number_format((float) $totalRevenue, 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="hc-dashboard-divider"></div>

        <div class="hc-dashboard-stack">
            @foreach ($statusFilters as $filter)
                <a href="{{ $filter['url'] }}" class="hc-dashboard-status-row">
                    <span class="hc-dashboard-status-row__icon">
                        <x-filament::icon :icon="$filter['icon']" class="hc-dashboard-status-row__svg" />
                    </span>
                    <span class="hc-dashboard-status-row__label">{{ $filter['label'] }}</span>
                    <strong>{{ $filter['count'] }}</strong>
                </a>
            @endforeach
        </div>
    </section>
</x-filament-widgets::widget>
