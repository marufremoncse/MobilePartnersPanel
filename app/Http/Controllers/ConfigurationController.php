<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ConfigurationController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "Configuration";
        $table_all = DB::table('oem_revenue_configurations')->get();
        return view('admin.configuration.config_manage',compact('page_name','table_all'));
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "New Configuration";
        return view('admin.configuration.config_create',compact('page_name'));
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('oem_revenue_configurations')->insert(
            array('organization_id'=>$request->org_id,
                'btrc_share'=>$request->btrc,
                'gp_share'=>$request->gp_share,
                'airtel_share'=>$request->airtel_share,
                'robi_share'=>$request->robi_share,
                'bl_share'=>$request->bl_share,
                'teletalk_share'=>$request->teletalk_share,
                'discrepancy'=>$request->discrepancy,
                'ait'=>$request->ait,
                'billing_fee'=>$request->billing_fee,
                'partner_share'=>$request->partner_share,
                'vat'=>$request->vat,
                'gp_grand_share'=>$request->gp_grand_share,
                'airtel_grand_share'=>$request->airtel_grand_share,
                'robi_grand_share'=>$request->robi_grand_share,
                'bl_grand_share'=>$request->bl_grand_share,
                'teletalk_grand_share'=>$request->teletalk_grand_share)
        );
        return redirect()->route('config.index')->with('success',"New Configuration created successfully");
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
        $page_name = "Update Configuration";
        $table_all = DB::table('oem_revenue_configurations')->where('id',$id)->get()->first();
        return view('admin.configuration.config_update',compact('page_name','table_all'));
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
        DB::table('oem_revenue_configurations')
            ->where('id',$id)
            ->update(array('organization_id'=>$request->org_id,
                'btrc_share'=>$request->btrc,
                'gp_share'=>$request->gp_share,
                'airtel_share'=>$request->airtel_share,
                'robi_share'=>$request->robi_share,
                'bl_share'=>$request->bl_share,
                'teletalk_share'=>$request->teletalk_share,
                'discrepancy'=>$request->discrepancy,
                'ait'=>$request->ait,
                'billing_fee'=>$request->billing_fee,
                'partner_share'=>$request->partner_share,
                'vat'=>$request->vat,
                'gp_grand_share'=>$request->gp_grand_share,
                'airtel_grand_share'=>$request->airtel_grand_share,
                'robi_grand_share'=>$request->robi_grand_share,
                'bl_grand_share'=>$request->bl_grand_share,
                'teletalk_grand_share'=>$request->teletalk_grand_share)
        );
        return redirect()->route('config.index')->with('success',"Configuration updated successfully");
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
