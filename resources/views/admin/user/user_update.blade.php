@extends('admin.master')
@section('content')
    <div id="app">
        <section class="content-header">
            <h1>
                <i class="fa fa-plus" aria-hidden="true"></i> Update {{$page_name}}
                <small></small>
            </h1>
            <div class="more_info"></div>
            <!-- breadcrumb start -->
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li> Update {{$page_name}}</li>
            </ol>
            <!-- breadcrumb end -->
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h2 class="box-title">Update {{$page_name}}</h2>

                            <div class="box-tools">
                                <div class="btn-group pull-right" style="margin-right: 5px">
                                    <a href="{{route('user.index')}}" class="btn  btn-flat btn-default"
                                       title="List"><i class="fa fa-list"></i><span
                                            class="hidden-xs"> Back List</span></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        @if(count($errors)>0)
                            <div class="alert alert-danger"  role="alert">
                                <ul>
                                    @foreach($errors->all() as $errors)
                                        <li>{{$errors}}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <!-- form start -->
                        <form action="{{route('user.update',$user->id)}}" method="post"
                              accept-charset="UTF-8" class="form-horizontal" id="form-main"
                              enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="box-body">
                                <div class="fields-group">

                                    <div class="form-group">
                                        <label for="name" class="col-sm-2  control-label">First Name</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="first_name" name="first_name" value="{{$user->first_name}}"
                                                       class="form-control name" placeholder="First Name"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="col-sm-2  control-label">Last Name</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="last_name" name="last_name" value="{{$user->last_name}}"
                                                       class="form-control name" placeholder="Last Name"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-sm-2  control-label">Email</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                                <input type="email" id="email" name="email" value="{{$user->email}}"
                                                       class="form-control email" placeholder="Email"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile" class="col-sm-2  control-label">Mobile</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="mobile" name="mobile" value="{{$user->mobile}}"
                                                       class="form-control fa-mobile -mobile" placeholder="Mobile Number"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile" class="col-sm-2  control-label">Address</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="address" name="address" value="{{$user->address}}"
                                                       class="form-control" placeholder="Address"/>
                                            </div>
                                        </div>
                                    </div>

                                    @role('Super Admin')
                                    <div class="form-group ">
                                        <label for="roles" class="col-sm-2  control-label">Organization</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                            <select class="form-control input-sm roles "
                                                    data-placeholder="Select Organization" style="width: 100%;" name="organization_select" >
                                                @foreach($org_all as $all)
                                                    <option value="{{$all->id}}" {{$all->id == $user->organization_id  ? 'selected' : ''}}>{{$all->organization_name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <input type="hidden"  name="organization_select" value="{{Auth::user()->organization_id}}"/>
                                    @endrole

                                    <div class="form-group  ">
                                        <label for="roles" class="col-sm-2  control-label">Profile Picture</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                            <input class="form-control" type="file" placeholder="Profile Picture" id="image" name="image">
                                        </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-2  control-label"></label>
                                        <div class="col-sm-8">
                                            <input type="button" id="click_for_slow" name="" value="Update Password" class="btn btn-primary btn-block"/>
                                        </div>
                                    </div>

                                    <div style="display: none" id="showing_password">
                                        <div class="form-group">
                                            <label for="password" class="col-sm-2  control-label">Password</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="password" id="password" name="password" value=""
                                                           class="form-control password" placeholder="Password"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="col-sm-2  control-label">Confirmation</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="password" id="password_confirmation"
                                                           name="password_confirmation" value=""
                                                           class="form-control password_confirmation" placeholder="Confirm Password"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @role('Super Admin')
                                    <div class="form-group">
                                        <label for="roles_select" class="col-sm-2  control-label">Roles</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" id="for_all_select" name="role_select[]" multiple="multiple">
                                                @foreach($role_all as $roles)
                                                    <option value="{{$roles->id}}" @foreach($author_current_roles as $current)
                                                        {{$roles->id == $current  ? 'selected' : ''}}
                                                            @endforeach>{{$roles->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endrole

                                </div>
                            </div>


                            <!-- /.box-body -->

                            <div class="box-footer">
                                <div class="col-md-2">
                                </div>

                                <div class="col-md-8">
                                    <div class="btn-group pull-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                    <div class="btn-group pull-left">
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                    </div>
                                </div>
                            </div>

                            <!-- /.box-footer -->
                        </form>

                    </div>
                </div>
            </div>



        </section>
    </div>


@endsection
