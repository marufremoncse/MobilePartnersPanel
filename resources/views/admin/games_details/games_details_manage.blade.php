@extends('admin.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    @role('Company Admin|Super Admin')

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
                <li>{{$page_name}} list</li>
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
                                <form action="{{route('config.index')}}" id="button_search">
                                    <div onclick="$(this).submit();" class="btn-group pull-right">
                                        <a class="btn btn-flat btn-primary" title="Refresh">
                                            <i class="fa  fa-search"></i><span class="hidden-xs"> Search</span>
                                        </a>
                                    </div>
                                    <div class="btn-group pull-right">
                                        <div class="form-group">
                                            <input type="text" name="keyword" class="form-control"
                                                   placeholder="Search Name, ID or Email" value="">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.box-tools -->
                        </div>

                        <div class="box-header with-border">
                            <div class="pull-right">

                                <div class="btn-group pull-right" style="margin-right: 10px">
                                    <a href="{{route('games-details.create')}}"
                                       class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                                        <i class="fa fa-plus"></i><span class="hidden-xs">Add new</span>
                                    </a>
                                </div>
                            </div>

                            <div class="pull-left">
                                <button type="button" class="btn btn-default grid-select-all"><i
                                            class="fa fa-square-o"></i></button> &nbsp;

                                <a class="btn   btn-flat btn-danger grid-trash" data-name="games-details" title="Delete"><i class="fa fa-trash-o"></i><span
                                            class="hidden-xs"> Delete</span></a> &nbsp;

                                <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i
                                            class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;
                            </div>

                            <form action="{{route('games-details.index')}}" method="post">
                                @csrf
                                {{method_field("get")}}
                                <div class="btn-group pull-left">
                                    <div class="form-group">
                                        <select class="form-control" id="order_sort" name="sort_select">
                                            <option value="id,desc">games-details ID desc</option>
                                            <option value="id,asc">games-details ID asc</option>
                                            <option value="oem,desc">OEM desc</option>
                                            <option value="oem,asc">OEM asc</option>
                                            <option value="brand,desc">Brand desc</option>
                                            <option value="brand,asc">Brand asc</option>
                                            <option value="game_provider,desc">Game Provider desc</option>
                                            <option value="game_provider,asc">Game Provider asc</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="btn-group pull-left">
                                    <button type="submit" class="btn btn-flat btn-primary">
                                        <i class="fa fa-sort-amount-asc"></i><span class="hidden-xs">Sort</span>
                                    </button>
                                </div>
                            </form>

                        </div>
                        <!-- /.box-header -->
                        <div id="table_data">
                            <section id="pjax-container" class="table-list">
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Company/ OEM Name</th>
                                            <th>Brand</th>
                                            <th>Keyword</th>
                                            <th>Sub Keyword</th>
                                            <th>Game Provider</th>
                                            <th>Device Type</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($table_all as $games_details)
                                            <tr>
                                                <td><input type="checkbox" form="user_delete_form" name="user_check[]"
                                                               id="user_check_{{$games_details->id}}" class="grid-row-checkbox"
                                                               data-id="{{$games_details->id}}"></td>

                                                <td>{{$games_details->oem}}</td>
                                                <td>{{$games_details->brand}}</td>
                                                <td>{{$games_details->keyword}}</td>
                                                <td>{{$games_details->sub_keyword}}</td>
                                                <td>{{$games_details->game_provider}}</td>
                                                <td>{{$games_details->device_type}}</td>
                                                <td><a href="{{route('games-details.edit',$games_details->id)}}"><span title="Edit" type="button" class="btn btn-flat btn-primary"><i
                                                                    class="fa fa-edit"></i></span></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="box-footer clearfix">
                                    Showing <b>1</b> to <b>1</b> of <b>1</b> <b>items</b>
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                     {{--   {{ $table_all->links() }}--}}
                                    </ul>

                                </div>
                            </section>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->

    <div class="control-sidebar-bg"></div>

    @else
        <script>window.location = "/dashboard";</script>

        @endrole

@endsection
