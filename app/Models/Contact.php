<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'address',
        'taluka',
        'district',
        'pin',
        'farm',
        'message',
    ];

}
