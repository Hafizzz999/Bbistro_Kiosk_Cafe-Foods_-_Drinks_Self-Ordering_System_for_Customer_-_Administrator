<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerCartController extends Controller
{
    public function show()
    {
        $cart = Session::get('cart', []);
        $products = [];
        $subtotal = 0;
        
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $product->quantity = $item['quantity'];
                $product->total = $product->price * $item['quantity'];
                $products[] = $product;
                $subtotal += $product->total;
            }
        }
        
        $tax = $subtotal * 0.06; // 6% tax
        $serviceCharge = $subtotal * 0.10; // 10% service charge
        $total = $subtotal + $tax + $serviceCharge;
        
        return view('customer.cart', compact('products', 'subtotal', 'tax', 'serviceCharge', 'total'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = Session::get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        
        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function updateCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cart = Session::get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }
        
        return redirect()->route('customer.cart');
    }

    public function removeFromCart($productId)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }
        
        return redirect()->route('customer.cart')->with('success', 'Product removed from cart');
    }
}
