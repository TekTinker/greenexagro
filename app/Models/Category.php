<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name',
        'type',
        'available',
    ];

    public function getAll(){
        $i = 0;
        foreach( Category::all() as $category){
            $category[$i] = $category->name;
            $i++;
        }
        return $category;
    }
}
