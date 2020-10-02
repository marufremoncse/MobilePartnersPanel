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
                                        <form action="{{route('organise.index')}}" id="button_search">
                                        <form action="{{route('organise.index')}}" method="post" id="button_search">
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
                                    <div class="pull-right">

                                        <div class="btn-group pull-right" style="margin-right: 10px">
                                            <a href="{{route('organise.create')}}"
                                               class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                                                <i class="fa fa-plus"></i><span class="hidden-xs">Add new</span>
                                            </a>
                                        </div>
                                    </div>
         <div class="pull-left">
                    <button type="button" class="btn btn-default grid-select-all"><i
                            class="fa fa-square-o"></i></button> &nbsp;

                    <a class="btn   btn-flat btn-danger grid-trash" data-name="organise" title="Delete"><i class="fa fa-trash-o"></i><span
                            class="hidden-xs"> Delete</span></a> &nbsp;

                    <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i
                            class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;</div>

                    <form action="{{route('organise.index')}}" method="post">
                        @csrf
                        {{method_field("get")}}

                       <div class="btn-group pull-left">
                        <div class="form-group">
                            <select class="form-control" id="order_sort" name="sort_select">
                                <option value="id,desc">User ID desc</option>
                                <option value="id,asc">User ID asc</option>
                                <option value="organization_name,desc">Name desc</option>
                                <option value="organization_name,asc">Name asc</option>
                                <option value="organization_email,desc">Email desc</option>
                                <option value="organization_email,asc">Email asc</option>
                                <option value="organization_mobile,desc">Mobile desc</option>
                                <option value="organization_mobile,asc">Mobile asc</option>
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
                                                <th></th>
                                                <th>ID</th>
                                                <th>Thumbnail</th>
                                                <th>Logo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Website</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($org_all as $all)
                                                <tr>
                                                    <td><input type="checkbox" form="user_delete_form" name = "user_check[]" id="user_check_{{$all->id}}" class="grid-row-checkbox" data-id="{{$all->id}}"></td>
                                                    <td>{{$all->id}}</td>
                                                    <td><img src="{{URL::asset($all->organization_thumbnail)}}" alt="thumbnail" height="20" width="20"></td>
                                                    <td><img src="{{URL::asset($all->organization_logo)}}" alt="logo" height="20" width="20"></td>

                                                    <td>{{$all->organization_name}}</td>
                                                    <td>{{$all->organization_email}}</td>
                                                    <td>{{$all->organization_mobile}}</td>
                                                    <td>{{$all->organization_address}}</td>
                                                    <td>{{$all->organization_website}}</td>
                                                    <td>
                                                        <a href="{{route('organise.edit',$all->id)}}"><span title="Edit" type="button"
                                                                         class="btn btn-flat btn-primary"><i
                                                                    class="fa fa-edit"></i></span></a>&nbsp;
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-footer clearfix">
                                        Showing <b>1</b> to <b>1</b> of <b>1</b> items</b>
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                            <!-- Previous Page Link -->
                                            <li class="page-item disabled"><span
                                                    class="page-link pjax-container">&laquo;</span></li>

                                            <!-- Pagination Elements -->
                                            <!-- "Three Dots" Separator -->

                                            <!-- Array Of Links -->
                                            <li class="page-item active"><span class="page-link pjax-container">1</span>
                                            </li>

                                            <!-- Next Page Link -->
                                            <li class="page-item disabled"><span
                                                    class="page-link pjax-container">&raquo;</span></li>
                                        Showing <b>1</b> to <b>1</b> of <b>1</b> <b>items</b>
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                            {{ $org_all->links() }}
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
