<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'employee_id',
        'address',
        'taluka',
        'district',
        'pin',
        'mobile',
        'status',
    ];

}
