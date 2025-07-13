<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollReceipt extends Model
{
    protected $table = 'payroll_receipts';

    public $timestamps = false;

    protected $casts = [
    'created_at' => 'datetime',
];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function details()
    {
        return $this->hasMany(PayrollReceiptDetail::class, 'receipt_id');
        // return $this->hasMany(PayrollReceiptDetail::class, 'payroll_receipt_id');
    }
}
