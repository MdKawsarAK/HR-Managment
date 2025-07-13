<?php

namespace App\Http\Controllers\Api\HR;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\HR\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        return json_encode(["invoice" => "test invoice"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employees = new Employee();

        $employees->first_name = $request->first_name;
        $employees->last_name = $request->last_name;
        $employees->category_id = $request->category_id;
        $employees->hire_date = date("Y-m-d H:i:s");
        $employees->email = $request->email;
        $employees->created_at =  now();
        $employees->updated_at =  now();
        $employees->status = $request->status;
        $employees->salary = $request->salary;
        $employees->phone = $request->phone;
        $employees->nid = $request->nid;
        $employees->gender = $request->gender;
        $employees->address = $request->address;
        $employees->dob = $request->dob;
        $employees->blood_id = $request->blood_id;

        if ($request->hasFile('photo')) {
            $employees['photo'] = $request->file('photo')->store('uploads', 'public');
        }




        return response()->json(['message' => 'Employee created successfully.'], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
