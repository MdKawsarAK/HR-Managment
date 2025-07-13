@extends('layouts.master')
@section('page')

<div class="container py-4">
    <div class="card bg-primary text-white mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title m-0">Invoice Details</h3>
            <a href="{{ route('payroll-invoices.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5>Employee: <strong>{{ $invoice->employee->first_name }} {{ $invoice->employee->last_name }}</strong></h5>
            <p><strong>Bill Date:</strong> {{ \Carbon\Carbon::parse($invoice->bill_date)->format('d M Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>
            <p><strong>Remarks:</strong> {{ $invoice->remarks }}</p>

            <hr>

            <h5>Invoice Items</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Payroll Item</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->details as $detail)
                    <tr>
                        <td>{{ $detail->item->name ?? 'N/A' }}</td>
                        <td>{{ number_format($detail->amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-end">Total:</th>
                        <th>{{ number_format($invoice->bill_total, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
