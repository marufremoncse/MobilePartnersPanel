@extends('admin.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->

    <div id="app">
        <section class="content-header">
            <h1>
                <i class="fa fa-indent" aria-hidden="true"></i>  {{$page_name}} list
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
                                        <form action="{{route('models')}}" method="post" id="sales_search">
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
                                                           placeholder="Model" value="">
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                @if(isset($keyword_of_searching))
                                    <p class="pull-left alert alert-success">Showing results for <b class="bg-red">{{$keyword_of_searching}}</b></p>
                                @endif
                            <!-- /.box-tools -->
                        </div>

                        <div class="box-header with-border">

                            <div class="pull-left">
                                <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i
                                            class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;</div>

                            <form action="{{route('models')}}" method="post">
                                @csrf
                                {{method_field("get")}}

                                <div class="btn-group pull-left">
                                    <div class="form-group">
                                        <select class="form-control" id="order_sort" name="sort_select">
                                            <option value="model,desc">Model desc</option>
                                            <option value="model,asc">Model asc</option>
                                            <option value="revenue,desc">Revenue desc</option>
                                            <option value="revenue,asc">Revenue asc</option>
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
                        </div>
                        <!-- /.box-header -->
                        <section id="pjax-container" class="table-list">
                            <div style="padding-right: 3%;padding-left: 3%;" class="box-body table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 25%">SL No.</th>
                                        <th style="width: 30%">Model</th>
                                        <th style="width: 30%">Total Active</th>
                                        <th style="width: 25%">Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none">
                                        {{$i =  ($table_all->currentPage()-1)*$items}}
                                    </div>
                                    @foreach($table_all as $all)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$all->model}}</td>
                                            <td>{{$all->total}}</td>
                                            <td><a href="{{url('/sales/activation/models/'.$all->model)}}"><span title="details" type="button" class="btn btn-primary" style="border-radius: 30%"><i style="font-size:larger;" class="fa fa-info-circle"></i></span></a>&nbsp;</td>
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
    </script>
@stop
