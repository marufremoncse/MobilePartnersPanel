@extends('admin.master')
@section('content')

        <section class="content-header">
            <h1>
                {{$page_name}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Profile</a></li>
                <li class="active">{{$page_name}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{asset($user->image)}}" alt="User profile picture">

                            <h3 class="profile-username text-center">{{$user->first_name}}&nbsp{{$user->last_name}}</h3>

                            <p class="text-muted text-center"></p>

                            <a href="{{route('dashboard')}}" class="btn btn-primary btn-block"><b>{{\App\Organization::where(['id'=>$user->organization_id])->pluck('organization_name')->first()}}</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- About Me Box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">About Me</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                            <p class="text-muted">{{$user->address}}</p>

                            <hr>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header with-border">
                            <h2 class="box-title">{{$page_name}}</h2>

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
                        @if($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{$message}}
                            </div>
                        @endif
                    <!-- form start -->
                        <form action="{{url('/profile/edit/'.$user->id)}}" method="post"
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
                                                <input type="text" id="name" name="first_name" value="{{$user->first_name}}"
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
                                                <input type="text" id="name" name="last_name" value="{{$user->last_name}}"
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

                                    <div class="form-group">
                                        <label class="col-sm-2  control-label"></label>
                                        <div class="col-sm-8">
                                            <input type="button" id="click_for_slow" name="" value="Update Password" class="btn btn-primary btn-block"/>
                                        </div>
                                    </div>

                                    <div style="display: none" id="showing_password" >
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

                                    <input type="hidden" name="organization_select" id="organization_select" value="{{$user->organization_id}} ">


                                    <div class="form-group  ">
                                        <label for="roles" class="col-sm-2  control-label">Profile Picture</label>
                                        <div class="col-sm-8">

                                            <input class="form-control" type="file" placeholder="Profile Picture" id="image" name="image">
                                        </div>
                                    </div>

                                    {{--<div class="form-group  ">
                                        <label for="roles" class="col-sm-2  control-label">Roles</label>
                                        <div class="col-sm-8">
                                            <select class="form-control input-sm roles select2"
                                                    data-placeholder="Select roles" style="width: 100%;" name="roles[]" multiple="multiple">

                                            </select>
                                        </div>
                                    </div>--}}



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
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
@endsection
