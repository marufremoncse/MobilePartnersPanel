@extends('admin.master')
@section('content')
    <div id="app">
        <section class="content-header">
            <h1>
                <i class="fa fa-plus" aria-hidden="true"></i> Add new {{$page_name}}
                <small></small>
            </h1>
            <div class="more_info"></div>
            <!-- breadcrumb start -->
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>Add new {{$page_name}}</li>
            </ol>
            <!-- breadcrumb end -->
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h2 class="box-title">Create a new {{$page_name}}</h2>

                            <div class="box-tools">
                                <div class="btn-group pull-right" style="margin-right: 5px">
                                    <a href="{{route('role.index')}}" class="btn  btn-flat btn-default" title="List"><i
                                                class="fa fa-list"></i><span class="hidden-xs"> Back List</span></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        @if(count($errors)>0)
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach($errors->all() as $errors)
                                        <li>{{$errors}}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <!-- form start -->
                        <form action="{{route('role.store')}}" method="post" accept-charset="UTF-8"
                              class="form-horizontal" id="form-main" enctype="multipart/form-data">
                            @csrf
                            {{method_field('post')}}
                            <div class="box-body">
                                <div class="fields-group">

                                    <div class="form-group   ">
                                        <label for="name" class="col-sm-2  control-label">Name</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="name" name="name" value=""
                                                       class="form-control name" placeholder=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group   ">
                                        <label for="slug" class="col-sm-2  control-label">Slug</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="slug" name="slug" value=""
                                                       class="form-control slug" placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="for_all_select" class="col-sm-2  control-label">Select
                                            permission</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                            <select class="form-control select2" id="for_all_select"
                                                    name="permission_select[]" multiple="multiple">
                                                @foreach($permission_all as $permission)
                                                    <option value="{{$permission->id}}">{{$permission->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
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