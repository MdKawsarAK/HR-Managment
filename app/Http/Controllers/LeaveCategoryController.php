<?php

namespace App\Http\Controllers;

use App\Models\LeaveCategory;
use Illuminate\Http\Request;


class LeaveCategoryController extends Controller
{
    public function index()
    {
        $leave_categories = LeaveCategory::orderBy('id', 'desc')->paginate(10);
        return view('pages.leave_categories.index', compact('leave_categories'));
    }

    public function create()
    {

        return view('pages.leave_categories.create', [
            'mode' => 'create',
            'leaveCategory' => new LeaveCategory(),

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        LeaveCategory::create($data);
        return redirect()->route('leave_categories.index')->with('success', 'Successfully created!');
    }

    public function show(LeaveCategory $leaveCategory)
    {
        return view('pages.leave_categories.view', compact('leaveCategory'));
    }

    public function edit(LeaveCategory $leaveCategory)
    {

        return view('pages.leave_categories.edit', [
            'mode' => 'edit',
            'leaveCategory' => $leaveCategory,

        ]);
    }

    public function update(Request $request, LeaveCategory $leaveCategory)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $leaveCategory->update($data);
        return redirect()->route('leave_categories.index')->with('success', 'Successfully updated!');
    }

    public function destroy(LeaveCategory $leaveCategory)
    {
        $leaveCategory->delete();
        return redirect()->route('leave_categories.index')->with('success', 'Successfully deleted!');
    }
}