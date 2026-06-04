@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-end justify-between">
        <div>
            <h1 class="hc-page-title">Hearing Aid Products</h1>
            <p class="hc-page-subtitle">Browse available products and review details before placing an order.</p>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-hc-border bg-white p-8 text-center text-hc-muted">
                No products are available yet.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection
