<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // role index page:
        $roles = Role::with('permissions')->whereNotIn('name',['super-admin'])->get();
        // print_r($roles);
        return view('backend.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::whereNotIn('name',['super-admin'])->get();
        $permissions = Permission::all();
         
        return view('backend.role.create',compact('roles','permissions'));
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
        $request->validate([
            "role" => "required",
            "permissions" => "required"
        ]);

        $role = new Role();
        $role->name = $request->role;
        $role->save();


        $role->givePermissionTo($request->permissions);
         
        return back();
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
        // $roles = Role::where('id',$id)->get();
        $roles = Role::where('id',$id)->with('permissions')->get();
        $permissions = Permission::all();
        
       
        return view('backend.role.edit',compact('roles','permissions'));
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
        $request->validate([
            'role' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->role;
        $role->syncPermissions($request->permissions);
        $role->save();
        return redirect()->route('dashboard.role.index');

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
        Role::find($id)->delete();
        return back();
    }
}
