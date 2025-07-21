<?php

namespace App\Http\Controllers;

use App\Models\LeaveStatus;
use Illuminate\Http\Request;


class LeaveStatusController extends Controller
{
    public function index()
    {
        $leave_statuses = LeaveStatus::orderBy('id', 'desc')->paginate(10);
        return view('pages.leave_statuses.index', compact('leave_statuses'));
    }

    public function create()
    {

        return view('pages.leave_statuses.create', [
            'mode' => 'create',
            'leaveStatus' => new LeaveStatus(),

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        LeaveStatus::create($data);
        return redirect()->route('leave_statuses.index')->with('success', 'Successfully created!');
    }

    public function show(LeaveStatus $leaveStatus)
    {
        return view('pages.leave_statuses.view', compact('leaveStatus'));
    }

    public function edit(LeaveStatus $leaveStatus)
    {

        return view('pages.leave_statuses.edit', [
            'mode' => 'edit',
            'leaveStatus' => $leaveStatus,

        ]);
    }

    public function update(Request $request, LeaveStatus $leaveStatus)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $leaveStatus->update($data);
        return redirect()->route('leave_statuses.index')->with('success', 'Successfully updated!');
    }

    public function destroy(LeaveStatus $leaveStatus)
    {
        $leaveStatus->delete();
        return redirect()->route('leave_statuses.index')->with('success', 'Successfully deleted!');
    }
}