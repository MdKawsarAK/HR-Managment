@extends('layouts.master')

@section('page')
    <div class="container py-4">
        <div class="card bg-dark text-white mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h3 class="m-0">Leave Applications</h3>
                <a href="{{ route('leaves.create') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-plus"></i> Apply Leave
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Employee</th>
                            <th>Category</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leave_applications as $app)
                            <tr>
                                <td>{{ $app->employee->first_name }} {{ $app->employee->last_name }}</td>
                                <td>{{ $app->category->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($app->from_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($app->to_date)->format('d M Y') }}</td>
                                <td>{{ $app->days }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ optional($app->status)->name == 'Approved' ? 'success' : (optional($app->status)->name == 'Rejected' ? 'danger' : 'warning') }}">
                                        {{ optional($app->status)->name ?? 'Pending' }}
                                    </span>

                                </td>
                                <td>
                                    <a href="{{ route('leaves.show', $app->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('leaves.edit', $app->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('leaves.destroy', $app->id) }}" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this application?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No leave applications found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection