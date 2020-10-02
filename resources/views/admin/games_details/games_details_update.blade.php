@extends('admin.master')
@section('content')
    <div id="app">
        <section class="content-header">
            <h1>
                <i class="fa fa-plus" aria-hidden="true"></i>{{$page_name}}
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
                            <h2 class="box-title">{{$page_name}}</h2>

                            <div class="box-tools">
                                <div class="btn-group pull-right" style="margin-right: 5px">
                                    <a href="{{route('games-details.index')}}" class="btn  btn-flat btn-default"
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
                        <form action="{{route('games-details.update',$table_all->id)}}" method="post"
                              accept-charset="UTF-8" class="form-horizontal" id="form-main"
                              enctype="multipart/form-data">

                            @csrf
                            {{method_field('put')}}
                            <div class="box-body">
                                <div class="fields-group">
                                    <div class="form-group">
                                        <label for="org_id" class="col-sm-2  control-label">Company/OEM Name</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <select class="form-control input-sm"
                                                        data-placeholder="Select Organization" style="width: 100%;" name="org_id" >
                                                    @foreach($org_all as $all)
                                                        <option value="{{$all->id}}" {{$all->id == $table_all->organization_id  ? 'selected' : ''}}>{{$all->organization_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="brand" class="col-sm-2  control-label">Brand</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="brand" name="brand" value="{{$table_all->brand}}"
                                                       class="form-control name" placeholder="Brand"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="keyword" class="col-sm-2  control-label">Keyword</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="keyword" name="keyword" value="{{$table_all->keyword}}"
                                                       class="form-control name" placeholder="Keyword"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_keyword" class="col-sm-2  control-label">Sub Keyword</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="sub_keyword" name="sub_keyword" value="{{$table_all->sub_keyword}}"
                                                       class="form-control name" placeholder="Sub Keyword"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="game_provider" class="col-sm-2  control-label">Game Provider</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" name="game_provider" list="game_provider_data_list"
                                                       class="form-control name" placeholder="Game Provider" value="{{$table_all->game_provider}}"/>
                                                <datalist  id="game_provider_data_list">
                                                    @foreach($game_provider as $all)
                                                        <option value="{{$all->game_provider}}" >{{$all->game_provider}}</option>
                                                    @endforeach

                                                </datalist >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="org_id" class="col-sm-2  control-label">Device Type</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <select class="form-control input-sm"
                                                        data-placeholder="Select device type" style="width: 100%;" name="device_type" >
                                                    <option value="Smart Phone" {{"Smart Phone"==$all->device_type ? 'selected':''}}>Smart Phone</option>
                                                    <option value="Feature Phone" {{"Feature Phone"==$all->device_type ? 'selected':''}}>Feature Phone</option>
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
