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

        $valided = $request->validate([
            'title' => 'required|unique:products',
            'description' => 'required|max:150',
            'short_description' => 'max:250',
            'additional_info' => 'max:250',
            'image' => 'required',
            'price' => 'required',
            'sale_price' => 'nullable',
            'discount' => 'nullable',
            'category' => 'required',
        ],
        [
            'title.required' => 'Please enter a title',
            'title.unique'=>'This title is already taken',
            'description.required' => 'Please enter a description',
            'description.max' => 'Max charecter is 250',
            'short_description.max' => 'Max charecter is 250',
            'image.required' => 'Please enter an image',
            'price.required' => 'Please enter a price',
            'category'=> 'Please enter a category',
            
        ]
        );

        if($valided){
            $product_image = $request->file('image');
            $image_name = Str::slug($request->title) . time(). "." .  strtolower($product_image->getClientOriginalExtension());

            if($image_name){
                $product_image->move(public_path('storage/products/'),$image_name);
            }

            $products = new Product();
            $products->user_id = auth()->user()->id;
            $products->title = $request->title;
            $products->slug = Str::slug($request->title);
            $products->description = $request->description;
            $products->short_description = $request->short_description;
            $products->additional_info =  $request->additional_info;
            $products->image = $image_name;
            $products->price = $request->price;
            $products->sale_price = $request->sale_price;
            $products->discount = $request->discount;
            $products->save();
    
            $products->categories()->attach($request->category);
    
            return redirect(route('dashboard.product.index'))->with('success','Product added successfull');
        }
        else{
            return "nothing";
        }
         
        

 
 
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
