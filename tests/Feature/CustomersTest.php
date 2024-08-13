<?php

namespace Tests\Feature;

use App\Mail\Customers\Created;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('GET', '/api/customers');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    ['id', 'name', 'email', 'tax', 'created_at', 'updated_at'],
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links' => [
                    ['url', 'label', 'active'],
                ],
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ])->assertJsonFragment([
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'tax' => $customer->tax,
            ]);
    }

    public function test_store_failed(): void
    {
        $user = User::factory()->create();

        Mail::fake();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/customers');

        Mail::assertNothingQueued();

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'name',
                    'tax',
                    'email',
                ],
            ]);

        $this->assertDatabaseEmpty(Customer::class);
    }

    public function test_store_success(): void
    {
        $user = User::factory()->create();

        Mail::fake();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/customers', [
                'name' => 'Company Ltd',
                'tax' => '11.111.111-5',
                'email' => 'contact@company.com',
            ]);

        Mail::assertQueued(Created::class);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'name',
                'tax',
                'email',
                'updated_at',
                'created_at',
                'id',
            ])
            ->assertJsonFragment([
                'name' => 'Company Ltd',
                'tax' => '11.111.111-5',
                'email' => 'contact@company.com',
            ]);
        $this->assertDatabaseHas(Customer::class, [
            'name' => 'Company Ltd',
            'tax' => '11.111.111-5',
            'email' => 'contact@company.com',
        ]);
    }

    public function test_show(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('GET', "/api/customers/{$customer->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'tax',
                'created_at',
                'updated_at',
            ])
            ->assertJsonFragment([
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'tax' => $customer->tax,
            ]);
    }

    public function test_update(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('PUT', "/api/customers/{$customer->id}", [
                'tax' => '11.111.111-5',
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas(Customer::class, [
            'id' => $customer->id,
            'tax' => '11.111.111-5',
        ]);
    }

    public function test_destroy(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('DELETE', "/api/customers/{$customer->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing(Customer::class, [
            'id' => $customer->id,
        ]);
    }
}
