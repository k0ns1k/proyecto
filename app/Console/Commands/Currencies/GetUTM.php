<?php

namespace App\Console\Commands\Currencies;

class GetUTM extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-utm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get monthly UTM value';

    /**
     * @var array
     */
    public $attributes = [
        'path' => 'utm',
        'name' => 'UTMs',
        'type' => 'UTM',
        'monthly' => true,
    ];
}
