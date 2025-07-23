<style>
    .td-w {
        width: 12%;
    }

    .table_p {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    
</style>

@extends('layouts.master')
@section('page')

<div class="container py-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title m-0">Create Payroll Invoice</h3>
            <a href="{{ route('payroll_invoices.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm">
        <div class="card-body row g-3">

            <!-- Employee -->
            <div class="col-md-6">
                <label for="employee_id" class="form-label">Employee</label>
                <select name="employee_id" id="employee_id" class="form-control" required>
                    <option value="">Select Employee</option>
                    @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Bill Date -->
            <div class="col-md-6">
                <label for="bill_date" class="form-label">Bill Date</label>
                <input type="date" name="bill_date" id="bill_date" class="form-control" required>
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
            <div class="col-md-6">
                <label for="remarks" class="form-label">Remarks</label>
                <input type="text" name="remarks" id="remarks" class="form-control" placeholder="Optional">
            </div>

            <!-- Invoice Items -->
            <div class="col-12">
                <label class="form-label">Invoice Items</label>
                <table class="table table-bordered" id="invoice-items-table">
                    <thead>
                        <tr>
                            <th class="td-w">#ID</th>
                            <th class="td-w">Payroll Item</th>
                            <th>Item Name</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
                <div class="table_p">
                    <!-- <button id="add-item" class="btn text-start btn-sm btn-primary mt-2">
                        <i class="fa fa-plus"></i> Add Item
                    </button> -->
                    <!-- Total Amount Display -->
                    <div class="mt-3 text-end">
                        <strong>Total Amount:</strong> <span id="total-amount" class="fw-bold">0.00</span>
                    </div>
                </div>


            </div>
        </div>

        <div class="card-footer text-end">
            <button id="save-btn" class="btn btn-success">
                <i class="fa fa-save"></i> Save Invoice
            </button>
        </div>
    </div>
</div>
<script>
    // Pass items to JS
    let rowIdx = 1;

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.item-amount').forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value;
            }
        });
        document.getElementById('total-amount').textContent = total.toFixed(2);
    }

    // document.getElementById('add-item').addEventListener('click', function() {
    //     const table = document.querySelector('#invoice-items-table tbody');
    //     const newRow = document.createElement('tr');

    //     newRow.innerHTML = `
    //                 <td>
    //                     <select name="items[${rowIdx}][item_id]" class="form-control" required>
    //                     <option value="">Select Item</option>
    //                     @foreach ($items as $item)
    //                         <option value="{{ $item->id }}">{{ $item->name }}</option>
    //                     @endforeach
    //                     </select>
    //                 </td>
    //                 <td>
    //                     <input type="number" name="items[${rowIdx}][amount]" class="form-control item-amount" step="0.01" required>
    //                 </td>
    //                 <td class="text-center">
    //                     <button type="button" class="btn btn-sm btn-danger remove-item">&times;</button>
    //                 </td>
    //             `;

    //     table.appendChild(newRow);
    //     rowIdx++;
    //     updateTotal();
    // });

    // document.addEventListener('click', function(e) {
    //     if (e.target.classList.contains('remove-item')) {
    //         e.target.closest('tr').remove();
    //         updateTotal();
    //     }
    // });

    // document.addEventListener('input', function(e) {
    //     if (e.target.classList.contains('item-amount')) {
    //         updateTotal();
    //     }
    // });

    // document.addEventListener('DOMContentLoaded', updateTotal);

    document.getElementById('save-btn').addEventListener('click', async function() {
        const employee_id = document.getElementById('employee_id').value;
        const invoice_total = document.getElementById('total-amount').textContent;
        const status = document.getElementById('status').value;
        const remarks = document.getElementById('remarks').value;
        const bill_date=document.getElementById('bill_date').value;
        // document.querySelectorAll('#invoice-items-table tbody tr').forEach(row => {
        //     const item_id = row.querySelector('select').value;
        //     const amount = row.querySelector('input.item-amount').value;

        //     if (item_id && amount) {
        //         items.push({
        //             payroll_item_id: parseInt(item_id),
        //             amount: parseFloat(amount)
        //         });
        //     }
        // });

        const data = {
            employee_id,
            invoice_total,
            bill_date,
            status,
            remarks,
            items
        }
        console.log(data);
        //sending data to the database
        try {
            console.log(data);
            const response = await fetch('http://127.0.0.1:8000/api/payroll_invoices', {
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
             window.location.assign("{{ route('payroll_invoices.index') }}");
            console.log(result);
        } catch (err) {
            alert('Error creating Money invoice!')
            console.log(`Failed to create Money invoice: ${err}`);
        }

        console.log(data);
    })

    ///getting salary configs
    const employeeSelect = document.getElementById('employee_id');
    const remarks = document.getElementById('remarks');
    const total_amount = document.getElementById('total-amount');
    let items=[];

    employeeSelect.addEventListener("change", async () => {
        const response = await fetch(
            `http://127.0.0.1:8000/api/get_salary_config?id=${employeeSelect.value}`, {
                method: "GET",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                },
            }
        );
        const result = await response.json();
        const data = result.salary[0];
        if (result.found) {
            alert(`Salary Found! Salary:`);
            remarks.value = data.remarks;
            total_amount.textContent = data.salary_total;
            showItems(data.details);

            //i want to set the data.details to the items variable 
            items=data.details;

        } else {
            console.log("Salary not found");
            alert('Salary Not found!');
        }
    });
    //show items
    function showItems(items) {
        const tbody = document.getElementById('tbody');
        tbody.innerHTML = '';
        items.forEach((item, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <tr>
                    <td>${index+1}</td>
                    <td>
                        ${item.payroll_item_id}
                    </td>
                    <td>
                        ${item.payroll_item_name}
                    </td>
                    <td>
                        ${item.amount}
                    </td>
                </tr>
            `;
            tbody.appendChild(tr);
        })

        return items;
    }
</script>
@endsection