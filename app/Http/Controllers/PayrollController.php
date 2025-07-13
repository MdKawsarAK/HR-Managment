<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{
    Employee,
    PayrollConfig,
    PayrollReceipt,
    PayrollReceiptDetail,
    PayrollBill,
    PayrollBillDetail
};

class PayrollController extends Controller
{
    public function generate($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $configs = PayrollConfig::where('employee_id', $employeeId)->get();

        $receipt = PayrollReceipt::create([
            'employee_id' => $employeeId,
            'created_at' => now(),
            'receipt_total' => 0,
        ]);

        $total = 0;
        foreach ($configs as $config) {
            PayrollReceiptDetail::create([
                'receipt_id' => $receipt->id,
                'item_id' => $config->payroll_item_id,
                'amount' => $config->amount
            ]);
            $total += $config->amount;
        }

        $receipt->update(['receipt_total' => $total]);

        return redirect()->route('payroll.slip', $receipt->id);
    }

    public function slip($receiptId)
    {
        $receipt = PayrollReceipt::with(['employee', 'details.item'])->findOrFail($receiptId);
        return view('payroll.slip', compact('receipt'));
    }
}
