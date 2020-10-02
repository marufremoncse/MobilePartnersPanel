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
                                        <form action="#" method="post" id="button_search">
                                            @csrf
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

         <div class="pull-left">
                    <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i
                            class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;</div>


                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a href="{{url('sales/projection/create')}}"
                               class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                                <i class="fa fa-plus"></i><span class="hidden-xs">Add new</span>
                            </a>
                        </div>

                    {{--<div class="pull-right">
                    <a href="{{ route('export') }}" class="btn   btn-flat btn-danger" title="Export Data"><i
                            class="fa fa-download"></i><span class="hidden-xs"> Export Data</span></a> &nbsp;</div>--}}



                    <form action="{{url('sales/projection')}}" method="post">
                        @csrf
                        {{method_field("get")}}

                       <div class="btn-group pull-left">
                        <div class="form-group">
                            <select class="form-control" id="order_sort" name="sort_select">
                                <option value="projection_id,desc">Projection ID desc</option>
                                <option value="projection_id,asc">Projection ID asc</option>
                                <option value="brand,desc">Brand desc</option>
                                <option value="brand,asc">Brand asc</option>
                                <option value="model,desc">Model desc</option>
                                <option value="model,asc">Model asc</option>
                                <option value="device_type,desc">Device Type desc</option>
                                <option value="device_type,asc">Device Type asc</option>
                                <option value="created_at,desc">Time desc</option>
                                <option value="created_at,asc">Time asc</option>
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
                                <section id="pjax-container" class="table-list">
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>SL No.</th>
                                                <th>Brand</th>
                                                <th>Model</th>
                                                <th>Device Type</th>
                                                <th>Target</th>
                                                <th>Active</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach($table_all as $all)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{\App\Organization::where(['id'=>$all->organization_id])->pluck('organization_name')->first()}}</td>
                                                    <td>{{$all->model}}</td>
                                                    <td>{{$all->device_type}}</td>
                                                    <td>{{\Illuminate\Support\Facades\DB::table('projections')->where('model',$all->model)->pluck('projection')->first()}}</td>
                                                    <td>{{$all->count}}</td>
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
