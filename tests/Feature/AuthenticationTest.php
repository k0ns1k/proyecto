<?php

namespace Tests\Feature;

use App\Mail\Users\Registered;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_register(): void
    {
        $user = User::factory()->make();
        $password = Str::random();

        Mail::fake();

        $response = $this->json('POST', '/api/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        Mail::assertQueued(Registered::class);

        $this->assertDatabaseHas(User::class, [
            'name' => $user->name,
            'email' => $user->email,
        ]);

        $response->assertStatus(201);
    }

    public function test_verify()
    {
        $user = User::factory()->unverified()->create([
            'verification_token' => Str::random(32),
        ]);

        $response = $this->json('POST', '/api/verify', [
            'verification_token' => $user->verification_token,
        ]);

        $this->assertDatabaseMissing(User::class, [
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => null,
        ]);

        $response->assertOk();

        $response = $this->json('POST', '/api/verify', [
            'verification_token' => $user->verification_token,
        ]);

        $response->assertForbidden();
    }

    public function test_attempt_success()
    {
        $password = Str::random();
        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);

        $response = $this->json('POST', '/api/attempt', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertCreated()
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_at',
            ])
            ->assertJsonFragment([
                'token_type' => 'Bearer',
            ]);

    }

    public function test_attempt_failed()
    {
        $password = Str::random();

        $response = $this->json('POST', '/api/attempt', [
            'email' => 'test@company.com',
            'password' => $password,
        ]);

        $response->assertUnprocessable();

        $user = User::factory()->unverified()->create([
            "password" => $password,
        ]);

        $response = $this->json('POST', '/api/attempt', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertUnprocessable();
    }

    public function test_change_password()
    {
        $password = Str::random();
        $recovery_token = Str::random(32);

        $user = User::factory()->unverified()->create([
            'recovery_token' => $recovery_token,
        ]);

        $response = $this->json('POST', '/api/change-password', [
            'recovery_token' => $recovery_token,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertOk();
    }

    public function test_recovery()
    {
        $user = User::factory()->create();

        $response = $this->json('POST', '/api/recovery', [
            'email' => $user->email,
        ]);

        $response->assertOk();
    }

    public function test_profile()
    {
        $user = User::factory()->create();

        $photo = UploadedFile::fake()->create(
            'avatar.jpg',
            100,
            'image/jpeg');


        $response = $this->actingAs($user)
            ->json('POST', '/api/profile', [
            'photo' => $photo,
        ]);

        $response->assertOk();

        $photo = UploadedFile::fake()->create(
            'avatar.jpg',
            100,
            'image/jpeg');

        $response = $this->actingAs($user)
            ->json('POST', '/api/profile', [
                'photo' => $photo,
            ]);

        $response->assertOk();

    }

    public function test_user()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->json('GET', "/api/users/{$user->id}");

        $response->assertOk();
    }
}
