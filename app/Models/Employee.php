<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name', 'category_id', 'hire_date', 'photo', 'email', 'status', 'salary', 'created_at', 'updated_at', 'phone', 'nid', 'gender', 'address', 'dob', 'blood_id'];
}