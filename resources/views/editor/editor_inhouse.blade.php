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

                            </div>
                        <!-- /.box-tools -->
                        </div>

                        <div class="box-header with-border">

                            <div class="btn-group pull-left">
                                <div class="form-control">Show</div>
                            </div>
                            <form>
                                <div class="btn-group pull-left">
                                    <div class="form-group">
                                        <select class="form-control" id="pagination">
                                            <option>{{$items}} </option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="btn-group pull-left">
                                <div class="form-control">Entries</div>
                            </div>
                            <!-- Date and time range -->

                            <div class="input-group pull-left">
                                <input type="text" class="form-control" id="reservationtime">

                            </div>
                            <form>
                                <div class="btn-group pull-left">
                                    <div class="form-group">
                                        <select class="form-control" id = "org_id_select">
                                            <option>Select Organization</option>
                                            @foreach($all_organizations as $org)
                                                <option value="{{$org->id}}" {{$org->id == $organization_id  ? 'selected' : ''}}>{{$org->organization_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <form action="" method="post">
                                @csrf
                                {{method_field("get")}}
                                <input type="hidden" id="start_time" name="start_time">
                                <input type="hidden" id="end_time" name="end_time">
                            </form>

                            <!-- /.input group -->
                        </div>
                        <!-- /.box-header -->
                        <section id="pjax-container" class="table-list">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover no-padding">
                                    <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Date</th>
                                        <th>Device Type</th>
                                        <th>Total Device</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($table_all)
                                    <div style="display: none">
                                        {{$i =  ($table_all->currentPage()-1)*$items}}
                                    </div>
                                        @foreach($table_all as $all)
                                            <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$all->date_of_activation}}</td>
                                        <td>{{$all->device_type}}</td>
                                        <td>{{$all->count}}</td>
                                        <td><a href="{{url('/editor-inhouse-details/'.$organization_id.'/'.$all->date_of_activation.'/'.$all->device_type)}}"><span title="details" type="button" class="btn btn-primary" style="border-radius: 30%"><i style="font-size:larger;" class="fa fa-info-circle"></i></span></a>&nbsp;</td>
                                            </tr>
                                        @endforeach
                                    @endisset

                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer clearfix">
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    @isset($table_all)
                                    {{ $table_all->links()}}
                                    @endisset
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

            let var1 = "{{$table_all->firstItem()}}";
            var1 = Math.ceil((var1) / this.value);
            let url = window.location.pathname;
            url = url + "?items=" + this.value + "&page=" + var1;
            window.location = url;
        };
        document.getElementById('org_id_select').onchange = function () {
            let org = this.value;
            window.location = "/editor-inhouse/" + org + "/" + document.getElementById('start_time').value + "/" + document.getElementById('end_time').value;
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
