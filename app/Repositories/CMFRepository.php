<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class CMFRepository
{
    public static function fetchFinancialIndicator(string $token, string $path, string $name, string $type, bool $monthly = false): void
    {
        $url = "https://api.cmfchile.cl/api-sbifv3/recursos_api/{$path}?apikey={$token}&formato=json";

        $response = Http::get($url)->json();

        $valor = $response[$name][0]['Valor'];
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $valor = floatval($valor);

        Currency::query()->create([
            'type' => $type,
            'valid_from' => $monthly ? now()->startOfMonth() : now()->startOfDay(),
            'valid_to' => $monthly ? now()->endOfMonth() : now()->endOfDay(),
            'value' => $valor,
        ]);
    }
}
