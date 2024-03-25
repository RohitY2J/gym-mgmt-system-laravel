<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookingHistoryController extends Controller
{
    public function getBookingHistories(){
        $statuses = [
            0 => 'Day',
            1 => 'Month',
            2 => 'Year',
        ];

        $usersWithBookingHistory = DB::table('booking_history')
            ->join('users', 'booking_history.user', '=', 'users.id')
            -> join('membership_package_category','booking_history.package_category','=','membership_package_category.id')
            ->select('booking_history.*', 'users.name as name', 'users.email as email', 'membership_package_category.*')
            ->get();
        


        return view('booking_history', ['usersWithBookingHistory'=> $usersWithBookingHistory, 'statuses'=> $statuses]);
    }
}