@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Dashboard
            <small>{{\App\Organization::where('id',Auth::user()->organization_id)->pluck('organization_name')->first()}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Sales Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div>
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3 class="num">{{Illuminate\Support\Facades\DB::table('subscriber')->where('organization_id',Auth::user()->organization_id)->count('model')}}</h3>

                            <p>Total Active</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-connection-bars"></i>
                        </div>
                        <a href="{{route('active')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3 class="num">{{Illuminate\Support\Facades\DB::table('subscriber')->where('organization_id',Auth::user()->organization_id)->distinct('model')->count('model')}}<sup style="font-size: 20px"></sup></h3>

                            <p>Total Model</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{route('models')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3 class="num">{{Illuminate\Support\Facades\DB::table('subscriber')->where('organization_id',Auth::user()->organization_id)->where('device_type','smart')->count('model')}}</h3>

                            <p>Total Smart Phone</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-iphone"></i>
                        </div>
                        <a href="{{route('smart')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3 class="num">{{Illuminate\Support\Facades\DB::table('subscriber')->where('organization_id',Auth::user()->organization_id)->where('device_type','feature')->count('model')}}</h3>

                            <p>Total Feature Phone</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-calculator"></i>
                        </div>
                        <a href="{{route('feature')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
    <!-- /.row -->
        <!-- /.box-header -->

            <div class="row">

                <div class="col-md-6">
                    <div {{--class="col-md-6"--}}>
                        <select id="PieChartID_smart" class="form-control" {{--style="background-color: rgba(34, 45, 50, 1);color: rgb(184,199,206); border-color: rgba(32, 38, 52, 1)"--}}>
                            <option value="pieChartCurrentMonthDivision">Current Month</option>
                            <option value="pieChartPreviousMonthDivision">Previous Month</option>
                            <option value="pieChartYearDivision">Current Year</option>
                            <option value="pieChartPreviousYearDivision">Previous Year</option>
                        </select>
                    </div>
                    <div class="box box-default">

                        <div class="box-header with-border">
                            <h3 class="box-title">Smart Phone</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row" id="refresh_main_smart">
                                <div id="refresh_smart">
                                <div class="col-md-8" >
                                    <div class="chart-responsive">
                                        <canvas id="pieChart" height="300" width="550"></canvas>
                                    </div>
                                    <!-- ./chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <ul class="chart-legend clearfix">
                                        <li><i class="fa fa-circle-o" style="color:violet;"></i> Dhaka</li>
                                        <li><i class="fa fa-circle-o" style="color:indigo;"></i> Chittagong</li>
                                        <li><i class="fa fa-circle-o" style="color:blue;"></i> Rajshahi</li>
                                        <li><i class="fa fa-circle-o" style="color:green;"></i> Khulna</li>
                                        <li><i class="fa fa-circle-o" style="color:yellow;"></i> Rangpur</li>
                                        <li><i class="fa fa-circle-o" style="color:orange;"></i> Barisal</li>
                                        <li><i class="fa fa-circle-o" style="color:red;"></i> Mymensingh</li>
                                        <li><i class="fa fa-circle-o" style="color:limegreen;"></i> Sylhet</li>
                                        <li><i class="fa fa-circle-o" style="color:grey;"></i> Others</li>
                                    </ul>
                                </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>

                        <!-- /.box-body -->
                        {{--<div class="box-footer no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">United States of America
                                        <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                                <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                                </li>
                                <li><a href="#">China
                                        <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                            </ul>
                        </div>--}}
                        <!-- /.footer -->
                    </div>
                </div>

                <div class="col-md-6">
                    <div>
                        <select id="PieChartID_feature" class="form-control" {{--style="background-color: rgba(34, 45, 50, 1);color: rgb(184,199,206); border-color: rgba(32, 38, 52, 1)"--}}>
                            <option value="pieChartCurrentMonthDivisionFeature">Current Month</option>
                            <option value="pieChartPreviousMonthDivisionFeature">Previous Month</option>
                            <option value="pieChartYearDivisionFeature">Current Year</option>
                            <option value="pieChartPreviousYearDivisionFeature">Previous Year</option>

                        </select>
                    </div>

                    <div class="box box-default">


                        <div class="box-header with-border">
                            <h3 class="box-title">Feature Phone</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">

                            <div class="row" id="refresh_main_feature">
                                <div id="refresh_feature">
                                <div class="col-md-8" >
                                    <div class="chart-responsive">
                                        <canvas id="pieChartFeature" height="300" width="550"></canvas>
                                    </div>
                                    <!-- ./chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <ul class="chart-legend clearfix">
                                        <li><i class="fa fa-circle-o" style="color:violet;"></i> Dhaka</li>
                                        <li><i class="fa fa-circle-o" style="color:indigo;"></i> Chittagong</li>
                                        <li><i class="fa fa-circle-o" style="color:blue;"></i> Rajshahi</li>
                                        <li><i class="fa fa-circle-o" style="color:green;"></i> Khulna</li>
                                        <li><i class="fa fa-circle-o" style="color:yellow;"></i> Rangpur</li>
                                        <li><i class="fa fa-circle-o" style="color:orange;"></i> Barisal</li>
                                        <li><i class="fa fa-circle-o" style="color:red;"></i> Mymensingh</li>
                                        <li><i class="fa fa-circle-o" style="color:limegreen;"></i> Sylhet</li>
                                        <li><i class="fa fa-circle-o" style="color:grey;"></i> Others</li>
                                    </ul>
                                </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>

                        <!-- /.box-body -->
                        {{--<div class="box-footer no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">United States of America
                                        <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                                <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                                </li>
                                <li><a href="#">China
                                        <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                            </ul>
                        </div>--}}
                        <!-- /.footer -->
                    </div>
                </div>
            </div>


        <div class="row" style="display: none">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly Recap Report(Revenue)</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                              {{--  <p class="text-center">
                                    <strong>Revenue: 1 Jan, 2019 - 31 Desc, 2019</strong>
                                </p>--}}

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        </div>
        <!-- ./box-body -->

    </section>
    <!-- /.content -->
@endsection

@section('pageSpecificScripts')
    <script src="{{asset('dist/js/pages/pieChart.js')}}"></script>
    <script src="{{asset('dist/js/pages/pieChartFeature.js')}}"></script>
@stop
