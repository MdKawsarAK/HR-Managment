<?php

namespace App\Http\Controllers;

use App\Models\PayrollItem;
use Illuminate\Http\Request;
use App\Models\PayrollItemType;


class PayrollItemController extends Controller
{
    public function index()
    {
        $payroll_items = PayrollItem::orderBy('id',"desc")->paginate(10);
        return view('pages.payroll_items.index', compact('payroll_items'));
    }

    public function create()
    {
        $payrollItemTypes = \App\Models\PayrollItemType::all();

        return view('pages.payroll_items.create', [
            'mode' => 'create',
            'payrollItem' => new PayrollItem(),
            'payrollItemTypes' => $payrollItemTypes,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        PayrollItem::create($data);
        return redirect()->route('payroll_items.index')->with('success', 'Successfully created!');
    }

    public function show(PayrollItem $payrollItem)
    {
        return view('pages.payroll_items.view', compact('payrollItem'));
    }

    public function edit(PayrollItem $payrollItem)
    {
        $payrollItemTypes = \App\Models\PayrollItemType::all();

        return view('pages.payroll_items.edit', [
            'mode' => 'edit',
            'payrollItem' => $payrollItem,
            'payrollItemTypes' => $payrollItemTypes,

        ]);
    }

    public function update(Request $request, PayrollItem $payrollItem)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $payrollItem->update($data);
        return redirect()->route('payroll_items.index')->with('success', 'Successfully updated!');
    }

    public function destroy(PayrollItem $payrollItem)
    {
        $payrollItem->delete();
        return redirect()->route('payroll_items.index')->with('success', 'Successfully deleted!');
    }
}