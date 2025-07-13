@extends('layouts.master')
@section('page')
    <!-- Page Header -->
    <div class="card bg-primary mb-3 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">Create __MODEL__</h3>
                <a href="{{ route('districts.index') }}" class="btn btn-light btn-sm" title="Back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div> 
<div class="mb-2">
    <strong>Id:</strong> {{ $district->id }}
</div>
<div class="mb-2">
    <strong>Name:</strong> {{ $district->name }}
</div>
<div class="mb-2">
    <strong>Division id:</strong> {{ $district->division->name ?? $district->division_id }}
</div>

@endsection