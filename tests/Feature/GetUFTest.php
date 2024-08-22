<?php

namespace Tests\Feature;

use App\Console\Commands\Currencies\GetUF;
use Tests\TestCase;

class GetUFTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->artisan(GetUF::class)
            ->assertExitCode(0);
    }
}
