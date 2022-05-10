<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/4/2016
 * Time: 2:33 PM
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;


class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'email',
        'mobile',
        'uid',
        'name',
        'password',
        'role',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function cart(){
        return $this->hasOne('App\Models\Cart', 'cart_id', 'id');
    }
}
