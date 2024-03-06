<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->middleware("auth:api", ['except' => ['login', 'register']]);
    }



    public function register(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|min:5|max:255',
            'password' => 'required|min:8|max:255',
        ]);

        if (!$valid->fails()) {
            $user = User::create($valid->safe()->all());
            return $this->sendSuccess($user, 'Register success');
        } else {
            return $this->sendError('Register failed');
        }
    }


    public function login(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!$valid->fails()) {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return $this->sendError("Email didn't registered yet");
            } else {
                $valid = Hash::check($request->password, $user->password);
                if ($valid) {
                    $token = auth()->login($user);
                    return $this->sendSuccess([
                        "user" => $user,
                        "token" => $token
                    ], "Login success");
                } else {
                    return $this->sendError("Invalid credentials1");
                }
            }
        } else {
            return $this->sendError("Login failed");
        }
    }
}
