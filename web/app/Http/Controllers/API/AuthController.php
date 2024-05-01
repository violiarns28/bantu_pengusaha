<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user = User::where('email', $request['email'])->firstOrFail();

        return response()
            ->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user,
            ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->token = $token;
        $user->token_type = 'Bearer';

        return response()
            ->json([
                'success' => true,
                'message' => 'Hi ' . $user->name . ', Welcome to Bantu Pengusaha Attendance',
                'data' => $user
            ]);
    }

    public function me()
    {
        $me = Auth::user();

        if ($me) {
            return response()
                ->json([
                    'success' => true,
                    'message' => 'User data',
                    'data' => $me
                ]);
        } else {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'User not found',
                    'data' => null
                ]);
        }
    }

    // method for user logout and delete token
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logout successfully'
        ]);
    }
}
