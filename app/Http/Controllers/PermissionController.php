<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Route_list;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "Permission";
        $permission_all = Permission::all();
        return view('admin.permission.permission_manage',compact('page_name','permission_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route_all = Route_list::all();
        $page_name = "Permission";
        return view('admin.permission.permission_create',compact('page_name','route_all'));
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>"Name field is required",
        ]);*/

        $permission = new Permission();
        $permission->slug = $request->slug;
        $permission->name = $request->name;
        $permission->http = $request->http;
        $permission->save();
        return redirect()->route('permission.index')->with('success',"Permission created successfully");
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
        $route_all = Route_list::all();
        $page_name = "Permission";
        $permission = Permission::findById($id);
        return view('admin.permission.permission_update',compact('permission','page_name','route_all'));
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
        /*$this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>"Name field is required",
        ]);*/

        $permission = Permission::find( $id);
        $permission->slug = $request->slug;
        $permission->name = $request->name;
        $permission->http = $request->http;
        $permission->save();
        return redirect()->route('permission.index')->with('success',"Permission updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode(",", $id);
        Permission::destroy($ids);
    }
}
