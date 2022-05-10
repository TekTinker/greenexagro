<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'cart_id',
        'total_items',
        'total_price',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'id', 'cart_id');
    }

    public function cart_items(){
        return $this->hasMany('App\Models\CartItem');
    }
}
