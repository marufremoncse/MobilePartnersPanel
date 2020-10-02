<?php

namespace App\Http\Controllers;

use function Complex\asec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;

class ActivationChartController extends Controller
{
    public function getTwentyFourMobileCount(Request $request)
    {
        $all_hours = array();
        $getHourlyCount_smart = array();
        $getHourlyCount_feature = array();

        $date = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
        $d = $date->format('M-d H:00');
        $d = date('M-d H:00', strtotime('-1 day', strtotime($d)));
        for ($m = 1; $m <= 24; $m++) {
            $index = date('H', strtotime('+1 hour', strtotime($d)));
            $all_hours[$index] = $d = date('M-d H:00', strtotime('+1 hour', strtotime($d)));
            $getHourlyCount_smart[(int)date('H', strtotime('+0 hour', strtotime($d)))] = $getHourlyCount_feature[(int)date('H', strtotime('+0 hour', strtotime($d)))] = 0;
        }

        if ($request->model == "all_models") {
            $data = DB::table('last_24_hours')->select('device_type', 'hour', DB::raw("SUM(cnt) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->groupBy('hour', 'device_type')->orderBy('day')->orderBy('hour')->get();
        } else {
            $data = DB::table('last_24_hours')->select('device_type', 'hour', DB::raw("SUM(cnt) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('model', $request->model)
                ->groupBy('hour', 'device_type')->orderBy('day')->orderBy('hour')->get();
        }

        foreach ($data as $row) {
            if ($row->device_type == 'smart')
                $getHourlyCount_smart[$row->hour] = (int)$row->count;
            else
                $getHourlyCount_feature[$row->hour] = (int)$row->count;
        }

        $new_all_hours = array();
        $new_getHourlyCount_smart = array();
        $new_getHourlyCount_feature = array();
        $i = 0;
        foreach ($all_hours as $hours) {
            $new_all_hours[$i++] = $hours;
        }
        $i = 0;
        foreach ($getHourlyCount_smart as $smart) {
            $new_getHourlyCount_smart[$i++] = $smart;
        }
        $i = 0;
        foreach ($getHourlyCount_feature as $feature) {
            $new_getHourlyCount_feature[$i++] = $feature;
        }

        $chartDataArray = array(
            'all_labels' => $new_all_hours,
            'all_data_smart' => $new_getHourlyCount_smart,
            'all_data_feature' => $new_getHourlyCount_feature
        );
        return $chartDataArray;
    }

    public function getLastSevenDaysMobileCount(Request $request)
    {
        $all_days = array();
        $start_date = date('Y-m-d', strtotime("-7 days"));
        $d = $start_date;
        $end_date = date('Y-m-d');

        $getCount_smart = array();
        $getCount_feature = array();
        $index = 0;
        for ($m = 1; $m <= 7; ++$m) {
            $all_days[$index++] = $d = date('d-M-y', strtotime('+1 day', strtotime($d)));
            $getCount_smart[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = $getCount_feature[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = 0;
        }

        if ($request->model == "all_models") {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>', $start_date)
                ->where('date', '<=', $end_date)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        } else {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>', $start_date)
                ->where('date', '<=', $end_date)
                ->where('model', $request->model)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        }

        foreach ($data as $row) {
            if ($row->device_type == 'smart')
                $getCount_smart[$row->date] = (int)$row->count;
            else
                $getCount_feature[$row->date] = (int)$row->count;
        }

        $chartDataArray = array(
            'all_labels' => $all_days,
            'all_data_smart' => $getCount_smart,
            'all_data_feature' => $getCount_feature,
        );
        return $chartDataArray;
    }

    public function getLastThirtyDaysMobileCount(Request $request)
    {
        $all_days = array();
        $start_date = date('Y-m-d', strtotime("-30 days"));
        $d = $start_date;
        $end_date = date('Y-m-d');

        $getCount_smart = array();
        $getCount_feature = array();
        $index = 0;
        for ($m = 1; $m <= 30; ++$m) {
            $all_days[$index++] = $d = date('d-M-y', strtotime('+1 day', strtotime($d)));
            $getCount_smart[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = $getCount_feature[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = 0;
        }

        if ($request->model == "all_models") {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>', $start_date)
                ->where('date', '<=', $end_date)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        } else {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>', $start_date)
                ->where('date', '<=', $end_date)
                ->where('model', $request->model)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        }
        foreach ($data as $row) {
            if ($row->device_type == 'smart')
                $getCount_smart[$row->date] = (int)$row->count;
            else
                $getCount_feature[$row->date] = (int)$row->count;
        }

        $chartDataArray = array(
            'all_labels' => $all_days,
            'all_data_smart' => $getCount_smart,
            'all_data_feature' => $getCount_feature,
        );
        return $chartDataArray;
    }

    public function getCurrentWeekMobileCount(Request $request)
    {
        $all_days = array();
        $start_date = strtotime("today");
        $start_date = date('Y-m-d', strtotime("last saturday midnight", $start_date));
        $d = $start_date;
        $end_date = date('Y-m-d', strtotime($start_date . "+7 days"));

        $getCount_smart = array();
        $getCount_feature = array();
        $index = 0;
        for ($m = 1; $m <= 7; ++$m) {
            $all_days[$index++] = $d = date('d-M-y', strtotime('+1 day', strtotime($d)));
            $getCount_smart[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = $getCount_feature[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = 0;
        }

        if ($request->model == "all_models") {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>', $start_date)
                ->where('date', '<=', $end_date)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        } else {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>', $start_date)
                ->where('date', '<=', $end_date)
                ->where('model', $request->model)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        }
        foreach ($data as $row) {
            if ($row->device_type == 'smart')
                $getCount_smart[$row->date] = (int)$row->count;
            else
                $getCount_feature[$row->date] = (int)$row->count;
        }

        $chartDataArray = array(
            'all_labels' => $all_days,
            'all_data_smart' => $getCount_smart,
            'all_data_feature' => $getCount_feature,
        );
        return $chartDataArray;
    }

    public function getPreviousWeekMobileCount(Request $request)
    {
        $all_days = array();
        $start_date = strtotime("-1 week ");
        $start_date = date('Y-m-d', strtotime("last saturday midnight", $start_date));
        $d = $start_date;
        $end_date = date('Y-m-d', strtotime($start_date . "+7 days"));

        $getCount_smart = array();
        $getCount_feature = array();
        $index = 0;
        for ($m = 1; $m <= 7; ++$m) {
            $all_days[$index++] = $d = date('d-M-y', strtotime('+1 day', strtotime($d)));
            $getCount_smart[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = $getCount_feature[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = 0;
        }

        if ($request->model == "all_models") {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>', $start_date)
                ->where('date', '<=', $end_date)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        } else {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>', $start_date)
                ->where('date', '<=', $end_date)
                ->where('model', $request->model)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        }
        foreach ($data as $row) {
            if ($row->device_type == 'smart')
                $getCount_smart[$row->date] = (int)$row->count;
            else
                $getCount_feature[$row->date] = (int)$row->count;
        }

        $chartDataArray = array(
            'all_labels' => $all_days,
            'all_data_smart' => $getCount_smart,
            'all_data_feature' => $getCount_feature,
        );
        return $chartDataArray;
    }

    public function getCurrentMonthMobileCount(Request $request)
    {
        $all_days = array();
        $start_date = date('Y-m-d', strtotime('first day of this month'));
        $d = $start_date;
        $end_date = date('Y-m-d', strtotime('last day of this month'));
        $for_loop_indexing = date('d', strtotime('last day of this month'));

        $getCount_smart = array();
        $getCount_feature = array();
        $index = 0;
        $all_days[$index] = $d = date('d-M-y', strtotime($d));
        $getCount_smart[date('Y-m-d', strtotime($d))] = $getCount_feature[date('Y-m-d', strtotime($d))] = 0;
        for ($m = 1; $m < $for_loop_indexing; ++$m) {
            $all_days[++$index] = $d = date('d-M-y', strtotime('+1 day', strtotime($d)));
            $getCount_smart[date('Y-m-d', strtotime($d))] = $getCount_feature[date('Y-m-d', strtotime($d))] = 0;
        }

        if ($request->model == "all_models") {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        } else {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->where('model', $request->model)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        }

        foreach ($data as $row) {
            if ($row->device_type == 'smart')
                $getCount_smart[$row->date] = (int)$row->count;
            else
                $getCount_feature[$row->date] = (int)$row->count;
        }

        $chartDataArray = array(
            'all_labels' => $all_days,
            'all_data_smart' => $getCount_smart,
            'all_data_feature' => $getCount_feature,
        );
        return $chartDataArray;
    }

    public function getPreviousMonthMobileCount(Request $request)
    {
        $all_days = array();
        $start_date = date('Y-m-d', strtotime('first day of last month'));
        $d = $start_date;
        $end_date = date('Y-m-d', strtotime('last day of last month'));
        $for_loop_indexing = date('d', strtotime('last day of last month'));

        $getCount_smart = array();
        $getCount_feature = array();
        $index = 0;
        $all_days[$index] = $d = date('d-M-y', strtotime($d));
        $getCount_smart[date('Y-m-d', strtotime($d))] = $getCount_feature[date('Y-m-d', strtotime($d))] = 0;
        for ($m = 1; $m < $for_loop_indexing; ++$m) {
            $all_days[++$index] = $d = date('d-M-y', strtotime('+1 day', strtotime($d)));
            $getCount_smart[date('Y-m-d', strtotime($d))] = $getCount_feature[date('Y-m-d', strtotime($d))] = 0;
        }

        if ($request->model == "all_models") {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        } else {
            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->where('model', $request->model)
                ->groupBy('date', 'device_type')->orderBy('date')->get();
        }

        foreach ($data as $row) {
            if ($row->device_type == 'smart')
                $getCount_smart[$row->date] = (int)$row->count;
            else
                $getCount_feature[$row->date] = (int)$row->count;
        }

        $chartDataArray = array(
            'all_labels' => $all_days,
            'all_data_smart' => $getCount_smart,
            'all_data_feature' => $getCount_feature,
        );
        return $chartDataArray;
    }

    public function getYearlyMobileCount(Request $request)
    {
        $all_month = array();
        $getMonthlyCount_smart = array();
        $getMonthlyCount_feature = array();

        for ($m = 1; $m <= 12; ++$m) {
            $all_month[$m] = date('F', mktime(0, 0, 0, $m, 1));
            $getMonthlyCount_smart[$m] = "0";
            $getMonthlyCount_feature[$m] = "0";
        }
        if ($request->model == "all_models") {
            $data = DB::table('current_years_activations')->select('device_type', 'month', DB::raw("SUM(cnt) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->groupBy('month', 'device_type')->orderBy('month')->get();

            foreach ($data as $row) {
                if ($row->device_type == 'smart')
                    $getMonthlyCount_smart[$row->month] = (string)$row->count;
                else
                    $getMonthlyCount_feature[$row->month] = (string)$row->count;
            }
        } else {
            $data = DB::table('current_years_activations')->select('device_type', 'month', DB::raw("SUM(cnt) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('model', $request->model)
                ->groupBy('month', 'device_type')->orderBy('month')->get();

            foreach ($data as $row)
                $getMonthlyCount_smart[$row->month] = (int)$row->count;
        }

        $chartDataArray = array(
            'all_labels' => $all_month,
            'all_data_smart' => $getMonthlyCount_smart,
            'all_data_feature' => $getMonthlyCount_feature
        );

        return $chartDataArray;
    }

    public function getPreviousYearlyMobileCount(Request $request)
    {
        $all_month = array();
        $getMonthlyCount_smart = array();
        $getMonthlyCount_feature = array();

        for ($m = 1; $m <= 12; ++$m) {
            $all_month[$m] = date('F', mktime(0, 0, 0, $m, 1));
            $getMonthlyCount_smart[$m] = "0";
            $getMonthlyCount_feature[$m] = "0";
        }
        if ($request->model == "all_models") {
            $data = DB::table('previous_years_activations')->select('device_type', 'month', DB::raw("SUM(cnt) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->groupBy('month', 'device_type')->orderBy('month')->get();

            foreach ($data as $row) {
                if ($row->device_type == 'smart')
                    $getMonthlyCount_smart[$row->month] = $row->count;
                else
                    $getMonthlyCount_feature[$row->month] = $row->count;
            }
        } else {
            $data = DB::table('previous_years_activations')->select('device_type', 'month', DB::raw("SUM(cnt) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('model', $request->model)
                ->groupBy('month', 'device_type')->orderBy('month')->get();

            foreach ($data as $row)
                $getMonthlyCount_smart[$row->month] = (int)$row->count;
        }

        $chartDataArray = array(
            'all_labels' => $all_month,
            'all_data_smart' => $getMonthlyCount_smart,
            'all_data_feature' => $getMonthlyCount_feature
        );
        return $chartDataArray;
    }
}
