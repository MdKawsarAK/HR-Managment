<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollItem extends Model
{
    // protected $table = 'core_hr_payroll_items';
    public $timestamps = false;

    protected $fillable = ['name', 'payroll_type_id'];

    public function type()
    {
        return $this->belongsTo(PayrollItemType::class, 'payroll_type_id');
    }
}