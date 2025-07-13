@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $payrollItem->name ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Payroll item type id</label>
    <select name="payroll_item_type_id" class="form-select">
        <option value="">Select Payroll item type id</option>
        @foreach ($payrollItemTypes as $option)
            <option value="{{ $option->id }}" {{ old('payroll_item_type_id', $payrollItem->payroll_item_type_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>