@extends('layouts.master')

@section('page')
<div class="container py-4">
    <div class="card bg-primary text-white mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">Apply for Leave</h3>
            <a href="{{ route('leaves.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('leaves.store') }}">
        @csrf
        <div class="card shadow-sm">
            <div class="card-body row g-3">

                <!-- Employee -->
                <div class="col-md-6">
                    <label class="form-label">Employee</label>
                    <select id="employee-id" name="employee_id" class="form-control" required>
                        @foreach ($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Leave Category -->
                <div class="col-md-6">
                    <label class="form-label">Leave Category</label>
                    <select name="leave_category_id" class="form-control" required>
                        @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- From Date -->
                <div class="col-md-6">
                    <label class="form-label">From Date</label>
                    <input type="date" name="from_date" class="form-control" required>
                </div>

                <!-- To Date -->
                <div class="col-md-6">
                    <label class="form-label">To Date</label>
                    <input type="date" name="to_date" class="form-control" required>
                </div>

                <!-- Reason -->
                <div class="col-md-12">
                    <label class="form-label">Reason</label>
                    <textarea name="reason" class="form-control" rows="3" required></textarea>
                </div>

                <!-- Days -->
                <div class="col-md-6">
                    <label class="form-label">Total Days</label>
                    <input id="days" type="number" name="days" class="form-control" step="1" required>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status_id" class="form-control" required>
                        @foreach ($statuses as $stat)
                        <option value="{{ $stat->id }}">{{ $stat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-paper-plane"></i> Submit Application
                </button>
            </div>
        </div>
    </form>


    <script>
        const employeeSelect = document.getElementById('employee-id');
        const daysField = document.getElementById('days');
        
        employeeSelect.addEventListener("change", async () => {
            const response = await fetch(
                `http://127.0.0.1:8000/api/leave_count?id=${employeeSelect.value}`, {
                    method: "GET",
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                    },
                }
            );
            const result = await response.json();
            console.log(result);
            if (result.found) {
                daysField.value=result.days;
                alert(`Employee Found! Leave count: ${result.days}`);
            } else {
                console.log("Employee not found");
                alert('Employee Not found!')
            }
        });
    </script>
</div>
@endsection