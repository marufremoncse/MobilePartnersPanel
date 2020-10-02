<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Organization;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class UserProfileController extends Controller
{
    use HasRoles;

    public function index(Request $request)
    {
        $checker = User::find(Auth::user()->id);
        $flag = $checker->hasAnyRole(['Company Admin', 'Super Admin']);
        $user = User::find($request->id);
        if ($user->organization_id != $checker->organization_id) {
            return view('404');
        } else {

            if (($request->id == Auth::user()->id) || $flag) {

                $org_all = Organization::all();
                $page_name = $user->first_name . ' ' . $user->last_name;

                return view('admin.user.profile.profile', compact('page_name', 'user', 'org_all'));
            }
            else
                return view('404');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|numeric||min:11|unique:users,mobile,' . $id,
            'address' => 'required',
            'password' => 'nullable|min:8',
            'password_confirmation' => 'nullable|required_with:password|same:password|min:8',
        ], [
            'first_name.required' => "First name field is required",
            'last_name.required' => "Last name field is required",
            'email.required' => "Email field is required",
            'email.email' => "Invalid email. Please, try a valid email address",
            'email.unique' => "User email already exists",
            'mobile.required' => "Mobile field is required",
            'mobile.unique' => "This mobile number is already exists",
            'address.required' => "This address field is required",
            'password.min' => "Password must be at least 8 characters long",
            'password_confirmation.same' => "Password mismatch",
        ]);

        $user = User::find($id);

        if ($request->image != null) {
            $profileImage = $request->file('image');
            $profileImageSaveAsName = "ProfilePictureOfId_" . $request->first_name . "." . $profileImage->getClientOriginalExtension();
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
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->address = $request->address;
        $user->type = 3;
        $user->status_active = 1;
        $user->updated_by = Auth::user()->id;
        $user->save();

        $checker = User::find(Auth::user()->id);
        $flag = $checker->hasRole('Super Admin');
        if ($flag) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            foreach ($request->role_select as $role) {
                $user->assignRole($role);
            }
        }
        return redirect('/profile/' . $id)->with('success', "Profile updated successfully");
    }
}



