<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingHistory;
use App\Models\User;

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
    public function createUser()
    {
        // $user = new User();

        // $user->name = request('username');
        // $user->email = request('email');
        // $user->password = request('password');
        // $user->role = 0;
        
        // $user->save();

        return redirect('/')-> with('msg','Thank you for Registration');
    }
}