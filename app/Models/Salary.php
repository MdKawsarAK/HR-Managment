<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public $timestamps = false;

    protected $fillable = ['employee_id', 'salary_total', 'status', 'remarks', 'created_at', 'updated_at'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function details()
    {
        return $this->hasMany(SalaryDetail::class, 'salary_id');
    }

}