<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/5/2016
 * Time: 11:43 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{

    protected $primaryKey = 'consultant_id';

    protected $fillable = [
        'consultant_id',
        'address',
        'taluka',
        'district',
        'pin',
    ];
}