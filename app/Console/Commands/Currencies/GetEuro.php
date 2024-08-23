<?php

namespace App\Console\Commands\Currencies;

class GetEuro extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-euro';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get today\"s Euro value';

    /**
     * @var array
     */
    public $attributes = [
        'path' => 'euro',
        'name' => 'Euros',
        'type' => 'EUR',
        'monthly' => false,
    ];
}
