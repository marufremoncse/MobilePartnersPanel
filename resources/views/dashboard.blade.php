@extends('admin.master')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>{{\App\Organization::where('id',Auth::user()->organization_id)->pluck('organization_name')->first()}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <div class="row">

            <div class="col-md-4">

                <select  id="ActivationChartID_Model" class="form-control">
                    <option value="all_models">All Models</option>
                    <optgroup label="Smart Phone">
                    @foreach($all_models_smart as $models)
                        <option value="{{$models->model}}">{{strtoupper($models->brand)}}{{" : "}}{{$models->model}}</option>
                    @endforeach
                    </optgroup>
                    <optgroup label="Feature Phone">
                    @foreach($all_models_feature as $models)
                        <option value="{{$models->model}}">{{strtoupper($models->brand)}}{{" : "}}{{$models->model}}</option>
                    @endforeach
                    </optgroup>
                </select >
            </div>
            <div class="col-md-4">
                <select id="ActivationChartID" class="form-control">
                    <option value="activationChartTwentyFour">Last 24 Hours</option>
                    <option value="activationChartLastSevenDays" selected>Last 7 Days</option>
                    <option value="activationChartLastThirtyDays">Last 30 Days</option>
                    <option value="activationChartCurrentWeek">Current Week</option>
                    <option value="activationChartPreviousWeek">Previous Week</option>
                    <option value="activationChartCurrentMonth">Current Month</option>
                    <option value="activationChartPreviousMonth">Previous Month</option>
                    <option value="activationChartYear">Current Year</option>
                    <option value="activationChartPreviousYear">Previous Year</option>
                </select>
            </div>
        </div>
        <div class="row" >

            <div class="col-md-12" >

                <div class="box"  style="background-color: rgba(34, 45, 50, 1)">
                    <div class="box-header with-border" style="color: rgb(184,199,206)">
                        <h3 class="box-title" >Activation Recap Report</h3>
                        <h3 class="box-title">--</h3>
                        <h3 id="title1" class="box-title">All Models</h3>
                        <h3 class="box-title">--</h3>
                        <h3 id="title2" class="box-title">Last 7 Days</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" >
                        <div id="loader_of_chart" style="display:none;height: 400px;"><img src="{{asset('dist/img/animated-loading-png-6.gif')}}" style="opacity: 0.7;width:5%;position:absolute;left: 50%;top: 50%;" alt="Loader"></div>
                        <div class="row" id="refresh_main">
                            <div  class="col-md-12"  id="refresh">

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="activationChart"  style="height: 400px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.box -->
            </div>

            <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->

@endsection

@section('pageSpecificScripts')
    <script src="{{asset('dist/js/pages/dashboard2.js')}}"></script>
    <script type="text/javascript">
        function chart_loader() {
            document.getElementById('loader_of_chart').style.display="none";
        }
        window.onload = chart_loader;
    </script>
@stop