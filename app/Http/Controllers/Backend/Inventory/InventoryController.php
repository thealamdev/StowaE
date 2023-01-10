<?php

namespace App\Http\Controllers\Backend\Inventory;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $product = Product::with('inventories:id,product_id,color_id,size_id')->where('id',$id)->get(['id','title']);
        $colors = Color::get(['id','name']);
        $sizes = Size::get(['id','name']);

        $products = Product::with(['inventories'=>function($q){
            $q->with('size')->
            with('color')->get('id','title');
            
        }])->findOrFail($id);
        
        // return $product;
        // return view('backend.inventory.index',compact('product'));
         
        return view('backend.inventory.create',compact('product','colors','sizes','products'));
        
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

        Inventory::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'additional_price' => $request->additional_price,
        ]);
        return back()->with('success','Inventory added successfully');
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

    // ajax functions here:
    public function colorSelect(Request $request){
        // return $request;
        // exit();
        $product = Product::with('inventories:id,color_id,product_id,size_id')->select(['id'])->findOrFail($request->id);
        $colors = Color::get('id','name');

        


        $sizes = Size::whereNotIn('id',[1])->get();

         

        // foreach($colors as $color){
        //     if($color->id == $request->color_id){
        //         $sizes = 10;
        //     }
        // }

        return response()->json($sizes);
    }
}
