<x-filament-widgets::widget>
    <section class="hc-dashboard-card hc-dashboard-card--flush">
        <div class="hc-dashboard-card__header">
            <div>
                <p class="hc-dashboard-card__kicker">Order Queue</p>
                <h2 class="hc-dashboard-card__title">Recent Orders</h2>
            </div>
            <a href="{{ $ordersUrl }}" class="hc-dashboard-card__link">View all</a>
        </div>

        <div class="hc-dashboard-filters" aria-label="Order status summary">
            @foreach ($statusFilters as $label => $count)
                <span class="hc-dashboard-filter">
                    <span>{{ $label }}</span>
                    <strong>{{ $count }}</strong>
                </span>
            @endforeach
        </div>

        <div class="hc-dashboard-table-wrap">
            <table class="hc-dashboard-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td>
                                <a href="{{ $ordersUrl }}" class="hc-dashboard-table__primary">
                                    {{ $order->order_code }}
                                </a>
                            </td>
                            <td>{{ $order->user?->name ?? '-' }}</td>
                            <td>
                                {{ $order->orderItems->pluck('product.name')->filter()->take(2)->join(', ') ?: '-' }}
                            </td>
                            <td>Rp {{ number_format((float) $order->total_price, 0, ',', '.') }}</td>
                            <td>
                                <span class="hc-dashboard-status">
                                    {{ str($order->status)->headline() }}
                                </span>
                            </td>
                            <td>{{ $order->created_at?->format('d M') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="hc-dashboard-table__empty">
                                No customer orders yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-filament-widgets::widget>
