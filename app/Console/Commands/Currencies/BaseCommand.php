<?php

namespace App\Console\Commands\Currencies;

use App\Jobs\Currencies\ExtractFromCMF;
use Illuminate\Console\Command;

class BaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-indicator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get indicator value';

    public $attributes = [
        'path' => '',
        'name' => '',
        'type' => '',
        'monthly' => false,
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting GET {$this->attributes['name']} command...");

        $api_key = env('CMF_API_KEY', 'NONE');

        if ($api_key == 'NONE' || $api_key == '') {
            $this->error('The CMF_API_KEY is not set or is empty.');

            return $this::FAILURE;
        }

        dispatch(new ExtractFromCMF(
            $api_key,
            $this->attributes['path'],
            $this->attributes['name'],
            $this->attributes['type'],
            $this->attributes['monthly']
        ));

        $this->info("Finished GET {$this->attributes['name']} command...");

        return $this::SUCCESS;
    }
}
