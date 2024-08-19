<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ProfileRequest $request)
    {
        $user = auth()->user();
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                File::delete(public_path("/avatars/{$user->photo}"));
            }
            $uuid = Str::uuid()->toString();
            $photo = $request->file('photo');
            $user->photo = "{$uuid}.{$photo->getClientOriginalExtension()}";
            $request->file('photo')->move(public_path('/avatars'), "{$uuid}.{$photo->getClientOriginalExtension()}");
        }
        $user->save();

        return response()->json();
    }
}
