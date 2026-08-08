@extends('layouts.app')

@section('content')
    <nav class="hc-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('orders.index') }}">Riwayat Pesanan</a>
        <span class="hc-breadcrumb-sep" aria-hidden="true">›</span>
        <span class="text-hc-text font-medium">{{ $order->order_code }}</span>
    </nav>

    <div class="mb-4 hc-card-elevated p-4">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Detail Pesanan</p>
                <h1 class="mt-1 text-xl font-semibold tracking-tight text-slate-900" style="font-family: var(--font-display)">Pesanan {{ $order->order_code }}</h1>
                <p class="mt-1 text-xs text-hc-muted">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            <x-status-badge :status="$order->status" class="px-3 py-1 text-sm" />
        </div>

        {{-- Status stepper --}}
        @php
            $statuses = ['pending', 'processing', 'completed'];
            $currentIndex = array_search($order->status, $statuses);
            $isCancelled = $order->status === 'cancelled';
        @endphp
        @if (! $isCancelled)
            <div class="mt-5 flex items-center gap-0" role="list" aria-label="Status pesanan">
                @foreach ($statuses as $i => $step)
                    <div class="flex flex-1 items-center" role="listitem">
                        <div class="flex flex-col items-center gap-1 shrink-0">
                            <span class="flex h-7 w-7 items-center justify-center rounded-full text-xs font-bold transition-all
                                @if ($currentIndex !== false && $i < $currentIndex) bg-emerald-500 text-white
                                @elseif ($i === $currentIndex) bg-hc-primary text-white shadow-sm shadow-teal-900/20
                                @else border-2 border-hc-border bg-white text-hc-muted @endif"
                                aria-current="{{ $i === $currentIndex ? 'step' : 'false' }}">
                                @if ($currentIndex !== false && $i < $currentIndex)
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                @else
                                    {{ $i + 1 }}
                                @endif
                            </span>
                            <span class="text-[10px] font-semibold uppercase tracking-wide
                                @if ($i === $currentIndex) text-hc-primary
                                @elseif ($currentIndex !== false && $i < $currentIndex) text-emerald-600
                                @else text-hc-muted @endif">
                                @if ($step === 'pending') Menunggu
                                @elseif ($step === 'processing') Diproses
                                @else Selesai @endif
                            </span>
                        </div>
                        @if (! $loop->last)
                            <div class="flex-1 border-t-2 mx-2 @if ($currentIndex !== false && $i < $currentIndex) border-emerald-400 @else border-hc-border @endif"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="overflow-hidden hc-card-elevated">
        <table class="hc-table">
            <thead class="bg-slate-50">
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach ($order->orderItems as $item)
                    <tr class="transition hover:bg-teal-50/30">
                        <td class="font-medium text-slate-900">{{ $item->product->name }}</td>
                        <td class="text-slate-700">{{ $item->quantity }}</td>
                        <td class="text-slate-700">Rp {{ number_format((float) $item->price, 0, ',', '.') }}</td>
                        <td class="font-medium text-slate-900">Rp {{ number_format((float) $item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-slate-50">
                <tr>
                    <td colspan="3" class="px-4 py-3 text-right text-sm font-semibold text-slate-700">Total Pembayaran</td>
                    <td class="px-4 py-3 text-sm font-bold text-hc-primary">Rp {{ number_format((float) $order->total_price, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
