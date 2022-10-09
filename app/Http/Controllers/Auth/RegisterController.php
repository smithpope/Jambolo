<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $phoneNumber = $request->phone_number;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $address = $request->address;
        $password = $request->password;
        $profilepics = $request->image;

        $validator = Validator::make($request->all(),[
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'exists:users,email'],
            'phone_number' => ['required', 'digits:11'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'image' => ['string', 'nullable', 'max:1999']
        ]);

        if ($validator->fails()){
            return response([
                'error' => 'invalid Entry',
                'info' => $validator->errors()
            ]);
        }

        $register = User::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone_number' => $phoneNumber,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'address' => $address,
            'password' => bcrypt($password),
            'image' => $profilepics
        ]);

        $token = $register->createToken('apiToken')->plainTextToken;

        return response([
            'Registration Successful',
            'user' => $register,
            'token' => $token
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Users::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $phoneNumber = $request->phone_number;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $address = $request->address;
       // $password = $request->password;
        $profilepics = $request->image;

        $validator = Validator::make($request->all(),[
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'exists:users, email'],
            'phone_number' => ['required', 'digits:11'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
          //  'password' => ['required', 'string', 'confirmed', 'min:8'],
            'image' => ['string', 'nullable', 'max:1999']
        ]);

        if ($validator->fails()){
            return response([
                'error' => 'invalid Entry',
                'info' => $validator->errors()
            ]);
        }

        $register = User::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone_number' => $phoneNumber,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'address' => $address,
         //   'password' => bcrypt($password),
            'image' => $profilepics
        ]);

        $token = $register->createToken('apiToken')->tokenPlainText;

        return response([
            'User Update Successful',
            'user' => $register,
            'token' => $token
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete($id);

        $users = User::all();

        return response([
            'User Successfilly Deleted',
            $users
        ]);
    }
}
