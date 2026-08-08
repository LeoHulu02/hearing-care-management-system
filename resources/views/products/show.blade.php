@extends('layouts.app')

@section('content')
    <nav class="hc-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('products.index') }}">Produk</a>
        <span class="hc-breadcrumb-sep" aria-hidden="true">›</span>
        <span class="text-hc-text font-medium">{{ $product->name }}</span>
    </nav>

    <div class="grid gap-6 lg:grid-cols-12 lg:gap-10 items-start">
        <div class="lg:col-span-5 xl:col-span-4">
            <div class="hc-card-elevated overflow-hidden">
                <div class="aspect-square bg-gradient-to-br from-slate-100 to-teal-50">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Foto produk {{ $product->name }}" class="h-full w-full object-cover">
                    @else
                        <img src="https://loremflickr.com/800/800/hearingaid,earbud?lock={{ $product->id }}" alt="Foto produk {{ $product->name }}" class="h-full w-full object-cover">
                    @endif
                </div>
            </div>
        </div>

        <aside class="space-y-4 lg:col-span-7 xl:col-span-8">
            <div class="hc-card-elevated p-3 sm:p-4">
                <div class="hc-section-kicker mb-2 sm:mb-3">Detail Produk</div>
                <div class="mb-2 flex flex-wrap items-start justify-between gap-2">
                    <h1 class="text-lg font-semibold tracking-tight text-hc-text sm:text-xl" style="font-family: var(--font-display)">{{ $product->name }}</h1>
                    <x-status-badge :status="$product->stock > 0 ? 'in_stock' : 'out_of_stock'" />
                </div>

                <p class="mb-3 text-xl font-bold text-hc-primary sm:mb-4 sm:text-2xl">Rp {{ number_format((float) $product->price, 0, ',', '.') }}</p>

                <div class="mb-3 rounded-xl border border-hc-border bg-slate-50 p-2.5 sm:mb-4 sm:p-3">
                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Stok Tersedia</p>
                    <p class="mt-1 text-sm font-semibold text-hc-text sm:text-base">{{ $product->stock }} unit</p>
                </div>

                @if ($product->stock > 0)
                    <a href="{{ route('orders.create', ['product' => $product->id]) }}" class="hc-button-primary inline-flex w-full justify-center text-sm">
                        Pesan Produk Ini
                    </a>
                @else
                    <button type="button" class="hc-button-primary w-full cursor-not-allowed justify-center opacity-50" disabled aria-disabled="true">
                        Stok Habis
                    </button>
                @endif
            </div>

            <div class="hc-card p-3 sm:p-4">
                <h2 class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Deskripsi Produk</h2>
                <p class="mt-1.5 text-sm leading-relaxed text-slate-700">{{ $product->description ?: 'Deskripsi belum tersedia.' }}</p>
            </div>
        </aside>
    </div>
@endsection
