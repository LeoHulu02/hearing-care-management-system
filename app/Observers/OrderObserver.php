<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Validation\ValidationException;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if (! $order->wasChanged('status')) {
            return;
        }

        if ($order->status !== Order::STATUS_COMPLETED) {
            return;
        }

        foreach ($order->orderItems as $item) {
            $affected = Product::query()
                ->whereKey($item->product_id)
                ->where('stock', '>=', $item->quantity)
                ->decrement('stock', $item->quantity);

            if ($affected === 0) {
                throw ValidationException::withMessages([
                    'status' => "Unable to complete order {$order->order_code}: insufficient stock.",
                ]);
            }
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
