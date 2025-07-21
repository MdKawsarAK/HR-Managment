@extends('layouts.master')

@section('page')
<div class="container py-4">
    <h3>Leave Balance Report</h3>

    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-4">
            <input type="month" name="month" class="form-control"
                   value="{{ request('month') ?? now()->format('Y-m') }}">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary">Filter</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Employee</th>
                <th>Category</th>
                <th>Allowed</th>
                <th>Used</th>
                <th>Remaining</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report as $row)
                <tr>
                    <td>{{ $row->employee->first_name }} {{ $row->employee->last_name }}</td>
                    <td>{{ $row->category }}</td>
                    <td>{{ $row->allowed }}</td>
                    <td>{{ $row->used }}</td>
                    <td>{{ $row->remaining }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
