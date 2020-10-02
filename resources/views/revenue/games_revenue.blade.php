@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>{{\App\Organization::where('id',Auth::user()->organization_id)->pluck('organization_name')->first()}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li >Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 class="num">{{Illuminate\Support\Facades\DB::table('games_revenue')->where('organization_id',Auth::user()->organization_id)->distinct('imei')->count('imei')}}</h3>

                        <p>Total Device</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-graph-up-right"></i>
                    </div>
                    <a href="{{url('/revenue/total-revenue')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 class="num">{{Illuminate\Support\Facades\DB::table('games_revenue')->where('organization_id',Auth::user()->organization_id)->distinct('game_name')->count('game_name')}}</h3>

                        <p>Total Unique Games</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-game-controller-a"></i>
                    </div>
                    <a href="{{url('/revenue/total-game')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-4 col-md-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 class="num">{{Illuminate\Support\Facades\DB::table('month_wise_revenue')->where('organization_id',Auth::user()->organization_id)->sum('month_wise_revenue')}}</h3>

                        <p>Total Revenue</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-graph-up-right"></i>
                    </div>
                    <a href="{{url('/revenue/total-revenue')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            {{--<div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 class="num">{{Illuminate\Support\Facades\DB::table('game_revenues')->where('organization_id',Auth::user()->organization_id)->whereMonth('created_at',date('m'))->sum('charged_amount')}}</h3>

                        <p>Revenue(Current Month)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-graph-up-right"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 class="num">{{Illuminate\Support\Facades\DB::table('game_revenues')->where('organization_id',Auth::user()->organization_id)->whereMonth('created_at',date('m',strtotime("last month")))->sum('charged_amount')}} </h3>

                        <p>Revenue(Previous Month)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-graph-up-right"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>--}}
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- /.box-header -->
   {{--     <div class="row">
            <div class="col-md-4" style="display: none">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Area/Cluster Wise Sales</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chart-responsive">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="pieChart" height="316" width="632" class="chartjs-render-monitor"
                                            style="display: block; width: 632px; height: 316px;"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <ul class="chart-legend clearfix">
                                    <li><i class="fa fa-circle text-danger"></i> Chrome</li>
                                    <li><i class="fa fa-circle text-success"></i> IE</li>
                                    <li><i class="fa fa-circle text-warning"></i> FireFox</li>
                                    <li><i class="fa fa-circle text-info"></i> Safari</li>
                                    <li><i class="fa fa-circle text-primary"></i> Opera</li>
                                    <li><i class="fa fa-circle text-secondary"></i> Navigator</li>
                                </ul>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <!-- /.footer -->
                </div>
            </div>
            <div class="col-md-8" style="display: none">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly Recap Report(Activation)</h3>

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
                                <p class="text-center">
                                    <strong>Activation: 1 Jan, 2019 - 31 Desc, 2019</strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="activationChart" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-12">
                                <p class="text-center">
                                    <strong>Goal Completion</strong>
                                </p>

                                <div class="progress-group">
                                    <span class="progress-text">Smart Phone</span>
                                    <span class="progress-number"><b>5135</b>/6557</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-aqua" style="width: 78.3%"></div>
                                    </div>
                                </div>

                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Feature Phone</span>
                                    <span class="progress-number"><b>426870</b>/450178</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-green" style="width: 94%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.box -->
            </div>

            <!-- /.col -->
        </div>--}}
        {{--<div class="row">
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
                                <p class="text-center">
                                    <strong>Revenue: 1 Jan, 2019 - 31 Desc, 2019</strong>
                                </p>

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
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 98%</span>
                                    <h5 class="description-header">7810595 </h5>
                                    <span class="description-text">TOTAL SELL VALUE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                        <span class="description-percentage text-yellow"><i
                                                class="fa fa-caret-left"></i> 74.4%</span>
                                    <h5 class="description-header">5810595 </h5>
                                    <span class="description-text">TOTAL COST VALUE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 7.72%</span>
                                    <h5 class="description-header">564321 </h5>
                                    <span class="description-text">TOTAL EXPENSE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block">
                                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18.4%</span>
                                    <h5 class="description-header">1435679 </h5>
                                    <span class="description-text">TOTAL PROFIT</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>--}}

        <!-- ./box-body -->

    </section>
    <!-- /.content -->
@endsection

@section('pageSpecificScripts')
    <script src="{{asset('dist/js/pages/dashboard3.js')}}"></script>
@stop
