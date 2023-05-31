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
        // return view('backend.inventory.index');
      
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
            with('color')->get();
            
        }])->findOrFail($id);

 

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
        $product = Product::with('inventories:id,color_id,product_id,size_id')->select(['id'])->findOrFail($request->id);

        $exSize = [];
        foreach($product->inventories as $inventory){
            if($inventory->color_id == $request->color_id){
                $exSize[] = $inventory->size_id; 
            }
        }

        $sizes = Size::whereNotIn('id',$exSize)->get();

        $options = ["<option selected disabled>Select a product size</option>"];
        foreach($sizes as $size){
            $options[] = "<option value='$size->id'>" .$size->name. "</option>" ;
        }


        return response()->json($options);
        
       

 
    }
}
