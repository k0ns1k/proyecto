<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VerifyRequest;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyRequest $request)
    {
        $user = User::query()
            ->where('verification_token', $request->input('verification_token'))
            ->first();

        if ($user->email_verified_at) {
            return response()->json(status: 403);
        }

        $user->update([
            'email_verified_at' => now(),
        ]);

        return response()->json();
    }
}
