@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Order Management</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('order.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="dining_method" class="form-label">Dining Method</label>
                        <select class="form-select" name="dining_method" id="dining_method">
                            <option value="">All Methods</option>
                            <option value="Eat In" {{ request('dining_method') == 'Eat In' ? 'selected' : '' }}>Eat In</option>
                            <option value="Take Away" {{ request('dining_method') == 'Take Away' ? 'selected' : '' }}>Take Away</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Order Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="">All Statuses</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Method</th>
                            <th>Table</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $order->dining_method }}</td>
                            <td>
                                @if($order->dining_table_id)
                                    {{ $order->table->table_number }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ number_format($order->total_price, 2) }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>
                                <span class="badge 
                                    @if($order->status == 'Pending') bg-warning
                                    @elseif($order->status == 'Completed') bg-success
                                    @else bg-danger @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('order.show', $order->id) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No orders found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection