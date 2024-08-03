<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get(); 
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // $requestData = $request->all();
        // $fileName = time().$request->file('photo')->GetClientOriginalName();
        // $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        // $requestData['photo'] = './storage/'.$path;
        // Product::create($requestData);
        // return redirect()->route('products.index')->with('success','Product has been created successfully.');

        $request -> validate([
            'product_name' => 'required|max:255|string',
            'category_id' => 'required',
            'description' => 'required|max:255|string',
            'price' => 'required',
            'photo' => 'required',
        ]);

        if($request->has('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $path = 'uploads/product/';
            $file->move($path, $fileName);
        }

        Product::create([
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'price'=>$request->price,
            'photo'=>$path.$fileName,
        ]);

        return redirect()->route('products_admin.index')->with('success','Product has been created successfully.');

    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([ 
            'product_name' => 'required', 
            'category_id' => 'required', 
            'description' => 'required', 
            'price' => 'required', 
            'photo' => 'required', 

        ]); 
         
        $product->fill($request->post())->save(); 
 
        return redirect()->route('products_admin.index')->with('success','Product Has Been updated successfully'); 
    }

    public function destroy(Product $product)
    {
        $product->delete(); 
        return redirect()->route('products_admin.index')->with('success','Product has been deleted successfully');
    }
}
