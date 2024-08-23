<?php

namespace App\Console\Commands\Currencies;

use App\Repositories\CMFRepository;
use Illuminate\Console\Command;

class GetEuro extends Command
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
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting GET Euro command...');

        $api_key = env('CMF_API_KEY', 'NONE');

        if ($api_key == 'NONE' || $api_key == '') {
            $this->error('The CMF_API_KEY is not set or is empty.');

            return $this::FAILURE;
        }

        CMFRepository::fetchFinancialIndicator($api_key, 'euro', 'Euros', 'EUR');

        $this->info('Finished GET Euro command...');

        return $this::SUCCESS;
    }
}
