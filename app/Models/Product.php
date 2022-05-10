<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/5/2016
 * Time: 12:01 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name',
        'contents',
        'img',
        'category',
        'category_id',
        'description',
        'usage',
        'type',
        'available',
    ];

    public function packages()
    {
        return $this->hasMany('App\Models\Package');
    }

}