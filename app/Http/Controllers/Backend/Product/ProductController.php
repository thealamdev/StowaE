<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::with(['user'=>function($q){
            $q->select('id','name');
        }])->get();
         
        // return $products;
        // exit();
        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::get(['id','name']);
        return view('backend.product.create',compact('categories'));
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
        $products = new Product();
        $products->user_id = auth()->user()->id;
        $products->title = $request->title;
        $products->slug = Str::slug($request->title);
        $products->description = $request->description;
        $products->short_description = $request->short_description;
        $products->additional_info =  $request->additional_info;
        $products->image = $request->title;
        $products->price = $request->price;
        $products->sale_price = $request->sale_price;
        $products->discount = $request->discount;
        $products->save();

        $products->categories()->attach($request->category);

        return redirect(route('dashboard.product.index'))->with('success','Product added successfull');

 
 
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
