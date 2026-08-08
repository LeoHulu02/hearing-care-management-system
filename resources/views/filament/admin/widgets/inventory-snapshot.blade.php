<x-filament-widgets::widget>
    <section class="hc-dashboard-grid">
        <div class="hc-dashboard-card">
            <div class="hc-dashboard-card__header">
                <div>
                    <p class="hc-dashboard-card__kicker">Inventory</p>
                    <h2 class="hc-dashboard-card__title">Stock Snapshot</h2>
                </div>
                <a href="{{ $productsUrl }}" class="hc-dashboard-card__link">Products</a>
            </div>

            <div class="hc-dashboard-metrics hc-dashboard-metrics--three">
                <div class="hc-dashboard-metric">
                    <span>Total Stock</span>
                    <strong>{{ $totalStock }}</strong>
                </div>
                <div class="hc-dashboard-metric">
                    <span>In Stock</span>
                    <strong>{{ $productsInStock }}</strong>
                </div>
                <div class="hc-dashboard-metric">
                    <span>Out</span>
                    <strong>{{ $outOfStockProducts }}</strong>
                </div>
            </div>

            <div class="hc-dashboard-list">
                @forelse ($lowStockProducts as $product)
                    <div class="hc-dashboard-list__item">
                        <span>{{ $product->name }}</span>
                        <strong>{{ $product->stock }} left</strong>
                    </div>
                @empty
                    <div class="hc-dashboard-list__empty">No low-stock product.</div>
                @endforelse
            </div>
        </div>

        <div class="hc-dashboard-card">
            <div class="hc-dashboard-card__header">
                <div>
                    <p class="hc-dashboard-card__kicker">Customers</p>
                    <h2 class="hc-dashboard-card__title">Latest Accounts</h2>
                </div>
                <a href="{{ $customersUrl }}" class="hc-dashboard-card__link">Customers</a>
            </div>

            <div class="hc-dashboard-list">
                @forelse ($latestCustomers as $customer)
                    <div class="hc-dashboard-list__item">
                        <span>
                            <strong>{{ $customer->name }}</strong>
                            <small>{{ $customer->email }}</small>
                        </span>
                        <em>{{ $customer->created_at?->format('d M') }}</em>
                    </div>
                @empty
                    <div class="hc-dashboard-list__empty">No customer accounts yet.</div>
                @endforelse
            </div>
        </div>
    </section>
</x-filament-widgets::widget>
