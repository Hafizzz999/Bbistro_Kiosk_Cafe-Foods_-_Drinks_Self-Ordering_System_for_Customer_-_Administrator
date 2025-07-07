@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Your Order</h1>
            <p class="text-muted">Review and confirm your items</p>
        </div>
        <a href="{{ route('customer.menu') }}" class="btn btn-outline-primary">
            <i class="fas fa-plus me-2"></i> Add More
        </a>
    </div>

    @if(count($products) > 0)
    <div class="card card-kiosk mb-4">
        <div class="card-body p-0">
            @foreach($products as $product)
            <div class="cart-item">
                <div class="flex-shrink-0 me-3">
                    @if($product->image)
                    <img src="{{ asset($product->image) }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                    @else
                    <div class="bg-light rounded" style="width: 80px; height: 80px;"></div>
                    @endif
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-1">{{ $product->name }}</h5>
                    <p class="text-muted small mb-2">{{ $product->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="quantity-control">
                            <form action="{{ route('cart.update', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="button" class="quantity-btn" onclick="this.form.quantity.value = parseInt(this.form.quantity.value) - 1; this.form.submit()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" class="quantity-input" 
                                       value="{{ $product->quantity }}" min="1">
                                <button type="button" class="quantity-btn" onclick="this.form.quantity.value = parseInt(this.form.quantity.value) + 1; this.form.submit()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </form>
                        </div>
                        <div>
                            <span class="fw-bold">RM {{ number_format($product->total, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="card card-kiosk mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal:</span>
                <span class="fw-bold">RM {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between fs-5 mt-3 pt-2 border-top">
                <span>Total:</span>
                <span class="fw-bold text-primary">RM {{ number_format($subtotal, 2) }}</span>
            </div>
        </div>
    </div>
    
    <div class="d-grid">
        <a href="{{ route('customer.checkout') }}" class="btn btn-kiosk btn-lg py-3">
            <i class="fas fa-credit-card me-2"></i> Proceed to Checkout
        </a>
        <a href="{{ route('customer.dining') }}" class="btn btn-outline-secondary mt-3">
            <i class="fas fa-arrow-left me-2"></i> Back to Start
        </a>
    </div>
    @else
    <div class="alert alert-info text-center py-5">
        <i class="fas fa-shopping-cart fa-3x mb-3"></i>
        <h3>Your cart is empty</h3>
        <p class="mb-4">Add some delicious items to your order!</p>
        <a href="{{ route('customer.menu') }}" class="btn btn-kiosk">
            <i class="fas fa-utensils me-2"></i> Browse Menu
        </a>
    </div>
    @endif
</div>
@endsection