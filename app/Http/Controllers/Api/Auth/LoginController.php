<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request){

        $error_message = 'The provided credentials are incorrect.';

        $request->validate([
            'email' => 'required|email|exists:App\Models\User,email|string',
            'password' => 'required|string',
            'device_name' => 'required|max:50|string'
            ],
            [
                'email.exists' => $error_message 
            ]
        );

        $user = User::where('email', $request->email)->first();

        if (! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [$error_message],
            ]);
        }



        $token = $user->createToken($request->device_name)->plainTextToken;
        // print($token);

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
