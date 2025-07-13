@extends('layouts.master')
@section('page')
    <!-- Page Header -->
    <div class="card bg-primary mb-3 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">Create PayrollItem</h3>
                <a href="{{ route('payroll_items.index') }}" class="btn btn-light btn-sm" title="Back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div> 
<div class="mb-2">
    <strong>Id:</strong> {{ $payrollItem->id }}
</div>
<div class="mb-2">
    <strong>Name:</strong> {{ $payrollItem->name }}
</div>
<div class="mb-2">
    <strong>Payroll item type id:</strong> {{ $payrollItem->payrollItemType->name ?? $payrollItem->payroll_item_type_id }}
</div>

@endsection