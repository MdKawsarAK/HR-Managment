<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;


class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->paginate(10);
        return view('pages.hotels.index', compact('hotels'));
    }

    public function create()
    {

        return view('pages.hotels.create', [
            'mode' => 'create',
            'hotel' => new Hotel(),

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Hotel::create($data);
        return redirect()->route('hotels.index')->with('success', 'Successfully created!');
    }

    public function show(Hotel $hotel)
    {
        return view('pages.hotels.view', compact('hotel'));
    }

    public function edit(Hotel $hotel)
    {

        return view('pages.hotels.edit', [
            'mode' => 'edit',
            'hotel' => $hotel,

        ]);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $hotel->update($data);
        return redirect()->route('hotels.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Successfully deleted!');
    }
}