@extends('layouts.master')
@section('page')

<div class="container py-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title m-0">Edit Payroll Receipt</h3>
            <a href="{{ route('payroll_receipts.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card shadow-sm">
        <form action="{{ route('payroll_receipts.update', $payrollReceipt->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label for="employee_id" class="form-label">Employee</label>
                    <select name="employee_id" id="employee_id" class="form-select" required>
                        <option value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->first_name }} {{ $employee->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="">Select Status</option>
                        <option value="paid" {{ $payrollReceipt->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ $payrollReceipt->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="pending" {{ $payrollReceipt->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="remarks" class="form-label">Remarks</label>
                    <input type="text" name="remarks" id="remarks" class="form-control" value="{{ $payrollReceipt->remarks }}">
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Update Receipt
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
