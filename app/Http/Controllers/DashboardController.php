<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $page_name = "Dashboard";
        $all_models_smart = DB::table('subscriber')
            ->where('organization_id',Auth::user()->organization_id)
            ->where('device_type','smart')
            ->orderBy('model')
            ->distinct()->get(['model','brand']);
        $all_models_feature = DB::table('subscriber')
            ->where('organization_id',Auth::user()->organization_id)
            ->where('device_type','feature')
            ->orderBy('model')
            ->distinct()->get(['model','brand']);
        return view('dashboard',compact('all_models_smart','all_models_feature','page_name'));
    }
}
