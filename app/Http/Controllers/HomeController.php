<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\DiningTable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Order statistics
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'Completed')->count();
        $pendingOrders = Order::where('status', 'Pending')->count();
        $revenue = Order::where('status', 'Completed')->sum('total_price');
        
        // Popular products (top 5)
        $popularProducts = Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->take(5)
            ->get();
            
        // Table status
        $availableTables = DiningTable::where('status', 'Available')->count();
        $occupiedTables = DiningTable::where('status', 'Occupied')->count();
        
        // Recent orders
        $recentOrders = Order::with('table')
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact(
            'totalOrders',
            'completedOrders',
            'pendingOrders',
            'revenue',
            'popularProducts',
            'availableTables',
            'occupiedTables',
            'recentOrders'
        ));
    }
}
