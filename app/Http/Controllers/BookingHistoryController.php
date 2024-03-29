<?php

namespace App\Http\Controllers;

use App\Models\BookingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;


class BookingHistoryController extends Controller
{
    protected $statuses;

      // Constructor
    public function __construct()
    {
        // Initialize the global variable in the constructor if needed
        $this->statuses = [
            0 => 'Day',
            1 => 'Month',
            2 => 'Year',
        ];
    }

    public function getBookingHistories(){
        $usersWithBookingHistory = DB::table('booking_history')
            ->join('users', 'booking_history.user', '=', 'users.id')
            -> join('membership_package_category','booking_history.package_category','=','membership_package_category.id')
            ->select('booking_history.*', 'users.name as name', 'users.email as email', 'membership_package_category.*')
            ->get();
        


        return view('booking_history', ['usersWithBookingHistory'=> $usersWithBookingHistory, 'statuses'=> $this->statuses]);
    }

    public function getAllBookingHistories(){
        $categories = Category::all();
        $usersWithBookingHistory = DB::table('booking_history')
            ->join('users', 'booking_history.user', '=', 'users.id')
            -> join('membership_package_category','booking_history.package_category','=','membership_package_category.id')
            ->select('booking_history.*', 
            'users.name as username', 'users.email as email', 
            'membership_package_category.price as packageprice', 
            'membership_package_category.name as packagename')
            ->get();
        


        return view('admin.booking_history', ['usersWithBookingHistory'=> $usersWithBookingHistory, 'statuses'=> $this->statuses, 'categories'=>$categories]);
    }

    public function addPayment(Request $request){
        $booking = BookingHistory::findorfail($request->id);

        $booking->payment_amount = $booking->payment_amount + $request->payment;
        $booking->save();

        return redirect()->back()->with('success','Amount Upated');
    }
}