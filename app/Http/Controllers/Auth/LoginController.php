<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $validate = $request->validate([
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8']
        ]);

        $user = User::where('email', $validate['email'])->first();

        if (!$user || !Hash::check($validate['password'], $user->password))
        {
            return response([
                'msg' => 'incorrect username or password',
            ], 401);
        }

        $token = $user->createToken('apiToken')->plainTextToken;

        return response([
            'message' => 'Login Successful',
            'user' => $user,
            'token' => $token
        ], 201);
    }
}
