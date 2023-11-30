<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        // dd($user->createToken('yourTokenName')->accessToken->token);

        if (Auth::validate($credentials)) {
            $user = User::where('email', $request->email)->first();
            // $user->tokens()->delete();
            $token = $user->createToken('YourTokenName')->plainTextToken;

            // dd($token->token);
            return response()->json(['user' => $user, 'token' => $token], 200);
        } else {
            return response()->json(['error' => 'Failed Authentication'], 401);
        }
    }

    public function Logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'logged out successfully'], 200);
    }
}
