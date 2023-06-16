<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Models\User;
use App\Models\Color;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $products = Product::select('id', 'title', 'short_description', 'image', 'price', 'sale_price', 'slug')->orderBy('id', 'desc')->paginate(9);
        return view('frontend.shop', compact('products'));
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
        $products = Product::where('slug', $slug)->with('product_gallaries')->first();
        $colorSize = Product::where('slug', $slug)->with(['inventories' => function ($q) {
            $q->with('color')
                ->with('size');
        }])->first();
        // return $colorSize;

        $inventory_color = [];
        foreach ($colorSize->inventories as $inventory) {
            $colors_inv[] = $inventory->color_id;
            if (!empty($colors_inv)) {
                $inv_colors = array_map("unserialize", array_unique(array_map("serialize", $colors_inv)));
            }
        }
        if (!empty($inv_colors)) {
            $inventory_color = Color::whereIn('id', $inv_colors)->get();
        }



        return view('frontend.show', compact('products', 'inventory_color', 'colorSize'));
    }


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


    public function sizeSelect(Request $request)
    {
        $products = Product::where('id', $request->id)->with(['inventories' => function ($q) {
            $q->with('size');
        }])->first();

        $options = ["<option selected disabled>Select a Product size</option>"];
        foreach ($products->inventories as $inventory) {

            if ($request->color_id == $inventory->color_id) {
                $options[] = "<option value='$inventory->size_id'>" . $inventory->size->name . "</option>";
            }
        }

        return response()->json($options);
    }

    /* Ajax functions:
        additionalPrice function:
       */

    public function additionalPrice(Request $request)
    {
        $product = Product::where('id', $request->product_id)->with(['inventories' => function ($q) use ($request) {

            $q->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first();
        }])->first();

        // return $product;

        if ($product->sale_price) {
            foreach ($product->inventories as $inventory) {
                $price = $product->sale_price + $inventory->additional_price;
            }
        } else {
            foreach ($product->inventories as $inventory) {
                $price = $product->price + $inventory->additional_price;
            }
        }

        $data = [];
        foreach ($product->inventories as $inventory) {
            $data['inventory_id'] = $inventory->id;
            $data['price'] = $price;
            $data['additional_price'] = $inventory->additional_price;
            $data['quantity'] = $inventory->quantity;
        }

        return response()->json($data);
    }
}
