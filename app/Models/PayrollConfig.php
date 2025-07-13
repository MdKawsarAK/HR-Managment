<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollConfig extends Model
{
    protected $table = 'payroll_configs';
    public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function item()
    {
        return $this->belongsTo(PayrollItem::class, 'payroll_item_id');
    }
}
