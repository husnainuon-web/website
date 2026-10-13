<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class GuestCustomerFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_browse_and_use_cart_wishlist_and_checkout(): void
    {
        $productId = $this->createProduct();

        $this->get(route('customer.products.index'))
            ->assertOk()
            ->assertSee('Guest-ready product')
            ->assertSee('id="menu-toggle"', false)
            ->assertSee('Sign In')
            ->assertSee('Register')
            ->assertSee('Wishlist')
            ->assertSee('Quotations');

        $this->post(route('customer.cart.store', $productId), ['quantity' => 2])
            ->assertRedirect(route('customer.cart.index'));
        $this->post(route('customer.wishlist.store', $productId))
            ->assertRedirect();

        $this->get(route('customer.cart.index'))
            ->assertOk()
            ->assertSee('Guest-ready product');
        $this->get(route('customer.wishlist.index'))
            ->assertOk()
            ->assertSee('Guest-ready product');

        $this->post(route('customer.checkout.store'), [
            'customer_name' => 'Guest Customer',
            'customer_email' => 'guest@example.com',
            'customer_phone' => '555-0100',
            'shipping_address' => '1 Market Street',
            'city' => 'Example City',
        ])->assertRedirect(route('customer.orders.show', 1));

        $this->assertDatabaseHas('orders', [
            'id' => 1,
            'user_id' => null,
            'customer_email' => 'guest@example.com',
            'total_amount' => 25,
        ]);
        $this->assertDatabaseHas('order_items', [
            'order_id' => 1,
            'product_id' => $productId,
            'quantity' => 2,
        ]);
        $this->get(route('customer.orders.show', 1))->assertOk()->assertSee('ZM-');
        $this->get(route('customer.orders.index'))->assertOk()->assertSee('ZM-');

        session()->forget('customer_order_ids');
        $this->get(route('customer.orders.show', 1))->assertNotFound();
    }

    public function test_guest_can_submit_an_order_request_for_an_out_of_stock_product(): void
    {
        $productId = $this->createProduct();
        DB::table('products')->where('id', $productId)->update(['stock' => 0]);

        $this->get(route('customer.products.show', $productId))
            ->assertOk()
            ->assertSee('Submit Order Request');

        $this->post(route('customer.products.order', $productId), ['quantity' => 1])
            ->assertRedirect(route('customer.checkout'));

        $this->get(route('customer.checkout'))
            ->assertOk()
            ->assertSee('confirm availability before processing');

        $this->post(route('customer.checkout.store'), [
            'customer_name' => 'Guest Customer',
            'customer_email' => 'guest@example.com',
            'shipping_address' => '1 Market Street',
        ])->assertRedirect(route('customer.orders.show', 1));

        $this->assertDatabaseHas('order_items', [
            'order_id' => 1,
            'product_id' => $productId,
            'quantity' => 1,
            'availability_requested' => true,
        ]);

        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get(route('admin.orders.show', 1))
            ->assertOk()
            ->assertSee('Confirm availability with the customer before processing');
    }

    public function test_guest_can_request_quotation_and_history_is_limited_to_the_session(): void
    {
        $productId = $this->createProduct();

        $this->post(route('customer.quotations.store', $productId), [
            'customer_name' => 'Guest Customer',
            'customer_email' => 'guest@example.com',
            'customer_phone' => '555-0100',
            'quantity' => 4,
            'message' => 'Please quote bulk pricing.',
        ])->assertRedirect(route('customer.quotations.show', 1));

        $this->assertDatabaseHas('quotations', [
            'id' => 1,
            'user_id' => null,
            'customer_name' => 'Guest Customer',
            'customer_email' => 'guest@example.com',
            'quantity' => 4,
        ]);
        $this->get(route('customer.quotations.index'))->assertOk()->assertSee('Guest-ready product');
        $this->get(route('customer.quotations.show', 1))->assertOk()->assertSee('Please quote bulk pricing.');
        session()->forget('customer_quotation_ids');
        $this->get(route('customer.quotations.show', 1))->assertNotFound();
    }

    public function test_guest_cart_wishlist_orders_and_quotations_merge_into_customer_account_on_login(): void
    {
        $productId = $this->createProduct();
        $user = User::factory()->create(['email' => 'customer@example.com']);

        $this->post(route('customer.cart.store', $productId), ['quantity' => 1]);
        $this->post(route('customer.wishlist.store', $productId));
        $this->post(route('customer.quotations.store', $productId), [
            'customer_name' => 'Account Customer',
            'customer_email' => 'customer@example.com',
            'quantity' => 1,
        ]);
        $this->post(route('customer.checkout.store'), [
            'customer_name' => 'Account Customer',
            'customer_email' => 'customer@example.com',
            'shipping_address' => '1 Market Street',
        ]);
        $this->post(route('customer.cart.store', $productId), ['quantity' => 1]);

        $this->post(route('login'), [
            'email' => 'customer@example.com',
            'password' => 'password',
        ])->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('carts', ['user_id' => $user->id, 'product_id' => $productId, 'quantity' => 1]);
        $this->assertDatabaseHas('wishlists', ['user_id' => $user->id, 'product_id' => $productId]);
        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'customer_email' => 'customer@example.com']);
        $this->assertDatabaseHas('quotations', ['user_id' => $user->id, 'customer_email' => 'customer@example.com']);
        $this->assertFalse(session()->has('customer_cart'));
        $this->assertFalse(session()->has('customer_wishlist'));
    }

    private function createProduct(): int
    {
        $categoryId = DB::table('categories')->insertGetId([
            'name' => 'Tools',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return DB::table('products')->insertGetId([
            'category_id' => $categoryId,
            'name' => 'Guest-ready product',
            'slug' => 'guest-ready-product',
            'sku' => 'GRP-001',
            'description' => 'A test product for guest shopping.',
            'price' => 12.50,
            'stock' => 10,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
