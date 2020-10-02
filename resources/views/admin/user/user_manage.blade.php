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
                                        <form action="{{route('user.index')}}" id="button_search">
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
                                            <a href="{{route('user.create')}}"
                                               class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                                                <i class="fa fa-plus"></i><span class="hidden-xs">Add new</span>
                                            </a>
                                        </div>
                                    </div>

                     <div class="pull-left">
                    <button type="button" class="btn btn-default grid-select-all"><i
                            class="fa fa-square-o"></i></button> &nbsp;

                    <a class="btn   btn-flat btn-danger grid-trash" data-name="user" title="Delete"><i class="fa fa-trash-o"></i><span
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
                                <div id="table_data">
                                <section id="pjax-container" class="table-list">
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Profile Picture</th>
                                                <th>Organization</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Roles</th>
                                                <th>Permission</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($user_all as $user)
                                                <tr>
                                                    @if($user->id == Auth::user()->id)
                                                        <th></th>
                                                    @else
                                                    <td><input type="checkbox" form="user_delete_form" name="user_check[]"
                                                               id="user_check_{{$user->id}}" class="grid-row-checkbox"
                                                               data-id="{{$user->id}}"></td>
                                                    @endif

                                                    <td><img src="{{URL::asset($user->image)}}" alt="profile Pic" height="50" width="50"></td>
                                                    <td>{{\App\Organization::where(['id'=>$user->organization_id])->pluck('organization_name')->first()}}</td>
                                                    <td>{{$user->first_name}}&nbsp{{$user->last_name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->mobile}}</td>
                                                    <td>{{$user->address}}</td>
                                                    <td><span class="label label-success"></span></td>
                                                    <td> <span class="label label-success"></span></td>
                                                    <td>{{$user->created_at}}</td>
                                                    <td>
                                                        @role('Super Admin')
                                                        <a href="{{route('user.edit',$user->id)}}"><span title="Edit"
                                                                                                         type="button"
                                                                                                         class="btn btn-flat btn-primary"><i
                                                                        class="fa fa-edit"></i></span></a>&nbsp;
                                                        @else
                                                        <a href="{{url('profile/'.$user->id)}}"><span title="Edit"
                                                                                                         type="button"
                                                                                                         class="btn btn-flat btn-primary"><i
                                                                        class="fa fa-edit"></i></span></a>&nbsp;
                                                        @endrole
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="box-footer clearfix">
                                        Showing <b>1</b> to <b>1</b> of <b>1</b> <b>items</b>
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                           {{ $user_all->links() }}
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
