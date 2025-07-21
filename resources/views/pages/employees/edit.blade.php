@extends('layouts.master')

@section('page')
    <div class="container-fluid mt-4">
        {{-- Page Header --}}
        <div class="card bg-primary text-white mb-4 shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">Edit Employee: {{ $employee->first_name }} {{ $employee->last_name }}</h3>
                    <a href="{{ route('employees.index') }}" class="btn btn-light btn-sm d-inline-flex align-items-center" title="Back to Employee List">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
        </div>

        {{-- Employee Edit Form Card --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Update Employee Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf {{-- CSRF token for security --}}
                    @method('PUT') {{-- Method spoofing for PUT request --}}

                    {{-- Include your form partial here --}}
                    @include('pages.employees._form', ['mode' => 'edit', 'employee' => $employee])

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
                            <i class="fas fa-save me-2"></i> Update Employee
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- You might need to include Font Awesome for icons if not already included in your master layout --}}
    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>
@endpush