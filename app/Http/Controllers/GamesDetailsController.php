<?php

namespace App\Http\Controllers;

use App\Game_detail;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class GamesDetailsController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $page_name = "Games Details";
        $table_all = Game_detail::orderBy('id','desc')->get();
        return view('admin.games_details.games_details_manage',compact('page_name','table_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        $page_name = "New Game Details";
        $org_all = Organization::get(['id','organization_name']);
        $game_provider = Game_detail::groupBy('game_provider')->get();
        return view('admin.games_details.games_details_create',compact('page_name','org_all','game_provider'));
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'keyword'=>'required',
        ],[
            'keyword.required'=>"Keyword field is required",
        ]);

        $game_deatils = new Game_detail();
        $oem_name =  Organization::where('id',$request->org_id)->get('organization_name')->first();
        $game_deatils->organization_id = $request->org_id;
        $game_deatils->oem = $oem_name->organization_name;
        $game_deatils->brand = $request->brand;
        $game_deatils->keyword = $request->keyword;
        $game_deatils->sub_keyword = $request->sub_keyword;
        $game_deatils->game_provider = $request->game_provider;
        $game_deatils->device_type = $request->device_type;
        $game_deatils->save();

        return redirect()->route('games-details.index')->with('success',"New Game Details created successfully");
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
     * @param
     */
    public function edit($id)
    {
        $page_name = "Update Game Details";
        $table_all = Game_detail::find($id);
        $org_all = Organization::get(['id','organization_name']);
        $game_provider = Game_detail::groupBy('game_provider')->get();
        return view('admin.games_details.games_details_update',compact('page_name','table_all','org_all','game_provider'));
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
            'keyword'=>'required',
        ],[
            'keyword.required'=>"Keyword field is required",
        ]);

        $game_deatils = Game_detail::find($id);
        $oem_name =  Organization::where('id',$request->org_id)->get('organization_name')->first();
        $game_deatils->organization_id = $request->org_id;
        $game_deatils->oem = $oem_name->organization_name;
        $game_deatils->brand = $request->brand;
        $game_deatils->keyword = $request->keyword;
        $game_deatils->sub_keyword = $request->sub_keyword;
        $game_deatils->game_provider = $request->game_provider;
        $game_deatils->device_type = $request->device_type;
        $game_deatils->save();
        return redirect()->route('games-details.index')->with('success',"Game Details updated successfully");
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
