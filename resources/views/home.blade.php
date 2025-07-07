@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dashboard Overview</h1>
        <div class="d-flex align-items-center">
            <span class="badge bg-primary fs-6 me-3">
                Today: {{ now()->format('d M Y') }}
            </span>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <!-- Total Orders -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-primary border-5 shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Total Orders</div>
                            <div class="h5 mb-0 fw-bold">{{ $totalOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-receipt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-success border-5 shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                Total Revenue</div>
                            <div class="h5 mb-0 fw-bold">RM {{ number_format($revenue, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Orders -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-info border-5 shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                Completed Orders</div>
                            <div class="h5 mb-0 fw-bold">{{ $completedOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-warning border-5 shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Pending Orders</div>
                            <div class="h5 mb-0 fw-bold">{{ $pendingOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Popular Products -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="m-0 fw-bold"><i class="fas fa-star me-2"></i>Popular Products</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popularProducts as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="img-thumbnail me-3" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-light border rounded d-flex justify-content-center align-items-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                            <div>{{ $product->name }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                                    <td>RM {{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->order_items_count }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">No popular products found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Recent Orders -->
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white py-3">
                    <h6 class="m-0 fw-bold"><i class="fas fa-history me-2"></i>Recent Orders</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Method</th>
                                    <th>Table</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td><a href="{{ route('order.show', $order->id) }}">#{{ $order->id }}</a></td>
                                    <td>{{ $order->created_at->format('d M H:i') }}</td>
                                    <td>{{ $order->dining_method }}</td>
                                    <td>
                                        @if($order->dining_table_id)
                                            {{ $order->table->table_number }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>RM {{ number_format($order->total_price, 2) }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($order->status == 'Pending') bg-warning
                                            @elseif($order->status == 'Completed') bg-success
                                            @else bg-danger @endif">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No recent orders</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <a href="{{ route('order.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-list me-1"></i> View All Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Table Status -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white py-3">
                    <h6 class="m-0 fw-bold"><i class="fas fa-chair me-2"></i>Table Status</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="text-center">
                            <div class="text-muted small">Available</div>
                            <div class="h2 text-success">{{ $availableTables }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-muted small">Occupied</div>
                            <div class="h2 text-danger">{{ $occupiedTables }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-muted small">Total</div>
                            <div class="h2 text-primary">{{ $availableTables + $occupiedTables }}</div>
                        </div>
                    </div>
                    <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar bg-success" 
                             role="progressbar" 
                             style="width: {{ $availableTablesPercentage = ($availableTables + $occupiedTables) > 0 ? ($availableTables/($availableTables + $occupiedTables))*100 : 0 }}%" 
                             aria-valuenow="{{ $availableTablesPercentage }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            Available
                        </div>
                        <div class="progress-bar bg-danger" 
                             role="progressbar" 
                             style="width: {{ $occupiedTablesPercentage = ($availableTables + $occupiedTables) > 0 ? ($occupiedTables/($availableTables + $occupiedTables))*100 : 0 }}%" 
                             aria-valuenow="{{ $occupiedTablesPercentage }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            Occupied
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('table.index') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-table me-1"></i> Manage Tables
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white py-3">
                    <h6 class="m-0 fw-bold"><i class="fas fa-tachometer-alt me-2"></i>Quick Stats</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-utensils text-primary me-2"></i>
                                Total Products
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ App\Models\Product::count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-list text-info me-2"></i>
                                Product Categories
                            </div>
                            <span class="badge bg-info rounded-pill">{{ App\Models\Category::count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-credit-card text-success me-2"></i>
                                Payment Methods
                            </div>
                            <span class="badge bg-success rounded-pill">{{ App\Models\PaymentMethod::count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-user-shield text-dark me-2"></i>
                                Admin Users
                            </div>
                            <span class="badge bg-dark rounded-pill">{{ App\Models\User::count() }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection