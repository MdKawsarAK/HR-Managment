@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Employee id</label>
    <select name="employee_id" class="form-control">
        <option value="">Select Employee id</option>
        @foreach ($employees as $option)
            <option value="{{ $option->id }}" {{ old('employee_id', $salary->employee_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Salary total</label>
    <input type="text" name="salary_total" value="{{ old('salary_total', $salary->salary_total ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Status</label>
    <input type="text" name="status" value="{{ old('status', $salary->status ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Remarks</label>
    <input type="text" name="remarks" value="{{ old('remarks', $salary->remarks ?? '') }}" class="form-control">
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>