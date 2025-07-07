<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerMenuController extends Controller
{
    public function show()
    {
        $categories = Category::with('products')->get();
        $products = Product::all();
        
        return view('customer.menu', compact('categories', 'products'));
    }
}
