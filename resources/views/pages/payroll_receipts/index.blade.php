@extends('layouts.master')

@section('page')
<div class="container py-4">
    <!-- Header -->
    <div class="card bg-primary text-white mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">Payroll Receipt List</h3>
            <a href="{{ route('payroll_receipts.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus mr-1"></i> Create New Receipt
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($receipts as $receipt)
                        <tr>
                            <td>{{ $receipt->id }}</td>
                            <td>{{ $receipt->employee->first_name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($receipt->created_at)->format('d M Y') }}</td>
                            <td>{{ number_format($receipt->receipt_total, 2) }}</td>
                            <td>{{ ucfirst($receipt->status) }}</td>
                            <td>{{ $receipt->remarks }}</td>
                            <td>
                                <a href="{{ route('payroll_receipts.show', $receipt->id) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('payroll_receipts.edit', $receipt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('payroll_receipts.destroy', $receipt->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this receipt?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">No receipts found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($receipts->hasPages())
        <div class="card-footer d-flex justify-content-center">
            {{ $receipts->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
