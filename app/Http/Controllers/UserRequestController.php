<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UserRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('users.products.userpage', compact('products'));
    }

    public function products()
    {
        $categories->withQueryString()->paginate(18);;
        return view('products');
    }

    public function detailes($id)
    {
        $product = Product::find($id);
        return view('users.products.detailes', compact('product'));
    }

}
