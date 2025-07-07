@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Order #{{ $order->id }} Details</h5>
                        <span class="badge bg-{{ $order->status == 'Pending' ? 'warning' : ($order->status == 'Completed' ? 'success' : 'danger') }}">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Order Summary -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="fw-bold">Order Date:</span> 
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </div>
                            <div class="mb-3">
                                <span class="fw-bold">Dining Method:</span> 
                                {{ $order->dining_method }}
                            </div>
                            @if($order->dining_table_id)
                            <div class="mb-3">
                                <span class="fw-bold">Table:</span> 
                                {{ $order->table->table_number }}
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="fw-bold">Payment Method:</span> 
                                {{ $order->payment_method }}
                            </div>
                            <div class="mb-3">
                                <span class="fw-bold">Order Total:</span> 
                                <h4 class="text-success">{{ number_format($order->total_price, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Items -->
                    <h5 class="border-bottom pb-2 mb-3">Order Items</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product->image)
                                                <img src="{{ asset($item->product->image) }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     class="img-thumbnail me-3" 
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                <small class="text-muted">{{ $item->product->category->name ?? 'Uncategorized' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ number_format($item->price, 2) }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('order.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Orders
                        </a>

                        
                        @if($order->status === 'Pending')
                            <!-- Complete Order Form -->
                            <form action="{{ route('order.complete', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="fas fa-check-circle"></i> Complete Order
                                </button>
                            </form>
                        @endif
                        
                        <!-- Delete Form -->
                        <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                            @csrf
                             @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this order?')">
                                <i class="fas fa-trash"></i> Delete Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection