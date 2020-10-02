<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\SubscriberExport;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\Console\Input\Input;

class DeviceActivationController extends Controller
{
    public function index()
    {
        $page_name = "Sales Dashboard";
        $all_models = DB::table('subscriber')
            ->where('organization_id', Auth::user()->organization_id)
            ->orderBy('model')
            ->orderBy('registration_date', 'desc')
            ->distinct()->get(['model']);
        return view('sales.device_activation', compact('all_models', 'page_name'));
    }

    public function total_active(Request $request)
    {
        $current_month_activation = DB::table('subscriber')->select(DB::raw("COUNT(first_imei) as count"))
            ->where('organization_id', Auth::user()->organization_id)
            ->whereMonth('registration_date', '=', date('m'))
            ->whereYear('registration_date', '=', date('Y'))
            ->first();
        $todays_activation = DB::table('subscriber')->select(DB::raw("COUNT(first_imei) as count"))
            ->where('organization_id', Auth::user()->organization_id)
            ->where('registration_date', '>=', date('Y-m-d') . ' 00:00:00')
            ->first();
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword) ? $request->keyword : null;
        $sort_select = isset($request->sort_select) ? $request->sort_select : null;
        $start_time = isset($request->start_time) ? $request->start_time : null;
        $end_time = isset($request->end_time) ? $request->end_time : null;
        $page_name = "Total Activation";

