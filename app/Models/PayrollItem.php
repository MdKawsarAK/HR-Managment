<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollItem extends Model
{
    protected $fillable = ['name', 'payroll_item_type_id'];
    public $timestamps=false;
}