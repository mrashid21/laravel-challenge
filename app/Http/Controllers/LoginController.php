<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\LoginRequest;
use App\Resources\UserResource;
use Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 404,
                'message' => 'Invalid credentials',
            ]);
        }

        return response()->json([
            'user' => UserResource::make(Auth::user()),
            'token' => Auth::user()->createToken('User-Token')->plainTextToken,
        ]);
    }
}
