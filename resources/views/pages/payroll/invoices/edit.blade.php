@extends('layouts.master')
@section('page')

<div class="container py-4">
    <div class="card bg-warning text-white mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title m-0">Edit Payroll Invoice</h3>
            <a href="{{ route('payroll-invoices.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <form action="{{ route('payroll-invoices.update', $invoice->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body row g-3">

                <!-- Reuse create form structure but pre-fill data -->
                @include('payroll_invoices._form', ['invoice' => $invoice])

            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Update Invoice
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
