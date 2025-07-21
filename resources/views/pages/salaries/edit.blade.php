@extends('layouts.master')

@section('page')
<div class="container py-4">
    <div class="card bg-warning text-white mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">Edit Salary Configuration</h3>
            <a href="{{ route('salaries.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('salaries.update', $salary->id) }}">
        @csrf
        @method('PUT')

        <div class="card shadow-sm">
            <div class="card-body row g-3">
                <!-- Employee -->
                <div class="col-md-6">
                    <label for="employee_id" class="form-label">Employee</label>
                    <select name="employee_id" class="form-control" required>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}"
                                @if($salary->employee_id == $emp->id) selected @endif>
                                {{ $emp->first_name }} {{ $emp->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="paid" @selected($salary->status == 'paid')>Paid</option>
                        <option value="unpaid" @selected($salary->status == 'unpaid')>Unpaid</option>
                        <option value="pending" @selected($salary->status == 'pending')>Pending</option>
                    </select>
                </div>

                <!-- Remarks -->
                <div class="col-md-12">
                    <label for="remarks" class="form-label">Remarks</label>
                    <input type="text" name="remarks" class="form-control" value="{{ $salary->remarks }}">
                </div>

                <!-- Salary Items -->
                <div class="col-12">
                    <label class="form-label">Salary Items</label>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salary->details as $index => $detail)
                                <tr>
                                    <td>
                                        <select name="items[{{ $index }}][payroll_item_id]" class="form-control" required>
                                            @foreach ($payroll_items as $item)
                                                <option value="{{ $item->id }}"
                                                    @if($detail->payroll_item_id == $item->id) selected @endif>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="items[{{ $index }}][amount]" class="form-control"
                                            value="{{ $detail->amount }}" step="0.01" required>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update Salary
                </button>
            </div>
        </div>
    </form>
</div>
@endsection