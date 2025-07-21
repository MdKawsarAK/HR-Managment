@extends('layouts.master')

@section('page')
    <div class="container-fluid mt-4">
        {{-- Page Header --}}
        <div class="card bg-primary text-white mb-4 shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">Employee Details: {{ $employee->first_name }} {{ $employee->last_name }}</h3>
                    <a href="{{ route('employees.index') }}" class="btn btn-light btn-sm d-inline-flex align-items-center" title="Back to Employee List">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Employee Photo Section --}}
            <div class="col-lg-4 col-md-5 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Employee Photo</h5>
                    </div>
                    <div class="card-body text-center p-4">
                        @if($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}" class="img-fluid rounded-circle mb-3" alt="Employee Photo" style="width: 180px; height: 180px; object-fit: cover; border: 3px solid #007bff;">
                        @else
                            <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3" style="width: 180px; height: 180px; border: 1px dashed #ced4da;">
                                <i class="fas fa-user-circle fa-5x"></i>
                            </div>
                            <p class="text-muted">No Photo Available</p>
                        @endif
                        <h4 class="mt-3 mb-0 text-primary">{{ $employee->first_name }} {{ $employee->last_name }}</h4>
                        <p class="text-muted">{{ $employee->category->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            {{-- Employee Details Section --}}
            <div class="col-lg-8 col-md-7 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-id-badge text-primary me-2"></i>Employee ID:</strong>
                                <p class="text-muted mb-0">{{ $employee->id }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-envelope text-primary me-2"></i>Email:</strong>
                                <p class="text-muted mb-0">{{ $employee->email }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-phone-alt text-primary me-2"></i>Phone:</strong>
                                <p class="text-muted mb-0">{{ $employee->phone }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-calendar-alt text-primary me-2"></i>Date of Birth:</strong>
                                <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($employee->dob)->format('M d, Y') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-venus-mars text-primary me-2"></i>Gender:</strong>
                                <p class="text-muted mb-0">{{ ucfirst($employee->gender) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-id-card-alt text-primary me-2"></i>NID:</strong>
                                <p class="text-muted mb-0">{{ $employee->nid }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-map-marker-alt text-primary me-2"></i>Address:</strong>
                                <p class="text-muted mb-0">{{ $employee->address }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-tint text-primary me-2"></i>Blood Group:</strong>
                                <p class="text-muted mb-0">{{ $employee->blood->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <hr class="my-3">

                        <h5 class="mb-3">Employment Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-briefcase text-primary me-2"></i>Category:</strong>
                                <p class="text-muted mb-0">{{ $employee->category->name ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-calendar-check text-primary me-2"></i>Hire Date:</strong>
                                <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-money-bill-wave text-primary me-2"></i>Salary:</strong>
                                <p class="text-muted mb-0">{{ number_format($employee->salary, 2) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-info-circle text-primary me-2"></i>Status:</strong>
                                <p class="text-muted mb-0">{{ ucfirst($employee->status) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-clock text-primary me-2"></i>Created At:</strong>
                                <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($employee->created_at)->format('M d, Y h:i A') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-history text-primary me-2"></i>Last Updated:</strong>
                                <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($employee->updated_at)->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- You might need to include Font Awesome for icons if not already included in your master layout --}}
    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>
@endpush