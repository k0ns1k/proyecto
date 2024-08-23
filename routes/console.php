<?php

use App\Console\Commands\Currencies\GetDolar;
use App\Console\Commands\Currencies\GetEuro;
use App\Console\Commands\Currencies\GetUF;
use App\Console\Commands\Currencies\GetUTM;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(GetUTM::class)
    ->monthly();

$daily_commands = [
    GetUF::class,
    GetEuro::class,
    GetDolar::class,
];

foreach ($daily_commands as $command) {
    Schedule::command($command)->daily();
}
