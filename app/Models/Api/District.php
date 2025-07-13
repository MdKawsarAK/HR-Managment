<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'division_id'];
}
