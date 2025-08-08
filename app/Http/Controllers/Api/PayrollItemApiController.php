<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayrollItem;

class PayrollItemApiController extends Controller
{
    // GET /api/payroll-items
    public function index()
    {
        $items = PayrollItem::all();
        return response()->json([
            'status' => 'success',
            'data' => $items
        ]);
    }

    // GET /api/payroll-items/{id}
    public function show($id)
    {
        $item = PayrollItem::find($id);

        if (!$item) {
            return response()->json(['status' => 'error', 'message' => 'Item not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $item]);
    }

    // POST /api/payroll-items
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:earning,deduction',
            'amount' => 'required|numeric|min:0'
        ]);

        $item = PayrollItem::create($validated);

        return response()->json(['status' => 'success', 'data' => $item], 201);
    }

    // PUT /api/payroll-items/{id}
    public function update(Request $request, $id)
    {
        $item = PayrollItem::find($id);

        if (!$item) {
            return response()->json(['status' => 'error', 'message' => 'Item not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:earning,deduction',
            'amount' => 'required|numeric|min:0'
        ]);

        $item->update($validated);

        return response()->json(['status' => 'success', 'data' => $item]);
    }

    // DELETE /api/payroll-items/{id}
    public function destroy($id)
    {
        $item = PayrollItem::find($id);

        if (!$item) {
            return response()->json(['status' => 'error', 'message' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json(['status' => 'success', 'message' => 'Item deleted']);
    }
}
