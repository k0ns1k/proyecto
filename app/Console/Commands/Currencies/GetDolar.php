<?php

namespace App\Console\Commands\Currencies;

class GetDolar extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-dolar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get today\"s Dolar value';

    /**
     * @var array
     */
    public $attributes = [
        'path' => 'dolar',
        'name' => 'Dolares',
        'type' => 'USD',
        'monthly' => false,
    ];
}
