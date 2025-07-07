@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Our Menu</h1>
            <p class="text-muted">Browse our delicious offerings</p>
        </div>
    </div>
    
    <div class="category-nav mb-4">
        <button class="category-btn active" data-category="all">All Items</button>
        @foreach($categories as $category)
        <button class="category-btn" data-category="{{ $category->id }}">
            {{ $category->name }}
        </button>
        @endforeach
    </div>
    
    <div class="row g-4">
        @foreach($products as $product)
        <div class="col-md-3 col-sm-4 col-6 product-card" data-category="{{ $product->category_id }}">
            <div class="card card-kiosk">
                <div class="position-relative">
                    @if($product->image)
                    <img src="{{ asset($product->image) }}" class="product-image">
                    @else
                    <div class="product-image-placeholder">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-primary">{{ $product->category->name }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                    <p class="card-text text-muted small">{{ $product->description }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="fw-bold text-primary">RM {{ number_format($product->price, 2) }}</span>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus"></i> Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<a href="{{ route('customer.cart') }}" class="floating-cart">
    <i class="fas fa-shopping-cart"></i>
    <span id="floating-cart-count" class="position-absolute top-0 start-100 translate-middle badge bg-danger">{{ array_sum(array_column(session('cart', []), 'quantity')) }}</span>
</a>

@section('scripts')
<script>
    // Category filtering
    $('.category-btn').click(function() {
        const categoryId = $(this).data('category');
        $('.category-btn').removeClass('active');
        $(this).addClass('active');

        if (categoryId === 'all') {
            $('.product-card').show();
        } else {
            $('.product-card').hide();
            $(`.product-card[data-category="${categoryId}"]`).show();
        }
        // In real app, this would filter products
    });
</script>
@endsection
@endsection