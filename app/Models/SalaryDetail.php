<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    public $timestamps = false;

    protected $fillable = ['salary_id', 'payroll_item_id', 'amount'];

    public function payroll_item()
    {
        return $this->belongsTo(PayrollItem::class);
    }
}
