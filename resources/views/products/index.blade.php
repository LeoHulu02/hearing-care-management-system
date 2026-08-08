@extends('layouts.app')

@section('content')
    <div class="mb-3 flex flex-col gap-2 sm:mb-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="hc-section-kicker mb-2">Katalog Produk</div>
            <h1 class="text-xl font-bold tracking-tight text-slate-800 sm:text-2xl" style="font-family: var(--font-display)">Alat Bantu Dengar</h1>
            <p class="mt-1 text-xs text-hc-muted sm:text-sm">Telusuri produk tersedia dan tinjau detail sebelum memesan.</p>
        </div>
        <div class="w-fit rounded-full border border-hc-border bg-white px-2.5 py-1 text-[11px] font-medium text-hc-muted shadow-sm sm:px-3 sm:py-1.5 sm:text-xs">
            {{ $products->total() }} produk
        </div>
    </div>

    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4 xl:gap-4">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <div class="hc-empty-state col-span-full">
                <svg class="mx-auto h-10 w-10 text-hc-muted/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z" />
                </svg>
                <p class="mt-3 font-semibold text-hc-text">Belum ada produk tersedia</p>
                <p class="mt-1 text-sm">Silakan cek kembali nanti untuk produk alat bantu dengar terbaru.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
