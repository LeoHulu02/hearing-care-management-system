<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function generateOrderCode(): string
    {
        $year = now()->format('Y');
        $prefix = "ORD-{$year}-";

        $latestCode = Order::query()
            ->where('order_code', 'like', $prefix.'%')
            ->orderByDesc('order_code')
            ->value('order_code');

        $nextSequence = 1;

        if ($latestCode) {
            $lastSequence = (int) substr($latestCode, -4);
            $nextSequence = $lastSequence + 1;
        }

        return $prefix.str_pad((string) $nextSequence, 4, '0', STR_PAD_LEFT);
    }

    public function createOrder(User $user, int $productId, int $quantity): Order
    {
        $maxAttempts = 3;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                return DB::transaction(function () use ($user, $productId, $quantity): Order {
                    $product = Product::query()->lockForUpdate()->findOrFail($productId);

                    if ($quantity > $product->stock) {
                        throw ValidationException::withMessages([
                            'quantity' => "Available stock is {$product->stock}.",
                        ]);
                    }

                    $price = (float) $product->price;
                    $subtotal = $price * $quantity;

                    $order = Order::create([
                        'user_id' => $user->id,
                        'order_code' => $this->generateOrderCode(),
                        'total_price' => $subtotal,
                        'status' => Order::STATUS_PENDING,
                    ]);

                    $order->orderItems()->create([
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                        'subtotal' => $subtotal,
                    ]);

                    return $order->load(['user', 'orderItems.product']);
                });
            } catch (QueryException $exception) {
                $isDuplicateOrderCode = str_contains(strtolower($exception->getMessage()), 'orders_order_code_unique');

                if ($isDuplicateOrderCode && $attempt < $maxAttempts) {
                    continue;
                }

                throw $exception;
            }
        }

        throw ValidationException::withMessages([
            'order' => 'Unable to generate a unique order code. Please try again.',
        ]);
    }
}
