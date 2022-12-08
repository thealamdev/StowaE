<?php

namespace App\Http\Controllers\Backend\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::with('user')->get(['id','name','description','slug','created_at','image','user_id']);
        return view('backend.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::select('id','parent_id','name')->get();
        return view('backend.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //find the image:
        $category_img = $request->file('image');

        //Sending before validation:
        $validated = $request->validate([
            'name'=>'required|unique:categories|max:20',
            'slug'=>'unique:categories|max:20',
            'description'=>'required|max:255',
            'image'=>'required|mimes:png,jpg,jpeg',
        ],
        [
            'name.required' => 'Please Enter a category',
            'description.required' => 'Please Enter a description',
            'image.required' => "Please ente a phpto",
            'image.mimes'=> "Image must be type of JPG, PNG OR JPEG",
        ]);

        // custom error message:
       
        
        if($validated == true){

            if($category_img->isValid()){
            $image_name = Str::slug($request->name) . time() . ".". $category_img->getClientOriginalExtension();
            $category_img->move(public_path('/storage/category'),$image_name);
                 
            $categories = new Category();
            $categories->name = $request->name;
            $categories->slug = Str::slug($request->name);
            $categories->description = $request->description;
            $categories->parent_id = $request->parent_id;
            $categories->user_id = auth()->user()->id;
            $categories->image = $image_name;
             

            $categories->save();
    
            return redirect(route('dashboard.category.index'))->with('success','Category inserted successfully');
            }

            
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
    public function edit(Request $request, $id)
    {
        //
        $categories = Category::where('id',$id)->get(['id','name','description','image','created_at']);
        $all_category = Category::get(['id','name']);
        return view('backend.category.edit',compact('categories','all_category'));
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
        $category_img = $request->file('image');
        // UPDATE METHOD:
        $categories = Category::find($id);
        // return $categories;
        // exit();
        $image_name = $categories->image;
        if($category_img==true){
            $file_path = public_path('storage/category/'.$image_name);
            if(file_exists($file_path)){
                unlink($file_path);
            }
        }
         
        if($category_img==true){
            $image_name = Str::slug($request->name) . time() . ".". $category_img->getClientOriginalExtension();
            $category_img->move(public_path('/storage/category'),$image_name);
        }

        $categories->name = $request->name;
        $categories->name = $request->name;
        $categories->slug = Str::slug($request->name);
        $categories->description = $request->description;
        $categories->parent_id = $request->parent_id;
        $categories->image = $image_name;
             

        $categories->save();
        return redirect(route('dashboard.category.index'))->with('success','Category Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back()->with('success','Delete successfully');
    }

    // Archieve function:
    public function archieve(){
        //
        $categories = Category::onlyTrashed()->get();
        return view('backend.category.archieve',compact('categories'));
    }

    // hard delete::
    public function hardDelete($id){
         // delete particular id's element:
        // delete existing image:
    
        $categories = Category::onlyTrashed()->find($id);

           $image_name = $categories->image;
           $file_path = public_path('storage/category/' . $image_name);

           if(file_exists($file_path)){
               unlink($file_path);
           }
        

         $categories->forceDelete();
         return back()->with('success','Empty byn successfully');
    }

    public function restore($id){
        $categories = Category::onlyTrashed()->find($id);
        $categories->restore();
        return back()->with('success','Restore successfully');
    }
}
