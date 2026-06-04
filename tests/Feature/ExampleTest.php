<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_from_home(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }

    public function test_customer_login_redirects_to_profile(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_CUSTOMER,
            'phone' => '081111111111',
            'password' => 'password',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('profile.edit'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_login_redirects_to_admin_panel(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'phone' => '082222222222',
            'password' => 'password',
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($admin);
    }

    public function test_customer_can_view_product_list_and_detail(): void
    {
        $customer = User::factory()->create([
            'role' => User::ROLE_CUSTOMER,
            'phone' => '083333333333',
        ]);

        $product = Product::create([
            'name' => 'Test Hearing Aid',
            'image' => null,
            'price' => 5000000,
            'stock' => 5,
            'description' => 'Sample description.',
        ]);

        $listResponse = $this->actingAs($customer)->get(route('products.index'));
        $listResponse->assertOk()->assertSee('Test Hearing Aid');

        $detailResponse = $this->actingAs($customer)->get(route('products.show', $product));
        $detailResponse->assertOk()->assertSee('Sample description.');
    }

    public function test_guest_cannot_access_products_routes(): void
    {
        $product = Product::create([
            'name' => 'Guest Block Product',
            'image' => null,
            'price' => 1000000,
            'stock' => 2,
            'description' => 'Protected route.',
        ]);

        $this->get(route('products.index'))->assertRedirect(route('login'));
        $this->get(route('products.show', $product))->assertRedirect(route('login'));
    }

    public function test_customer_can_create_order_and_get_generated_order_code(): void
    {
        $customer = User::factory()->create([
            'role' => User::ROLE_CUSTOMER,
            'phone' => '084444444444',
        ]);

        $product = Product::create([
            'name' => 'Order Product',
            'image' => null,
            'price' => 2750000,
            'stock' => 8,
            'description' => 'Order test.',
        ]);

        $response = $this->actingAs($customer)->post(route('orders.store'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $order = Order::first();

        $response->assertRedirect(route('orders.show', $order));
        $this->assertNotNull($order);
        $this->assertMatchesRegularExpression('/^ORD-\d{4}-\d{4}$/', $order->order_code);
        $this->assertSame(Order::STATUS_PENDING, $order->status);
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_customer_cannot_order_more_than_available_stock(): void
    {
        $customer = User::factory()->create([
            'role' => User::ROLE_CUSTOMER,
            'phone' => '085555555555',
        ]);

        $product = Product::create([
            'name' => 'Limited Product',
            'image' => null,
            'price' => 1200000,
            'stock' => 1,
            'description' => 'Low stock.',
        ]);

        $response = $this->from(route('orders.create'))->actingAs($customer)->post(route('orders.store'), [
            'product_id' => $product->id,
            'quantity' => 5,
        ]);

        $response->assertRedirect(route('orders.create'));
        $response->assertSessionHasErrors('quantity');
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_stock_is_reduced_when_order_status_becomes_completed(): void
    {
        $customer = User::factory()->create([
            'role' => User::ROLE_CUSTOMER,
            'phone' => '086666666666',
        ]);

        $product = Product::create([
            'name' => 'Stock Deduction Product',
            'image' => null,
            'price' => 3000000,
            'stock' => 6,
            'description' => 'Stock deduction test.',
        ]);

        $order = Order::create([
            'user_id' => $customer->id,
            'order_code' => 'ORD-2026-0001',
            'total_price' => 6000000,
            'status' => Order::STATUS_PENDING,
        ]);

        $order->orderItems()->create([
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => 3000000,
            'subtotal' => 6000000,
        ]);

        $order->update(['status' => Order::STATUS_COMPLETED]);

        $this->assertSame(4, $product->fresh()->stock);
    }
}
