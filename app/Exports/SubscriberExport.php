<?php

namespace App\Exports;

use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscriberExport implements FromCollection
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
        $data_to_be_returned = DB::table('subscriber')->select('registration_date','keyword','first_imei','first_imsi',
            'msisdn','brand','model','cell_id','lac_id','device_type','operator','division','district','thana')
            ->where('organization_id',Auth::user()->organization_id)
            ->where('registration_date','>=',$this->from)
            ->where('registration_date','<=',$this->to)
            ->get();
        return $data_to_be_returned;
    }
}
