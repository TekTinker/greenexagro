<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/4/2016
 * Time: 3:50 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{

    protected $primaryKey = 'customer_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'address',
        'taluka',
        'district',
        'pin',
        'farm_area',
    ];

    public function crops()
    {
        return $this->hasMany('App\Models\Crop', 'customer_id', 'customer_id');
    }
}
