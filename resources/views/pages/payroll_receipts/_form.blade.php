@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Employee id</label>
    <select name="employee_id" class="form-select">
        <option value="">Select Employee id</option>
        @foreach ($employees as $option)
            <option value="{{ $option->id }}" {{ old('employee_id', $payrollReceipt->employee_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Receipt total</label>
    <input type="text" name="receipt_total" value="{{ old('receipt_total', $payrollReceipt->receipt_total ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Status</label>
    <input type="text" name="status" value="{{ old('status', $payrollReceipt->status ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Remarks</label>
    <input type="text" name="remarks" value="{{ old('remarks', $payrollReceipt->remarks ?? '') }}" class="form-control">
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>