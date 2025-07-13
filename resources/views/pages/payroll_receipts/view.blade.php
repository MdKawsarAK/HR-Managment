@extends('layouts.master')
@section('page')

<div class="container py-4">
    <div class="card bg-primary text-white mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title m-0">Payroll Receipt #{{ $payrollReceipt->id }}</h3>
            <a href="{{ route('payroll_receipts.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card shadow-sm p-4">
        <h5>Employee: <strong>{{ $payrollReceipt->employee->first_name ?? 'N/A' }} {{ $payrollReceipt->employee->last_name ?? '' }}</strong></h5>
        <p>Date: {{ $payrollReceipt->created_at ? $payrollReceipt->created_at->format('d M Y, H:i') : 'N/A' }}</p>
        <p>Total Amount: ${{ number_format($payrollReceipt->receipt_total, 2) }}</p>
        <p>Status: <span class="badge 
            @if($payrollReceipt->status == 'paid') bg-success
            @elseif($payrollReceipt->status == 'unpaid') bg-danger
            @elseif($payrollReceipt->status == 'pending') bg-warning
            @else bg-secondary
            @endif
            ">
            {{ ucfirst($payrollReceipt->status) }}
        </span></p>
        <p>Remarks: {{ $payrollReceipt->remarks }}</p>

        <!-- Optional: Add receipt details if you have a relation set up -->
        @if($payrollReceipt->details && $payrollReceipt->details->count())
            <h5 class="mt-4">Receipt Details</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Payroll Item</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payrollReceipt->details as $detail)
                        <tr>
                            <td>{{ $detail->payrollItem->name ?? 'N/A' }}</td>
                            <td>${{ number_format($detail->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
