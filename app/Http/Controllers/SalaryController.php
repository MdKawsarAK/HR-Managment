<?php
namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\SalaryDetail;
use App\Models\Employee;
use App\Models\PayrollItem;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->get();
        return view('pages.salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::all();
        $payroll_items = PayrollItem::all();
        return view('pages.salaries.create', compact('employees', 'payroll_items'));
    }

    public function store(Request $request)
    {
        $salary = new Salary();
        $salary->employee_id = $request->employee_id;
        $salary->status = $request->status;
        $salary->remarks = $request->remarks;
        $salary->salary_total = array_sum(array_column($request->items, 'amount'));
        $salary->created_at = now();
        $salary->updated_at = now();
        $salary->save();

        foreach ($request->items as $item) {
            SalaryDetail::create([
                'salary_id' => $salary->id,
                'payroll_item_id' => $item['payroll_item_id'],
                'amount' => $item['amount']
            ]);
        }

        return redirect()->route('salaries.index')->with('success', 'Salary saved!');
    }

    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        $payroll_items = PayrollItem::all();
        return view('pages.salaries.edit', compact('salary', 'employees', 'payroll_items'));
    }

    public function update(Request $request, Salary $salary)
    {
        $salary->employee_id = $request->employee_id;
        $salary->status = $request->status;
        $salary->remarks = $request->remarks;
        $salary->salary_total = array_sum(array_column($request->items, 'amount'));
        $salary->updated_at = now();
        $salary->save();

        $salary->details()->delete();
        foreach ($request->items as $item) {
            SalaryDetail::create([
                'salary_id' => $salary->id,
                'payroll_item_id' => $item['payroll_item_id'],
                'amount' => $item['amount']
            ]);
        }

        return redirect()->route('salaries.index')->with('success', 'Salary updated!');
    }

    public function show(Salary $salary)
    {
        return view('pages.salaries.view', compact('salary'));
    }

    public function destroy(Salary $salary)
    {
        $salary->details()->delete();
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Salary deleted!');
    }
}