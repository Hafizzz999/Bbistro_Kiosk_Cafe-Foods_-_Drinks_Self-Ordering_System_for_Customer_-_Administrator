@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-3">Select Your Table</h1>
        <p class="lead text-muted">Please choose an available table</p>
    </div>
    
    <form method="POST" action="{{ route('customer.table') }}" id="table-form">
        @csrf
        <div class="row g-4">
            @foreach($tables as $table)
            <div class="col-md-3 col-sm-4 col-6">
                <input type="radio" name="table_id" value="{{ $table->id }}" id="table-{{ $table->id }}" class="d-none" {{ $table->status !== 'Available' ? 'disabled' : '' }}>
                <label for="table-{{ $table->id }}" class="card card-kiosk table-card text-center {{ $table->status === 'Available' ? 'table-available' : 'table-occupied' }}"
                    data-status="{{ $table->status }}" style="cursor: {{ $table->status === 'Available' ? 'pointer' : 'not-allowed' }};">
                    <div class="card-body py-4">
                        <i class="fas fa-chair fa-3x mb-3"></i>
                        <h3 class="mb-0">{{ $table->table_number }}</h3>
                        <div class="mt-2">
                            <span class="badge bg-{{ $table->status === 'Available' ? 'light text-dark' : 'dark' }}">
                                {{ $table->status }}
                            </span>
                        </div>
                    </div>
                </label>
            </div>
            @endforeach
        </div>
    </form>
    
    <div class="fixed-bottom p-3 bg-light border-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('customer.dining') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </a>
                <button id="select-table" class="btn btn-kiosk" disabled>
                    Select Table <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        let selectedTable = null;
        
        $('.table-card').click(function() {
            if ($(this).data('status') === 'Available') {
                $('.table-card').removeClass('selected');
                $(this).addClass('selected');
                selectedTable = $(this).find('h3').text();
                $('#select-table').prop('disabled', false);

                // Check the radio input
                $(this).prev('input[type="radio"]').prop('checked', true);
            }
        });
        
        $('#select-table').click(function() {
            if (selectedTable) {
                $('#table-form').submit();
            }
        });
    });
</script>
@endsection
@endsection