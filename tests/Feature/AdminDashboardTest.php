<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_is_available_to_admins_and_has_the_new_store_overview(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Store at a glance')
            ->assertSee('Order pipeline')
            ->assertSee('Recent orders')
            ->assertSee('Quick actions')
            ->assertSee('id="admin-menu-toggle"', false)
            ->assertSee('id="admin-sidebar"', false);
    }

    public function test_admin_dashboard_stays_protected_from_guests_and_customers(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));

        $customer = User::factory()->create(['role' => 'customer']);
        $this->actingAs($customer)->get(route('admin.dashboard'))->assertForbidden();
    }
}
