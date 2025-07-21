@extends('layouts.master')

@section('page')
<div class="container py-4">
    <div class="card bg-primary text-white mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">Create Salary Configuration</h3>
            <a href="{{ route('salaries.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('salaries.store') }}">
        @csrf

        <div class="card shadow-sm">
            <div class="card-body row g-3">
                <!-- Employee -->
                <div class="col-md-6">
                    <label for="employee_id" class="form-label">Employee</label>
                    <select name="employee_id" class="form-control" required>
                        <option value="">Select Employee</option>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <!-- Remarks -->
                <div class="col-md-12">
                    <label for="remarks" class="form-label">Remarks</label>
                    <input type="text" name="remarks" class="form-control" placeholder="Optional">
                </div>

                <!-- Salary Items -->
                <div class="col-12">
                    <label class="form-label">Salary Items</label>
                    <table class="table table-bordered" id="salary-items-table">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Amount</th>
                                <th style="width: 50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="items[0][payroll_item_id]" class="form-control" required>
                                        <option value="">Select Item</option>
                                        @foreach ($payroll_items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="items[0][amount]" class="form-control" required step="0.01">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger remove-item">&times;</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button id="add-item" type="button" class="btn btn-sm btn-primary mt-2">
                        <i class="fa fa-plus"></i> Add Item
                    </button>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Save Salary
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let rowIndex = 1;

    document.getElementById('add-item').addEventListener('click', () => {
        const tableBody = document.querySelector('#salary-items-table tbody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>
                <select name="items[${rowIndex}][payroll_item_id]" class="form-control" required>
                    <option value="">Select Item</option>
                    @foreach ($payroll_items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="items[${rowIndex}][amount]" class="form-control" required step="0.01">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger remove-item">&times;</button>
            </td>
        `;

        tableBody.appendChild(newRow);
        rowIndex++;
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            const row = e.target.closest('tr');
            row.remove();
        }
    });
</script>
@endsection