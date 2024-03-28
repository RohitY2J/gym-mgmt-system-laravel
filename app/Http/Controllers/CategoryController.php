<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategory(){
        $categories = Category::all();
        return view('admin.category', ['categories' => $categories]);
    }

    public function addCategory(Request $request)
    {
        $this->validateAddCategory($request);
        Category::create([
            "title"=> $request->category,
        ]);

        // Flash a success message to the session
        return redirect()->route('admin.category')->with('success', 'Record saved successfully.');
    }

    protected function validateAddCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            //'password' => 'required|string',
        ]);
    }
}
