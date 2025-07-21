<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveConfig extends Model
{
    protected $table = 'leave_configs';
    public $timestamps = false;

    protected $fillable = ['employee_id', 'leave_category_id', 'days'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function category()
    {
        return $this->belongsTo(LeaveCategory::class, 'leave_category_id');
    }
}
