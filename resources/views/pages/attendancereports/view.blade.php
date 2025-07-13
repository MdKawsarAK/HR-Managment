@extends('layouts.master')
@section('page')
    <!-- Page Header -->
    <div class="card bg-primary mb-3 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">Create Attendancereport</h3>
                <a href="{{ route('attendancereports.index') }}" class="btn btn-light btn-sm" title="Back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div> 
<div class="mb-2">
    <strong>Id:</strong> {{ $attendancereport->id }}
</div>
<div class="mb-2">
    <strong>Employees id:</strong> {{ $attendancereport->employee->name ?? $attendancereport->employees_id }}
</div>
<div class="mb-2">
    <strong>Att datetime:</strong> {{ $attendancereport->att_datetime }}
</div>
<div class="mb-2">
    <strong>Check in:</strong> {{ $attendancereport->check_in }}
</div>
<div class="mb-2">
    <strong>Check out:</strong> {{ $attendancereport->check_out }}
</div>

@endsection