<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Route_list;

class RoleController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_all = Role::all();
        $permission = Permission::all();

        $page_name = "Role";
        return view('admin.role.role_manage',compact('page_name','role_all'));
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "Role";
        $permission_all = Permission::all();
        return view('admin.role.role_create',compact('page_name','permission_all'));
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
            'name'=>'required',
            'permission_select'=>'required|array',
            'permission_select.*'=>'required|string'
        ],[
            'name.required'=>"Name field is required",
            'permission_select.required'=>"Select permissions",
            'permission_select.*.required'=>"Select a permission"
        ]);*/
        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();

        foreach ($request->permission_select as $permission) {
            $role->givePermissionTo($permission);
        }
        return redirect()->route('role.index')->with('success',"Role assigned successfully");

    }

    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_name = "Role";
        $role = Role::findById($id);
        $permission_all = Permission::all();
        $permission_already_selected = DB::table('role_has_permissions')->where('role_has_permissions.role_id',$id)->pluck('permission_id')->toArray();
        return view('admin.role.role_update',compact('page_name','role','permission_all','permission_already_selected'));
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'permission_select'=>'required|array',
            'permission_select.*'=>'required|string'
        ],[
            'name.required'=>"Name field is required",
            'permission_select.required'=>"Select permissions",
            'permission_select.*.required'=>"Select a permission"
        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();

        DB::table('role_has_permissions')->where('role_has_permissions.role_id',$id)->delete();

        foreach ($request->permission_select as $permission) {
            $role->givePermissionTo($permission);
        }
        return redirect()->route('role.index')->with('success',"Role updated successfully");
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode(",", $id);
        Role::destroy($ids);
    }
}
