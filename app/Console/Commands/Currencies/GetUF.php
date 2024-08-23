<?php

namespace App\Console\Commands\Currencies;

use App\Repositories\CMFRepository;
use Illuminate\Console\Command;

class GetUF extends Command
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
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting GET UF command...');

        $api_key = env('CMF_API_KEY', 'NONE');

        if ($api_key == 'NONE' || $api_key == '') {
            $this->error('The CMF_API_KEY is not set or is empty.');

            return $this::FAILURE;
        }

        CMFRepository::fetchFinancialIndicator($api_key, 'uf', 'UFs', 'UF');

        $this->info('Finished GET UF command...');

        return $this::SUCCESS;
    }
}
