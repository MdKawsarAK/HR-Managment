@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>First name</label>
    <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Last name</label>
    <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Leave category id</label>
    <select name="leave_category_id" class="form-control">
        <option value="">Select Leave category id</option>
        @foreach ($leaveCategories as $option)
            <option value="{{ $option->id }}" {{ old('leave_category_id', $leaveConfig->leave_category_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Days</label>
    <input type="text" name="days" value="{{ old('days', $leaveConfig->days ?? '') }}" class="form-control">
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>