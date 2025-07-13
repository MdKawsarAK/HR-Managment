<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollReceiptDetail extends Model
{
    protected $table = 'payroll_receipt_details';
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(PayrollItem::class, 'item_id');
        // return $this->belongsTo(PayrollItem::class, 'item_id');
    }
}
