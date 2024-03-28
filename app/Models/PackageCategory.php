<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    //use HasFactory;

    protected $table = 'membership_package_category';

    protected $fillable = [
        "name",
        "category_id",
        "price",
        "duration",
        "time_unit"
    ];
}