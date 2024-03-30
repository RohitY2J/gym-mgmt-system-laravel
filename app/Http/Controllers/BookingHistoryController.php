<?php

namespace App\Http\Controllers;

use App\Models\BookingHistory;
use App\Models\PackageCategory;
use App\Models\User;
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

    public function getBookingHistories()
    {
        $usersWithBookingHistory = DB::table('booking_history')
            ->join('users', 'booking_history.user', '=', 'users.id')
            ->join('membership_package_category', 'booking_history.package_category', '=', 'membership_package_category.id')
            ->select('booking_history.*', 'users.name as name', 'users.email as email', 'membership_package_category.*')
            ->get();



        return view('booking_history', ['usersWithBookingHistory' => $usersWithBookingHistory, 'statuses' => $this->statuses]);
    }

    public function getAllBookingHistories(Request $request)
    {
        $categories = Category::all();

        $usersWithBookingHistory = $request->session()->get('usersWithBookingHistory');

        if($usersWithBookingHistory == null){
            $usersWithBookingHistory = DB::table('booking_history')
            ->join('users', 'booking_history.user', '=', 'users.id')
            ->join('membership_package_category', 'booking_history.package_category', '=', 'membership_package_category.id')
            ->select(
                'booking_history.*',
                'users.name as username',
                'users.email as email',
                'membership_package_category.price as packageprice',
                'membership_package_category.name as packagename'
            )->get();
        }
        

        $users = User::where('role', '0')->get();
        $payments = [
            ["value"=>"No Payment", "key"=>0], 
            ["value"=>"Partial Payment", "key"=>2], 
            ["value"=>"Full Payment", "key"=>1]];

        $activeStatus = [
            ["value"=>"Active", "key"=>1], 
            ["value"=>"Inactive", "key"=>0]];

        return view('admin.booking_history', ['usersWithBookingHistory' => $usersWithBookingHistory, 
        'statuses' => $this->statuses,
        'users' => $users, 
        "payments" => $payments,
        'activeStatus' => $activeStatus,
        'categories' => $categories]);
    }

    public function getAllBookingHistoriesFilter(Request $request)
    {
        $usersWithBookingHistoryTemp = DB::table('booking_history')
            ->join('users', 'booking_history.user', '=', 'users.id')
            ->join('membership_package_category', 'booking_history.package_category', '=', 'membership_package_category.id')
            ->select(
                'booking_history.*',
                'users.name as username',
                'users.email as email',
                'membership_package_category.price as packageprice',
                'membership_package_category.name as packagename'
            );
                // Check if specific parameters exist in the request and apply filters accordingly
        if ($request->payment) {
            if($request->payment == 1)
                $usersWithBookingHistoryTemp->where('booking_history.is_payment_complete', $request->payment);
            else if($request->payment == 2)
            {
                $usersWithBookingHistoryTemp->where('booking_history.payment_amount','>', 0);
            }
            else{
                $usersWithBookingHistoryTemp->where('booking_history.payment_amount', 0);
            }
        }

        if ($request->user) {
            $usersWithBookingHistoryTemp->where('booking_history.user', $request->user);
        }

        if ($request->active) {
            $usersWithBookingHistoryTemp->where('booking_history.active_status', $request->user);
        }

        if($request->pagination){
            $usersWithBookingHistoryTemp->limit($request->pagination);
        }
        $usersWithBookingHistory = $usersWithBookingHistoryTemp->get();
        // Redirect to the getAllBookingHistories method with the filtered data
        return response()->json(['usersWithBookingHistory' => $usersWithBookingHistory]);

    }

    public function addPayment(Request $request)
    {
        $booking = BookingHistory::findorfail($request->id);

        $booking->payment_amount = $booking->payment_amount + $request->payment;

        $package = PackageCategory::findorfail($booking->package_category);

        if ($package && $package->price == $booking->payment_amount) {
            $booking->is_payment_complete = 1;
        } else {
            $booking->is_payment_complete = 0;
        }

        if ($request->startDate) {
            $booking->starting_date = $request->startDate;
        }

        if ($request->endDate) {
            $booking->ending_date = $request->endDate;
        }

        if ($booking->starting_date && $booking->ending_date) {
            $startingDate = new \DateTime($booking->starting_date);
            $endingDate = new \DateTime($booking->ending_date);

            // Get today's date
            $today = new \DateTime();

            // Check if today's date is between starting_date and ending_date
            if ($today >= $startingDate && $today <= $endingDate) {
                // Today's date is between starting_date and ending_date
                $booking->active_status = true;
            } else {
                // Today's date is not within the booking period
                $booking->active_status = false;
            }
        }

        $booking->save();

        return redirect()->back()->with('success', 'Amount Upated');
    }
}