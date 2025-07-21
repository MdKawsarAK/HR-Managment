@extends('layouts.master')

@section('page')
<div class="container py-4">
    <div class="card bg-info text-white mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">Leave Application Details</h3>
            <a href="{{ route('leaves.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <dl class="row">
                <dt class="col-md-4">Employee</dt>
                <dd class="col-md-8">{{ $application->employee->first_name }} {{ $application->employee->last_name }}</dd>

                <dt class="col-md-4">Category</dt>
                <dd class="col-md-8">{{ $application->category->name }}</dd>

                <dt class="col-md-4">From</dt>
                <dd class="col-md-8">{{ \Carbon\Carbon::parse($application->from_date)->format('d M Y') }}</dd>


                <dt class="col-md-4">To</dt>
                <dd class="col-md-8">{{ \Carbon\Carbon::parse($application->to_date)->format('d M Y') }}</dd>


                <dt class="col-md-4">Days</dt>
                <dd class="col-md-8">{{ $application->days }}</dd>

                <dt class="col-md-4">Reason</dt>
                <dd class="col-md-8">{{ $application->reason }}</dd>

                <dt class="col-md-4">Status</dt>
                <dd class="col-md-8">
                    <span class="badge bg-{{ $application->status->name == 'Approved' ? 'success' : ($application->status->name == 'Rejected' ? 'danger' : 'warning') }}">
                        {{ $application->status->name }}
                    </span>
                </dd>
            </dl>
        </div>
    </div>
</div>
@endsection
