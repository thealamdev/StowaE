<?php

namespace App\Http\Controllers\Backend\Color;

use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $colors = Color::select('id','name','slug')->orderBy('id','desc')->paginate(10);
        return view('backend.color.index',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.color.create');
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
            'name' => 'required',
        ],
        [
            'name.required' => 'Please Enter a Color',
        ]);
       
        if($valided == true){
            $colors = new Color();
            $colors->name = $request->name;
            $colors->slug = Str::slug($request->name);
            $colors->save();
            return redirect(route('dashboard.color.index'))->with('success','Color Add successfully');
        }
        else{
            return back()->with('
            danger','Data does not enter');
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
        $colors = Color::where('id',$id)->get(['id','name']);
        return view('backend.color.edit',compact('colors'));
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
        $colors = Color::find($id);
        // return $colors;
        // exit();
        $valided = $request->validate([
            'name' => 'required|unique:colors'
        ],
        [
            'name.required' => 'Please Enter a Color',
        ]);

        if($valided == true){
            $colors->name = $request->name;
            $colors->slug = Str::slug($request->name); 
            $colors->save(); 
            return redirect(route('dashboard.color.index'))->with('success','Color update successfull');
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
        // return $id;
        $colors = Color::find($id);
        $colors->delete();
        return redirect(route('dashboard.color.index'))->with('success','Trashed successfull');
    }



    public function archieve(){
        $colors = Color::onlyTrashed()->get(['id','name','slug']);
        return view('backend.color.archieve',compact('colors'));
    }

    public function trash($id){
         
        $colors = Color::onlyTrashed()->find($id);
        $colors->forceDelete();
        return redirect(route('dashboard.color.index'))->with('success','Trashed successfull');
    }

    public function restore($id){
        $colors = Color::onlyTrashed()->find($id);
        $colors->restore();
        return redirect(route('dashboard.color.index'))->with('success','Restore successfull');
    }
}
