<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['employees_id', 'att_datetime', 'attendance_method_id', 'attendancereport_id'];
}