@props(['product'])

<article class="hc-card p-4 transition hover:-translate-y-0.5 hover:shadow-md">
    <div class="mb-4 aspect-[16/9] overflow-hidden rounded-lg border border-hc-border bg-slate-100">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
        @else
            <div class="flex h-full w-full items-center justify-center text-sm text-hc-muted">No product image</div>
        @endif
    </div>

    <div class="mb-2 flex items-start justify-between gap-3">
        <h2 class="font-semibold text-hc-text">{{ $product->name }}</h2>
        <x-status-badge :status="$product->stock > 0 ? 'in_stock' : 'out_of_stock'" />
    </div>

    <p class="mb-4 text-sm text-hc-muted">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>

    <div class="flex items-center justify-between">
        <p class="text-lg font-semibold text-hc-primary">Rp {{ number_format((float) $product->price, 0, ',', '.') }}</p>
        <a href="{{ route('products.show', $product) }}" class="rounded-md bg-hc-primary px-3 py-1.5 text-sm font-medium text-white transition hover:brightness-95">
            View Detail
        </a>
    </div>
</article>
