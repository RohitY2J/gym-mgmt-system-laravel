<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    protected $table = 'booking_history';

    public function users(){
        return $this->belongsTo(User::class);
    }
    //use HasFactory;
}