        if ($sort_select != null) {
            $ara = explode(',', $sort_select);
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->orderBy($ara[0], $ara[1])->paginate($items)
                ->appends('sort_select', $sort_select)->appends('items', $items);
            return view('sales.statistics_block.total_active', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation', 'current_month_activation'));
        } else if ($keyword_of_searching != null) {
            $page_name = "Search";
            $q = $request->keyword;
            $keyword_of_searching = $request->keyword;

            $table_all = DB::table('subscriber')->where('organization_id', '=', Auth::user()->organization_id)
                ->where(function ($table_all) use ($q) {
                    $table_all->where('first_imei', 'LIKE', '%' . $q . '%')
                        ->orWhere('first_imsi', 'LIKE', '%' . $q . '%')
                        ->orWhere('msisdn', 'LIKE', '%' . $q . '%')
                        ->orWhere('model', 'LIKE', '%' . $q . '%')
                        ->orWhere('device_type', 'LIKE', '%' . $q . '%')
                        ->orWhere('thana', 'LIKE', '%' . $q . '%')
                        ->orWhere('district', 'LIKE', '%' . $q . '%')
                        ->orWhere('division', 'LIKE', '%' . $q . '%')
                        ->orWhere('registration_date', 'LIKE', '%' . $q . '%');
                })
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('keyword', $keyword_of_searching)->appends('items', $items);
            return view('sales.statistics_block.total_active', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation', 'current_month_activation'));
        } else if ($start_time != null && $end_time != null) {
            $start_time = $start_time.' 00:00:00';
            $end_time = $end_time.' 23:59:59';
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('registration_date', '>=', $start_time)
                ->where('registration_date', '<=', $end_time)
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('items', $items)->appends('start_time', $start_time)->appends('end_time', $end_time);
            return view('sales.statistics_block.total_active', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation', 'current_month_activation'));
        } else {
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('items', $items);
            return view('sales.statistics_block.total_active', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation', 'current_month_activation'));
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new SubscriberExport($request->from,$request->to), 'ActivationList ('.$request->from.' - '.$request->to.').xlsx');
    }

    public function total_model(Request $request)
    {
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword) ? $request->keyword : null;
        $sort_select = isset($request->sort_select) ? $request->sort_select : null;
        $page_name = "Model Wise Activation";
        if ($sort_select != null) {
            $ara = explode(',', $sort_select);
            if($ara[0]=='revenue'){
                $table_all = DB::table('subscriber')
                    ->select('model', DB::raw('count(*) as total'))
                    ->where('organization_id', '=', Auth::user()->organization_id)
                    ->groupBy('model')->orderBy((DB::raw('count(*)')), $ara[1])->paginate($items)
                    ->appends('sort_select', $sort_select)->appends('items', $items);
            }
            else{
                $table_all = DB::table('subscriber')
                    ->select('model', DB::raw('count(*) as total'))
                    ->where('organization_id', '=', Auth::user()->organization_id)
                    ->groupBy('model')->orderBy($ara[0], $ara[1])->paginate($items)
                    ->appends('sort_select', $sort_select)->appends('items', $items);
            }
            return view('sales.statistics_block.total_model', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select'));
        } else if ($request->keyword != null) {
            $page_name = "Search";
            $q = $request->keyword;
            $keyword_of_searching = $request->keyword;
            if ($q != null) {
                $table_all = DB::table('subscriber')
                    ->select('model', DB::raw('count(*) as total'))
                    ->where('organization_id', '=', Auth::user()->organization_id)
                    ->where('model', 'LIKE', '%' . $q . '%')
                    ->groupBy('model')
                    ->paginate($items)->appends('keyword', $keyword_of_searching)->appends('items', $items);
                return view('sales.statistics_block.total_model', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select'));
            }
        } else {
            $table_all = DB::table('subscriber')
                ->select('model', DB::raw('count(*) as total'))
                ->where('organization_id', '=', Auth::user()->organization_id)
                ->groupBy('model')
                ->paginate($items)->appends('items', $items);
            return view('sales.statistics_block.total_model', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select'));
        }
    }

    public function total_smart(Request $request)
    {
        $current_month_activation_smart = DB::table('subscriber')->select(DB::raw("COUNT(first_imei) as count"))
            ->where('organization_id', Auth::user()->organization_id)
            ->whereMonth('registration_date', '=', date('m'))
            ->whereYear('registration_date', '=', date('Y'))
            ->where('device_type', '=', 'smart')
            ->first();
        $todays_activation_smart = DB::table('subscriber')->select(DB::raw("COUNT(first_imei) as count"))
            ->where('organization_id', Auth::user()->organization_id)
            ->where('device_type', 'smart')
            ->where('registration_date', '>=', date('Y-m-d') . ' 00:00:00')
            ->first();
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword) ? $request->keyword : null;
        $sort_select = isset($request->sort_select) ? $request->sort_select : null;
        $start_time = isset($request->start_time) ? $request->start_time : null;
        $end_time = isset($request->end_time) ? $request->end_time : null;
        $page_name = "Smart Mobile";
        if ($sort_select != null) {
            $ara = explode(',', $sort_select);
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('device_type', '=', 'smart')
                ->orderBy($ara[0], $ara[1])->paginate($items)
                ->appends('sort_select', $sort_select)->appends('items', $items);
            return view('sales.statistics_block.total_smart', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation_smart', 'current_month_activation_smart'));
        } else if ($request->keyword != null) {
            $page_name = "Search";
            $q = $request->keyword;
            $keyword_of_searching = $request->keyword;
            $table_all = DB::table('subscriber')->where('organization_id', '=', Auth::user()->organization_id)
                ->where('device_type', '=', 'smart')
                ->where(function ($table_all) use ($q) {
                    $table_all->where('first_imei', 'LIKE', '%' . $q . '%')
                        ->orWhere('first_imsi', 'LIKE', '%' . $q . '%')
                        ->orWhere('msisdn', 'LIKE', '%' . $q . '%')
                        ->orWhere('model', 'LIKE', '%' . $q . '%')
                        ->orWhere('device_type', 'LIKE', '%' . $q . '%')
                        ->orWhere('thana', 'LIKE', '%' . $q . '%')
                        ->orWhere('district', 'LIKE', '%' . $q . '%')
                        ->orWhere('division', 'LIKE', '%' . $q . '%')
                        ->orWhere('registration_date', 'LIKE', '%' . $q . '%');
                })
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('items', $items);
            return view('sales.statistics_block.total_smart', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation_smart', 'current_month_activation_smart'));
        } else if ($start_time != null && $end_time != null) {
            $start_time = $start_time.' 00:00:00';
            $end_time = $end_time.' 23:59:59';
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('device_type', '=', 'smart')
                ->where('registration_date', '>=', $start_time)
                ->where('registration_date', '<=', $end_time)
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('items', $items)->appends('start_time', $start_time)->appends('end_time', $end_time);
            return view('sales.statistics_block.total_smart', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation_smart', 'current_month_activation_smart'));
        } else {
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('device_type', '=', 'smart')
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('items', $items);
            return view('sales.statistics_block.total_smart', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation_smart', 'current_month_activation_smart'));
        }
    }

    public function total_feature(Request $request)
    {
        $current_month_activation_feature = DB::table('subscriber')->select(DB::raw("COUNT(first_imei) as count"))
            ->where('organization_id', Auth::user()->organization_id)
            ->whereMonth('registration_date', '=', date('m'))
            ->whereYear('registration_date', '=', date('Y'))
            ->where('device_type', '=', 'feature')
            ->first();
        $todays_activation_feature = DB::table('subscriber')->select(DB::raw("COUNT(first_imei) as count"))
            ->where('organization_id', Auth::user()->organization_id)
            ->where('device_type', 'feature')
            ->where('registration_date', '>=', date('Y-m-d') . ' 00:00:00')
            ->first();
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword) ? $request->keyword : null;
        $sort_select = isset($request->sort_select) ? $request->sort_select : null;
        $start_time = isset($request->start_time) ? $request->start_time : null;
        $end_time = isset($request->end_time) ? $request->end_time : null;
        $page_name = "Feature Mobile";
        if ($sort_select != null) {
            $ara = explode(',', $sort_select);
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('device_type', '=', 'feature')
                ->orderBy($ara[0], $ara[1])->paginate($items)
                ->appends('sort_select', $sort_select)->appends('items', $items);
            return view('sales.statistics_block.total_feature', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation_feature', 'current_month_activation_feature'));
        } else if ($keyword_of_searching != null) {
            $page_name = "Search";
            $q = $request->keyword;
            $keyword_of_searching = $request->keyword;
            $table_all = DB::table('subscriber')->where('organization_id', '=', Auth::user()->organization_id)
                ->where('device_type', '=', 'feature')
                ->where(function ($table_all) use ($q) {
                    $table_all->where('first_imei', 'LIKE', '%' . $q . '%')
                        ->orWhere('first_imsi', 'LIKE', '%' . $q . '%')
                        ->orWhere('msisdn', 'LIKE', '%' . $q . '%')
                        ->orWhere('model', 'LIKE', '%' . $q . '%')
                        ->orWhere('device_type', 'LIKE', '%' . $q . '%')
                        ->orWhere('thana', 'LIKE', '%' . $q . '%')
                        ->orWhere('district', 'LIKE', '%' . $q . '%')
                        ->orWhere('division', 'LIKE', '%' . $q . '%')
                        ->orWhere('registration_date', 'LIKE', '%' . $q . '%');
                })
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('keyword', $keyword_of_searching)->appends('items', $items);
            return view('sales.statistics_block.total_feature', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation_feature', 'current_month_activation_feature'));
        } else if ($start_time != null && $end_time != null) {
            $start_time = $start_time.' 00:00:00';
            $end_time = $end_time.' 23:59:59';
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('device_type', '=', 'feature')
                ->where('registration_date', '>=', $start_time)
                ->where('registration_date', '<=', $end_time)
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('items', $items)->appends('start_time', $start_time)->appends('end_time', $end_time);
            return view('sales.statistics_block.total_feature', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation_feature', 'current_month_activation_feature'));
        } else {
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('device_type', '=', 'feature')
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('items', $items);
            return view('sales.statistics_block.total_feature', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation_feature', 'current_month_activation_feature'));
        }
    }

    public function device_details(Request $request)
    {
        $current_month_activation = DB::table('subscriber')->select(DB::raw("COUNT(first_imei) as count"))
            ->where('organization_id', Auth::user()->organization_id)
            ->where('model', $request->device_model)
            ->whereMonth('registration_date', '=', date('m'))
            ->whereYear('registration_date', '=', date('Y'))
            ->first();
        $todays_activation = DB::table('subscriber')->select(DB::raw("COUNT(first_imei) as count"))
            ->where('organization_id', Auth::user()->organization_id)
            ->where('model', $request->device_model)
            ->where('registration_date', '>=', date('Y-m-d') . ' 00:00:00')
            ->first();
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword) ? $request->keyword : null;
        $sort_select = isset($request->sort_select) ? $request->sort_select : null;
        $start_time = isset($request->start_time) ? $request->start_time : null;
        $end_time = isset($request->end_time) ? $request->end_time : null;
        $page_name = $request->device_model . " Details";
        if ($sort_select != null) {
            $ara = explode(',', $sort_select);
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('model', '=', $request->device_model)
                ->orderBy($ara[0], $ara[1])->paginate($items)
                ->appends('sort_select', $sort_select)->appends('items', $items);
            return view('sales.statistics_block.total_active', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation', 'current_month_activation'));
        } else if ($start_time != null && $end_time != null) {
            $start_time = $start_time.' 00:00:00';
            $end_time = $end_time.' 23:59:59';
            $table_all = DB::table('subscriber')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('model', '=', $request->device_model)
                ->where('registration_date', '>=', $start_time)
                ->where('registration_date', '<=', $end_time)
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('items', $items)->appends('start_time', $start_time)->appends('end_time', $end_time);
            return view('sales.statistics_block.total_smart', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation', 'current_month_activation'));
        } else {
            $table_all = DB::table('subscriber')
                ->where('organization_id', '=', Auth::user()->organization_id)
                ->where('model', '=', $request->device_model)
                ->orderBy('registration_date', 'desc')
                ->paginate($items)->appends('items', $items);
            return view('sales.statistics_block.total_active', compact('table_all', 'page_name', 'items', 'keyword_of_searching', 'sort_select', 'todays_activation', 'current_month_activation'));
        }
    }

    public function downloads(Request $request)
    {
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword)? $request->keyword : null;
        $sort_select = isset($request->sort_select)? $request->sort_select : null;
        $page_name = "Monthly Activation List";
        $oem_name = DB::table('game_details')->where('organization_id', Auth::user()->organization_id)->get('oem')->first();

        if (isset($sort_select) && $sort_select != null) {
            $ara = explode(',', $request->sort_select);
            $table_all = DB::table('year_wise_month_wise_activations')
                ->where('organization_id', Auth::user()->organization_id)
                ->orderBy($ara[0], $ara[1])->paginate($items)
                ->appends('sort_select', $sort_select)->appends('items',$items);
            return view('sales.statistics_block.downloads', compact('table_all', 'page_name',  'oem_name', 'keyword_of_searching','sort_select','items'));
        } else if (isset($request->keyword) && $request->keyword != null) {
            $page_name = "Search";
            $q = $request->keyword;
            $keyword_of_searching = $request->keyword;
            if ($q != null) {
                $table_all = DB::table('year_wise_month_wise_activations')->where('organization_id', '=', Auth::user()->organization_id)
                    ->where(function ($table_all) use ($q) {
                        $table_all->Where('year', 'LIKE', '%' . $q . '%')
                            ->orWhere('month', 'LIKE', '%' . $q . '%')
                            ->orWhere('cnt', 'LIKE', '%' . $q . '%');
                    })
                    ->orderBy('year','desc')
                    ->orderBy('month','desc')
                    ->paginate($items)->appends('keyword', $keyword_of_searching)->appends('items',$items);
                return view('sales.statistics_block.downloads', compact('table_all', 'page_name',  'oem_name', 'keyword_of_searching','sort_select','items'));
            }
        } else {
            $table_all = DB::table('year_wise_month_wise_activations')
                ->where('organization_id', Auth::user()->organization_id)
                ->orderBy('year','desc')
                ->orderBy('month','desc')
                ->paginate($items)->appends('items',$items);
            return view('sales.statistics_block.downloads', compact('table_all', 'page_name',  'oem_name', 'keyword_of_searching','sort_select','items'));

        }
    }
}
