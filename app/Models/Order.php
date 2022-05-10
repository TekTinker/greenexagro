<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/5/2016
 * Time: 1:27 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'customer_id',
        'customer_uid',
        'address',
        'taluka',
        'district',
        'status',
        'total_price',
        'total_items',
        'delivered_at',
    ];

    public function orderitems(){
        return $this->hasMany('App\Models\OrderItem');
    }
}