<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;

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
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json();
    }
}
