<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        $phNumber = request('phonenumber');

            return view('contact',
            [
                'phonenumber' => $phNumber,
            ]
        );
    }
}