@extends('layouts.master')

@section('page')
<div class="container py-4">
    <div class="card bg-warning text-white mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">Edit Leave Application</h3>
            <a href="{{ route('leaves.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('leaves.update', $application->id) }}">
        @csrf @method('PUT')
        <div class="card shadow-sm">
            <div class="card-body row g-3">

                <div class="col-md-6">
                    <label>Employee</label>
                    <select name="employee_id" class="form-control" required>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" @selected($application->employee_id == $emp->id)>
                                {{ $emp->first_name }} {{ $emp->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Leave Category</label>
                    <select name="leave_category_id" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected($application->leave_category_id == $cat->id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>From Date</label>
                    <input type="date" name="from_date" class="form-control"
                           value="{{ $application->from_date->format('Y-m-d') }}" required>
                </div>

                <div class="col-md-6">
                    <label>To Date</label>
                    <input type="date" name="to_date" class="form-control"
                           value="{{ $application->to_date->format('Y-m-d') }}" required>
                </div>

                <div class="col-md-12">
                    <label>Reason</label>
                    <textarea name="reason" class="form-control" rows="3" required>{{ $application->reason }}</textarea>
                </div>

                <div class="col-md-6">
                    <label>Days</label>
                    <input type="number" name="days" class="form-control" step="1"
                           value="{{ $application->days }}" required>
                </div>

                <div class="col-md-6">
                    <label>Status</label>
                    <select name="status_id" class="form-control" required>
                        @foreach($statuses as $stat)
                            <option value="{{ $stat->id }}" @selected($application->status_id == $stat->id)>
                                {{ $stat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update Application
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
