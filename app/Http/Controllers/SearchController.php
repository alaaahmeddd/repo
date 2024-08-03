<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('product_name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhere('category_id', 'like', "%$query%")
            ->get();

        return view('search', compact('products', 'query'));
    }   }
