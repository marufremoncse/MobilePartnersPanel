<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TargetController extends Controller
{
    public function index(Request $request){
        $page_name = "Projection";
        if($request->sort_select!=null){
            $ara = explode(',',$request->sort_select);
            $table_all =  DB::table('subscriber')->select('organization_id','model', 'device_type', DB::raw("count(model) as count"))
                ->where('organization_id',Auth::user()->organization_id)
                ->groupBy('model')
                ->orderBy($ara[0], $ara[1])->paginate(25)
                ->appends('sort_select',$request->sort_select);
            return view('sales.projection.total_target',compact('table_all','page_name'));
        }else{
            $table_all = DB::table('subscriber')->select('organization_id','model', 'device_type', DB::raw("count(model) as count"))
                ->where('organization_id',Auth::user()->organization_id)
                ->groupBy('model')
                ->paginate(25);
            return view('sales.projection.total_target',compact('table_all','page_name'));
        }
    }


    public function create(){
        $page_name = "New Projection";
        $brand_all = DB::table('handset_details')->where('organization_id',Auth::user()->organization_id)->select('brand')->distinct()->get();
        return view('sales.projection.add_new_target', compact('page_name','brand_all'));
    }

    function store(Request $request)
    {
        DB::table('projections')->insert(
            array('organization_id' => Auth::user()->organization_id,
                'brand' => $request->brand_select,
                'model' => $request->model,
                'projection' => $request->target,
                'lot_number' => $request->lot_number,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id)
        );
        return redirect('/sales/projection')->with('success', "New projection created successfully");
    }
}
