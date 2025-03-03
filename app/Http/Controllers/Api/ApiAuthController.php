<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;

class ApiAuthController extends Controller
{

    public function login(LoginUserRequest $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(
                [
                    "message" => "Invalid credentials!"
                ],
                404
            );
        }

        $user = Auth::user();

        return response()->json(
            [
                "token" => $user->createToken($request->email)->plainTextToken,
                "message" => "Authenticated successfully",
                "user" => $user,
            ],
            200
        );
    }

    public function register(RegisterUserRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        return response()->json(
            [
                "token" => $user->createToken($request->email)->plainTextToken,
                "message" => "Authenticated successfully",
                "user" => $user,
            ],
            200
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(
            ["message" => "Logged out successfully"],
            200
        );
    }
}
