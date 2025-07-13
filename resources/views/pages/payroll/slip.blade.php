<!DOCTYPE html>
<html>
<head>
    <title>Payslip</title>
</head>
<body>
    <h2>Payslip for {{ $receipt->employee->name }}</h2>
    <p>Date: {{ $receipt->created_at }}</p>
    <table border="1" width="50%">
        <thead>
            <tr><th>Item</th><th>Amount</th></tr>
        </thead>
        <tbody>
        @foreach($receipt->details as $detail)
            <tr>
                <td>{{ $detail->item->name }}</td>
                <td>{{ number_format($detail->amount, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr><th>Total</th><th>{{ number_format($receipt->receipt_total, 2) }}</th></tr>
        </tfoot>
    </table>
</body>
</html>
