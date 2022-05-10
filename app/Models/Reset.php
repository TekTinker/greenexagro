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


class Reset extends Model implements Authenticatable
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
        'pin',
        'attempt',
    ];
    
}
