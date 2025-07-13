@extends('layouts.master')
@section('page')
    <!-- Page Header -->
    <div class="card bg-primary mb-3 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">Create LeaveApplication</h3>
                <a href="{{ route('leave_applications.index') }}" class="btn btn-light btn-sm" title="Back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div> 
<div class="mb-2">
    <strong>Id:</strong> {{ $leaveApplication->id }}
</div>
<div class="mb-2">
    <strong>Created at:</strong> {{ $leaveApplication->created_at }}
</div>
<div class="mb-2">
    <strong>Person id:</strong> {{ $leaveApplication->person->name ?? $leaveApplication->person_id }}
</div>
<div class="mb-2">
    <strong>Reason id:</strong> {{ $leaveApplication->reason->name ?? $leaveApplication->reason_id }}
</div>
<div class="mb-2">
    <strong>Remark:</strong> {{ $leaveApplication->remark }}
</div>
<div class="mb-2">
    <strong>From date:</strong> {{ $leaveApplication->from_date }}
</div>
<div class="mb-2">
    <strong>To date:</strong> {{ $leaveApplication->to_date }}
</div>
<div class="mb-2">
    <strong>Status id:</strong> {{ $leaveApplication->status->name ?? $leaveApplication->status_id }}
</div>
<div class="mb-2">
    <strong>Category id:</strong> {{ $leaveApplication->category->name ?? $leaveApplication->category_id }}
</div>
<div class="mb-2">
    <strong>Days:</strong> {{ $leaveApplication->days }}
</div>

@endsection