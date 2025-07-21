<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveTransaction extends Model
{
    protected $table = 'core_hr_leave_transactions';
    public $timestamps = false;

    protected $fillable = ['employee_id', 'from_date', 'to_date', 'leave_category_id', 'created_at', 'days'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function category()
    {
        return $this->belongsTo(LeaveCategory::class, 'leave_category_id');
    }
}
