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
                                <a href="{{route('permission.create')}}" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                                    <i class="fa fa-plus"></i><span class="hidden-xs">Add new</span>
                                </a>
                            </div>
                        </div>

                <div class="pull-left">
                    <button type="button" class="btn btn-default grid-select-all"><i
                                class="fa fa-square-o"></i></button> &nbsp;

                    <a class="btn   btn-flat btn-danger grid-trash" data-name="permission" title="Delete"><i class="fa fa-trash-o"></i><span
                                class="hidden-xs"> Delete</span></a> &nbsp;

                    <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i
                                class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;
                     </div>


                        <form action="{{route('user.index')}}" method="post">
                            @csrf
                            {{method_field("get")}}
                            <div class="btn-group pull-left">
                                <div class="form-group">
                                    <select class="form-control" id="order_sort" name="sort_select">
                                        <option value="id,desc">User ID desc</option>
                                        <option value="id,asc">User ID asc</option>
                                        <option value="first_name,desc">Name desc</option>
                                        <option value="first_name,asc">Name asc</option>
                                        <option value="email,desc">Email desc</option>
                                        <option value="email,asc">Email asc</option>
                                        <option value="mobile,desc">Mobile desc</option>
                                        <option value="mobile,asc">Mobile asc</option>
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
                        <div class="box-body table-responsive no-padding" >
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Slug</th>
                                    <th>Name</th>
                                    <th>Method</th>
                                    <th>HTTP path</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permission_all as $permission)
                                <tr>
                                    <td><input type="checkbox" class="grid-row-checkbox" data-id="{{$permission->id}}"></td>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->slug}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td><span class="label label-info">{{\App\Route_list::where(['id'=>$permission->http])->pluck('method')->first()}}</span></td>
                                       <td> <code>{{\App\Route_list::where(['id'=>$permission->http])->pluck('http')->first()}}</code></td>
                                    <td>{{$permission->updated_at}}</td>
                                    <td>
                                        <a href="{{route('permission.edit',$permission->id)}}"><span title="Edit" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;
                                        <span onclick="deleteItem({{$permission->id}});"  title="Delete" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer clearfix">

                        </div>
                    </section>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>

@endsection