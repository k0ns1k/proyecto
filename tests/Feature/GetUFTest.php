<?php

namespace Tests\Feature;

use App\Console\Commands\Currencies\GetUF;
use Illuminate\Support\Env;
use Symfony\Component\Console\Command\Command;
use Tests\TestCase;

class GetUFTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->artisan(GetUF::class)
            ->assertExitCode(Command::SUCCESS);

        Env::getRepository()->set('CMF_API_KEY', '');

        $this->artisan(GetUF::class)
            ->assertExitCode(Command::FAILURE);
    }
}
