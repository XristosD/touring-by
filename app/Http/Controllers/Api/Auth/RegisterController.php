<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => 'required|max:50|string',
            'email' => 'required|email|unique:App\Models\User,email|string',
            'password' => 'required|string',
            'device_name' => 'required|max:50|string'

        ]);
 
        $user = User::create([
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ]);

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token,
            ]
        ]);

    }

}
