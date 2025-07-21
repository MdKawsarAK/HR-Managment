<?php

namespace App\Http\Controllers;

use App\Models\LeaveTransaction;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveCategory;


class LeaveTransactionController extends Controller
{
    public function index()
    {
        $leaveTransactions = LeaveTransaction::latest()->paginate(10);
        return view('pages.leave_transactions.index', compact('leaveTransactions'));
    }

    public function create()
    {
        $employees = \App\Models\Employee::all();
        $leaveCategories = \App\Models\LeaveCategory::all();

        return view('pages.leave_transactions.create', [
            'mode' => 'create',
            'leaveTransaction' => new LeaveTransaction(),
            'employees' => $employees,
            'leaveCategories' => $leaveCategories,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        LeaveTransaction::create($data);
        return redirect()->route('leaveTransactions.index')->with('success', 'Successfully created!');
    }

    public function show(LeaveTransaction $leaveTransaction)
    {
        return view('pages.leave_transactions.view', compact('leaveTransaction'));
    }

    public function edit(LeaveTransaction $leaveTransaction)
    {
        $employees = \App\Models\Employee::all();
        $leaveCategories = \App\Models\LeaveCategory::all();

        return view('pages.leave_transactions.edit', [
            'mode' => 'edit',
            'leaveTransaction' => $leaveTransaction,
            'employees' => $employees,
            'leaveCategories' => $leaveCategories,

        ]);
    }

    public function update(Request $request, LeaveTransaction $leaveTransaction)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $leaveTransaction->update($data);
        return redirect()->route('leaveTransactions.index')->with('success', 'Successfully updated!');
    }

    public function destroy(LeaveTransaction $leaveTransaction)
    {
        $leaveTransaction->delete();
        return redirect()->route('leaveTransactions.index')->with('success', 'Successfully deleted!');
    }
}