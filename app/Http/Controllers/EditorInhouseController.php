<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use Illuminate\Support\Facades\DB;

class EditorInhouseController extends Controller
{
    public function index(Request $request){
        $items = $request->items ?? 50;
        $all_organizations = Organization::get(['id','organization_name']);
        $organization_id = $request->org ?? 20201;
        $org_name = Organization::select('organization_name')->where('id',$organization_id)->first();
        $page_name = $org_name->organization_name;
        $table_all = DB::table('subscriber')->select(DB::raw('date(registration_date) as date_of_activation'),'device_type',DB::raw('COUNT(first_imei) as count'))
            ->where('organization_id','=',213213)
            ->groupBy(DB::raw('date(registration_date)'),'device_type')
            ->paginate($items)->appends('organization_id', $organization_id);
        if(isset($request->start_time) && isset($request->end_time)){
            $start_time = $request->start_time;
            $end_time = $request->end_time;
            $table_all = DB::table('subscriber')->select(DB::raw('date(registration_date) as date_of_activation'),'device_type',DB::raw('COUNT(first_imei) as count'))
                ->where('organization_id',$organization_id)
                ->where('registration_date','>=',$start_time)
                ->where('registration_date','<=',$end_time)
                ->groupBy(DB::raw('date(registration_date)'),'device_type')
                ->paginate($items)->appends('organization_id', $organization_id);
            return view('editor.editor_inhouse',compact('page_name','items','table_all','all_organizations','organization_id'));
        }
        return view('editor.editor_inhouse',compact('page_name','items','table_all','all_organizations','organization_id'));
    }
    public function activation_details(Request $request){
        $page_name = "Details";
        $items = $request->items ?? 50;
        $day = $request->date;
        $device_type = $request->device_type;
        $organization_id = 20201;
        $table_all = DB::table('subscriber')
                ->where('organization_id',$organization_id)
                ->where('registration_date','>=',$day.' 00:00:00')
                ->where('registration_date','<=',$day.' 23:59:59')
                ->where('device_type',$device_type)
                ->orderBy('registration_date','desc')
                ->paginate($items);
        return view('editor.editor_inhouse_details',compact('page_name','items','table_all'));
    }
    public function mo_search(Request $request){
        $page_name = "MO Search";
        $items = $request->items ?? 50;

        if(isset($request->keyword)){
            $keyword_of_searching = $request->keyword;
            $table_all =  DB::table('inbox')
                ->select('keyword','msisdn','brand','model','first_imei','second_imei','first_imsi','second_imsi','operator','org_mo','created_at')
                ->where(function ($table_all) use ($keyword_of_searching) {
                    $table_all->where('first_imei', 'LIKE', '%' . $keyword_of_searching . '%')
                        ->orWhere('second_imei', 'LIKE', '%' . $keyword_of_searching . '%')
                        ->orWhere('msisdn', 'LIKE', '%' . $keyword_of_searching . '%');
                })
                ->orderBy('created_at','desc')
                ->paginate($items)->appends('keyword',$keyword_of_searching);
            return view('editor.editor_inhouse_search_list',compact('page_name','table_all','items','keyword_of_searching'));
        }
        return view('editor.editor_inhouse_search_list',compact('page_name','items'));
    }
}
