@extends('layouts.master')
@section('page')
    <!-- Page Header -->
    <div class="card bg-primary mb-3 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">Create LeaveCategory</h3>
                <a href="{{ route('leave_categories.index') }}" class="btn btn-light btn-sm" title="Back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div>    
    <form action="{{ route('leave_categories.store') }}" method="POST" enctype="multipart/form-data">
        @include('pages.leave_categories._form', ['mode' => 'create', 'leaveCategory' => new App\Models\LeaveCategory])
    </form>
@endsection