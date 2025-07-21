@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Employee id</label>
    <select name="employee_id" class="form-control">
        <option value="">Select Employee id</option>
        @foreach ($employees as $option)
            <option value="{{ $option->id }}" {{ old('employee_id', $leaveApplication->employee_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Reason</label>
    <input type="text" name="reason" value="{{ old('reason', $leaveApplication->reason ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>From date</label>
    <input type="date" name="from_date" value="{{ old('from_date', $leaveApplication->from_date ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>To date</label>
    <input type="date" name="to_date" value="{{ old('to_date', $leaveApplication->to_date ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Status id</label>
    <select name="status_id" class="form-control">
        <option value="">Select Status id</option>
        @foreach ($statuses as $option)
            <option value="{{ $option->id }}" {{ old('status_id', $leaveApplication->status_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Leave category id</label>
    <select name="leave_category_id" class="form-control">
        <option value="">Select Leave category id</option>
        @foreach ($leaveCategories as $option)
            <option value="{{ $option->id }}" {{ old('leave_category_id', $leaveApplication->leave_category_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Days</label>
    <input type="text" name="days" value="{{ old('days', $leaveApplication->days ?? '') }}" class="form-control">
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>