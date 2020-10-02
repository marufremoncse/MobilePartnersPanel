@extends('admin.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->

    <div id="app">
        <section class="content-header">
            <h1>
                <i class="fa fa-indent" aria-hidden="true"></i> {{$page_name}} list
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
                                <form action="{{route('smart')}}" method="post" id="sales_search">
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
                                                   placeholder="IMEI, IMSI, MSISDN, Model, Device Type etc" value="">
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

                        <div class="box-header with-border">

                            <div class="pull-left">
                                <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i
                                            class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;
                            </div>

                            <form action="{{route('smart')}}" method="post">
                                @csrf
                                {{method_field("get")}}

                                <div class="btn-group pull-left">
                                    <div class="form-group">
                                        <select class="form-control" id="order_sort" name="sort_select">
                                            <option value="first_imei,desc">First IMEI desc</option>
                                            <option value="first_imei,asc">First IMEI asc</option>
                                            <option value="first_imsi,desc">First IMSI desc</option>
                                            <option value="first_imsi,asc">First IMSI asc</option>
                                            <option value="msisdn,desc">MSISDN desc</option>
                                            <option value="msisdn,asc">MSISDN asc</option>
                                            <option value="model,desc">Model desc</option>
                                            <option value="model,asc">Model asc</option>
                                            <option value="device_type,desc">Device Type desc</option>
                                            <option value="device_type,asc">Device Type asc</option>
                                            <option value="thana,desc">Thana desc</option>
                                            <option value="thana,asc">Thana asc</option>
                                            <option value="district,desc">District desc</option>
                                            <option value="district,asc">District asc</option>
                                            <option value="division,desc">Division desc</option>
                                            <option value="division,asc">Division asc</option>
                                            <option value="registration_date,desc">Activation Time desc</option>
                                            <option value="registration_date,asc">Activation Time asc</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="btn-group pull-left">
                                    <button type="submit" class="btn btn-flat btn-primary">
                                        <i class="fa fa-sort-amount-asc"></i><span class="hidden-xs">Sort</span>
                                    </button>&nbsp;&nbsp;
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
                            <div class="pull-right col-sm-2">
                                <span class="form-control btn-danger">{{--{{date("M-y")." : "}}--}}This Month:
                                    {{$current_month_activation_smart->count}}</span>
                            </div>

                            <div class="pull-right col-sm-2">
                                <span class="form-control btn-success">{{--{{date("d-M-y")." : "}} --}}Today: {{$todays_activation_smart->count}}</span>
                            </div>

                        </div>
                        <div class="box-header with-border">
                            <div class="col-md-12">
                                <div class="col-md-5 form-group pull-left">
                                    <label class="col-md-2">From:</label>
                                    <div class="col-md-10 input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker_start" placeholder="From">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="col-md-5 form-group pull-left">
                                    <label class="col-md-2">To:</label>
                                    <div class="col-md-10 input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker_end" placeholder="To">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="col-md-2 pull-left">
                                    <form action="{{route('active')}}" method="post">
                                        @csrf
                                        {{method_field("get")}}
                                        <input type="hidden" id="start_time" name="start_time">
                                        <input type="hidden" id="end_time" name="end_time">
                                        <button onclick="datepicker_caller()" type="submit" class="btn btn-flat btn-primary">Apply
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <section id="pjax-container" class="table-list">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>IMEI</th>
                                        <th>IMSI</th>
                                        <th>MSISDN</th>
                                        <th>Model</th>
                                        <th>Device Type</th>
                                        <th>Thana</th>
                                        <th>District</th>
                                        <th>Division</th>
                                        <th>Activation Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none">
                                        {{$i =  ($table_all->currentPage()-1)*$items}}
                                    </div>
                                    @foreach($table_all as $all)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$all->first_imei}}

                                                @if($all->second_imei!=null && $all->second_imei!="null" && $all->second_imei!="NA")
                                                    {{' : '.$all->second_imei}}
                                                @endif
                                            </td>
                                            <td>{{$all->first_imsi}}

                                                @if($all->second_imsi!=null && $all->second_imsi!="null" && $all->second_imsi!="NA")
                                                    {{' : '.$all->second_imsi}}
                                                @endif
                                            </td>
                                            <td>{{$all->msisdn}}</td>
                                            <td>{{$all->model}}</td>
                                            <td>{{$all->device_type}}</td>
                                            <td>{{$all->thana}}</td>
                                            <td>{{$all->district}}</td>
                                            <td>{{$all->division}}</td>
                                            <td>{{$all->registration_date}}</td>
                                        </tr>
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
                let url = window.location.pathname;
                url = url + "?items=" + this.value + "&page=" + var1;
                window.location = url;
            }
        };
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        }, function (start, end, label) {
            document.getElementById('start_time').value = start.format('YYYY-MM-DD hh:mm:ss');
            document.getElementById('end_time').value = end.format('YYYY-MM-DD hh:mm:ss');
        })
    </script>
@stop
