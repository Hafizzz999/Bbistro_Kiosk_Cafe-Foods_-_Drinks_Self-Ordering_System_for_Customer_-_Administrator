<?php

namespace App\Http\Controllers;

use App\Models\DiningTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerTableController extends Controller
{
    public function show()
    {
        $tables = DiningTable::all();
        return view('customer.table', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:dining_tables,id'
        ]);
        
        // Store selected table in session
        Session::put('customer.table_id', $request->table_id);
        
        // Update table status to Occupied
        DiningTable::where('id', $request->table_id)->update(['status' => 'Occupied']);
        
        return redirect()->route('customer.menu');
    }
}
