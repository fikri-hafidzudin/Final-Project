<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function form(){
        return view('form');
    }
    public function welcome(Request $request){
        $nama = $request["firstname"] . " " . $request["lastname"];
        return view('welcome', ['name' => $nama]);
    }
}
