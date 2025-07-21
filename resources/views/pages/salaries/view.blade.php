@extends('layouts.master')

@section('page')
<div class="container py-5">
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold text-primary">💰 Salary Details</h2>
            <a href="{{ route('salaries.index') }}" class="btn btn-outline-primary">
                <i class="fa fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
        <div class="card border-0 shadow rounded-3">
            <div class="card-body">
                <h4 class="text-dark mb-3">{{ $salary->employee->first_name }} {{ $salary->employee->last_name }}</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <p><strong>Status:</strong> 
                            <span class="badge text-bg-info text-capitalize">{{ $salary->status }}</span>
                        </p>
                        <p><strong>Total Amount:</strong> 
                            <span class="text-success fw-semibold">{{ number_format($salary->salary_total, 2) }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Remarks:</strong> {{ $salary->remarks }}</p>
                        <p><strong>Created At:</strong> 
                            {{ \Carbon\Carbon::parse($salary->created_at)->format('d M, Y h:i A') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Salary Breakdown Table -->
    <div class="card border-0 shadow rounded-3">
        <div class="card-header bg-light">
            <h5 class="fw-bold m-0">🧾 Salary Breakdown</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>Payroll Item</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salary->details as $detail)
                        <tr>
                            <td>{{ $detail->payroll_item->name ?? 'Unknown Item' }}</td>
                            <td class="text-end">{{ number_format($detail->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
