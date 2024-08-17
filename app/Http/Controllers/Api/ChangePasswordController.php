<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Mail\Users\Recovery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        $user = User::query()
            ->where('recovery_token', $request->input('recovery_token'))
            ->first();
        $user->update([
            'password' => bcrypt($request->input("password")),
        ]);

        return response()->json();

    }
}
