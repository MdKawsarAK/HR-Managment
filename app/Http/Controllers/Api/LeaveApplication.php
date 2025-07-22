<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaveConfig;
use Illuminate\Http\Request;

class LeaveApplication extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    // get leave count form leave config
    public function getLeaveCount(Request $request){
        $employee=LeaveConfig::where('employee_id',$request->id)->first();

        if(!$employee){
          return response()->json(['found'=>false]);
        }
        
        return response()->json([
            'found' =>true,
            'days'=>$employee->days,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
