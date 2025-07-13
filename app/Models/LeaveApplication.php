<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    protected $fillable = ['created_at', 'person_id', 'reason_id', 'remark', 'from_date', 'to_date', 'status_id', 'category_id', 'days'];
}