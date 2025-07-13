<?php

namespace App\Http\Controllers;

use App\Models\Blood;
use Illuminate\Http\Request;


class BloodController extends Controller
{
    public function index()
    {
        $bloods = Blood::latest()->paginate(10);
        return view('pages.bloods.index', compact('bloods'));
    }

    public function create()
    {

        return view('pages.bloods.create', [
            'mode' => 'create',
            'blood' => new Blood(),

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Blood::create($data);
        return redirect()->route('bloods.index')->with('success', 'Successfully created!');
    }

    public function show(Blood $blood)
    {
        return view('pages.bloods.view', compact('blood'));
    }

    public function edit(Blood $blood)
    {

        return view('pages.bloods.edit', [
            'mode' => 'edit',
            'blood' => $blood,

        ]);
    }

    public function update(Request $request, Blood $blood)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $blood->update($data);
        return redirect()->route('bloods.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Blood $blood)
    {
        $blood->delete();
        return redirect()->route('bloods.index')->with('success', 'Successfully deleted!');
    }
}