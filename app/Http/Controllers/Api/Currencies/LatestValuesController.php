<?php

namespace App\Http\Controllers\Api\Currencies;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticatedRequest;
use App\Models\Currency;
use Illuminate\Http\Request;

class LatestValuesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AuthenticatedRequest $request)
    {
        $types = [
            'UF',
            'UTM',
            'USD',
            'EUR',
        ];
        $items = [];

        foreach ($types as $type) {
            $items[$type] = Currency::query()
                ->where('type', $type)
                ->orderBy('id', 'desc')
                ->first();
        }

        return response()->json($items);
    }
}
