@extends('layouts.app')

@section('content')
    <section class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
        <div class="relative">
            <div class="hc-section-kicker mb-5">
                <span class="h-2 w-2 rounded-full bg-hc-primary"></span>
                Hearing Care Order Management
            </div>
            <h1 class="max-w-3xl text-4xl font-bold tracking-tight text-hc-text sm:text-5xl lg:text-6xl">
                Kelola pemesanan alat bantu dengar dengan lebih jelas.
            </h1>
            <p class="mt-5 max-w-2xl text-base leading-8 text-hc-muted sm:text-lg">
                Lihat katalog produk, cek stok, buat pesanan, dan pantau status order dalam satu alur yang sederhana untuk customer.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                @auth
                    @if (auth()->user()->isCustomer())
                        <a href="{{ route('products.index') }}" class="hc-button-primary text-center text-sm">Browse Products</a>
                        <a href="{{ route('orders.index') }}" class="hc-button-secondary text-center text-sm">View Orders</a>
                    @else
                        <a href="{{ url('/admin') }}" class="hc-button-primary text-center text-sm">Open Admin Panel</a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="hc-button-primary text-center text-sm">Create Customer Account</a>
                    <a href="{{ route('login') }}" class="hc-button-secondary text-center text-sm">Login</a>
                @endauth
            </div>

            <div class="mt-8 grid gap-2.5 sm:grid-cols-3">
                <div class="hc-card p-3">
                    <p class="text-xl font-bold text-hc-text">01</p>
                    <p class="mt-1 text-xs font-semibold uppercase tracking-wide text-hc-muted">Catalog</p>
                </div>
                <div class="hc-card p-3">
                    <p class="text-xl font-bold text-hc-text">02</p>
                    <p class="mt-1 text-xs font-semibold uppercase tracking-wide text-hc-muted">Order</p>
                </div>
                <div class="hc-card p-3">
                    <p class="text-xl font-bold text-hc-text">03</p>
                    <p class="mt-1 text-xs font-semibold uppercase tracking-wide text-hc-muted">Track</p>
                </div>
            </div>
        </div>

        <div class="hc-card-elevated overflow-hidden">
            <div class="border-b border-hc-border/70 bg-gradient-to-r from-slate-50 to-teal-50 px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Order Flow</p>
                <h2 class="mt-1 text-lg font-semibold tracking-tight text-hc-text">From product to status tracking</h2>
            </div>
            <div class="space-y-3 p-4 sm:p-5">
                <div class="flex gap-3 rounded-xl border border-hc-border bg-white p-3 shadow-sm">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-teal-50 text-xs font-bold text-hc-primary">1</span>
                    <div>
                        <p class="text-sm font-semibold text-hc-text">Browse hearing aid products</p>
                        <p class="mt-1 text-sm leading-relaxed text-hc-muted">Bandingkan detail, harga, dan ketersediaan stok sebelum order.</p>
                    </div>
                </div>
                <div class="flex gap-3 rounded-xl border border-hc-border bg-white p-3 shadow-sm">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-teal-50 text-xs font-bold text-hc-primary">2</span>
                    <div>
                        <p class="text-sm font-semibold text-hc-text">Place an order</p>
                        <p class="mt-1 text-sm leading-relaxed text-hc-muted">Pilih produk dan quantity dengan form yang ringkas dan mudah dipahami.</p>
                    </div>
                </div>
                <div class="flex gap-3 rounded-xl border border-hc-border bg-white p-3 shadow-sm">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-teal-50 text-xs font-bold text-hc-primary">3</span>
                    <div>
                        <p class="text-sm font-semibold text-hc-text">Track progress</p>
                        <p class="mt-1 text-sm leading-relaxed text-hc-muted">Status pending, processing, completed, atau cancelled tampil konsisten.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
