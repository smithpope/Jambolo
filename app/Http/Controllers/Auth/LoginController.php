<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        //$email = $request->email;
       // $password = $request->password;

       //return response($request->all());

        $validator = Validator::make($request->all(),[
            'email' => ['required', 'string', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8']
        ]);

        if ($validator->fails()){
            return response([
                'error' => 'Invalid Entry',
                'info' => $validator->errors()
            ]);
        }

       // return response($request->all());
       $validate = $request->all();

        $user = User::where('email', $validate['email'])->firstOrFail();

        if (!$user || !Hash::check($validate['password'], $user->password))
        {
            return response([
                'msg' => 'incorrect username or password',
            ], 401);
        }

    
        $token = $user->createToken('apiToken')->plainTextToken;

        return response()->json([
           // $request->all(),
            'message' => 'Login Successful',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout (Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'msg' => 'User loged out'
        ];
    }
}
