@extends('layouts.master')
@section('page')
    <!-- Page Header -->
    <div class="card bg-primary mb-3 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">Create LeaveTransaction</h3>
                <a href="{{ route('leave_transactions.index') }}" class="btn btn-light btn-sm" title="Back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div> 
<div class="mb-2">
    <strong>Id:</strong> {{ $leaveTransaction->id }}
</div>
<div class="mb-2">
    <strong>Employee id:</strong> {{ $leaveTransaction->employee->name ?? $leaveTransaction->employee_id }}
</div>
<div class="mb-2">
    <strong>From date:</strong> {{ $leaveTransaction->from_date }}
</div>
<div class="mb-2">
    <strong>To date:</strong> {{ $leaveTransaction->to_date }}
</div>
<div class="mb-2">
    <strong>Leave category id:</strong> {{ $leaveTransaction->leaveCategory->name ?? $leaveTransaction->leave_category_id }}
</div>
<div class="mb-2">
    <strong>Created at:</strong> {{ $leaveTransaction->created_at }}
</div>
<div class="mb-2">
    <strong>Days:</strong> {{ $leaveTransaction->days }}
</div>

@endsection