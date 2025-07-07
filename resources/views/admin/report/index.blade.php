@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Sales Reports</h1>
        <div class="d-flex align-items-center">
            <span class="badge bg-primary fs-6 me-3">
                Total Revenue: {{ number_format($totalRevenue, 2) }}
            </span>
            <button class="btn btn-success" onclick="exportToExcel()">
                <i class="fas fa-file-excel"></i> Export to Excel
            </button>
        </div>
    </div>

    <!-- Date Filter Form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('report.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="from" class="form-label">From Date</label>
                        <input type="date" 
                               class="form-control" 
                               id="from" 
                               name="from"
                               value="{{ request('from') }}"
                               max="{{ now()->format('Y-m-d') }}">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="to" class="form-label">To Date</label>
                        <input type="date" 
                               class="form-control" 
                               id="to" 
                               name="to"
                               value="{{ request('to') }}"
                               max="{{ now()->format('Y-m-d') }}">
                    </div>
                    
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Apply Filters
                        </button>
                    </div>
                    
                    <div class="col-md-2">
                        <a href="{{ route('report.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Total Orders</h5>
                            <h3 class="card-text">{{ $orders->count() }}</h3>
                        </div>
                        <i class="fas fa-receipt fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Completed Orders</h5>
                            <h3 class="card-text">{{ $orders->where('status', 'Completed')->count() }}</h3>
                        </div>
                        <i class="fas fa-check-circle fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Avg. Order Value</h5>
                            <h3 class="card-text">
                                {{ $orders->count() > 0 ? number_format($orders->avg('total_price'), 2) : '0.00' }}
                            </h3>
                        </div>
                        <i class="fas fa-dollar-sign fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="reportTable">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Method</th>
                            <th>Table</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Total</th>
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
                            <td>{{ $order->payment_method }}</td>
                            <td>
                                <span class="badge 
                                    @if($order->status == 'Pending') bg-warning
                                    @elseif($order->status == 'Completed') bg-success
                                    @else bg-danger @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="fw-bold">{{ number_format($order->total_price, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No orders found in selected period</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="table-secondary">
                        <tr>
                            <td colspan="6" class="text-end fw-bold">Total Revenue:</td>
                            <td class="fw-bold">{{ number_format($totalRevenue, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Excel Export Script -->
<script>
function exportToExcel() {
    // Get table element
    const table = document.getElementById('reportTable');
    
    // Create a new workbook
    const wb = XLSX.utils.book_new();
    
    // Convert table to worksheet
    const ws = XLSX.utils.table_to_sheet(table);
    
    // Add worksheet to workbook
    XLSX.utils.book_append_sheet(wb, ws, 'Sales Report');
    
    // Generate file name with date range
    const fromDate = document.getElementById('from').value || 'all';
    const toDate = document.getElementById('to').value || 'today';
    const fileName = `sales_report_${fromDate}_to_${toDate}.xlsx`;
    
    // Save the file
    XLSX.writeFile(wb, fileName);
}
</script>

<!-- Include SheetJS for Excel export -->
<script src="https://cdn.sheetjs.com/xlsx-0.19.3/package/dist/xlsx.full.min.js"></script>
@endsection