@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Checkout</h1>
            <p class="text-muted">Complete your order</p>
        </div>
        <div class="cart-icon position-relative">
            <i class="fas fa-shopping-cart"></i>
            <span id="cart-count" class="cart-badge">{{ array_sum(array_column(session('cart', []), 'quantity')) }}</span>
        </div>
    </div>
    
    <div class="card card-kiosk mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Order Summary</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <span>{{ count(session('cart', [])) }} Items</span>
                <span class="fw-bold">RM {{ number_format($subtotal, 2) }}</span>
            </div>
            <ul class="list-group list-group-flush">
                @foreach(session('cart', []) as $id => $item)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                    <span>RM {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    
    <div class="card card-kiosk mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Select Payment Method</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('customer.checkout') }}" method="POST" id="checkout-form">
                @csrf
                <div class="row g-3">
                    @foreach($paymentMethods as $method)
                    <div class="col-md-4">
                        <div class="card card-kiosk text-center payment-method" data-method="{{ $method->id }}">
                            <div class="card-body py-4">
                                <i class="fas fa-{{ $method->name == 'Cash' ? 'money-bill-wave' : ($method->name == 'QR Pay' ? 'qrcode' : 'credit-card') }} fa-3x text-success mb-3"></i>
                                <h5>{{ $method->name }}</h5>
                                <input type="radio" name="payment_method" value="{{ $method->id }}" class="d-none" id="method-{{ $method->id }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </form>

        </div>
    </div>
    
    <div class="d-grid gap-3">
        <button id="confirm-order" class="btn btn-kiosk btn-lg py-3" disabled>
            <i class="fas fa-check-circle me-2"></i> Confirm Order
        </button>
        <a href="{{ route('customer.cart') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Cart
        </a>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        let selectedMethod = null;
        
        $('.payment-method').click(function() {
            $('.payment-method').removeClass('border border-2 border-primary');
            $(this).addClass('border border-2 border-primary');
            selectedMethod = $(this).data('method');
            $(`#method-${selectedMethod}`).prop('checked', true);
            $('#confirm-order').prop('disabled', false);
        });
        
        $('#confirm-order').click(function() {
            if (selectedMethod) {
                $('#checkout-form').submit();
            }
        });
    });
</script>
@endsection
@endsection