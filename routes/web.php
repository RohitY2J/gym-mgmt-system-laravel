<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingHistoryController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard',function(){
    return view('admin.dashboard');
})->name('admin.dashboard');
