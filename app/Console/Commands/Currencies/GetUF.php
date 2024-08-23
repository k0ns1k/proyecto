<?php

namespace App\Console\Commands\Currencies;

class GetUF extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-uf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get today\"s UF value';

    /**
     * @var array
     */
    public $attributes = [
        'path' => 'uf',
        'name' => 'UFs',
        'type' => 'UF',
        'monthly' => false,
    ];
}
