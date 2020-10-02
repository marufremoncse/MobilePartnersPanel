<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public  function index(Request $request)
        {
            if ($request->sort_select != null) {
                $ara = explode(',', $request->sort_select);
                $org_all = Organization::where('status_active', 1)->orderBy($ara[0], $ara[1])->paginate(10);
                $page_name = "Organization";
                return view('business_organization.organization_manage', compact('page_name', 'org_all'));
            }
            $org_all = Organization::where('status_active', 1)->paginate(10);
            $page_name = "Organization";
            return view('business_organization.organization_manage', compact('page_name', 'org_all'));
        }

        /*
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $page_name = "Organization";
            return view('business_organization.organization_create', compact('page_name'));
        }

        /*
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public
        function store(Request $request)
        {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:organizations,organization_email',
                'mobile' => 'required|numeric|unique:organizations,organization_mobile|min:11',
                'address' => 'required',
                'website' => 'required',
            ], [
                'name.required' => "Name field is required",
                'email.required' => "Email field is required",
                'email.email' => "Invalid email. Please, try a valid email address",
                'email.unique' => "User email already exists",
                'mobile.required' => "Mobile field is required",
                'mobile.unique' => "This mobile number is already exists",
                'address.required' => "Address field is required",
                'website.required' => "Website field is required",
            ]);

            $organization = new Organization();

            if($request->thumbnail!=null){
                $profileImage = $request->file('thumbnail');
                $profileImageSaveAsName = "OrganizationThumbnailOf_". $request->name.".". $profileImage->getClientOriginalExtension();
                $upload_path = 'organization_images/';
                $profile_image_url = $upload_path . $profileImageSaveAsName;
                $success = $profileImage->move($upload_path, $profileImageSaveAsName);
                $organization->organization_thumbnail = $profile_image_url;
            }

            if($request->logo!=null){
                $profileImage = $request->file('logo');
                $profileImageSaveAsName = "OrganizationLogoOf_". $request->name.".". $profileImage->getClientOriginalExtension();
                $upload_path = 'organization_images/';
                $profile_image_url = $upload_path . $profileImageSaveAsName;
                $success = $profileImage->move($upload_path, $profileImageSaveAsName);
                $organization->organization_logo = $profile_image_url;
            }

            $organization->organization_name = $request->name;
            $organization->organization_email = $request->email;
            $organization->organization_mobile = $request->mobile;
            $organization->organization_address = $request->address;
            $organization->organization_website = $request->website;
            $organization->status_active = 1;
            $organization->created_by = Auth::user()->id;
            $organization->updated_by = Auth::user()->id;
            $organization->save();
            return redirect()->route('organise.index')->with('success', "Organization created successfully");
        }

        /*
         * Display the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public
        function show($id)
        {
            //
        }

        /*
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public
        function edit($id)
        {
            $org = Organization::find($id);
            $page_name = "Organization";
            return view('business_organization.organization_update', compact('page_name', 'org'));
        }

        /*
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public
        function update(Request $request, $id)
        {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:organizations,organization_email,' . $id,
                'mobile' => 'required|numeric||min:11|unique:organizations,organization_mobile,' . $id,
                'address' => 'required',
                'website' => 'required',
            ], [
                'name.required' => "Name field is required",
                'email.required' => "Email field is required",
                'email.email' => "Invalid email. Please, try a valid email address",
                'email.unique' => "User email already exists",
                'mobile.required' => "Mobile field is required",
                'mobile.unique' => "This mobile number is already exists",
                'address.required' => "Address field is required",
                'website.required' => "Website field is required",
            ]);
            $organization = Organization::find($id);

            if($request->thumbnail!=null){
                $profileImage = $request->file('thumbnail');
                $profileImageSaveAsName = "OrganizationThumbnailOf_". $request->name.".". $profileImage->getClientOriginalExtension();
                $upload_path = 'organization_images/';
                $profile_image_url = $upload_path . $profileImageSaveAsName;
                $success = $profileImage->move($upload_path, $profileImageSaveAsName);
                $organization->organization_thumbnail = $profile_image_url;
            }

            if($request->logo!=null){
                $profileImage = $request->file('logo');
                $profileImageSaveAsName = "OrganizationLogoOf_". $request->name.".". $profileImage->getClientOriginalExtension();
                $upload_path = 'organization_images/';
                $profile_image_url = $upload_path . $profileImageSaveAsName;
                $success = $profileImage->move($upload_path, $profileImageSaveAsName);
                $organization->organization_logo = $profile_image_url;
            }


            $organization->organization_name = $request->name;
            $organization->organization_email = $request->email;
            $organization->organization_mobile = $request->mobile;
            $organization->organization_address = $request->address;
            $organization->organization_website = $request->website;
            $organization->status_active = 1;
            $organization->updated_by = Auth::user()->id;
            $organization->save();
            return redirect()->route('organise.index')->with('success', "Organization updated successfully");
        }

        /*
         * Remove the specified resource from storage.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public
        function destroy($ids)
        {
            $ara = explode(',', $ids);
            DB::table('organizations')->whereIn('id', $ara)->update(['status_active' => 0]);
        }
    }
