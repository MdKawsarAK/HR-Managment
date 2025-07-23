@extends('layouts.master')

@section('page')
<div class="container py-4">
    <div class="card bg-info text-white mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">Leave Configurations</h3>
            <a href="{{ route('leave_configs.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i> Add New
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Employee</th>
                        <th>Category</th>
                        <th>Allowed Days</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($configs as $cfg)
                    <tr>
                        <td>{{ $cfg->employee->first_name }} {{ $cfg->employee->last_name }}</td>
                        <td>{{ $cfg->category->name }}</td>
                        <td>{{ $cfg->days }}</td>
                        <td>
    <a href="{{ route('leave_configs.show', $cfg->id) }}" class="btn btn-sm btn-info">View</a>

                            <a href="{{ route('leave_configs.edit', $cfg->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('leave_configs.destroy', $cfg->id) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete config?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No leave configs found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection