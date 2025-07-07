@extends('layouts.customer')

@section('content')
<div class="container h-100 d-flex flex-column justify-content-center">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="mb-5">
                <div class="d-flex justify-content-center mb-4">
                    <div class="bg-success p-4 rounded-circle">
                        <i class="fas fa-check fa-5x text-white"></i>
                    </div>
                </div>
                <h1 class="display-4 fw-bold mb-4 text-success">Order Confirmed!</h1>
                <p class="lead mb-4">Thank you for your order at Bbistro</p>
                
                <div class="card card-kiosk border-success mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Order ID:</span>
                            <span class="fw-bold">#{{ $order->id }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Date & Time:</span>
                            <span class="fw-bold">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total Amount:</span>
                            <span class="fw-bold text-success">RM {{ number_format($order->subtotal_price, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Payment Method:</span>
                            <span class="fw-bold">{{ $paymentMethod->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="card card-kiosk mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Order Items</h5>
                    </div>
                    <div class="card-body p-0">
                        @foreach($order->orderItems as $item)
                        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                            <div class="text-start">
                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                <small class="text-muted">{{ $item->quantity }} × RM {{ number_format($item->price, 2) }}</small>
                            </div>
                            <span class="fw-bold">RM {{ number_format($item->quantity * $item->price, 2) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <p class="text-muted mb-5">Your order will be ready shortly. Please check the screen for updates.</p>
            </div>
            
            <div class="d-grid gap-2">
                <a href="{{ route('welcome') }}" class="btn btn-kiosk btn-lg py-3">
                    <i class="fas fa-home me-2"></i> Back to Homepage
                </a>
            </div>
        </div>
    </div>
</div>
@endsection