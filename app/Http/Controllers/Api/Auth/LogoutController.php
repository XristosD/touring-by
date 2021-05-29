<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LogoutController extends Controller
{
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
    }
}
