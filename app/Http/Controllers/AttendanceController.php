<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\AttendanceMethod;
use App\Models\Attendancereport;


class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::orderBy('id', 'desc')->paginate(10);
        return view('pages.attendances.index', compact('attendances'));
    }

    public function create()
    {
        $employees = \App\Models\Employee::all();
        $attendanceMethods = \App\Models\AttendanceMethod::all();
        $attendancereports = \App\Models\Attendancereport::all();

        return view('pages.attendances.create', [
            'mode' => 'create',
            'attendance' => new Attendance(),
            'employees' => $employees,
            'attendanceMethods' => $attendanceMethods,
            'attendancereports' => $attendancereports,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Attendance::create($data);
        return redirect()->route('attendances.index')->with('success', 'Successfully created!');
    }

    public function show(Attendance $attendance)
    {
        return view('pages.attendances.view', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $employees = \App\Models\Employee::all();
        $attendanceMethods = \App\Models\AttendanceMethod::all();
        $attendancereports = \App\Models\Attendancereport::all();

        return view('pages.attendances.edit', [
            'mode' => 'edit',
            'attendance' => $attendance,
            'employees' => $employees,
            'attendanceMethods' => $attendanceMethods,
            'attendancereports' => $attendancereports,

        ]);
    }

    public function update(Request $request, Attendance $attendance)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $attendance->update($data);
        return redirect()->route('attendances.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Successfully deleted!');
    }
}