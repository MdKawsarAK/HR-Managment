<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollBillDetail extends Model
{
     protected $table = 'payroll_bill_details';
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(PayrollItem::class, 'item_id');
    }
}
