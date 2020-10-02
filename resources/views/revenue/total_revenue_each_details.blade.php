@extends('admin.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->

    <div id="app">
        <section class="content-header">
            <h1>
                <i class="fa fa-indent" aria-hidden="true"></i>  {{$page_name}}
                <small></small>
            </h1>
            <div class="more_info"></div>
            <!-- breadcrumb start -->
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li> {{$page_name}}</li>
            </ol>
            <!-- breadcrumb end -->
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            @if($message = Session::get('success'))
                                <div class="alert alert-success">
                                    {{$message}}
                                </div>
                            @endif

                            <div class="pull-right">
                                <form action="{{url('/revenue/total-revenue/'.$request_month.'/'.$request_year)}}" method="post" id="active_search">
                                    @csrf
                                    {{method_field('get')}}
                                    <div class="btn-group pull-right">
                                        <button type="Submit" class="btn btn-flat btn-primary">
                                            <i class="fa  fa-search"></i><span class="hidden-xs"> Search</span>
                                        </button>
                                    </div>
                                    <div class="btn-group pull-right">
                                        <div class="form-group">
                                            <input type="text" name="keyword" class="form-control"
                                                   placeholder="Search" value="">
                                        </div>
                                    </div>
                                </form>
                            </div>
                                @if(isset($keyword_of_searching))
                                    <p class="pull-left alert alert-success">Showing results for <b
                                                class="bg-red">{{$keyword_of_searching}}</b></p>
                            @endif
                            <!-- /.box-tools -->
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="calculation_table_modal" role="dialog">
                            <div class="modal-dialog" style="width: 70%;">

                                <!-- Modal content-->
                                <div class="modal-content" style="width: 100%;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            &times;
                                        </button>
                                        <h4 class="modal-title"><b>{{$oem_name->oem}}</b> Revenue
                                            Calculation Details</h4>
                                    </div>
                                    <div class="modal-body" style="width: 100%;">
                                        <div class="rTable">
                                            <div class="rTableRow">
                                                <div class="rTableHead" style="width: 14%">Grameenphone</div>
                                                <div class="rTableHead">End User</div>
                                                <div class="rTableHead">
                                                    {{$share_details->btrc_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->gp_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->discrepancy*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->ait*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->billing_fee*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->partner_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->vat*100}}%
                                                </div>
                                            </div>
                                            <div class="rTableRow">
                                                <div class="rTableCell"></div>
                                                <div class="rTableCell">User Payment</div>
                                                <div class="rTableCell">After BTRC Share</div>
                                                <div class="rTableCell">After Telco Share</div>
                                                <div class="rTableCell">After Discrepancy</div>
                                                <div class="rTableCell">After AIT</div>
                                                <div class="rTableCell">After Billing Fee</div>
                                                <div class="rTableCell">{{$oem_name->oem}} Share</div>
                                                <div class="rTableCell">After VAT</div>
                                            </div>
                                            <div class="rTableRow">
                                                <div class="rTableCell"></div>
                                                <div class="rTableCell">{{$base = 40}}</div>
                                                <div class="rTableCell">{{$btrc = round($base - $base*$share_details->btrc_share,2)}}</div>
                                                <div class="rTableCell">{{$telco = round($btrc - $btrc*$share_details->gp_share,2)}}</div>
                                                <div class="rTableCell">{{$discrepancy = round($telco - $telco*$share_details->discrepancy,2)}}</div>
                                                <div class="rTableCell">{{$ait = round($discrepancy - $discrepancy*$share_details->ait,2)}}</div>
                                                <div class="rTableCell">{{$billing_fee = round($ait - $ait*$share_details->billing_fee,2)}}</div>
                                                <div class="rTableCell">{{$partner_share = round($billing_fee*$share_details->partner_share,2)}}</div>
                                                <div class="rTableCell">{{$vat = round($partner_share - $partner_share*$share_details->vat,2)}}</div>
                                            </div>

                                        </div>
                                        <div class="rTable">
                                            <div class="rTableRow">
                                                <div class="rTableHead" style="width: 14%">Robi-Airtel</div>
                                                <div class="rTableHead">End User</div>
                                                <div class="rTableHead">
                                                    {{$share_details->btrc_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->robi_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->discrepancy*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->ait*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->billing_fee*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->partner_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->vat*100}}%
                                                </div>
                                            </div>
                                            <div class="rTableRow">
                                                <div class="rTableCell"></div>
                                                <div class="rTableCell">User Payment</div>
                                                <div class="rTableCell">After BTRC Share</div>
                                                <div class="rTableCell">After Telco Share</div>
                                                <div class="rTableCell">After Discrepancy</div>
                                                <div class="rTableCell">After AIT</div>
                                                <div class="rTableCell">After Billing Fee</div>
                                                <div class="rTableCell">{{$oem_name->oem}} Share</div>
                                                <div class="rTableCell">After VAT</div>
                                            </div>
                                            <div class="rTableRow">
                                                <div class="rTableCell"></div>
                                                <div class="rTableCell">{{$base = 40}}</div>
                                                <div
                                                        class="rTableCell">{{$btrc = round($base - $base*$share_details->btrc_share,2)}}</div>
                                                <div
                                                        class="rTableCell">{{$telco = round($btrc - $btrc*$share_details->robi_share,2)}}</div>
                                                <div
                                                        class="rTableCell">{{$discrepancy = round($telco - $telco*$share_details->discrepancy,2)}}</div>
                                                <div
                                                        class="rTableCell">{{$ait = round($discrepancy - $discrepancy*$share_details->ait,2)}}</div>
                                                <div
                                                        class="rTableCell">{{$billing_fee = round($ait - $ait*$share_details->billing_fee,2)}}</div>
                                                <div class="rTableCell">{{$partner_share = round($billing_fee*$share_details->partner_share,2)}}</div>
                                                <div class="rTableCell">{{$vat = round($partner_share - $partner_share*$share_details->vat,2)}}</div>
                                            </div>

                                        </div>
                                        <div class="rTable">
                                            <div class="rTableRow">
                                                <div class="rTableHead" style="width: 14%">Banglalink</div>
                                                <div class="rTableHead">End User</div>
                                                <div class="rTableHead">
                                                    {{$share_details->btrc_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->bl_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->discrepancy*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->ait*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->billing_fee*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->partner_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->vat*100}}%
                                                </div>
                                            </div>
                                            <div class="rTableRow">
                                                <div class="rTableCell"></div>
                                                <div class="rTableCell">User Payment</div>
                                                <div class="rTableCell">After BTRC Share</div>
                                                <div class="rTableCell">After Telco Share</div>
                                                <div class="rTableCell">After Discrepancy</div>
                                                <div class="rTableCell">After AIT</div>
                                                <div class="rTableCell">After Billing Fee</div>
                                                <div class="rTableCell">{{$oem_name->oem}} Share</div>
                                                <div class="rTableCell">After VAT</div>
                                            </div>
                                            <div class="rTableRow">
                                                <div class="rTableCell"></div>
                                                <div class="rTableCell">{{$base = 40}}</div>
                                                <div class="rTableCell">{{$btrc = round($base - $base*$share_details->btrc_share,2)}}</div>
                                                <div class="rTableCell">{{$telco = round($btrc - $btrc*$share_details->bl_share,2)}}</div>
                                                <div class="rTableCell">{{$discrepancy = round($telco - $telco*$share_details->discrepancy,2)}}</div>
                                                <div class="rTableCell">{{$ait = round($discrepancy - $discrepancy*$share_details->ait,2)}}</div>
                                                <div class="rTableCell">{{$billing_fee = round($ait - $ait*$share_details->billing_fee,2)}}</div>
                                                <div class="rTableCell">{{$partner_share = round($billing_fee*$share_details->partner_share,2)}}</div>
                                                <div class="rTableCell">{{$vat = round($partner_share - $partner_share*$share_details->vat,2)}}</div>
                                            </div>

                                        </div>
                                        <div class="rTable">
                                            <div class="rTableRow">
                                                <div class="rTableHead" style="width: 14%">Teletalk</div>
                                                <div class="rTableHead">End User</div>
                                                <div class="rTableHead">
                                                    {{$share_details->btrc_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->teletalk_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->discrepancy*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->ait*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->billing_fee*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->partner_share*100}}%
                                                </div>
                                                <div class="rTableHead">
                                                    {{$share_details->vat*100}}%
                                                </div>
                                            </div>
                                            <div class="rTableRow">
                                                <div class="rTableCell"></div>
                                                <div class="rTableCell">User Payment</div>
                                                <div class="rTableCell">After BTRC Share</div>
                                                <div class="rTableCell">After Telco Share</div>
                                                <div class="rTableCell">After Discrepancy</div>
                                                <div class="rTableCell">After AIT</div>
                                                <div class="rTableCell">After Billing Fee</div>
                                                <div class="rTableCell">{{$oem_name->oem}} Share</div>
                                                <div class="rTableCell">After VAT</div>
                                            </div>
                                            <div class="rTableRow">
                                                <div class="rTableCell"></div>
                                                <div class="rTableCell">{{$base = 40}}</div>
                                                <div
                                                        class="rTableCell">{{$btrc = round($base - $base*$share_details->btrc_share,2)}}</div>
                                                <div
                                                        class="rTableCell">{{$telco = round($btrc - $btrc*$share_details->teletalk_share,2)}}</div>
                                                <div
                                                        class="rTableCell">{{$discrepancy = round($telco - $telco*$share_details->discrepancy,2)}}</div>
                                                <div
                                                        class="rTableCell">{{$ait = round($discrepancy - $discrepancy*$share_details->ait,2)}}</div>
                                                <div
                                                        class="rTableCell">{{$billing_fee = round($ait - $ait*$share_details->billing_fee,2)}}</div>
                                                <div class="rTableCell">{{$partner_share = round($billing_fee*$share_details->partner_share,2)}}</div>
                                                <div class="rTableCell">{{$vat = round($partner_share - $partner_share*$share_details->vat,2)}}</div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-header with-border">

                            <div class="pull-left">
                                <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i
                                            class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;</div>

                            <form action="{{url('/revenue/total-revenue/'.$request_month.'/'.$request_year)}}" method="post">
                                @csrf
                                {{method_field("get")}}

                                <div class="btn-group pull-left">
                                    <div class="form-group">
                                        <select class="form-control" id="order_sort" name="sort_select">
                                            <option value="game_name,desc">Game Name desc</option>
                                            <option value="game_name,asc">Game Name asc</option>
                                            <option value="imei,desc">IMEI desc</option>
                                            <option value="imei,asc">IMEI asc</option>
                                            <option value="operator,desc">Operator desc</option>
                                            <option value="operator,asc">Operator asc</option>
                                            <option value="model,desc">Model desc</option>
                                            <option value="model,asc">Model asc</option>
                                            <option value="action_time,desc">Action Time desc</option>
                                            <option value="action_time,asc">Action Time asc</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="btn-group pull-left">
                                    <button type="submit" class="btn btn-flat btn-primary">
                                        <i class="fa fa-sort-amount-asc"></i><span class="hidden-xs">Sort</span>
                                    </button>
                                </div>

                            </form>
                            <form>
                                <div class="form-group pull-left">
                                    <select class="form-control" id="pagination">
                                        <option>Per Page: {{$items}} </option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </form>
                            <div class="pull-right">
                        <span type="button" class="btn btn-primary"
                              data-toggle="modal"
                              data-target="#calculation_table_modal"><i
                                    style="font-size:larger;" class="fa fa-expand"></i></span>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <section id="pjax-container" class="table-list">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Game Name</th>
                                        <th>IMEI</th>
                                        <th>MSISDN</th>
                                        <th>Operator</th>
                                        {{--<th>Brand:Model</th>--}}
                                        <th>Action Time</th>
                                        <th>{{$oem_name->oem}} Revenue (BDT)</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none">
                                        {{$i =  ($table_all->currentPage()-1)*$items}}
                                    </div>
                                    @foreach($table_all as $all)
                                        <div style="display: none">
                                            {{$charged_amount = $all->charged_amount}}
                                            {{$after_btrc = $charged_amount - $charged_amount*$share_details->btrc_share}}
                                            @if(substr($all->msisdn,0,5)=="88019" || substr($all->msisdn,0,5)=="88014")
                                                {{$telco_share = $share_details->bl_share}}
                                            @elseif(substr($all->msisdn,0,5)=="88018" || substr($all->msisdn,0,5)=="88016")
                                                {{$telco_share = $share_details->robi_share}}
                                            @elseif(substr($all->msisdn,0,5)=="88016")
                                                {{$telco_share = $share_details->airtel_share}}
                                            @elseif(substr($all->msisdn,0,2)=="57" || substr($all->msisdn,0,5)=="88017" || substr($all->msisdn,0,5)=="88013")
                                                {{$telco_share = $share_details->gp_share}}
                                            @endif
                                            {{$after_telco = $after_btrc - $after_btrc*$telco_share}}
                                            {{$after_discrepancy = $after_telco - $after_telco*$share_details->discrepancy}}
                                            {{$after_ait= $after_discrepancy - $after_discrepancy*$share_details->ait}}
                                            {{$after_billing_fee = $after_ait - $after_ait*$share_details->billing_fee}}
                                            {{$partner_share = $after_billing_fee*$share_details->partner_share}}
                                            {{$after_vat = $partner_share - $partner_share*$share_details->vat}}
                                        </div>
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{Str::after($all->game_name,'BD')}}</td>
                                            <td>{{$all->imei}}</td>
                                            <td>{{$all->msisdn}}</td>
                                            <td>{{$all->operator}}</td>
                                            {{--<td>@if($all->brand_name!="null" && $all->brand_name!="NA")
                                                    {{$all->brand_name}}
                                                @endif

                                                @if($all->model!="null" && $all->model!="NA")
                                                    {{' : '.$all->model}}
                                                @endif
                                            </td>--}}
                                            <td>{{$all->action_time}}</td>
                                            <td>{{round($after_vat,2)}}</td>
                                            <td><span  data-toggle="modal" data-target="#myModal{{$i}}"><i class="fa fa-expand"></i></span></td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal{{$i}}" role="dialog">
                                            <div class="modal-dialog" style="width: 70%;">

                                                <!-- Modal content-->
                                                <div class="modal-content" style="width: 100%;">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">{{$oem_name->oem}} Revenue Calculation</h4>
                                                    </div>
                                                    <div class="modal-body" style="width: 100%;" >
                                                        <div class="rTable">
                                                            <div class="rTableRow">
                                                                <div class="rTableHead">Charged Amount</div>
                                                                <div class="rTableHead">After BTRC Share <br>of {{$share_details->btrc_share*100}}%</div>
                                                                <div class="rTableHead">After {{$all->operator}} Share <br>of {{$telco_share*100}}%</div>
                                                                <div class="rTableHead">After Discrepancy <br>of {{$share_details->discrepancy*100}}%</div>
                                                                <div class="rTableHead">After AIT <br>of {{$share_details->ait*100}}%</div>
                                                                <div class="rTableHead">After Billing Fee <br>of {{$share_details->billing_fee*100}}%</div>
                                                                <div class="rTableHead">{{$oem_name->oem}} Share <br>of {{$share_details->partner_share*100}}%</div>
                                                                <div class="rTableHead">After VAT <br>of {{$share_details->vat*100}}%</div>
                                                            </div>
                                                            <div class="rTableRow">
                                                                <div class="rTableCell">{{round($charged_amount,2)}}</div>
                                                                <div class="rTableCell">{{round($after_btrc,2)}}</div>
                                                                <div class="rTableCell">{{round($after_telco,2)}}</div>
                                                                <div class="rTableCell">{{round($after_discrepancy,2)}}</div>
                                                                <div class="rTableCell">{{round($after_ait,2)}}</div>
                                                                <div class="rTableCell">{{round($after_billing_fee,2)}}</div>
                                                                <div class="rTableCell">{{round($partner_share,2)}}</div>
                                                                <div class="rTableCell">{{round($after_vat,2)}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="box-footer clearfix">
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    {{ $table_all->links() }}
                                </ul>
                            </div>
                        </section>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->

    <div class="control-sidebar-bg"></div>

@endsection
@section('pageSpecificScripts')
    <script>
        document.getElementById('pagination').onchange = function () {
            if ("{{$keyword_of_searching}}") {
                let keyword_of_searching = "{{$keyword_of_searching}}";
                let var1 = "{{ $table_all->firstItem()}}";
                var1 = Math.ceil((var1) / this.value);
                let url = window.location.pathname;
                url = url + "?items=" + this.value + "&page=" + var1 + "&keyword=" + keyword_of_searching;
                window.location = url;
            } else if ("{{$sort_select}}") {
                let sort_select = "{{$sort_select}}";
                let var1 = "{{ $table_all->firstItem()}}";
                var1 = Math.ceil((var1) / this.value);
                let url = window.location.pathname;
                url = url + "?items=" + this.value + "&page=" + var1 + "&sort_select=" + sort_select;
                window.location = url;
            } else {
                let var1 = "{{ $table_all->firstItem()}}";
                var1 = Math.ceil((var1) / this.value);
                console.log("{{ $table_all->firstItem()}}");
                let url = window.location.pathname;
                url = url + "?items=" + this.value + "&page=" + var1;
                window.location = url;
            }
        };
    </script>
@stop
