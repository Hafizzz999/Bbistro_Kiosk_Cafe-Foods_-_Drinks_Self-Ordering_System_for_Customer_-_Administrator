@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dining Table Management</h1>
        <a href="{{ route('table.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Table
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Table Number</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tables as $table)
                        <tr>
                            <td>{{ $table->id }}</td>
                            <td>{{ $table->table_number }}</td>
                            <td>
                                <span class="badge bg-{{ $table->status == 'Available' ? 'success' : 'danger' }}">
                                    {{ $table->status }}
                                </span>
                            </td>
                            <td>{{ $table->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('table.edit', $table->id) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('table.destroy', $table->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this table?')">
                                    <!-- CSRF Protection -->
                                    @csrf
                                    <!-- Method Spoofing for DELETE -->
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No tables found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $tables->links() }}
            </div>
        </div>
    </div>
</div>
@endsection