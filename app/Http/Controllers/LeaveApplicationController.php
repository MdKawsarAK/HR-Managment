<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Reason;
use App\Models\Status;
use App\Models\Category;


class LeaveApplicationController extends Controller
{
    public function index()
    {
        $leaveApplications = LeaveApplication::latest()->paginate(10);
        return view('pages.leaveApplications.index', compact('leaveApplications'));
    }

    public function create()
    {
        $people = \App\Models\Person::all();
        $reasons = \App\Models\Reason::all();
        $statuses = \App\Models\Status::all();
        $categories = \App\Models\Category::all();

        return view('pages.leaveApplications.create', [
            'mode' => 'create',
            'leaveApplication' => new LeaveApplication(),
            'people' => $people,
            'reasons' => $reasons,
            'statuses' => $statuses,
            'categories' => $categories,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        LeaveApplication::create($data);
        return redirect()->route('leaveApplications.index')->with('success', 'Successfully created!');
    }

    public function show(LeaveApplication $leaveApplication)
    {
        return view('pages.leaveApplications.view', compact('leaveApplication'));
    }

    public function edit(LeaveApplication $leaveApplication)
    {
        $people = \App\Models\Person::all();
        $reasons = \App\Models\Reason::all();
        $statuses = \App\Models\Status::all();
        $categories = \App\Models\Category::all();

        return view('pages.leaveApplications.edit', [
            'mode' => 'edit',
            'leaveApplication' => $leaveApplication,
            'people' => $people,
            'reasons' => $reasons,
            'statuses' => $statuses,
            'categories' => $categories,

        ]);
    }

    public function update(Request $request, LeaveApplication $leaveApplication)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $leaveApplication->update($data);
        return redirect()->route('leaveApplications.index')->with('success', 'Successfully updated!');
    }

    public function destroy(LeaveApplication $leaveApplication)
    {
        $leaveApplication->delete();
        return redirect()->route('leaveApplications.index')->with('success', 'Successfully deleted!');
    }
}