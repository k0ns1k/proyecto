<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class CustomersDocumentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $document = Document::factory()->create([
            'customer_id' => $customer->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->json('GET', "/api/customers/{$customer->id}/documents");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    ['id', 'name', 'path', 'mime', 'size', 'customer_id', 'created_at', 'updated_at'],
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
                'id' => $document->id,
                'name' => $document->name,
                'path' => $document->path,
                'size' => $document->size,
                'customer_id' => $document->customer_id,
            ]);
    }

    public function test_store_and_download_and_destroy(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $document = Document::factory()->make([
            'customer_id' => $customer->id,
        ]);

        $file = UploadedFile::fake()->create(
            'document.pdf',
            100,
            'application/pdf');

        $response = $this
            ->actingAs($user)
            ->json('POST', "/api/customers/{$customer->id}/documents", [
                'name' => $document->name,
                'file' => $file,
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'path',
                'mime',
                'size',
                'customer_id',
                'created_at',
                'updated_at',
            ])
            ->assertJsonFragment([
                'name' => $document->name,
                'mime' => 'application/pdf',
                'size' => 100 * 1024,
                'customer_id' => $customer->id,
            ]);

        $this->assertDatabaseHas(Document::class, [
            'name' => $document->name,
            'mime' => 'application/pdf',
            'size' => 100 * 1024,
            'customer_id' => $customer->id,
        ]);

        $created_document = Document::query()->where([
            'name' => $document->name,
            'mime' => 'application/pdf',
            'size' => 100 * 1024,
            'customer_id' => $customer->id,
        ])->first();

        $this->assertFileExists(storage_path("app/documents/{$created_document->path}"));
        $response = $this
            ->actingAs($user)
            ->json('GET', "/api/customers/{$customer->id}/documents/{$created_document->id}/download");

        $response->assertDownload();

        $response = $this
            ->actingAs($user)
            ->json('DELETE', "/api/customers/{$customer->id}/documents/{$created_document->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing(Document::class, [
            'id' => $created_document->id,
        ]);
    }

    public function test_show(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $document = Document::factory()->create([
            'customer_id' => $customer->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->json('GET', "/api/customers/{$customer->id}/documents/{$document->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'path',
                'mime',
                'size',
                'customer_id',
                'created_at',
                'updated_at',
            ])
            ->assertJsonFragment([
                'name' => $document->name,
                'mime' => $document->mime,
                'size' => $document->size,
                'customer_id' => $customer->id,
            ]);
    }

    public function test_update(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $document = Document::factory()->create([
            'customer_id' => $customer->id,
        ]);

        $name = Str::random();

        $response = $this
            ->actingAs($user)
            ->json('PUT', "/api/customers/{$customer->id}/documents/{$document->id}", [
                'name' => $name,
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas(Document::class, [
            'id' => $document->id,
            'name' => $name,
        ]);
    }
}
