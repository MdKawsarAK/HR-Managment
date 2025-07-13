@extends('layouts.master')

@section('page')
    <div class="container py-4">
        <!-- Header -->
        <div class="card bg-primary text-white mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h3 class="m-0">Create Payroll Receipt</h3>
                <a href="{{ route('payroll_receipts.index') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="card shadow-sm">
            <div class="card-body row g-3">
                <!-- Employee -->
                <div class="col-md-6">
                    <label for="employee_id" class="form-label">Employee</label>
                    <select name="employee_id" id="employee_id" class="form-control" required>
                        <option value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->first_name }} {{ $employee->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Select Status</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <!-- Remarks -->
                <div class="col-md-12">
                    <label for="remarks" class="form-label">Remarks</label>
                    <input type="text" name="remarks" id="remarks" class="form-control" placeholder="Optional">
                </div>

                <!-- Items Table -->
                <div class="col-12">
                    <label class="form-label">Payroll Items</label>
                    <table class="table table-bordered" id="receipt-items-table">
                        <thead class="table-light">
                            <tr>
                                <th>Payroll Item</th>
                                <th>Amount</th>
                                <th style="width: 50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="items[0][payroll_item_id]" class="form-control" required>
                                        <option value="">Select Item</option>
                                        @foreach ($payroll_items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="items[0][amount]" class="form-control item-amount" required
                                        step="0.01">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger remove-item">&times;</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button id="add-item" class="btn btn-sm btn-primary mt-2">
                        <i class="fa fa-plus"></i> Add Item
                    </button>

                    <div class="mt-3 text-end">
                        <strong>Total Amount: </strong><span id="total-amount">0.00</span>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button id="save-btn" class="btn btn-success">
                    <i class="fa fa-save"></i> Save Receipt
                </button>
            </div>
        </div>
    </div>
    <script>
        let rowIdx = 1;

        // Recalculate total
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.item-amount').forEach(input => {
                const value = parseFloat(input.value);
                if (!isNaN(value)) total += value;
            });
            document.getElementById('total-amount').textContent = total.toFixed(2);
        }
        // Add new item row
        document.getElementById('add-item').addEventListener('click', () => {
            const table = document.querySelector('#receipt-items-table tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>
                    <select name="items[${rowIdx}][payroll_item_id]" class="form-control" required>
                        <option value="">Select Item</option>
                        @foreach ($payroll_items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="items[${rowIdx}][amount]" class="form-control item-amount" required step="0.01">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger remove-item">&times;</button>
                </td>
            `;

            table.appendChild(newRow);
            rowIdx++;
        });

        // Remove item row
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                const row = e.target.closest('tr');
                row.remove();
                updateTotal();
            }
        });

        // Update total when amount changes
        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('item-amount')) {
                updateTotal();
            }
        });

        // Initial calculation
        document.addEventListener('DOMContentLoaded', updateTotal);

        //creating payroll receipts
        document.getElementById('save-btn').addEventListener('click', async function () {
            const employee_id = document.getElementById('employee_id').value;
            const receipt_total = document.getElementById('total-amount').textContent;
            const status = document.getElementById('status').value;
            const remarks = document.getElementById('remarks').value;
            const items = [];

            document.querySelectorAll('#receipt-items-table tbody tr').forEach(row => {
                const item_id = row.querySelector('select').value;
                const amount = row.querySelector('input.item-amount').value;

                if (item_id && amount) {
                    items.push({
                        payroll_item_id: parseInt(item_id),
                        amount: parseFloat(amount)
                    });
                }
            });

            const data = {
                employee_id,
                receipt_total,
                status,
                remarks,
                items
            }
            //sending dat to the database
            try {
                const response = await fetch('http://127.0.0.1:8000/api/payroll_receipt', {
                    method: "POST",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });
                if (!response.ok) {
                    throw new Error(`Server error: ${response.status}`);
                }
                const result = await response.json();
                alert('Successfully created!')

                //redirecting to the manage page
                window.location.assign('{{ route('payroll_receipts.index') }}');
                console.log(result);
            } catch (err) {
                alert('Error creating Money receipt!')
                console.log(`Failed to crate Money receipt: ${err}`);
            }

            console.log(data);
        })
    </script>
@endsection