<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PieChartController extends Controller
{
    public function getYearlyDivisionMobileCount(Request $request){
        if ($request->model == "all_models") {
            $all_division = array("Dhaka"=>"Dhaka","Chittagong"=>"Chittagong",
                                "Rajshahi"=>"Rajshahi","Khulna"=>"Khulna",
                                "Rangpur"=>"Rangpur","Barisal"=>"Barisal",
                                "Mymensingh"=>"Mymensingh","Sylhet"=>"Sylhet","Others"=>"Others");

            $data = DB::table('subscriber')->select('division', DB::raw("count(first_imei) as total"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('device_type','=','smart')
                ->whereYear('registration_date', '=', date('Y'))
                ->groupBy('division')->get();


            $getDhaka = $getChittagong = $getRajshahi = $getKhulna = $getRangpur = $getBarisal = $getMymensingh =  $getSylhet = $getOthers = 0;

            foreach ($data as $row){
                if(strtolower((string)$row->division)=="dhaka")
                    $getDhaka = $row->total;
                else if(strtolower((string)$row->division)=="chittagong")
                    $getChittagong = $row->total;
                else if(strtolower((string)$row->division)=="rajshahi")
                    $getRajshahi = $row->total;
                else if(strtolower((string)$row->division)=="khulna")
                    $getKhulna = $row->total;
                else if(strtolower((string)$row->division)=="rangpur")
                    $getRangpur = $row->total;
                else if(strtolower((string)$row->division)=="barisal")
                    $getBarisal = $row->total;
                else if(strtolower((string)$row->division)=="mymensingh")
                    $getMymensingh = $row->total;
                else if(strtolower((string)$row->division)=="sylhet")
                    $getSylhet = $row->total;
                else{
                    $getOthers = $row->total;
                }
            }

            $chartDataArray = array(
                'all_labels' => $all_division,
                'data_dhaka' => $getDhaka,
                'data_chittagong' => $getChittagong,
                'data_rajshahi' => $getRajshahi,
                'data_khulna' => $getKhulna,
                'data_rangpur' => $getRangpur,
                'data_barisal' => $getBarisal,
                'data_mymensingh' => $getMymensingh,
                'data_sylhet' => $getSylhet,
                'data_others' => $getOthers
            );

            return $chartDataArray;
        }
    }

    public function getPreviousYearlyDivisionMobileCount(Request $request){
        if ($request->model == "all_models") {
            $all_division = array("Dhaka"=>"Dhaka","Chittagong"=>"Chittagong",
                "Rajshahi"=>"Rajshahi","Khulna"=>"Khulna",
                "Rangpur"=>"Rangpur","Barisal"=>"Barisal",
                "Mymensingh"=>"Mymensingh","Sylhet"=>"Sylhet","Others"=>"Others");

            $data = DB::table('subscriber')->select('division', DB::raw("count(first_imei) as total"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('device_type','=','smart')
                ->whereYear('registration_date', '=', date('Y',strtotime("-1 year")))
                ->groupBy('division')->get();


            $getDhaka = $getChittagong = $getRajshahi = $getKhulna = $getRangpur = $getBarisal = $getMymensingh =  $getSylhet = $getOthers = 0;

            foreach ($data as $row){
                if(strtolower((string)$row->division)=="dhaka")
                    $getDhaka = $row->total;
                else if(strtolower((string)$row->division)=="chittagong")
                    $getChittagong = $row->total;
                else if(strtolower((string)$row->division)=="rajshahi")
                    $getRajshahi = $row->total;
                else if(strtolower((string)$row->division)=="khulna")
                    $getKhulna = $row->total;
                else if(strtolower((string)$row->division)=="rangpur")
                    $getRangpur = $row->total;
                else if(strtolower((string)$row->division)=="barisal")
                    $getBarisal = $row->total;
                else if(strtolower((string)$row->division)=="mymensingh")
                    $getMymensingh = $row->total;
                else if(strtolower((string)$row->division)=="sylhet")
                    $getSylhet = $row->total;
                else{
                    $getOthers = $row->total;
                }
            }

            $chartDataArray = array(
                'all_labels' => $all_division,
                'data_dhaka' => $getDhaka,
                'data_chittagong' => $getChittagong,
                'data_rajshahi' => $getRajshahi,
                'data_khulna' => $getKhulna,
                'data_rangpur' => $getRangpur,
                'data_barisal' => $getBarisal,
                'data_mymensingh' => $getMymensingh,
                'data_sylhet' => $getSylhet,
                'data_others' => $getOthers
            );

            return $chartDataArray;
        }
    }

    public function getCurrentMonthDivisionMobileCount(Request $request){
        if ($request->model == "all_models") {
            $all_division = array("Dhaka"=>"Dhaka","Chittagong"=>"Chittagong",
                "Rajshahi"=>"Rajshahi","Khulna"=>"Khulna",
                "Rangpur"=>"Rangpur","Barisal"=>"Barisal",
                "Mymensingh"=>"Mymensingh","Sylhet"=>"Sylhet","Others"=>"Others");

            $data = DB::table('subscriber')->select('division', DB::raw("count(first_imei) as total"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('device_type','=','smart')
                ->whereMonth('registration_date', '=', date('m'))
                ->groupBy('division')->get();


            $getDhaka = $getChittagong = $getRajshahi = $getKhulna = $getRangpur = $getBarisal = $getMymensingh =  $getSylhet = $getOthers = 0;

            foreach ($data as $row){
                if(strtolower((string)$row->division)=="dhaka")
                    $getDhaka = $row->total;
                else if(strtolower((string)$row->division)=="chittagong")
                    $getChittagong = $row->total;
                else if(strtolower((string)$row->division)=="rajshahi")
                    $getRajshahi = $row->total;
                else if(strtolower((string)$row->division)=="khulna")
                    $getKhulna = $row->total;
                else if(strtolower((string)$row->division)=="rangpur")
                    $getRangpur = $row->total;
                else if(strtolower((string)$row->division)=="barisal")
                    $getBarisal = $row->total;
                else if(strtolower((string)$row->division)=="mymensingh")
                    $getMymensingh = $row->total;
                else if(strtolower((string)$row->division)=="sylhet")
                    $getSylhet = $row->total;
                else{
                    $getOthers = $row->total;
                }
            }

            $chartDataArray = array(
                'all_labels' => $all_division,
                'data_dhaka' => $getDhaka,
                'data_chittagong' => $getChittagong,
                'data_rajshahi' => $getRajshahi,
                'data_khulna' => $getKhulna,
                'data_rangpur' => $getRangpur,
                'data_barisal' => $getBarisal,
                'data_mymensingh' => $getMymensingh,
                'data_sylhet' => $getSylhet,
                'data_others' => $getOthers
            );

            return $chartDataArray;
        }
    }

    public function getPreviousMonthDivisionMobileCount(Request $request){
        if ($request->model == "all_models") {
            $all_division = array("Dhaka"=>"Dhaka","Chittagong"=>"Chittagong",
                "Rajshahi"=>"Rajshahi","Khulna"=>"Khulna",
                "Rangpur"=>"Rangpur","Barisal"=>"Barisal",
                "Mymensingh"=>"Mymensingh","Sylhet"=>"Sylhet","Others"=>"Others");

            $d= date('m');

            $data = DB::table('subscriber')->select('division', DB::raw("count(first_imei) as total"))
                ->where('organization_id', Auth::user()->organization_id)
                ->where('device_type','=','smart')
                ->whereMonth('registration_date', '=', ($d-1))
                ->groupBy('division')->get();


            $getDhaka = $getChittagong = $getRajshahi = $getKhulna = $getRangpur = $getBarisal = $getMymensingh =  $getSylhet = $getOthers = 0;

            foreach ($data as $row){
                if(strtolower((string)$row->division)=="dhaka")
                    $getDhaka = $row->total;
                else if(strtolower((string)$row->division)=="chittagong")
                    $getChittagong = $row->total;
                else if(strtolower((string)$row->division)=="rajshahi")
                    $getRajshahi = $row->total;
                else if(strtolower((string)$row->division)=="khulna")
                    $getKhulna = $row->total;
                else if(strtolower((string)$row->division)=="rangpur")
                    $getRangpur = $row->total;
                else if(strtolower((string)$row->division)=="barisal")
                    $getBarisal = $row->total;
                else if(strtolower((string)$row->division)=="mymensingh")
                    $getMymensingh = $row->total;
                else if(strtolower((string)$row->division)=="sylhet")
                    $getSylhet = $row->total;
                else{
                    $getOthers = $row->total;
                }
            }

            $chartDataArray = array(
                'all_labels' => $all_division,
                'data_dhaka' => $getDhaka,
                'data_chittagong' => $getChittagong,
                'data_rajshahi' => $getRajshahi,
                'data_khulna' => $getKhulna,
                'data_rangpur' => $getRangpur,
                'data_barisal' => $getBarisal,
                'data_mymensingh' => $getMymensingh,
                'data_sylhet' => $getSylhet,
                'data_others' => $getOthers
            );

            return $chartDataArray;
        }
    }
}
