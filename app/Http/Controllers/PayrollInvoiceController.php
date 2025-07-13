<?php

namespace App\Http\Controllers;

use App\Models\PayrollInvoice;
use App\Models\PayrollInvoiceDetail;
use App\Models\Employee;
use App\Models\PayrollItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollInvoiceController extends Controller
{
    /**
     * Display a list of all payroll invoices.
     */
    public function index()
    {
        $invoices = PayrollInvoice::with('employee')->orderBy('id', 'desc')->get();
        return view('pages.payroll.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new invoice.
     */
public function create()
{
    $employees = Employee::all();
    $items = PayrollItem::all();

    return view('pages.payroll.invoices.create', [
        'employees' => $employees,
        'items' => $items,
        'invoice' => new PayrollInvoice(),
    ]);
}

    /**
     * Store a new payroll invoice with its details.
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        DB::beginTransaction();
        try {
            $total = collect($request->items)->sum('amount');

            $invoice = PayrollInvoice::create([
                'employee_id' => $request->employee_id,
                'created_at' => now(),
                'bill_date' => $request->bill_date,
                'bill_total' => $total,
                'status' => $request->status,
                'remarks' => $request->remarks ?? '',
            ]);

            $this->storeInvoiceDetails($invoice->id, $request->items);

            DB::commit();
            return redirect()->route('payroll-invoices.index')
                ->with('success', 'Payroll invoice created successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    /**
     * Show a single invoice with employee and details.
     */
    public function show($id)
    {
        $invoice = PayrollInvoice::with(['employee', 'details.item'])->findOrFail($id);
        return view('pages.payroll.invoices.show', compact('invoice'));
    }

    /**
     * Delete a payroll invoice and its details.
     */
    public function destroy($id)
    {
        $invoice = PayrollInvoice::findOrFail($id);
        $invoice->details()->delete(); // delete child rows first
        $invoice->delete();

        return redirect()->route('payroll-invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    /**
     * Validate the store request data.
     */
    protected function validateRequest(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bill_date' => 'required|date',
            'status' => 'required|string|max:45',
            'remarks' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:payroll_items,id',
            'items.*.amount' => 'required|numeric|min:0',
        ]);
    }

    /**
     * Store details for the given invoice.
     */
    protected function storeInvoiceDetails($invoiceId, array $items)
    {
        foreach ($items as $item) {
            PayrollInvoiceDetail::create([
                'invoice_id' => $invoiceId,
                'item_id' => $item['item_id'],
                'amount' => $item['amount'],
            ]);
        }
    }
}
