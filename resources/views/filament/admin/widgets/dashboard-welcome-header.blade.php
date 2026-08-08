<x-filament-widgets::widget>
    <div class="hc-dashboard-hero">
        <div class="hc-dashboard-hero__accent"></div>
        <div class="hc-dashboard-hero__glow"></div>

        <div class="hc-dashboard-hero__inner">
            <div class="hc-dashboard-hero__main">
                <div class="hc-dashboard-hero__heading-row">
                    <div class="hc-dashboard-hero__icon-box">
                        <x-filament::icon
                            icon="heroicon-o-chart-bar-square"
                            class="hc-dashboard-hero__icon-svg"
                        />
                    </div>

                    <div class="hc-dashboard-hero__heading-text">
                        <p class="hc-dashboard-hero__eyebrow">Admin Dashboard</p>
                        <h1 class="hc-dashboard-hero__title">Selamat datang, {{ $userName }}</h1>
                    </div>
                </div>

                <p class="hc-dashboard-hero__desc">
                    Pantau performa bisnis, prioritaskan pesanan aktif, dan jaga kualitas layanan Hearing Care dari satu tempat yang rapi.
                </p>

                <div class="hc-dashboard-hero__badges">
                    <span class="hc-dashboard-hero__badge">
                        <x-filament::icon icon="heroicon-m-clock" class="hc-dashboard-hero__badge-icon" />
                        <span>{{ $pendingOrders }} pending</span>
                    </span>
                    <span class="hc-dashboard-hero__badge">
                        <x-filament::icon icon="heroicon-m-arrow-path" class="hc-dashboard-hero__badge-icon" />
                        <span>{{ $processingOrders }} processing</span>
                    </span>
                    <span class="hc-dashboard-hero__badge">
                        <x-filament::icon icon="heroicon-m-calendar-days" class="hc-dashboard-hero__badge-icon" />
                        <span>{{ now()->translatedFormat('l, d M Y') }}</span>
                    </span>
                </div>
            </div>

            <div class="hc-dashboard-hero__links">
                @foreach ($quickLinks as $link)
                    <a href="{{ $link['url'] }}" class="hc-dashboard-hero__link">
                        <span class="hc-dashboard-hero__link-icon">
                            <x-filament::icon :icon="$link['icon']" class="hc-dashboard-hero__link-icon-svg" />
                        </span>
                        <span class="hc-dashboard-hero__link-text">
                            <span class="hc-dashboard-hero__link-label">{{ $link['label'] }}</span>
                            <span class="hc-dashboard-hero__link-desc">{{ $link['description'] }}</span>
                        </span>
                        <x-filament::icon
                            icon="heroicon-m-chevron-right"
                            class="hc-dashboard-hero__link-chevron"
                        />
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
