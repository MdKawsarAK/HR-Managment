<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendancereport extends Model
{
    protected $fillable = ['employees_id', 'att_datetime', 'check_in', 'check_out'];
}