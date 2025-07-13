@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $district->name ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Division id</label>
    <select name="division_id" class="form-select">
        <option value="">Select Division id</option>
        @foreach ($divisions as $option)
            <option value="{{ $option->id }}" {{ old('division_id', $district->division_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>