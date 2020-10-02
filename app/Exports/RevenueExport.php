<?php

namespace App\Exports;

use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class RevenueExport implements FromCollection
{

    public $from;
    public $to;

    public function __construct($from,$to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        $this->from.=' 00:00:00';
        $this->to.=' 23:59:59';
        $data_to_be_returned = DB::table('games_revenue_view')->select("*")
            ->where('organization_id',Auth::user()->organization_id)
            ->where('action_time','>=',$this->from)
            ->where('action_time','<=',$this->to)
            ->orderBy('action_time', 'desc')
            ->get();
        return $data_to_be_returned;
    }
}
