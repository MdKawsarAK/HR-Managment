<?php

namespace App\Http\Controllers;

use App\Models\PayrollReceiptDetail;
use Illuminate\Http\Request;
use App\Models\PayrollReceipt;
use App\Models\PayrollItem;


class PayrollReceiptDetailController extends Controller
{
    public function index()
    {
        $payrollReceiptDetails = PayrollReceiptDetail::latest()->paginate(10);
        return view('pages.payrollReceiptDetails.index', compact('payrollReceiptDetails'));
    }

    public function create()
    {
        $payrollReceipts = \App\Models\PayrollReceipt::all();
        $payrollItems = \App\Models\PayrollItem::all();

        return view('pages.payrollReceiptDetails.create', [
            'mode' => 'create',
            'payrollReceiptDetail' => new PayrollReceiptDetail(),
            'payrollReceipts' => $payrollReceipts,
            'payrollItems' => $payrollItems,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        PayrollReceiptDetail::create($data);
        return redirect()->route('payrollReceiptDetails.index')->with('success', 'Successfully created!');
    }

    public function show(PayrollReceiptDetail $payrollReceiptDetail)
    {
        return view('pages.payrollReceiptDetails.view', compact('payrollReceiptDetail'));
    }

    public function edit(PayrollReceiptDetail $payrollReceiptDetail)
    {
        $payrollReceipts = \App\Models\PayrollReceipt::all();
        $payrollItems = \App\Models\PayrollItem::all();

        return view('pages.payrollReceiptDetails.edit', [
            'mode' => 'edit',
            'payrollReceiptDetail' => $payrollReceiptDetail,
            'payrollReceipts' => $payrollReceipts,
            'payrollItems' => $payrollItems,

        ]);
    }

    public function update(Request $request, PayrollReceiptDetail $payrollReceiptDetail)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $payrollReceiptDetail->update($data);
        return redirect()->route('payrollReceiptDetails.index')->with('success', 'Successfully updated!');
    }

    public function destroy(PayrollReceiptDetail $payrollReceiptDetail)
    {
        $payrollReceiptDetail->delete();
        return redirect()->route('payrollReceiptDetails.index')->with('success', 'Successfully deleted!');
    }
}