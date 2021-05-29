<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function findUserByEmail(Request $request){

        $error_message = 'No user found';

        $request->validate([
            'email' => 'required|email|exists:App\Models\User,email|string',
            ],
            [
                'email.exists' => $error_message 
            ]
        );
        $user = User::where('email', '=', $request->email)->first();
        return $user->makeHidden(['email_verified_at', 'created_at', 'updated_at']);
    }
}
