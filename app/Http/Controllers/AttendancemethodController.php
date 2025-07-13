<?php

namespace App\Http\Controllers;

use App\Models\Attendancemethod;
use Illuminate\Http\Request;


class AttendancemethodController extends Controller
{
    public function index()
    {
        $attendancemethods = Attendancemethod::latest()->paginate(10);
        return view('pages.attendancemethods.index', compact('attendancemethods'));
    }

    public function create()
    {

        return view('pages.attendancemethods.create', [
            'mode' => 'create',
            'attendancemethod' => new Attendancemethod(),

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Attendancemethod::create($data);
        return redirect()->route('attendancemethods.index')->with('success', 'Successfully created!');
    }

    public function show(Attendancemethod $attendancemethod)
    {
        return view('pages.attendancemethods.view', compact('attendancemethod'));
    }

    public function edit(Attendancemethod $attendancemethod)
    {

        return view('pages.attendancemethods.edit', [
            'mode' => 'edit',
            'attendancemethod' => $attendancemethod,

        ]);
    }

    public function update(Request $request, Attendancemethod $attendancemethod)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $attendancemethod->update($data);
        return redirect()->route('attendancemethods.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Attendancemethod $attendancemethod)
    {
        $attendancemethod->delete();
        return redirect()->route('attendancemethods.index')->with('success', 'Successfully deleted!');
    }
}