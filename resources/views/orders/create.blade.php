@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-5xl">
        <nav class="hc-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('products.index') }}">Produk</a>
            <span class="hc-breadcrumb-sep" aria-hidden="true">›</span>
            <span class="text-hc-text font-medium">Buat Pesanan</span>
        </nav>

        <div class="mb-6">
            <div class="hc-section-kicker mb-3">Pesanan Baru</div>
            <h1 class="hc-page-title" style="font-family: var(--font-display)">Buat Pesanan</h1>
            <p class="hc-page-subtitle">Pilih produk dan jumlah untuk membuat pesanan baru.</p>
        </div>

        <div class="grid gap-4 lg:grid-cols-[0.65fr_0.35fr]">
            <form id="order-form" method="POST" action="{{ route('orders.store') }}" class="hc-card-elevated space-y-5 p-5 sm:p-6">
                @csrf

                <div>
                    <label for="product_id" class="hc-label">Produk</label>
                    <select id="product_id" name="product_id" class="hc-input" required>
                        <option value="">— Pilih produk —</option>
                        @foreach ($products as $product)
                            <option
                                value="{{ $product->id }}"
                                data-price="{{ $product->price }}"
                                data-stock="{{ $product->stock }}"
                                @selected((int) old('product_id', $selectedProductId) === $product->id)
                            >
                                {{ $product->name }} — Rp {{ number_format((float) $product->price, 0, ',', '.') }} (Stok: {{ $product->stock }})
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="mt-1.5 flex items-center gap-1.5 text-sm text-rose-600">
                            <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="quantity" class="hc-label">Jumlah</label>
                    <div class="flex items-center gap-0 rounded-lg border border-hc-border bg-white focus-within:border-hc-primary focus-within:ring-2 focus-within:ring-teal-500/20">
                        <button type="button" id="qty-minus" aria-label="Kurangi jumlah"
                            class="flex h-10 w-11 shrink-0 items-center justify-center rounded-l-lg border-r border-hc-border text-hc-muted transition hover:bg-slate-50 hover:text-hc-text focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                        </button>
                        <input id="quantity" name="quantity" type="number" min="1" value="{{ old('quantity', 1) }}"
                            class="w-full border-0 bg-transparent py-2 text-center text-sm font-medium text-hc-text focus:outline-none focus:ring-0" required>
                        <button type="button" id="qty-plus" aria-label="Tambah jumlah"
                            class="flex h-10 w-11 shrink-0 items-center justify-center rounded-r-lg border-l border-hc-border text-hc-muted transition hover:bg-slate-50 hover:text-hc-text focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </button>
                    </div>
                    @error('quantity')
                        <p class="mt-1.5 flex items-center gap-1.5 text-sm text-rose-600">
                            <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Live total preview --}}
                <div id="total-preview" class="hidden rounded-xl border border-teal-100 bg-teal-50 p-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-teal-700">Estimasi Total</p>
                    <p id="total-value" class="mt-0.5 text-xl font-bold text-hc-primary">Rp 0</p>
                </div>

                <div class="flex flex-col gap-3 border-t border-hc-border pt-4 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ route('orders.index') }}" class="hc-link text-sm">Lihat riwayat pesanan</a>
                    <button type="submit" class="hc-button-primary text-sm">
                        Konfirmasi &amp; Pesan
                    </button>
                </div>
            </form>

            <aside class="hc-soft-panel p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Sebelum memesan</p>
                <ul class="mt-4 space-y-3 text-sm leading-relaxed text-hc-muted">
                    <li class="flex gap-2.5">
                        <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-hc-primary text-[10px] font-bold text-white">1</span>
                        Pastikan stok produk tersedia sebelum memilih.
                    </li>
                    <li class="flex gap-2.5">
                        <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-hc-primary text-[10px] font-bold text-white">2</span>
                        Total pesanan dihitung otomatis berdasarkan harga saat ini.
                    </li>
                    <li class="flex gap-2.5">
                        <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-hc-primary text-[10px] font-bold text-white">3</span>
                        Pantau status pesanan dari halaman riwayat pesanan Anda.
                    </li>
                </ul>
            </aside>
        </div>
    </div>

    <script>
        (function () {
            const productSelect = document.getElementById('product_id');
            const quantityInput = document.getElementById('quantity');
            const qtyMinus = document.getElementById('qty-minus');
            const qtyPlus = document.getElementById('qty-plus');
            const totalPreview = document.getElementById('total-preview');
            const totalValue = document.getElementById('total-value');

            function formatRupiah(n) {
                return 'Rp ' + Math.round(n).toLocaleString('id-ID');
            }

            function updateTotal() {
                const selected = productSelect.options[productSelect.selectedIndex];
                const price = parseFloat(selected?.dataset?.price || 0);
                const qty = parseInt(quantityInput.value) || 0;
                const maxStock = parseInt(selected?.dataset?.stock || 0);

                if (price > 0 && qty > 0) {
                    if (qty > maxStock && maxStock > 0) {
                        quantityInput.value = maxStock;
                    }
                    totalPreview.classList.remove('hidden');
                    totalValue.textContent = formatRupiah(price * (parseInt(quantityInput.value) || 0));
                } else {
                    totalPreview.classList.add('hidden');
                }
            }

            qtyMinus.addEventListener('click', function () {
                const val = parseInt(quantityInput.value) || 1;
                if (val > 1) { quantityInput.value = val - 1; updateTotal(); }
            });

            qtyPlus.addEventListener('click', function () {
                const selected = productSelect.options[productSelect.selectedIndex];
                const maxStock = parseInt(selected?.dataset?.stock || 0);
                const val = parseInt(quantityInput.value) || 1;
                if (maxStock === 0 || val < maxStock) { quantityInput.value = val + 1; updateTotal(); }
            });

            productSelect.addEventListener('change', updateTotal);
            quantityInput.addEventListener('input', updateTotal);

            // Init on load (e.g. after validation error)
            updateTotal();
        })();
    </script>
@endsection
