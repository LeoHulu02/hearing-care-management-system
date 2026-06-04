@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-2xl hc-card p-6">
        <h1 class="mb-2 hc-page-title">Create Order</h1>
        <p class="mb-6 hc-page-subtitle">Select a product and quantity to place a new order.</p>

        <form method="POST" action="{{ route('orders.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="product_id" class="mb-1 block text-sm font-medium text-slate-700">Product</label>
                <select id="product_id" name="product_id" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none" required>
                    <option value="">Select a product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @selected((int) old('product_id', $selectedProductId) === $product->id)>
                            {{ $product->name }} - Rp {{ number_format((float) $product->price, 0, ',', '.') }} (Stock: {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
                @error('product_id') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="quantity" class="mb-1 block text-sm font-medium text-slate-700">Quantity</label>
                <input id="quantity" name="quantity" type="number" min="1" value="{{ old('quantity', 1) }}" class="w-full rounded-md border border-slate-300 px-3 py-2 focus:border-teal-600 focus:outline-none" required>
                @error('quantity') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('orders.index') }}" class="text-sm font-medium text-hc-muted hover:text-hc-primary">View order history</a>
                <button type="submit" class="hc-button-primary">
                    Place Order
                </button>
            </div>
        </form>
    </div>
@endsection
