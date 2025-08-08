<?php

namespace App\Http\Controllers\Api\HR;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\HR\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'category_id' => 'required|integer',
            'email'      => 'nullable|email|max:150|unique:employees,email',
            'status'     => 'required|string|max:50',
            'salary'     => 'nullable|numeric',
            'phone'      => 'nullable|string|max:20',
            'nid'        => 'nullable|string|max:50',
            'gender'     => 'nullable|string|max:20',
            'address'    => 'nullable|string',
            'dob'        => 'nullable|date',
            'blood_id'   => 'nullable|integer',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $employee = new Employee();
        $employee->first_name  = $request->first_name;
        $employee->last_name   = $request->last_name;
        $employee->category_id = $request->category_id;
        $employee->hire_date   = now();
        $employee->email       = $request->email;
        $employee->created_at  = now();
        $employee->updated_at  = now();
        $employee->status      = $request->status;
        $employee->salary      = $request->salary;
        $employee->phone       = $request->phone;
        $employee->nid         = $request->nid;
        $employee->gender      = $request->gender;
        $employee->address     = $request->address;
        $employee->dob         = $request->dob;
        $employee->blood_id    = $request->blood_id;

        if ($request->hasFile('photo')) {
            $employee->photo = $request->file('photo')->store('uploads', 'public');
        }

        $employee->save();

        return response()->json(['success' => true, 'message' => 'Employee created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'category_id' => 'required|integer',
            'email'      => 'nullable|email|max:150|unique:employees,email,' . $id,
            'status'     => 'required|string|max:50',
            'salary'     => 'nullable|numeric',
            'phone'      => 'nullable|string|max:20',
            'nid'        => 'nullable|string|max:50',
            'gender'     => 'nullable|string|max:20',
            'address'    => 'nullable|string',
            'dob'        => 'nullable|date',
            'blood_id'   => 'nullable|integer',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $employee->first_name  = $request->first_name;
        $employee->last_name   = $request->last_name;
        $employee->category_id = $request->category_id;
        $employee->email       = $request->email;
        $employee->status      = $request->status;
        $employee->salary      = $request->salary;
        $employee->phone       = $request->phone;
        $employee->nid         = $request->nid;
        $employee->gender      = $request->gender;
        $employee->address     = $request->address;
        $employee->dob         = $request->dob;
        $employee->blood_id    = $request->blood_id;
        $employee->updated_at  = now();

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($employee->photo && Storage::disk('public')->exists($employee->photo)) {
                Storage::disk('public')->delete($employee->photo);
            }
            $employee->photo = $request->file('photo')->store('uploads', 'public');
        }

        $employee->save();

        return response()->json(['success' => true, 'message' => 'Employee updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        // Delete photo if exists
        if ($employee->photo && Storage::disk('public')->exists($employee->photo)) {
            Storage::disk('public')->delete($employee->photo);
        }

        $employee->delete();

        return response()->json(['success' => true, 'message' => 'Employee deleted successfully.']);
    }
}
