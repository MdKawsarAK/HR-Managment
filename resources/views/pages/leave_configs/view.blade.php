@extends('layouts.master')

@section('page')
<div class="container py-4">
    <div class="card bg-secondary text-white mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">Leave Config Details</h3>
            <a href="{{ route('leave_configs.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <dl class="row">
                <dt class="col-md-3">Employee</dt>
                <dd class="col-md-9">{{ $config->employee->first_name }} {{ $config->employee->last_name }}</dd>

                <dt class="col-md-3">Leave Category</dt>
                <dd class="col-md-9">{{ $config->category->name }}</dd>

                <dt class="col-md-3">Allowed Days</dt>
                <dd class="col-md-9">{{ $config->days }}</dd>
            </dl>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('leave_configs.edit', $config->id) }}" class="btn btn-warning">
                <i class="fa fa-edit"></i> Edit
            </a>
            <form method="POST" action="{{ route('leave_configs.destroy', $config->id) }}" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Delete this config?')">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
