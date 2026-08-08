@props(['status'])

@php
    $status = strtolower((string) $status);

    $map = [
        'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-700'],
        'processing' => ['label' => 'Processing', 'class' => 'bg-blue-100 text-blue-700'],
        'completed' => ['label' => 'Completed', 'class' => 'bg-emerald-100 text-emerald-700'],
        'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-rose-100 text-rose-700'],
        'in_stock' => ['label' => 'In Stock', 'class' => 'bg-emerald-100 text-emerald-700'],
        'out_of_stock' => ['label' => 'Out of Stock', 'class' => 'bg-rose-100 text-rose-700'],
    ];

    $entry = $map[$status] ?? ['label' => ucfirst(str_replace('_', ' ', $status)), 'class' => 'bg-slate-100 text-slate-700'];
@endphp

<span {{ $attributes->class("rounded-full px-2 py-0.5 text-[11px] font-medium {$entry['class']}") }}>
    {{ $entry['label'] }}
</span>
