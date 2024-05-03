<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function getCategory(){
        $categories = Category::all();
        return view('admin.category', ['categories' => $categories]);
    }

    public function getCategories(){
        return Category::all();
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function addCategory(Request $request)
    {
        $this->validateAddCategory($request);
        Category::create([
            "title"=> $request->title,
        ]);

        // Flash a success message to the session
        return redirect()->route('admin.category')->with('success', 'Record saved successfully.');
    }

    public function add(Request $request){
        $this->validateAddCategory($request);
        Category::create([
            "title"=> $request->title,
        ]);

        return response()->json(['message' => 'Record saved successfully'], 200); 
    }

    protected function validateAddCategory(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'string',
                Rule::unique('categories')->where(function ($query) use ($request) {
                    return $query;
                }),
            ],
        ], [
            'title.unique' => 'The category with given title already exists.',
        ]);
    }
}