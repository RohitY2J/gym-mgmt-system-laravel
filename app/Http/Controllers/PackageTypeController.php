<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PackageCategory;
use Illuminate\Http\Request;

class PackageTypeController extends Controller
{
    public function getPackageTypeView(){
        $categories = Category::all();
        $packages = PackageCategory::all();

        return view("admin.package_type",["categories"=>$categories, "packages"=>$packages]);
    }
}
