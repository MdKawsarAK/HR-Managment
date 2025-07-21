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
    <label>Category id</label>
    <select name="category_id" class="form-control">
        <option value="">Select Category id</option>
        @foreach ($categories as $option)
            <option value="{{ $option->id }}" {{ old('category_id', $employee->category_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Hire date</label>
    <input type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Photo</label>
    @if(isset($employee->photo) && $employee->photo)
        <br><img src="{{ asset('storage/' . $employee->photo) }}" width="100">
    @endif
    <input type="file" name="photo" class="form-control">
</div>
<div class="mb-2">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Status</label>
    <input type="text" name="status" value="{{ old('status', $employee->status ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Salary</label>
    <input type="number" name="salary" value="{{ old('salary', $employee->salary ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Phone</label>
    <input type="number" name="phone" value="{{ old('phone', $employee->phone ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Nid</label>
    <input type="number" name="nid" value="{{ old('nid', $employee->nid ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Gender</label>
    <input type="text" name="gender" value="{{ old('gender', $employee->gender ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Address</label>
    <input type="text" name="address" value="{{ old('address', $employee->address ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Dob</label>
    <input type="date" name="dob" value="{{ old('dob', $employee->dob ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Blood id</label>
    <select name="blood_id" class="form-control">
        <option value="">Select Blood id</option>
        @foreach ($bloods as $option)
            <option value="{{ $option->id }}" {{ old('blood_id', $employee->blood_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>