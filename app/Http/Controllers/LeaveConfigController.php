<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveConfig;
use App\Models\Employee;
use App\Models\LeaveCategory;

class LeaveConfigController extends Controller
{
    // Show all leave configs
    public function index()
    {
        $configs = LeaveConfig::with(['employee', 'category'])->get();
                return view('pages.leave_configs.index', compact('configs'));
    }

    // Show form to create new config
    public function create()
    {
        $employees = Employee::all();
        $categories = LeaveCategory::all();
                return view('pages.leave_configs.create', compact('employees', 'categories'));
    }

    // Store leave config
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_category_id' => 'required|exists:leave_categories,id',
            'days' => 'required|integer|min:0'
        ]);

        LeaveConfig::create([
            'employee_id' => $request->employee_id,
            'category_id' => $request->leave_category_id,
            'days' => $request->days
        ]);

        return redirect()->route('leave_configs.index')->with('success', 'Leave configuration created successfully!');
    }

    // Show form to edit config
    public function edit($id)
    {
        $config = LeaveConfig::findOrFail($id);
        $employees = Employee::all();
        $categories = LeaveCategory::all();

                return view('pages.leave_configs.edit', compact('config', 'employees', 'categories'));
    }

    // Update existing config
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_category_id' => 'required|exists:leave_categories,id',
            'days' => 'required|integer|min:0'
        ]);

        $config = LeaveConfig::findOrFail($id);
        $config->update([
            'employee_id' => $request->employee_id,
            'leave_category_id' => $request->leave_category_id,
            'days' => $request->days
        ]);

        return redirect()->route('leave_configs.index')->with('success', 'Leave configuration updated successfully!');
    }
       public function show(string $id)
    {
        $config = LeaveConfig::with(['employee', 'category'])->findOrFail($id);
                return view('pages.leave_configs.view', compact('config'));
    }

    //     public function show($id)
    // {
    //     $invoice = PayrollInvoice::with(['employee', 'details.item'])->findOrFail($id);
    //     return view('pages.payroll.invoices.show', compact('invoice'));
    // }
    // Delete config
    public function destroy($id)
    {
        $config = LeaveConfig::findOrFail($id);
        $config->delete();

        return redirect()->route('leave_configs.index')->with('success', 'Leave configuration deleted successfully!');
    }
}
