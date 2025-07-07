<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerDiningController extends Controller
{
    public function show()
    {
        return view('customer.dining');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dining_method' => 'required|in:Eat In,Take Away'
        ]);
        
        Session::put('customer.dining_method', $request->dining_method);
        
        if ($request->dining_method === 'Eat In') {
            return redirect()->route('customer.table');
        }
        
        return redirect()->route('customer.menu');
    }
}
