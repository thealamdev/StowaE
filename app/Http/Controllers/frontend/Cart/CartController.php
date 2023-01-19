<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::with(['inventory'=>function($q){
            $q->select('id','additional_price','product_id');
            $q->with(['product'=>function($query){
                $query->select(['id','title','image','price','sale_price']);
            }]);
        }])->get(['id','inventory_id','quantity']);
         
        // foreach($carts as $cart){
        //     $additional_price = $cart->inventory->additional_price;
        //     $price = $cart->inventory->product->price;
        //     $sale_price = $cart->inventory->product->sale_price;
        //     $quantity = $cart->quantity;

        //     if($sale_price){
        //         $product_price = $sale_price + $additional_price;
        //         $total_price = ( $sale_price * $quantity ) + $additional_price;
        //     }
        //     else{
        //         $product_price = $price + $additional_price;
        //         $total_price = ( $sale_price * $quantity ) + $additional_price;
        //     }
             
        // }
        // return $carts;
        return view('frontend.cart',compact('carts'));
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
        $carts = new Cart();
        $carts->user_id = auth()->user()->id;
        $carts->inventory_id = $request->inventory_id;
        $carts->quantity = $request->quantity;

        $carts->save();
    
        return redirect(route('frontend.cart.index'))->with('success','Add to cart done');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
