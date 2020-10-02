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
                                <form action="{{url('/editor-inhouse-search-list')}}" method="post" id="mo_search">
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
                                                   placeholder="IMEI, MSISDN" value="">
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

                            <!-- /.input group -->
                        </div>
                        <!-- /.box-header -->
                        <section id="pjax-container" class="table-list">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover no-padding">
                                    <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Keyword</th>
                                        <th>IMEI</th>
                                        <th>IMSI</th>
                                        <th>MSISDN</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Operator</th>
                                        <th>MO</th>
                                        <th>Created At</th>
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
                                                <td>{{$all->keyword}}</td>
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
                                                <td>{{$all->brand}}</td>
                                                <td>{{$all->model}}</td>
                                                <td>{{$all->operator}}</td>
                                                <td>{{$all->org_mo}}</td>
                                                <td>{{$all->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    @endisset

                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer clearfix">
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    @isset($table_all)
                                    {{ $table_all->links() }}
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
    {{--<script>
        document.getElementById('pagination').onchange = function () {

                let var1 = "{{ $table_all->firstItem()}}";
                var1 = Math.ceil((var1) / this.value);
                let url = window.location.pathname;
                url = url + "?items=" + this.value + "&page=" + var1;
                window.location = url;
        };
    </script>--}}
@stop
