@props(['product'])

<article class="hc-card-elevated flex flex-col p-2.5 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md sm:p-3">
    <div class="group relative mb-2 aspect-[5/3] overflow-hidden rounded-xl border border-hc-border/60 bg-gradient-to-br from-slate-50 to-teal-50">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <img src="https://loremflickr.com/600/400/hearingaid,earbud?lock={{ $product->id }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
        @endif
    </div>

    <div class="mb-1.5 flex items-start justify-between gap-2">
        <h2 class="text-sm font-semibold leading-tight tracking-tight text-hc-text">{{ $product->name }}</h2>
        <div class="mt-0.5 shrink-0">
            <x-status-badge :status="$product->stock > 0 ? 'in_stock' : 'out_of_stock'" />
        </div>
    </div>

    <p class="mb-3 flex-grow text-xs leading-relaxed text-hc-muted">{{ \Illuminate\Support\Str::limit($product->description, 80) ?: 'Deskripsi belum tersedia.' }}</p>

    <div class="mt-auto flex flex-col gap-2 border-t border-slate-100 pt-2 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-col">
            <span class="mb-0.5 text-[11px] text-hc-muted">Price</span>
            <p class="text-sm font-bold text-hc-primary">Rp {{ number_format((float) $product->price, 0, ',', '.') }}</p>
        </div>
        <a href="{{ route('products.show', $product) }}" class="inline-flex justify-center rounded-full bg-hc-primary px-4 py-2 text-xs font-medium text-white transition-all hover:bg-hc-primary-dark hover:shadow-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 active:scale-[0.97]" aria-label="Lihat detail {{ $product->name }}">
            Lihat Detail
        </a>
    </div>
</article>
