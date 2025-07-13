<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Http\Request;
use App\Http\Resources\DistrictResource;
use App\Models\Api\District;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return District::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $data = $request->validate([
        'name' => 'required|string',
        'division_id' => 'required|exists:divisions,id',
    ]);

    $district = District::create($data);

    return new DistrictResource($district);
}
    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        return new DistrictResource($district);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
