<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollItemType extends Model
{
    protected $table = 'payroll_item_types';
    public $timestamps = false;

    protected $fillable = ['name'];
}