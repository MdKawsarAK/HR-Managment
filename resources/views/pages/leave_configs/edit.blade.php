@extends('layouts.master')

@section('page')
<div class="container py-4">
    <div class="card bg-warning text-white mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">Edit Leave Configuration</h3>
            <a href="{{ route('leave_configs.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('leave_configs.update', $config->id) }}">
        @csrf
        @method('PUT')
        <div class="card shadow-sm">
            <div class="card-body row g-3">
                <!-- Employee -->
                <div class="col-md-6">
                    <label for="employee_id" class="form-label">Employee</label>
                    <select name="employee_id" class="form-control" required>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}" @selected($config->employee_id == $emp->id)>
                                {{ $emp->first_name }} {{ $emp->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Leave Category -->
                <div class="col-md-6">
                    <label for="leave_category_id" class="form-label">Leave Category</label>
                    <select name="leave_category_id" class="form-control" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @selected($config->leave_category_id == $cat->id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Days -->
                <div class="col-md-12">
                    <label for="days" class="form-label">Allowed Days</label>
                    <input type="number" name="days" class="form-control" step="1"
                           value="{{ old('days', $config->days) }}" required>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update Config
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
