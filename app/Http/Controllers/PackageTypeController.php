<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PackageCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class PackageTypeController extends Controller
{
    public function getPackageTypeView(){
        $categories = Category::all();
        $packages = DB::table('membership_package_category')
            ->join('categories', 'membership_package_category.category_id', '=', 'categories.id')
            ->select('membership_package_category.*','categories.title as category')
            ->get();

        return view("admin.package_type",["categories"=>$categories, "packages"=>$packages]);
    }

    public function getPackageType(){
        $categories = Category::all();
        $packages = DB::table('membership_package_category')
            ->join('categories', 'membership_package_category.category_id', '=', 'categories.id')
            ->select('membership_package_category.*','categories.title as category')
            ->get();
        
        return response()->json(["packages"=> $packages], 200);
    }

    public function addPackage(request $request){
        $this->validateAddCategory($request);
    
        PackageCategory::create([
            "name" => $request->name,
            "category_id" => $request->category,
            "price" => $request->price,
            "duration" => $request->duration,
            "time_unit" => $request->period
        ]);

        $categories = Category::all();
        $packages = DB::table('membership_package_category')
            ->join('categories', 'membership_package_category.category_id', '=', 'categories.id')
            ->select('membership_package_category.*','categories.title as category')
            ->get();

        return response()->json(['message'=>'Package added successfully', 'packages'=>$packages],200);
    }

    public function deleteCategory($id)
    {
        $package = PackageCategory::findOrFail($id);
        $package->delete();

        $categories = Category::all();
        $packages = DB::table('membership_package_category')
            ->join('categories', 'membership_package_category.category_id', '=', 'categories.id')
            ->select('membership_package_category.*','categories.title as category')
            ->get();

        return response()->json(['message' => 'Record deleted successfully', 'packages'=>$packages], 200);
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
