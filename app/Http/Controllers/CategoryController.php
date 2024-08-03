<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','desc')->paginate(5); 
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([ 
            'category_name' => 'required', 
            'description' => 'required', 
        ]); 
         
        Category::create($request->post()); 
 
        return redirect()->route('categories.index')->with('success','Category has been created successfully.'); 
   }

    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([ 
            'category_name' => 'required', 
            'description' => 'required', 
        ]); 
         
        $category->fill($request->post())->save(); 
 
        return redirect()->route('categories.index')->with('success','Category Has Been updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete(); 
        return redirect()->route('categories.index')->with('success','Category has been deleted successfully'); 
    }
}
