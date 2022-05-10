<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/9/2016
 * Time: 9:07 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Package extends Model
{
    protected $fillable = [
        'product_id',
        'product_name',
        'package',
        'price',
        'available',
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }

}