<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('GET', '/api/customers');

        $response->assertStatus(200);
    }

    public function test_store(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/customers', [
                'name' => 'Company Ltd',
                'tax' => '11.111.111-5',
                'email' => 'contact@company.com',
            ]);

        $response->assertStatus(201);
    }

    public function test_show(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('GET', "/api/customers/{$customer->id}");

        $response->assertStatus(200);
    }

    public function test_update(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('PUT', "/api/customers/{$customer->id}", [
                'name' => $customer->name,
                'tax' => '11.111.111-5',
                'email' => $customer->email,
            ]);

        $response->assertStatus(200);
    }

    public function test_destroy(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('DELETE', "/api/customers/{$customer->id}");

        $response->assertStatus(200);
    }
}
