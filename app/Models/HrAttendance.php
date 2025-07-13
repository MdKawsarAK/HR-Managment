<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HrAttendance extends Model
{
    protected $fillable = ['person_id', 'att_datetime', 'method_id'];
}