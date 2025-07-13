@extends('layouts.master')
@section('page')
    <!-- Page Header -->
    <div class="card bg-primary mb-3 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">Create Attendancemethod</h3>
                <a href="{{ route('attendancemethods.index') }}" class="btn btn-light btn-sm" title="Back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div> 
<div class="mb-2">
    <strong>Id:</strong> {{ $attendancemethod->id }}
</div>
<div class="mb-2">
    <strong>Name:</strong> {{ $attendancemethod->name }}
</div>
<div class="mb-2">
    <strong>Created at:</strong> {{ $attendancemethod->created_at }}
</div>

@endsection