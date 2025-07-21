<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Models\Employee;
use App\Models\LeaveCategory;
use App\Models\LeaveStatus;

class LeaveApplicationController extends Controller
{
    // Show all leave_applications
    public function index()
    {
        $leave_applications = LeaveApplication::with(['employee', 'category', 'status'])->orderBy('created_at', 'desc')->get();
        return view('pages.leave_applications.index', compact('leave_applications'));
    }

    // Show apply form
    public function create()
    {
        $employees = Employee::all();
        $categories = LeaveCategory::all();
        $statuses = LeaveStatus::all();
        return view('pages.leave_applications.create', compact('employees', 'categories', 'statuses'));
    }

    // Store leave application
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_category_id' => 'required|exists:leave_categories,id',
            'reason' => 'required|string|max:255',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'days' => 'required|integer|min:1',
            'status_id' => 'required|exists:leave_statuses,id'
        ]);

        LeaveApplication::create([
            'employee_id' => $request->employee_id,
            'leave_category_id' => $request->leave_category_id,
            'reason' => $request->reason,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'days' => $request->days,
            'status_id' => $request->status_id,
            'created_at' => now()
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave application submitted!');
    }

    // Show application details
    public function show($id)
    {
        $application = LeaveApplication::with(['employee', 'category', 'status'])->findOrFail($id);
        return view('pages.leave_applications.view', compact('application'));
    }

    // Edit application (for admin approval or correction)
    public function edit($id)
    {
        $application = LeaveApplication::findOrFail($id);
        $employees = Employee::all();
        $categories = LeaveCategory::all();
        $statuses = LeaveStatus::all();
        return view('pages.leave_applications.edit', compact('application', 'employees', 'categories', 'statuses'));
    }

    // Update application
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_category_id' => 'required|exists:leave_categories,id',
            'reason' => 'required|string|max:255',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'days' => 'required|integer|min:1',
            'status_id' => 'required|exists:leave_statuses,id'
        ]);

        $application = LeaveApplication::findOrFail($id);
        $application->update([
            'employee_id' => $request->employee_id,
            'leave_category_id' => $request->leave_category_id,
            'reason' => $request->reason,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'days' => $request->days,
            'status_id' => $request->status_id
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave application updated!');
    }

    // Delete application
    public function destroy($id)
    {
        $application = LeaveApplication::findOrFail($id);
        $application->delete();
        return redirect()->route('leaves.index')->with('success', 'Leave application deleted!');
    }
}
