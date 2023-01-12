<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::select('id','title','short_description','image','price','sale_price','slug')->orderBy('id','desc')->paginate(9);
        return view('frontend.shop',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $products = Product::where('slug',$slug)->with('product_gallaries')->first();
        $colorSize = Product::where('slug',$slug)->with(['inventories'=>function($q){
            $q->with('color')
            ->with('size');
        }])->first();
        // return $colorSize;

        $inventory_color = [];
        foreach($colorSize->inventories as $inventory){
                $colors_inv[] = $inventory->color_id;
                if(!empty($colors_inv)){
                    $inv_colors = array_map("unserialize", array_unique(array_map("serialize", $colors_inv)));
                }
        }
        if(!empty($inv_colors)){
            $inventory_color = Color::whereIn('id', $inv_colors)->get();
        }
         
        return view('frontend.show',compact('products','inventory_color','colorSize'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function sizeSelect(Request $request){
        $products = Product::where('id',$request->id)->with(['inventories'=>function($q){
            $q->with('size');
        }])->first();

        //  return $products;
        $options = [];
        foreach($products->inventories as $inventory){
            // return $inventory;
            if($request->color_id == $inventory->color_id){
                // $inventory_size[] = $inventory->size_id;
                $options[] = "<li data-value='$inventory->size_id' class='option'>" .$inventory->size->name." </li>";
                // "<li data-value='$inventory->size_id' class='option'>" .$inventory->size->name." </li>";
            }
        }


        // return $products;
        return response()->json($options);
    }
}
