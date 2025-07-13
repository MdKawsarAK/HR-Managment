<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollBill extends Model
{
     protected $table = 'payroll_bills';
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(PayrollBillDetail::class, 'bill_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
