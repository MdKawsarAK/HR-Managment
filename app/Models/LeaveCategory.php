<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveCategory extends Model
{
    public $timestamps=false;
    protected $fillable = ['name'];
}