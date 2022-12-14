<?php

namespace App\Http\Controllers\Backend\RoleAssign;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_roles = User::with(['roles'=>function($q){
            $q->select(['id','name'])->whereNotIn('name',['super-admin']);
        }])->get(['id','name'])->whereNotIn('id',[1]);
        return view('backend.role-assign.index',compact('user_roles'));    
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
        $user_roles = User::where('id',$id)->with(['roles'=>function($q){
            $q->select('id','name');
        }])->get(['id','name']);

        $roles = Role::get(['id','name'])->whereNotIn('name',['super-admin']);
         return view('backend.role-assign.edit',compact('user_roles','roles'));
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->syncRoles($request->role);
        $user->save();
        
        return redirect(route('dashboard.roleAssign.index'))->with('success','Role assign successfully done');

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
        $user = User::find($id);
        $user->delete();
        if($user->delete()==true){
            return back()->with('success', 'User delete successfully');
        }
        else{
            return back('danger','Somethng wrong');
        }
         
    }
}
