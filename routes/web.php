<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PackageTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home_custom');
})->name('welcome.home');

Route::get('/contact', function(){
    return view('contact');
})->name('welcome.contact');
Route::get('/booking', [BookingHistoryController::class,'getBookingHistories'])->name('booking')->middleware('auth');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard',function(){
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth', 'admin');

Route::get('/admin/category', [CategoryController::class,'getCategory'])->name('admin.category')->middleware('auth','admin');

Route::get('/admin/package-type', [PackageTypeController::class,'getPackageTypeView'])->name('admin.package_type')->middleware('auth','admin');

Route::get('/admin/bookings', [BookingHistoryController::class, 'getAllBookingHistories'])->name('admin.bookings')->middleware('auth','admin');
Route::post('/admin/bookings/filter', [BookingHistoryController::class, 'getAllBookingHistoriesFilter'])->name('admin.bookings.filter')->middleware('auth','admin');

Route::get('/admin/report', function(){
    return view('admin.report');
})->name('admin.report')->middleware('auth','admin');

Route::post('/admin/category/addcategory', [CategoryController::class,'addCategory'])->name('admin.category.addcategory')->middleware('auth','admin');
Route::delete('/admin/category/deletecategory/{id}',[CategoryController::class,'deleteCategory'])->name('admin.category.deletecategory')->middleware('auth','admin');
Route::post('/admin/package-type/addpackagetype', [PackageTypeController::class,'addPackageType'])->name('admin.package_type.addpackage')->middleware('auth','admin');
Route::post('/admin/bookings/addpayment', [BookingHistoryController::class, 'addPayment'])->name('admin.booking_history.add_payment')->middleware('auth','admin');


Route::post('/api/signIn', [LoginController::class, 'signIn']);
Route::post('/api/test', function(){
    return response()->json(['error' => 'Could not create token'], 200);
})->middleware(CheckRole::class . ':0');

Route::get('/api/test2', function(){
    return response()->json(['error' => 'Could not create token'], 500);
});

