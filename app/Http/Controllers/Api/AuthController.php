<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return  returnResponse(false, $validator->errors()->first(), []);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);
        return  returnResponse(true, 'User Registered Successfully', ['token' => $token,  'user' => $user]);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return  returnResponse(false, $validator->errors()->first(), []);
        }

        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return  returnResponse(false,  'Invalid login credentials', []);
        }

        return  returnResponse(true, 'User login Successfully', ['token' => $token,  'user' => auth()->user()]);
    }

    public function userInfo()
    {

        return  returnResponse(true, 'User Info Fetched Successfully', [auth()->user()]);

    }
}
