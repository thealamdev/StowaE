<?php

namespace App\Http\Controllers\Backend\Size;

use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sizes = Size::orderBy('name','asc')->get(['id','name','slug']);
        return view('backend.size.index',compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.size.create');
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
            'name' => 'required|unique:sizes'
        ],
        [
        'name.required' => 'Please enter a size'
        ]); 

        if($valided == true){
            $sizes = new Size();
            $sizes->name = $request->name;
            $sizes->slug = Str::slug($request->name);
            $sizes->save();
            return redirect(route('dashboard.size.index'))->with('success','Sise added successfully');
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
        $sizes =  Size::where('id',$id)->get(['id','name']);
        return view('backend.size.edit',compact('sizes'));
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
        $valided = $request->validate([
            'name' => 'required'
        ],
        [
        'name.required' => 'Please enter a size'
        ]); 

        if($valided == true){
            $sizes = Size::find($id);
            $sizes->name = $request->name;
            $sizes->slug = Str::slug($request->name);
            $sizes->save();
            return redirect(route('dashboard.size.index'))->with('success','Sise Update successfully');
        }
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
        $sizes = Size::find($id);
        $sizes->delete();
        return back()->with('success','Size delete successfull');
    }


    public function archieve(){
        $sizes = Size::onlyTrashed()->get(['id','name','slug']);
        return view('backend.size.archieve',compact('sizes'));
    }

    public function trash($id){
        $sizes = Size::onlyTrashed()->find($id);
        $sizes->forceDelete();
        return back()->with('success','Size trashed successfully');
    }

    public function restore($id){
        $sizes = Size::onlyTrashed()->find($id);
        $sizes->restore();
        return back()->with('success','Size restore successfully');
    }
}
