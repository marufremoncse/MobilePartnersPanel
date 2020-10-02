<?php

namespace App\Http\Controllers;

use App\Exports\RevenueExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class GamesRevenueController extends Controller
{
    public function index()
    {
        $page_name = "Games Revenue";
        return view('revenue.games_revenue', compact('page_name'));
    }

    public function revenue_report(Request $request)
    {
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword)? $request->keyword : null;
        $sort_select = isset($request->sort_select)? $request->sort_select : null;
        $start_time = isset($request->start_time) ? $request->start_time : null;
        $end_time = isset($request->end_time) ? $request->end_time : null;
        $todays_revenue = DB::table('month_wise_day_wise_revenue')
                    ->select('day_wise_revenue')
                    ->where('organization_id', Auth::user()->organization_id)
                    ->where('year',date('Y'))
                    ->where('month',date('m'))
                    ->where('day',date('d'))->first();
        $share_details = DB::table('oem_revenue_configurations')->where('organization_id', Auth::user()->organization_id)->get()->first();
        $oem_name = DB::table('game_details')->where('organization_id', Auth::user()->organization_id)->get('oem')->first();
        $page_name = "Games Revenue";
        if (isset($sort_select) && $sort_select != null) {
            $ara = explode(',', $sort_select);
            $table_all = DB::table('games_revenue')
                ->where('organization_id', Auth::user()->organization_id)
                ->orderBy($ara[0], $ara[1])->paginate($items)
                ->appends('sort_select', $sort_select)->appends('items',$items);
            return view('revenue.revenue_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','todays_revenue','sort_select','items'));
        } else if (isset($keyword_of_searching) && $keyword_of_searching != null) {
            $page_name = "Search";
            $q = $request->keyword;
            $keyword_of_searching = $request->keyword;
            if ($q != null) {
                $table_all = DB::table('games_revenue')->where('organization_id', '=', Auth::user()->organization_id)
                    ->where(function ($table_all) use ($q) {
                        $table_all->where('keyword', 'LIKE', '%' . $q . '%')
                            ->orWhere('game_name', 'LIKE', '%' . $q . '%')
                            ->orWhere('imei', 'LIKE', '%' . $q . '%')
                            ->orWhere('msisdn', 'LIKE', '%' . $q . '%')
                            ->orWhere('operator', 'LIKE', '%' . $q . '%')
                            ->orWhere('brand_name', 'LIKE', '%' . $q . '%')
                            ->orWhere('model', 'LIKE', '%' . $q . '%')
                            ->orWhere('action_time', 'LIKE', '%' . $q . '%');
                    })
                    ->orderBy('action_time', 'desc')
                    ->paginate($items)->appends('keyword', $keyword_of_searching)->appends('items',$items);
                return view('revenue.revenue_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','todays_revenue','sort_select','items'));
            }
        } else if ($start_time != null && $end_time != null) {
            $start_time = $start_time.' 00:00:00';
            $end_time = $end_time.' 23:59:59';
            $table_all = DB::table('games_revenue')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('action_time', '>=', $start_time)
                ->where('action_time', '<=', $end_time)
                ->orderBy('action_time', 'desc')
                ->paginate($items)->appends('items', $items)->appends('start_time', $start_time)->appends('end_time', $end_time);
            return view('revenue.revenue_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','todays_revenue','sort_select','items'));
        } else {
            $table_all = DB::table('games_revenue')->where('organization_id', Auth::user()->organization_id)
                ->orderBy('action_time', 'desc')->paginate($items)->appends('items', $items);
            return view('revenue.revenue_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','todays_revenue','sort_select','items'));
        }
    }

    public function total_game(Request $request)
    {
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword)? $request->keyword : null;
        $sort_select = isset($request->sort_select)? $request->sort_select : null;
        $page_name = "Game Wise Revenue";
        $oem_name = DB::table('game_details')->where('organization_id', Auth::user()->organization_id)->get('oem')->first();
        if (isset($sort_select) && $sort_select != null) {
            $ara = explode(',', $request->sort_select);
            $table_all = DB::table('game_wise_revenue')
                ->where('organization_id', Auth::user()->organization_id)
                ->orderBy($ara[0], $ara[1])->paginate($items)
                ->appends('sort_select', $request->sort_select)->appends('items',$items);
            return view('revenue.total_games', compact('table_all', 'page_name', 'oem_name', 'keyword_of_searching','sort_select','items'));
        } else if (isset($keyword_of_searching) && $keyword_of_searching != null) {
            $page_name = "Search";
            $q = $request->keyword;
            $keyword_of_searching = $request->keyword;
            if ($q != null) {
                $table_all = DB::table('game_wise_revenue')->where('organization_id', '=', Auth::user()->organization_id)
                    ->where(function ($table_all) use ($q) {
                        $table_all->Where('monthly_revenue', 'LIKE', '%' . $q . '%')
                            ->orWhere('game_name', 'LIKE', '%' . $q . '%');
                    })
                    ->paginate($items)->appends('keyword', $keyword_of_searching)->appends('items',$items);
                return view('revenue.total_games', compact('table_all', 'page_name', 'oem_name', 'keyword_of_searching','sort_select','items'));
            }
        } else {
            $table_all = DB::table('game_wise_revenue')
                ->where('organization_id', Auth::user()->organization_id)
                ->paginate($items)->appends('items',$items);
            return view('revenue.total_games', compact('table_all', 'page_name', 'oem_name', 'keyword_of_searching','sort_select','items'));
        }
    }

    public function total_game_each_details(Request $request)
    {
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword)? $request->keyword : null;
        $sort_select = isset($request->sort_select)? $request->sort_select : null;
        $start_time = isset($request->start_time) ? $request->start_time : null;
        $end_time = isset($request->end_time) ? $request->end_time : null;
        $page_name = $request->details;
        $share_details = DB::table('oem_revenue_configurations')->where('organization_id', Auth::user()->organization_id)->get()->first();
        $oem_name = DB::table('game_details')->where('organization_id', Auth::user()->organization_id)->get('oem')->first();
        if (isset($sort_select) && $sort_select != null) {
            $ara = explode(',', $sort_select);
            $table_all = DB::table('games_revenue')
                ->where('organization_id', '=', Auth::user()->organization_id)
                ->where('game_name', '=', $request->details)
                ->orderBy($ara[0], $ara[1])->paginate($items)
                ->appends('sort_select', $sort_select)->appends('items',$items);
            return view('revenue.total_games_each_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','sort_select','items'));
        } else if (isset($request->keyword) && $request->keyword != null) {
            $page_name = "Search";
            $q = $request->keyword;
            $keyword_of_searching = $request->keyword;
            if ($q != null) {
                $table_all = DB::table('games_revenue')
                    ->where('organization_id', '=', Auth::user()->organization_id)
                    ->where('game_name', '=', $request->details)
                    ->where(function ($table_all) use ($q) {
                        $table_all->where('keyword', 'LIKE', '%' . $q . '%')
                            ->orWhere('imei', 'LIKE', '%' . $q . '%')
                            ->orWhere('msisdn', 'LIKE', '%' . $q . '%')
                            ->orWhere('operator', 'LIKE', '%' . $q . '%')
                            ->orWhere('brand_name', 'LIKE', '%' . $q . '%')
                            ->orWhere('model', 'LIKE', '%' . $q . '%')
                            ->orWhere('action_time', 'LIKE', '%' . $q . '%');
                    })
                    ->orderBy('action_time', 'desc')
                    ->paginate($items)->appends('keyword', $keyword_of_searching)->appends('items',$items);
                return view('revenue.total_games_each_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','sort_select','items'));
            }
        } else if ($start_time != null && $end_time != null) {
            $start_time = $start_time.' 00:00:00';
            $end_time = $end_time.' 23:59:59';
            $table_all = DB::table('games_revenue')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('game_name', '=', $request->details)
                ->where('action_time', '>=', $start_time)
                ->where('action_time', '<=', $end_time)
                ->orderBy('action_time', 'desc')
                ->paginate($items)->appends('items', $items)->appends('start_time', $start_time)->appends('end_time', $end_time);
            return view('revenue.total_games_each_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','sort_select','items'));
        } else {
            $table_all = DB::table('games_revenue')
                ->where('organization_id', Auth::user()->organization_id)
                ->where('game_name', '=', $request->details)
                ->orderBy('action_time', 'desc')
                ->paginate($items)->appends('items',$items);
            return view('revenue.total_games_each_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','sort_select','items'));
        }
    }

    public function total_revenue(Request $request)
    {
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword)? $request->keyword : null;
        $sort_select = isset($request->sort_select)? $request->sort_select : null;
        $page_name = "Month Wise Revenue";
        $oem_name = DB::table('game_details')->where('organization_id', Auth::user()->organization_id)->get('oem')->first();

        if (isset($sort_select) && $sort_select != null) {
            $ara = explode(',', $request->sort_select);
            $table_all = DB::table('month_wise_revenue')
                ->where('organization_id', Auth::user()->organization_id)
                ->orderBy($ara[0], $ara[1])->paginate($items)
                ->appends('sort_select', $sort_select)->appends('items',$items);
            return view('revenue.total_revenue', compact('table_all', 'page_name',  'oem_name', 'keyword_of_searching','sort_select','items'));
        } else if (isset($request->keyword) && $request->keyword != null) {
            $page_name = "Search";
            $q = $request->keyword;
            $keyword_of_searching = $request->keyword;
            if ($q != null) {
                $table_all = DB::table('month_wise_revenue')->where('organization_id', '=', Auth::user()->organization_id)
                    ->where(function ($table_all) use ($q) {
                        $table_all->Where('year', 'LIKE', '%' . $q . '%')
                            ->orWhere('month', 'LIKE', '%' . $q . '%')
                            ->orWhere('month_wise_revenue', 'LIKE', '%' . $q . '%');
                    })
                    ->paginate($items)->appends('keyword', $keyword_of_searching)->appends('items',$items);
                return view('revenue.total_revenue', compact('table_all', 'page_name',  'oem_name', 'keyword_of_searching','sort_select','items'));
            }
        } else {
            $table_all = DB::table('month_wise_revenue')
                ->where('organization_id', Auth::user()->organization_id)
                ->paginate($items)->appends('items',$items);
            return view('revenue.total_revenue', compact('table_all', 'page_name',  'oem_name', 'keyword_of_searching','sort_select','items'));

        }
    }

    public function total_revenue_each_details(Request $request)
    {
        $items = $request->items ?? 50;
        $keyword_of_searching = isset($request->keyword)? $request->keyword : null;
        $sort_select = isset($request->sort_select)? $request->sort_select : null;
        $page_name = date("F", mktime(0, 0, 0, $request->month, 10)) . '-' . $request->year . " Details";
        $request_month = $request->month;
        $request_year = $request->year;
        $share_details = DB::table('oem_revenue_configurations')->where('organization_id', Auth::user()->organization_id)->get()->first();
        $oem_name = DB::table('game_details')->where('organization_id', Auth::user()->organization_id)->get('oem')->first();
        if (isset($sort_select) && $sort_select != null) {
            $ara = explode(',', $sort_select);
            $table_all = DB::table('games_revenue')
                ->where('organization_id', '=', Auth::user()->organization_id)
                ->where(DB::raw('month(action_time)'), '=', $request->month)
                ->where(DB::raw('year(action_time)'), '=', $request->year)
                ->orderBy($ara[0], $ara[1])->paginate($items)
                ->appends('sort_select', $request->sort_select)->appends('items',$items);
            return view('revenue.total_revenue_each_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','sort_select','items', 'request_month', 'request_year'));
        } else if (isset($request->keyword) && $request->keyword != null) {
            $page_name = "Search";
            $q = $request->keyword;
            $keyword_of_searching = $request->keyword;
            if ($q != null) {
                $table_all = DB::table('games_revenue')
                    ->where('organization_id', '=', Auth::user()->organization_id)
                    ->where(DB::raw('month(action_time)'), '=', $request->month)
                    ->where(DB::raw('year(action_time)'), '=', $request->year)
                    ->where(function ($table_all) use ($q) {
                        $table_all->where('keyword', 'LIKE', '%' . $q . '%')
                            ->orWhere('game_name', 'LIKE', '%' . $q . '%')
                            ->orWhere('imei', 'LIKE', '%' . $q . '%')
                            ->orWhere('msisdn', 'LIKE', '%' . $q . '%')
                            ->orWhere('operator', 'LIKE', '%' . $q . '%')
                            ->orWhere('brand_name', 'LIKE', '%' . $q . '%')
                            ->orWhere('model', 'LIKE', '%' . $q . '%')
                            ->orWhere('action_time', 'LIKE', '%' . $q . '%');
                    })
                    ->orderBy('action_time', 'desc')
                    ->paginate($items)->appends('keyword', $keyword_of_searching)->appends('items',$items);
                return view('revenue.total_revenue_each_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','sort_select','items', 'request_month', 'request_year'));
            }
        } else {
            $table_all = DB::table('games_revenue')
                ->where('organization_id', Auth::user()->organization_id)
                ->where(DB::raw('month(action_time)'), '=', $request->month)
                ->where(DB::raw('year(action_time)'), '=', $request->year)
                ->orderBy('action_time', 'desc')
                ->paginate($items)->appends('items',$items);
            return view('revenue.total_revenue_each_details', compact('table_all', 'page_name', 'share_details', 'oem_name', 'keyword_of_searching','sort_select','items', 'request_month', 'request_year'));
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new RevenueExport($request->from,$request->to), 'RevenueList ('.$request->from.' - '.$request->to.').xlsx');
    }
}
