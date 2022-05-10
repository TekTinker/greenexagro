<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{

    protected $fillable = [
        'cart_id',
        'package_id',
        'product_name',
        'package',
        'quantity',
        'price',
    ];

    public function cart(){
        return $this->belongsTo('App\Models\Cart');
    }
}
