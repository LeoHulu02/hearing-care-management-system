<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {
    }

    public function index(Request $request): View
    {
        $orders = Order::query()
            ->where('user_id', $request->user()->id)
            ->with(['orderItems.product'])
            ->latest()
            ->paginate(10);

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    public function create(Request $request): View
    {
        $products = Product::query()
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('orders.create', [
            'products' => $products,
            'selectedProductId' => (int) $request->query('product'),
        ]);
    }

    public function store(CreateOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $order = $this->orderService->createOrder(
            $request->user(),
            (int) $validated['product_id'],
            (int) $validated['quantity']
        );

        return redirect()
            ->route('orders.show', $order)
            ->with('status', 'Order created successfully.');
    }

    public function show(Request $request, Order $order): View
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        $order->loadMissing(['orderItems.product', 'user']);

        return view('orders.show', [
            'order' => $order,
        ]);
    }
}
