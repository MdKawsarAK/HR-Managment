@extends('layouts.master')
@section('page')
    <!-- Page Header -->
    <div class="card bg-primary mb-3 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">Create Attendance</h3>
                <a href="{{ route('attendances.index') }}" class="btn btn-light btn-sm" title="Back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div> 
<div class="mb-2">
    <strong>Id:</strong> {{ $attendance->id }}
</div>
<div class="mb-2">
    <strong>Employees id:</strong> {{ $attendance->employee->name ?? $attendance->employees_id }}
</div>
<div class="mb-2">
    <strong>Att datetime:</strong> {{ $attendance->att_datetime }}
</div>
<div class="mb-2">
    <strong>Attendance method id:</strong> {{ $attendance->attendanceMethod->name ?? $attendance->attendance_method_id }}
</div>
<div class="mb-2">
    <strong>Attendancereport id:</strong> {{ $attendance->attendancereport->name ?? $attendance->attendancereport_id }}
</div>

@endsection