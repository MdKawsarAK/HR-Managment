<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Models\PayrollInvoiceDetail;
use App\Models\PayrollInvoice;

class PayrollInvoiceController extends Controller
{
    public function getSalaryConfig(Request $request)
    {
        $salary = Salary::with('details.payroll_item')
            ->where('employee_id', $request->id)
            ->get();

        if ($salary->isEmpty()) {
            return response()->json(['found' => false]);
        }

        $data = $salary->map(function ($s) {
            return [
                'id' => $s->id,
                'employee_id' => $s->employee_id,
                'created_at' => $s->created_at,
                'salary_total' => $s->salary_total,
                'status' => $s->status,
                'remarks' => $s->remarks,
                'updated_at' => $s->updated_at,
                'details' => $s->details->map(function ($d) {
                    return [
                        'id' => $d->id,
                        'salary_id' => $d->salary_id,
                        'payroll_item_id' => $d->payroll_item_id,
                        'payroll_item_name' => $d->payroll_item->name ?? null,
                        'amount' => $d->amount,
                    ];
                }),
            ];
        });

        return response()->json(['found' => true, 'salary' => $data]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = PayrollInvoice::with('details.payroll_item')->latest()->get();
        return response()->json($invoices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer',
            'invoice_total' => 'required|numeric',
            'bill_date' => 'required|date',
            'status' => 'required|string',
            'items' => 'required|array',
            'items.*.payroll_item_id' => 'required|integer',
            'items.*.amount' => 'required|numeric',
        ]);

        $invoice = new PayrollInvoice();
        $invoice->employee_id = $request->employee_id;
        $invoice->invoice_total = $request->invoice_total;
        $invoice->bill_date = $request->bill_date;
        $invoice->status = $request->status;
        $invoice->remarks = $request->remarks;
        $invoice->created_at = now();
        $invoice->save();

        foreach ($request->items as $item) {
            $detail = new PayrollInvoiceDetail();
            $detail->invoice_id = $invoice->id;
            $detail->payroll_item_id = $item['payroll_item_id'];
            $detail->amount = $item['amount'];
            $detail->save();
        }

        return response()->json(['success' => true, 'invoice_id' => $invoice->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = PayrollInvoice::with('details.payroll_item')->find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        return response()->json($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = PayrollInvoice::find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        $request->validate([
            'employee_id' => 'required|integer',
            'invoice_total' => 'required|numeric',
            'bill_date' => 'required|date',
            'status' => 'required|string',
            'items' => 'required|array',
            'items.*.payroll_item_id' => 'required|integer',
            'items.*.amount' => 'required|numeric',
        ]);

        $invoice->employee_id = $request->employee_id;
        $invoice->invoice_total = $request->invoice_total;
        $invoice->bill_date = $request->bill_date;
        $invoice->status = $request->status;
        $invoice->remarks = $request->remarks;
        $invoice->updated_at = now();
        $invoice->save();

        // Delete old details
        PayrollInvoiceDetail::where('invoice_id', $invoice->id)->delete();

        // Insert new details
        foreach ($request->items as $item) {
            $detail = new PayrollInvoiceDetail();
            $detail->invoice_id = $invoice->id;
            $detail->payroll_item_id = $item['payroll_item_id'];
            $detail->amount = $item['amount'];
            $detail->save();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = PayrollInvoice::find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        PayrollInvoiceDetail::where('invoice_id', $invoice->id)->delete();
        $invoice->delete();

        return response()->json(['success' => true]);
    }
}
