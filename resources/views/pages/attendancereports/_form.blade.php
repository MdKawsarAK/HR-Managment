@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Employees id</label>
    <select name="employees_id" class="form-select">
        <option value="">Select Employees id</option>
        @foreach ($employees as $option)
            <option value="{{ $option->id }}" {{ old('employees_id', $attendancereport->employees_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Att datetime</label>
    <input type="date" name="att_datetime" value="{{ old('att_datetime', $attendancereport->att_datetime ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Check in</label>
    <input type="text" name="check_in" value="{{ old('check_in', $attendancereport->check_in ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Check out</label>
    <input type="text" name="check_out" value="{{ old('check_out', $attendancereport->check_out ?? '') }}" class="form-control">
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>