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
                                    <a href="{{route('config.create')}}"
                                       class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                                        <i class="fa fa-plus"></i><span class="hidden-xs">Add new</span>
                                    </a>
                                </div>
                            </div>

                            <div class="pull-left">
                                <button type="button" class="btn btn-default grid-select-all"><i
                                            class="fa fa-square-o"></i></button> &nbsp;

                                <a class="btn   btn-flat btn-danger grid-trash" data-name="config" title="Delete"><i class="fa fa-trash-o"></i><span
                                            class="hidden-xs"> Delete</span></a> &nbsp;

                                <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i
                                            class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;
                            </div>

                            <form action="{{route('config.index')}}" method="post">
                                @csrf
                                {{method_field("get")}}
                                <div class="btn-group pull-left">
                                    <div class="form-group">
                                        <select class="form-control" id="order_sort" name="sort_select">
                                            <option value="id,desc">ID desc</option>
                                            <option value="id,asc">ID asc</option>
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
                                            <th>Org ID</th>
                                            <th>BTRC Share</th>
                                            <th>GP Share</th>
                                            <th>Airtel Share</th>
                                            <th>Robi Share</th>
                                            <th>BL Share</th>
                                            <th>TT Share</th>
                                            <th>Discrepancy</th>
                                            <th>AIT</th>
                                            <th>Billing Fee</th>
                                            <th>Partner Share</th>
                                            <th>VAT</th>
                                            <th>GP Grand Share</th>
                                            <th>Airtel Grand Share</th>
                                            <th>Robi Grand Share</th>
                                            <th>BL Grand Share</th>
                                            <th>Teletalk Grand Share</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($table_all as $config)
                                            <tr>
                                                <td><input type="checkbox" form="config_delete_form" name="config_check[]"
                                                               id="config_check_{{$config->id}}" class="grid-row-checkbox"
                                                               data-id="{{$config->id}}"></td>

                                                <td>{{$config->organization_id}}</td>
                                                <td>{{$config->btrc_share}}</td>
                                                <td>{{$config->gp_share}}</td>
                                                <td>{{$config->airtel_share}}</td>
                                                <td>{{$config->robi_share}}</td>
                                                <td>{{$config->bl_share}}</td>
                                                <td>{{$config->teletalk_share}}</td>
                                                <td>{{$config->discrepancy}}</td>
                                                <td>{{$config->ait}}</td>
                                                <td>{{$config->billing_fee}}</td>
                                                <td>{{$config->partner_share}}</td>
                                                <td>{{$config->vat}}</td>
                                                <td>{{$config->gp_grand_share}}</td>
                                                <td>{{$config->airtel_grand_share}}</td>
                                                <td>{{$config->robi_grand_share}}</td>
                                                <td>{{$config->bl_grand_share}}</td>
                                                <td>{{$config->teletalk_grand_share}}</td>
                                                <td><a href="{{route('config.edit',$config->id)}}"><span title="Edit" type="button" class="btn btn-flat btn-primary"><i
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
