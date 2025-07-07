@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-3">Select Dining Method</h1>
        <p class="lead text-muted">How would you like to enjoy your order?</p>
    </div>
    
    <form method="POST" action="{{ route('customer.dining') }}">
        @csrf
        <div class="row justify-content-center g-4">
            <div class="col-md-6">
                <button type="submit" name="dining_method" value="Eat In" class="card card-kiosk h-100 text-center w-100 border-0 bg-transparent p-0">
                    <div class="card-body p-5">
                        <div class="mb-4">
                            <i class="fas fa-utensils fa-5x text-primary mb-3"></i>
                            <h2 class="fw-bold">Eat In</h2>
                            <p class="text-muted">Enjoy your meal in our cozy cafe</p>
                        </div>
                    </div>
                </button>
            </div>
        
            <div class="col-md-6">
                <button type="submit" name="dining_method" value="Take Away" class="card card-kiosk h-100 text-center w-100 border-0 bg-transparent p-0">
                    <div class="card-body p-5">
                        <div class="mb-4">
                            <i class="fas fa-shopping-bag fa-5x text-secondary mb-3"></i>
                            <h2 class="fw-bold">Take Away</h2>
                            <p class="text-muted">Take your order to go</p>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection