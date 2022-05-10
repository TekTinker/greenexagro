<?php
/**
 * Created by PhpStorm.
 * User: aniket
 * Date: 18/6/16
 * Time: 10:34 AM
 */

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Support\Facades\View;

class Base extends Controller
{

    public function __construct()
    {
        //its just a dummy data object.
        $category_product = Category::where('type', 'product')
            ->where('available', 1)
            ->get();

        $category_raw = Category::where('type', 'raw')
            ->where('available', 1)
            ->get();

        $category_crop = Category::where('type', 'crop')
            ->where('available', 1)
            ->get();

        // Sharing is caring
        View::share('category_product', $category_product);
        View::share('category_raw', $category_raw);
        View::share('category_crop', $category_crop);
    }
}