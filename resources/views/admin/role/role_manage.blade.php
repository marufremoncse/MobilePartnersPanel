@extends('admin.master')
@section('content')
    <div id="app">
        <section class="content-header">
            <h1>
                <i class="fa fa-indent" aria-hidden="true"></i> {{$page_name}}
                <small></small>
            </h1>
            <div class="more_info"></div>
            <!-- breadcrumb start -->
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>{{$page_name}}</li>
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
                            <div class="pull-right">

                                <div class="btn-group pull-right" style="margin-right: 10px">
                                    <a href="{{route('role.create')}}" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                                        <i class="fa fa-plus"></i><span class="hidden-xs">Add new</span>
                                    </a>
                                </div>
                            </div>



         <div class="pull-left">
                    <button type="button" class="btn btn-default grid-select-all"><i class="fa fa-square-o"></i></button> &nbsp;

                    <a class="btn   btn-flat btn-danger grid-trash" data-name="role" title="Delete"><i class="fa fa-trash-o"></i><span class="hidden-xs"> Delete</span></a> &nbsp;

                    <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;</div>


                       <div class="btn-group pull-left">
                        <div class="form-group">
                           <select class="form-control" id="order_sort">
                            <option   value="id__desc">ID desc</option>
                               <option   value="id__asc">ID asc</option>
                               <option   value="name__desc">Name desc</option>
                               <option   value="name__asc">Name asc</option>
                           </select>
                         </div>
                       </div>

                       <div class="btn-group pull-left">
                           <a class="btn btn-flat btn-primary" title="Sort" id="button_sort">
                              <i class="fa fa-sort-amount-asc"></i><span class="hidden-xs"> Sort</span>
                           </a>
                       </div>

                        </div>
                        <!-- /.box-header -->
                        <section id="pjax-container" class="table-list">
                            <div class="box-body table-responsive no-padding" >
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Slug</th>
                                        <th>Name</th>
                                        <th>Permission</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($role_all as $role)
                                    <tr>
                                        <td><input type="checkbox" class="grid-row-checkbox" data-id="{{$role->id}}"></td>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>@php
                                                $all = $role->getAllPermissions()
                                            @endphp
                                            @foreach($all as $all)
                                                <ul>
                                                    <li class="label label-primary">{{$all->name}}</li>
                                                </ul>
                                            @endforeach</td>
                                        <td>{{$role->created_at}}</td>
                                        <td>{{$role->updated_at}}</td>
                                        <td>
                                            <a href="{{route('role.edit',$role->id)}}"><span title="Edit" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;
                                            <span onclick="deleteItem({{$role->id}});"  title="Delete" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span></td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer clearfix">
                                Showing <b>1</b> to <b>6</b> of <b>6</b> items</b>
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    <!-- Previous Page Link -->
                                    <li class="page-item disabled"><span class="page-link pjax-container">&laquo;</span></li>

                                    <!-- Pagination Elements -->
                                    <!-- "Three Dots" Separator -->

                                    <!-- Array Of Links -->
                                    <li class="page-item active"><span class="page-link pjax-container">1</span></li>

                                    <!-- Next Page Link -->
                                    <li class="page-item disabled"><span class="page-link pjax-container">&raquo;</span></li>
                                </ul>

                            </div>
                        </section>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection