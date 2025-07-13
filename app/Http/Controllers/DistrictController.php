<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use App\Models\Division;


class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::orderBy('id', 'desc')->paginate(10);
        return view('pages.districts.index', compact('districts'));
    }

    public function create()
    {
        $divisions = \App\Models\Division::all();

        return view('pages.districts.create', [
            'mode' => 'create',
            'district' => new District(),
            'divisions' => $divisions,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        District::create($data);
        return redirect()->route('districts.index')->with('success', 'Successfully created!');
    }

    public function show(District $district)
    {
        return view('pages.districts.view', compact('district'));
    }

    public function edit(District $district)
    {
        $divisions = \App\Models\Division::all();

        return view('pages.districts.edit', [
            'mode' => 'edit',
            'district' => $district,
            'divisions' => $divisions,

        ]);
    }

    public function update(Request $request, District $district)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $district->update($data);
        return redirect()->route('districts.index')->with('success', 'Successfully updated!');
    }

    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('districts.index')->with('success', 'Successfully deleted!');
    }
}