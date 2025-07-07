<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\DiningTable;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerCheckoutController extends Controller
{
    public function show()
    {
        $cart = Session::get('cart', []);
        $paymentMethods = PaymentMethod::all();
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $tax = $subtotal * 0.06;
        $serviceCharge = $subtotal * 0.10;
        $total = $subtotal + $tax + $serviceCharge;
        
        return view('customer.checkout', compact('paymentMethods', 'subtotal', 'tax', 'serviceCharge', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|exists:payment_methods,id'
        ]);
        
        // Get cart and calculate total
        $cart = Session::get('cart', []);
        $subtotal = 0;
        
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $tax = $subtotal * 0.06;
        $serviceCharge = $subtotal * 0.10;
        $total = $subtotal + $tax + $serviceCharge;
        
        // Create order
        $order = Order::create([
            'dining_method' => Session::get('customer.dining_method', 'Take Away'),
            'dining_table_id' => Session::get('customer.table_id'),
            'payment_method' => $request->payment_method,
            'total_price' => $total,
            'status' => 'Pending'
        ]);
        
        // Create order items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }
        
        // Clear cart and session data
        Session::forget('cart');
        Session::forget('customer');
        
        return redirect()->route('customer.success', ['order' => $order->id]);
    }
    
    public function success(Order $order)
    {
        $order->load('orderItems.product', 'table');
        $paymentMethod = PaymentMethod::find($order->payment_method);
        
        return view('customer.success', compact('order', 'paymentMethod'));
    }
}
