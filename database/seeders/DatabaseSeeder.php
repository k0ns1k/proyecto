<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Document;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $customers = Customer::factory(10)
            ->create();
        foreach ($customers as $customer) {
            for ($i = 0; $i < 10; $i++) {
                $document = Document::factory()
                    ->make();
                $customer
                    ->documents()
                    ->create($document->toArray());
            }

        }
    }
}
