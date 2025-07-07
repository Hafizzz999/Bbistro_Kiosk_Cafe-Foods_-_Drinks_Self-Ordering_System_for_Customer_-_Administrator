@extends('layouts.customer')

@section('content')
<div class="container h-100 d-flex flex-column justify-content-center">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="mb-5">
                <h1 class="display-4 fw-bold mb-4">Welcome to Bbistro</h1>
                <p class="lead mb-5">Self-Service Ordering Kiosk</p>
                <div class="d-flex justify-content-center mb-4">
                    <div class="bg-light p-4 rounded-circle">
                        <img src="{{ asset('images/photo_6057551501695498248_x2.jpg') }}" alt="Bbistro Logo" class="welcome-logo">
                    </div>
                </div>
            </div>
            
            <div class="d-grid gap-3">
                <a href="{{ route('customer.dining') }}" class="btn btn-kiosk btn-lg py-4">
                    <i class="fas fa-play-circle me-2"></i> Start Order
                </a>
            </div>
        </div>
    </div>
</div>
@endsection