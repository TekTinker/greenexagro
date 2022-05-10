<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/5/2016
 * Time: 3:45 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_name',
        'product_id',
        'package_id',
        'package',
        'quantity',
        'price',
    ];

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

}