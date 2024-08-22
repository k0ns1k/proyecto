<?php

namespace App\Console\Commands\Currencies;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
        $this->info('Starting GE UF command...');

        $api_key = env('CMF_API_KEY', 'NONE');

        if ($api_key == 'NONE' || $api_key == '') {
            $this->error('The CMF_API_KEY is not set or is empty.');

            return $this::FAILURE;
        }
        $url = "https://api.cmfchile.cl/api-sbifv3/recursos_api/uf?apikey={$api_key}&formato=json";

        $response = Http::get($url)->json();

        $valor = $response['UFs'][0]['Valor'];
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $valor = floatval($valor);

        Currency::query()->create([
            'type' => 'UF',
            'valid_from' => now()->startOfDay(),
            'valid_to' => now()->endOfDay(),
            'value' => $valor,
        ]);

        $this->info('Finished GE UF command...');

        return $this::SUCCESS;
    }
}
