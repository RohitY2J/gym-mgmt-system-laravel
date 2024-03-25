<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingHistory;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        $phNumber = request('phonenumber');
        $usersWithBookingHistory = DB::table('booking_history')
            ->join('users', 'booking_history.user', '=', 'users.id')
            ->select('booking_history.*', 'users.name as name', 'users.email as email')
            ->get();
        
        foreach( $usersWithBookingHistory as $bookingHistory ){
            echo "UserName {$bookingHistory->name} ";
            echo "Email {$bookingHistory->email} ";
        }
        
        return view('contact',
        [
            'phonenumber' => $phNumber,
        ]
        );

    }
}