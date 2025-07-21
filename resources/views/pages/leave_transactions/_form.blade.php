@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Employee id</label>
    <select name="employee_id" class="form-control">
        <option value="">Select Employee id</option>
        @foreach ($employees as $option)
            <option value="{{ $option->id }}" {{ old('employee_id', $leaveTransaction->employee_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>From date</label>
    <input type="date" name="from_date" value="{{ old('from_date', $leaveTransaction->from_date ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>To date</label>
    <input type="date" name="to_date" value="{{ old('to_date', $leaveTransaction->to_date ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Leave category id</label>
    <select name="leave_category_id" class="form-control">
        <option value="">Select Leave category id</option>
        @foreach ($leaveCategories as $option)
            <option value="{{ $option->id }}" {{ old('leave_category_id', $leaveTransaction->leave_category_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Days</label>
    <input type="text" name="days" value="{{ old('days', $leaveTransaction->days ?? '') }}" class="form-control">
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>