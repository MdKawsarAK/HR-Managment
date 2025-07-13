@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Employees id</label>
    <select name="employees_id" class="form-select">
        <option value="">Select Employees id</option>
        @foreach ($employees as $option)
            <option value="{{ $option->id }}" {{ old('employees_id', $attendance->employees_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Att datetime</label>
    <input type="date" name="att_datetime" value="{{ old('att_datetime', $attendance->att_datetime ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Attendance method id</label>
    <select name="attendance_method_id" class="form-select">
        <option value="">Select Attendance method id</option>
        @foreach ($attendanceMethods as $option)
            <option value="{{ $option->id }}" {{ old('attendance_method_id', $attendance->attendance_method_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Attendancereport id</label>
    <select name="attendancereport_id" class="form-select">
        <option value="">Select Attendancereport id</option>
        @foreach ($attendancereports as $option)
            <option value="{{ $option->id }}" {{ old('attendancereport_id', $attendance->attendancereport_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>