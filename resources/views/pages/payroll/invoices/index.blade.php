@extends('layouts.master')
@section('page')

<div class="container py-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title m-0">Payroll Invoice List</h3>
            <a href="{{ route('payroll_invoices.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus mr-1"></i> Create New Invoice
            </a>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form class="row g-2">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search by employee name">
                    </div>
                </div>

                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Filter by Status</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Apply</button>
                </div>

                <div class="col-md-2">
                    <button type="reset" class="btn btn-outline-danger w-100">Reset</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Bill Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->employee->first_name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($invoice->bill_date)->format('d M Y') }}</td>
                            <td>{{ number_format($invoice->bill_total, 2) }}</td>
                            <td>{{ ucfirst($invoice->status) }}</td>
                            <td>{{ $invoice->remarks }}</td>
                            <td>
                                <a href="{{ route('payroll_invoices.show', $invoice->id) }}" class="btn btn-sm btn-primary">View</a>
                                <form action="{{ route('payroll_invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No invoices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if (method_exists($invoices, 'links'))
            <div class="card-footer d-flex justify-content-center">
                {{ $invoices->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
