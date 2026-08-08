@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="hc-section-kicker mb-3">Pesanan Saya</div>
            <h1 class="hc-page-title" style="font-family: var(--font-display)">Riwayat Pesanan</h1>
            <p class="hc-page-subtitle">Pantau status pesanan alat bantu dengar Anda.</p>
        </div>
        <a href="{{ route('orders.create') }}" class="hc-button-primary text-sm">
            Buat Pesanan Baru
        </a>
    </div>

    <div class="overflow-hidden hc-card-elevated">
        <table class="hc-table">
            <thead class="bg-slate-50">
                <tr>
                    <th>Kode Pesanan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($orders as $order)
                    <tr class="transition hover:bg-teal-50/30">
                        <td class="font-medium text-slate-900">{{ $order->order_code }}</td>
                        <td class="text-slate-700">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="font-semibold text-hc-primary">Rp {{ number_format((float) $order->total_price, 0, ',', '.') }}</td>
                        <td>
                            <x-status-badge :status="$order->status" />
                        </td>
                        <td class="text-right">
                            <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center rounded-full border border-hc-border bg-white px-3 py-1.5 text-xs font-medium text-hc-text transition hover:border-teal-200 hover:bg-teal-50 hover:text-hc-primary focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2" aria-label="Lihat pesanan {{ $order->order_code }}">
                                Lihat
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center">
                            <svg class="mx-auto h-10 w-10 text-hc-muted/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p class="mt-3 font-semibold text-hc-text">Belum ada pesanan</p>
                            <p class="mt-1 text-sm text-hc-muted">Jelajahi katalog produk dan buat pesanan pertama Anda.</p>
                            <a href="{{ route('products.index') }}" class="hc-button-primary mt-4 inline-flex text-sm">
                                Lihat Produk
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
@endsection
