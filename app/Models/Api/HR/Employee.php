<?php

namespace App\Models\Api\HR;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name', 'category_id,', 'hire_date', 'photo', 'email', 'status','salary','phone','nid', 'gender', 'address','dob','blood_id'];
}
