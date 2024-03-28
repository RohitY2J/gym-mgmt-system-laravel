<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PackageCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PackageTypeController extends Controller
{
    public function getPackageTypeView(){
        $categories = Category::all();
        $packages = PackageCategory::all();

        return view("admin.package_type",["categories"=>$categories, "packages"=>$packages]);
    }

    public function addPackageType(Request $request){ 
        $this->validateAddCategory($request);
    
        PackageCategory::create([
            "name" => $request->name,
            "category_id" => $request->category,
            "price" => $request->price,
            "duration" => $request->duration,
            "time_unit" => $request->period
        ]);
    
        // Return a success response
        return redirect()->route('admin.package_type')->with('success', 'Record saved successfully.');

        // Flash a success message to the session
        
     }

     protected function validateAddCategory(Request $request)
    {
        $request->validate([
            'name' => "required",
            'category'=>"required|numeric",
            'price'=>"required|numeric",
            'duration'=>"required|numeric",
            'period'=>"required"
        ]);
    }
}
