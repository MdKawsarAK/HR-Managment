<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PayrollReceiptDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollReceipt extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $receipts = PayrollReceipt::with(['employee', 'details.item'])->latest()->get();
        return PayrolReceipts::all();
        response()->json($receipts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pr=new \App\Models\PayrollReceipt();
        $pr->employee_id=$request->employee_id;
        $pr->receipt_total=$request->receipt_total;
        $pr->status=$request->status;
        $pr->remarks=$request->remarks;
        $pr->created_at=now();
        $pr->save();

        $items=$request->items;
        foreach($items as $item){
            $details=new PayrollReceiptDetail();
            $details->receipt_id=$pr->id;
            $details->payroll_item_id=$item['payroll_item_id'];
            $details->amount=$item['amount'];
            $details->save();
        }

        return response()->json($pr,200);
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
