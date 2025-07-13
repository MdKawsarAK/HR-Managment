<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blood;


class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('pages.employees.index', compact('employees'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        $bloods = \App\Models\Blood::all();

        return view('pages.employees.create', [
            'mode' => 'create',
            'employee' => new Employee(),
            'categories' => $categories,
            'bloods' => $bloods,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Employee::create($data);
        return redirect()->route('employees.index')->with('success', 'Successfully created!');
    }

    public function show(Employee $employee)
    {
        return view('pages.employees.view', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $categories = \App\Models\Category::all();
        $bloods = \App\Models\Blood::all();

        return view('pages.employees.edit', [
            'mode' => 'edit',
            'employee' => $employee,
            'categories' => $categories,
            'bloods' => $bloods,

        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $employee->update($data);
        return redirect()->route('employees.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Successfully deleted!');
    }
}