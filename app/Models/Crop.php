<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/5/2016
 * Time: 3:13 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{

    protected $fillable = [
        'customer_id',
        'crop_name',
        'area',
    ];

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'customer_id');
    }
}