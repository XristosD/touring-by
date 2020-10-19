<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        //return view('dashboard');
        return "ok";
    }
}
