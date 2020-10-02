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
                                <form action="{{url('/revenue/total-revenue')}}" method="post" id="active_search">
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
                        <div class="box-header with-border">

                            <div class="pull-left">
                                <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i
                                            class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;</div>


                            <form action="{{url('/revenue/total-revenue')}}" method="post">
                                @csrf
                                {{method_field("get")}}

                                <div class="btn-group pull-left">
                                    <div class="form-group">
                                        <select class="form-control" id="order_sort" name="sort_select">
                                            <option value="month,desc">Month desc</option>
                                            <option value="month,asc">Month asc</option>
                                            <option value="year,desc">Year desc</option>
                                            <option value="year,asc">Year asc</option>
                                            <option value="month_wise_revenue,desc">Revenue desc</option>
                                            <option value="month_wise_revenue,asc">Revenue asc</option>
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
                        </div>
                        <!-- /.box-header -->
                        <section id="pjax-container" class="table-list">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Month</th>
                                        <th>{{$oem_name->oem}} Revenue(BDT)</th>
                                        <th>Details</th>
                                        <th>1st Week</th>
                                        <th>2nd Week</th>
                                        <th>3rd Week</th>
                                        <th>4th Week</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none">
                                        {{$i =  ($table_all->currentPage()-1)*$items}}
                                    </div>
                                    @foreach($table_all as $all)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{date("F", mktime(0, 0, 0, $all->month, 10))."-"}}{{$all->year}}</td>
                                            <td>{{$all->month_wise_revenue}}</td>
                                            <td><a href="{{url('/revenue/total-revenue/'.$all->month.'/'.$all->year)}}"><span title="details" type="button" class="btn btn-primary" style="border-radius: 30%"><i style="font-size:larger;" class="fa fa-info-circle"></i></span></a>&nbsp;</td>
                                            <td style="width:15px"><a href="{{route('revenue_export',['from'=>$all->year.'-'.$all->month.'-01', 'to'=>$all->year.'-'.$all->month.'-07'])}}"><span title="download" type="button" class="btn btn-primary" style="border-radius: 30%"><i style="font-size:larger;" class="fa fa-download"></i></span></a>&nbsp;</td>
                                            <td style="width:15px"><a href="{{route('revenue_export',['from'=>$all->year.'-'.$all->month.'-08', 'to'=>$all->year.'-'.$all->month.'-14'])}}"><span title="download" type="button" class="btn btn-success" style="border-radius: 30%"><i style="font-size:larger;" class="fa fa-download"></i></span></a>&nbsp;</td>
                                            <td style="width:15px"><a href="{{route('revenue_export',['from'=>$all->year.'-'.$all->month.'-15', 'to'=>$all->year.'-'.$all->month.'-21'])}}"><span title="download" type="button" class="btn btn-warning" style="border-radius: 30%"><i style="font-size:larger;" class="fa fa-download"></i></span></a>&nbsp;</td>
                                            <td style="width:15px"><a href="{{route('revenue_export',['from'=>$all->year.'-'.$all->month.'-22', 'to'=>$all->year.'-'.$all->month.'-31'])}}"><span title="download" type="button" class="btn btn-danger"  style="border-radius: 30%"><i style="font-size:larger;" class="fa fa-download"></i></span></a>&nbsp;</td>
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
                console.log("{{ $table_all->firstItem()}}");
                let url = window.location.pathname;
                url = url + "?items=" + this.value + "&page=" + var1;
                window.location = url;
            }
        };
    </script>
@stop
