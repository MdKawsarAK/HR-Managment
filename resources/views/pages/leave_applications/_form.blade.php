@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Person id</label>
    <select name="person_id" class="form-select">
        <option value="">Select Person id</option>
        @foreach ($people as $option)
            <option value="{{ $option->id }}" {{ old('person_id', $leaveApplication->person_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Reason id</label>
    <select name="reason_id" class="form-select">
        <option value="">Select Reason id</option>
        @foreach ($reasons as $option)
            <option value="{{ $option->id }}" {{ old('reason_id', $leaveApplication->reason_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Remark</label>
    <input type="text" name="remark" value="{{ old('remark', $leaveApplication->remark ?? '') }}" class="form-control">
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
    <select name="status_id" class="form-select">
        <option value="">Select Status id</option>
        @foreach ($statuses as $option)
            <option value="{{ $option->id }}" {{ old('status_id', $leaveApplication->status_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Category id</label>
    <select name="category_id" class="form-select">
        <option value="">Select Category id</option>
        @foreach ($categories as $option)
            <option value="{{ $option->id }}" {{ old('category_id', $leaveApplication->category_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Days</label>
    <input type="text" name="days" value="{{ old('days', $leaveApplication->days ?? '') }}" class="form-control">
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>