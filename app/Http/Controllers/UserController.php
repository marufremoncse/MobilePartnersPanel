<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Organization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


class UserController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->sort_select!=null){
            $ara = explode(',',$request->sort_select);
            if(Auth::user()->organization_id==4399)
                $user_all = User::where([['status_active','=',1],['type','!=',1]])->orderBy($ara[0], $ara[1]) ->paginate(10);
            else
                $user_all = User::where([['status_active','=',1],['type','!=',1],['organization_id','=',Auth::user()->organization_id]])->orderBy($ara[0], $ara[1]) ->paginate(10);
            $page_name = "User";
            return view('admin.user.user_manage',compact('page_name','user_all'));
        }
        if(Auth::user()->organization_id==4399)
            $user_all =User::where([['status_active','=',1],['type','!=',1]])->paginate(10);
        else
            $user_all = User::where([['status_active','=',1],['type','!=',1],['organization_id','=',Auth::user()->organization_id]])->paginate(10);
        $page_name = "User";
        return view('admin.user.user_manage',compact('page_name','user_all'));
    }


    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $org_all = Organization::all();
        $role_all = Role::all();
        $page_name = "User";
        return view('admin.user.user_create',compact('page_name','org_all','role_all'));
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users,email',
            'mobile'=> 'required|numeric|unique:users,mobile|min:11',
            'address'=>'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
        ],[
            'first_name.required'=>"First name field is required",
            'last_name.required'=>"Last name field is required",
            'email.required'=>"Email field is required",
            'email.email'=>"Invalid email. Please, try a valid email address",
            'email.unique'=>"User email already exists",
            'mobile.required'=>"Mobile field is required",
            'mobile.unique'=>"This mobile number is already exists",
            'address.required'=>"This address field is required",
            'password.required'=>"Password field is required",
            'password.min'=>"Password must be at least 8 characters long",
            'password_confirmation.same'=>"Password mismatch",
        ]);

        $user = new User();

        if($request->image!=null){
            $profileImage = $request->file('image');
            $profileImageSaveAsName = "ProfilePictureOfId_". $request->first_name.".". $profileImage->getClientOriginalExtension();
            $upload_path = 'profile_images/';
            $profile_image_url = $upload_path . $profileImageSaveAsName;
            $success = $profileImage->move($upload_path, $profileImageSaveAsName);
            $user->image = $profile_image_url;
        }


        $user->organization_id = $request->organization_select;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->type = 3;
        $user->status_active = 1;
        $user->created_by = Auth::user()->id;
        $user->updated_by = Auth::user()->id;
        $user->save();

        $checker = User::find(Auth::user()->id);
        $flag = $checker->hasRole('Company Admin');
        if($flag)
            $user->assignRole('Company User');
        else{
            foreach ($request->role_select as $role) {
                $user->assignRole($role);
            }
        }

        return redirect()->route('user.index')->with('success',"User created successfully");
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

    /*
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $org_all = Organization::all();
        $role_all = Role::all();
        $user = User::find($id);
        $page_name = "User";
        $author_current_roles = DB::table('model_has_roles')->where('model_has_roles.model_id',$id)->pluck('role_id')->toArray();
        return view('admin.user.user_update',compact('page_name','user','org_all','author_current_roles','role_all'));
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
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'mobile'=> 'required|numeric||min:11|unique:users,mobile,'.$id,
            'address'=>'required',
            'password' => 'nullable|min:8',
            'password_confirmation' => 'nullable|required_with:password|same:password|min:8',
        ],[
            'first_name.required'=>"First name field is required",
            'last_name.required'=>"Last name field is required",
            'email.required'=>"Email field is required",
            'email.email'=>"Invalid email. Please, try a valid email address",
            'email.unique'=>"User email already exists",
            'mobile.required'=>"Mobile field is required",
            'mobile.unique'=>"This mobile number is already exists",
            'address.required'=>"This address field is required",
            'password.min'=>"Password must be at least 8 characters long",
            'password_confirmation.same'=>"Password mismatch",
        ]);

        $user = User::find($id);

        if($request->image!=null){
            $profileImage = $request->file('image');
            $profileImageSaveAsName = "ProfilePictureOfId_". $request->first_name.".". $profileImage->getClientOriginalExtension();
            $upload_path = 'profile_images/';
            $profile_image_url = $upload_path . $profileImageSaveAsName;
            $success = $profileImage->move($upload_path, $profileImageSaveAsName);
            $user->image = $profile_image_url;
        }

        $user->organization_id = $request->organization_select;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->address = $request->address;
        $user->type = 3;
        $user->status_active = 1;
        $user->updated_by = Auth::user()->id;
        $user->save();

        $checker = User::find(Auth::user()->id);
        $flag = $checker->hasRole('Super Admin');
        if($flag){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            foreach ($request->role_select as $role) {
                $user->assignRole($role);
            }
        }
        return redirect()->route('user.index')->with('success',"Profile updated successfully");
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        $ara = explode(',',$ids);
        DB::table('users')->whereIn('id', $ara)->update(['status_active' =>0]);
    }
}
