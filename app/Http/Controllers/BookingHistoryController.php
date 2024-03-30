<?php

namespace App\Http\Controllers;

use App\Models\BookingHistory;
use App\Models\PackageCategory;
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

    public function getAllBookingHistories()
    {
        $categories = Category::all();
        $usersWithBookingHistory = DB::table('booking_history')
            ->join('users', 'booking_history.user', '=', 'users.id')
            ->join('membership_package_category', 'booking_history.package_category', '=', 'membership_package_category.id')
            ->select(
                'booking_history.*',
                'users.name as username',
                'users.email as email',
                'membership_package_category.price as packageprice',
                'membership_package_category.name as packagename'
            )
            ->get();



        return view('admin.booking_history', ['usersWithBookingHistory' => $usersWithBookingHistory, 'statuses' => $this->statuses, 'categories' => $categories]);
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