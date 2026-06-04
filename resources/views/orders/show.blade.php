@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('orders.index') }}" class="text-sm font-medium text-hc-primary hover:brightness-90">&larr; Back to orders</a>
    </div>

    <div class="mb-6 hc-card p-6">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Order {{ $order->order_code }}</h1>
                <p class="mt-1 text-sm text-slate-600">Placed on {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
            <x-status-badge :status="$order->status" class="px-3 py-1 text-sm" />
        </div>
    </div>

    <div class="overflow-hidden hc-card">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Product</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Qty</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Price</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ $item->product->name }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $item->quantity }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">Rp {{ number_format((float) $item->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-sm font-medium text-slate-900">Rp {{ number_format((float) $item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-slate-50">
                <tr>
                    <td colspan="3" class="px-4 py-3 text-right text-sm font-semibold text-slate-700">Total</td>
                    <td class="px-4 py-3 text-sm font-semibold text-teal-700">Rp {{ number_format((float) $order->total_price, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
