@extends('layouts.master')

@section('page')
<div class="container py-3">
    <!-- Header -->
    <div class="card bg-primary text-white mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">Salary Configuration List</h3>
            <a href="{{ route('salaries.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i> Add New Salary
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Employee</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Remarks</th>
                        <th>Created</th>
                        <th style="width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salaries as $salary)
                        <tr>
                            <td>{{ $salary->employee->first_name }} {{ $salary->employee->last_name }}</td>
                            <td><span class="badge bg-secondary text-capitalize">{{ $salary->status }}</span></td>
                            <td>{{ number_format($salary->salary_total, 2) }}</td>
                            <td>{{ $salary->remarks }}</td>
                            <td>{{ \Carbon\Carbon::parse($salary->created_at)->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('salaries.destroy', $salary->id) }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this salary?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No salary configurations found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection