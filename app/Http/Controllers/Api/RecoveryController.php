<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RecoveryRequest;
use App\Mail\Users\Recovery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RecoveryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RecoveryRequest $request)
    {
        $user = User::query()
            ->where('email', $request->input('email'))
            ->first();
        $user->update([
            'recovery_token' => Str::random(32),
        ]);
        Mail::to($user)->send(new Recovery($user));

        return response()->json();
    }


}
