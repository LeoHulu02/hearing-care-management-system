@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('products.index') }}" class="text-sm font-medium text-hc-primary hover:brightness-90">&larr; Back to products</a>
    </div>

    <div class="grid gap-6 hc-card p-6 lg:grid-cols-2">
        <div class="overflow-hidden rounded-lg border border-hc-border bg-slate-100">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
            @else
                <div class="flex min-h-72 items-center justify-center text-sm text-hc-muted">No product image</div>
            @endif
        </div>

        <div>
            <div class="mb-3 flex items-center gap-3">
                <h1 class="text-2xl font-semibold text-hc-text">{{ $product->name }}</h1>
                <x-status-badge :status="$product->stock > 0 ? 'in_stock' : 'out_of_stock'" />
            </div>

            <p class="mb-4 text-3xl font-semibold text-hc-primary">Rp {{ number_format((float) $product->price, 0, ',', '.') }}</p>

            <div class="mb-4 rounded-lg border border-hc-border bg-slate-50 p-4">
                <p class="text-sm text-hc-muted">Available Stock</p>
                <p class="text-lg font-semibold text-hc-text">{{ $product->stock }} unit(s)</p>
            </div>

            <div>
                <h2 class="mb-2 text-sm font-semibold uppercase tracking-wide text-hc-muted">Description</h2>
                <p class="leading-relaxed text-slate-700">{{ $product->description ?: 'No description provided.' }}</p>
            </div>

            <div class="mt-6">
                @if ($product->stock > 0)
                    <a href="{{ route('orders.create', ['product' => $product->id]) }}" class="inline-flex rounded-md bg-hc-primary px-4 py-2 font-medium text-white transition hover:brightness-95">
                        Order This Product
                    </a>
                @else
                    <button type="button" class="inline-flex cursor-not-allowed rounded-md bg-slate-300 px-4 py-2 font-medium text-white" disabled>
                        Out of Stock
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection
