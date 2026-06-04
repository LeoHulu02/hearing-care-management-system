@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-end justify-between">
        <div>
            <h1 class="hc-page-title">Order History</h1>
            <p class="hc-page-subtitle">Track your hearing aid orders and their latest status.</p>
        </div>
        <a href="{{ route('orders.create') }}" class="hc-button-primary text-sm">
            New Order
        </a>
    </div>

    <div class="overflow-hidden hc-card">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Order Code</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Total Price</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Status</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($orders as $order)
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $order->order_code }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">Rp {{ number_format((float) $order->total_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            <x-status-badge :status="$order->status" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('orders.show', $order) }}" class="text-sm font-medium text-hc-primary hover:brightness-90">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-sm text-slate-500">No orders found yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
@endsection
