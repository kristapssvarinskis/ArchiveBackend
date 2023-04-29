<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
class LoginController extends Controller
{
    public function check(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials))
        {
            $user = User::where('email', $credentials['email'])->first();
            return response()->json([
                'data' => new UserResource($user),
                'access_token' => $user->createToken('login')->accessToken,
            ]);
        }
        return response()->json(['status' => false ,
            'message' => "Fail"

        ]);
    }

    public function logout() {
        auth('api')->user()->token()->revoke();
        return response()->json([
            'message' => 'Logged out',
        ]);
    }

    public function user() {
        return new UserResource(auth('api')->user());
    }
}
