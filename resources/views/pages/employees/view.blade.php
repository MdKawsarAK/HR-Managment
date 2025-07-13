@extends('layouts.master')
@section('page')
    <!-- Page Header -->
    <div class="card bg-primary mb-3 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">Create Employee</h3>
                <a href="{{ route('employees.index') }}" class="btn btn-light btn-sm" title="Back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div> 
<div class="mb-2">
    <strong>Id:</strong> {{ $employee->id }}
</div>
<div class="mb-2">
    <strong>First name:</strong> {{ $employee->first_name }}
</div>
<div class="mb-2">
    <strong>Last name:</strong> {{ $employee->last_name }}
</div>
<div class="mb-2">
    <strong>Category id:</strong> {{ $employee->category->name ?? $employee->category_id }}
</div>
<div class="mb-2">
    <strong>Hire date:</strong> {{ $employee->hire_date }}
</div>
<div class="mb-2">
    <strong>Photo:</strong><br>
    @if($employee->photo)
        <img src="{{ asset('storage/' . $employee->photo) }}" width="150">
    @else
        No Photo
    @endif
</div>
<div class="mb-2">
    <strong>Email:</strong> {{ $employee->email }}
</div>
<div class="mb-2">
    <strong>Status:</strong> {{ $employee->status }}
</div>
<div class="mb-2">
    <strong>Salary:</strong> {{ $employee->salary }}
</div>
<div class="mb-2">
    <strong>Created at:</strong> {{ $employee->created_at }}
</div>
<div class="mb-2">
    <strong>Updated at:</strong> {{ $employee->updated_at }}
</div>
<div class="mb-2">
    <strong>Phone:</strong> {{ $employee->phone }}
</div>
<div class="mb-2">
    <strong>Nid:</strong> {{ $employee->nid }}
</div>
<div class="mb-2">
    <strong>Gender:</strong> {{ $employee->gender }}
</div>
<div class="mb-2">
    <strong>Address:</strong> {{ $employee->address }}
</div>
<div class="mb-2">
    <strong>Dob:</strong> {{ $employee->dob }}
</div>
<div class="mb-2">
    <strong>Blood id:</strong> {{ $employee->blood->name ?? $employee->blood_id }}
</div>

@endsection