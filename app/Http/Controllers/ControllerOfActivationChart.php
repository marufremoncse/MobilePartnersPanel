<?php

namespace App\Http\Controllers;

use function Complex\asec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;

class ControllerOfActivationChart extends Controller
{

    public function getLastThirtyDaysMobileCount(Request $request)
    {
        if ($request->model == "all_models") {
            $all_days = array();
            $start_date = date('Y-m-d', strtotime("-30 days"));
            $d = $start_date;
            $end_date = date('Y-m-d');

            $getCount_smart = array();
            $getCount_feature = array();
            $index = 0 ;
            for ($m = 1; $m <= 30; ++$m) {
                $all_days[$index++] = $d = date('d-M-y', strtotime('+1 day', strtotime($d)));
                $getCount_smart[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = $getCount_feature[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = 0;
            }

            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date','>',$start_date)
                ->where('date','<=',$end_date)
                ->groupBy('date', 'device_type')->orderBy('date')->get();

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
        else {
            $all_days = array();
            $start_date = date('Y-m-d', strtotime("-30 days"));
            $d = $start_date;
            $end_date = date('Y-m-d');

            $getCount_smart = array();
            $getCount_feature = array();
            $index = 0 ;
            for ($m = 1; $m <= 30; ++$m) {
                $all_days[$index++] = $d = date('d-M-y', strtotime('+1 day', strtotime($d)));
                $getCount_smart[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = $getCount_feature[date('Y-m-d', strtotime('+0 day', strtotime($d)))] = 0;
            }

            $data = DB::table('all_activations')->select('device_type', 'date', DB::raw("sum(total) as count"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('date','>',$start_date)
                ->where('date','<=',$end_date)
                ->where('model', $request->model)
                ->groupBy('date', 'device_type')->orderBy('date')->get();

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
    }
}
