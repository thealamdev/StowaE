<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategorySearchController extends Controller
{
    public function categoryView($slug){
        
         $products = DB::table('category_product as cp')
        ->join('products as p','cp.product_id','=','p.id')
        ->join('categories as c','cp.category_id','=','c.id')
        ->where('c.slug','=',$slug)
        ->select(
            'p.title',
            'p.price',
            'p.sale_price',
            'p.image',
            'p.description',
            'p.description',
            'p.slug as product_slug',
            'c.slug as category_slug',
            'c.name',
        )
        ->paginate(6);
        
        return view('frontend.searching.category-view',compact('slug','products'));
    }
}
