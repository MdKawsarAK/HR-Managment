<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\PayrollReceipt;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\PayrollItem;
use App\Models\PayrollReceiptDetail;


class PayrollReceiptController extends Controller
{

    public function index()
    {
        $receipts = PayrollReceipt::with('employee')->orderBy('id', 'desc')->paginate(10);
        return view('pages.payroll_receipts.index', compact('receipts'));
    }


    public function create()
    {
        $employees = Employee::all();
        $payroll_items = PayrollItem::all();


        return view('pages.payroll_receipts.create', [
            'mode' => 'create',
            'payrollReceipt' => new PayrollReceipt(),
            'employees' => $employees,
            'payroll_items' => $payroll_items

        ]);
    }




    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'employee_id' => 'required|exists:employees,id',
    //         'status' => 'required|string|max:45',
    //         'remarks' => 'nullable|string|max:255',
    //         'items' => 'required|array|min:1',
    //         'items.*.payroll_item_id' => 'required|exists:payroll_items,id',
    //         'items.*.amount' => 'required|numeric|min:0',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         // Calculate total
    //         $total = collect($request->items)->sum('amount');

    //         // Create main receipt
    //         $receipt = PayrollReceipt::create([
    //             'employee_id' => $request->employee_id,
    //             'created_at' => now(),
    //             'receipt_total' => $total,
    //             'status' => $request->status,
    //             'remarks' => $request->remarks ?? '',
    //         ]);

    //         // Insert each receipt item
    //         foreach ($request->items as $item) {
    //             PayrollReceiptDetail::create([
    //                 'payroll_receipt_id' => $receipt->id,
    //                 'payroll_item_id' => $item['payroll_item_id'],
    //                 'amount' => $item['amount'],
    //             ]);
    //         }

    //         DB::commit();

    //         return redirect()->route('payroll_receipts.index')
    //             ->with('success', 'Payroll receipt created successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
    //     }
    // }


    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'created_at' => 'required|date',
            'receipt_total' => 'required|numeric',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
            'details' => 'required|array',
            'details.*.payroll_item_id' => 'required|exists:payroll_items,id',
            'details.*.amount' => 'required|numeric',
        ]);

        $payrollReceipt = PayrollReceipt::create($data);

        // Save details
        foreach ($data['details'] as $detail) {
            $payrollReceipt->details()->create($detail);
        }

        return redirect()->route('payroll_receipts.index')->with('success', 'Successfully created!');
    }

    public function show(PayrollReceipt $payrollReceipt)
    {
        $payrollReceipt->load('employee', 'details.payrollItem'); // eager load relations
        return view('pages.payroll_receipts.view', compact('payrollReceipt'));
    }


    public function edit(PayrollReceipt $payrollReceipt)
    {
        $employees = Employee::all();
        $payroll_items = PayrollItem::all();

        return view('pages.payroll_receipts.edit', [
            'mode' => 'edit', // Also fix mode
            'payrollReceipt' => $payrollReceipt,
            'employees' => $employees,
            'payroll_items' => $payroll_items
        ]);
    }

    public function update(Request $request, PayrollReceipt $payrollReceipt)
    {
        // Validate the form inputs
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'created_at' => 'required|date',
            'status' => 'required|string|max:45',
            'remarks' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.payroll_item_id' => 'required|exists:payroll_items,id',
            'items.*.amount' => 'required|numeric|min:0',
        ]);

        // Calculate total from items
        $total = collect($request->items)->sum('amount');

        // Update the main payroll receipt
        $payrollReceipt->update([
            'employee_id' => $request->employee_id,
            'created_at' => $request->created_at,
            'receipt_total' => $total,
            'status' => $request->status,
            'remarks' => $request->remarks ?? '',
        ]);

        // Delete old details and recreate new ones
        $payrollReceipt->details()->delete();

        foreach ($request->items as $item) {
            PayrollReceiptDetail::create([
                'payroll_receipt_id' => $payrollReceipt->id,
                'payroll_item_id' => $item['payroll_item_id'],
                'amount' => $item['amount'],
            ]);
        }

        return redirect()->route('payroll_receipts.index')
            ->with('success', 'Payroll receipt updated successfully.');
    }


    public function destroy(PayrollReceipt $payrollReceipt)
    {
        // First delete the related receipt details
        $payrollReceipt->details()->delete();

        // Then delete the main receipt record
        $payrollReceipt->delete();

        return redirect()->route('payroll_receipts.index')
            ->with('success', 'Payroll receipt deleted successfully.');
    }
}
