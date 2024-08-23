<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrenciesTest extends TestCase
{
    use RefreshDatabase;

    public function test_show(): void
    {
        $user = User::factory()->create();

        Currency::create([
            'type' => 'UF',
            'value' => 37000,
            'valid_from' => now()->startOfDay(),
            'valid_to' => now()->endOfDay(),
        ]);
        Currency::create([
            'type' => 'UTM',
            'value' => 65000,
            'valid_from' => now()->startOfMonth(),
            'valid_to' => now()->endOfMonth(),
        ]);
        Currency::create([
            'type' => 'USD',
            'value' => 900,
            'valid_from' => now()->startOfDay(),
            'valid_to' => now()->endOfDay(),
        ]);
        Currency::create([
            'type' => 'EUR',
            'value' => 1000,
            'valid_from' => now()->startOfDay(),
            'valid_to' => now()->endOfDay(),
        ]);

        $response = $this
            ->actingAs($user)
            ->json('GET', '/api/currencies/latest-values');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'UF' => [
                    'id',
                    'type',
                    'valid_from',
                    'valid_to',
                    'created_at',
                    'updated_at',
                ],
                'UTM' => [
                    'id',
                    'type',
                    'valid_from',
                    'valid_to',
                    'created_at',
                    'updated_at',
                ],
                'USD' => [
                    'id',
                    'type',
                    'valid_from',
                    'valid_to',
                    'created_at',
                    'updated_at',
                ],
                'EUR' => [
                    'id',
                    'type',
                    'valid_from',
                    'valid_to',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJsonFragment([
                'type' => 'UF',
                'value' => 37000,
            ])
            ->assertJsonFragment([
                'type' => 'UTM',
                'value' => 65000,
            ])
            ->assertJsonFragment([
                'type' => 'USD',
                'value' => 900,
            ])
            ->assertJsonFragment([
                'type' => 'EUR',
                'value' => 1000,
            ]);
    }
}
