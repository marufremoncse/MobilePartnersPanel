@extends('admin.master')
@section('content')
<div id="app">
    <section class="content-header">
        <h1>
            <i class="fa fa-plus" aria-hidden="true"></i> Add New {{$page_name}}
            <small></small>
        </h1>
        <div class="more_info"></div>
        <!-- breadcrumb start -->
        <ol class="breadcrumb">
            <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li> Add New {{$page_name}}</li>
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
                                <a href="{{route('organise.index')}}" class="btn  btn-flat btn-default"
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
                    <form action="{{route('organise.store')}}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"
                          enctype="multipart/form-data">
                    @csrf
                        {{method_field('POST')}}
                        <div class="box-body">
                            <div class="fields-group">

                                <div class="form-group">
                                    <label for="name" class="col-sm-2  control-label">Name</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="name" name="name" value=""
                                                   class="form-control name" placeholder="Name of the Organization"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group   ">
                                    <label for="email" class="col-sm-2  control-label">Email</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                            <input type="email" id="email" name="email" value=""
                                                   class="form-control email" placeholder="Email Address"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group   ">
                                    <label for="mobile" class="col-sm-2  control-label">Mobile</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="mobile" name="mobile" value=""
                                                   class="form-control fa-mobile -mobile" placeholder="Mobile Number"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group   ">
                                    <label for="address" class="col-sm-2  control-label">Address</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="address" name="address" value=""
                                                   class="form-control text" placeholder="Address"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group   ">
                                    <label for="website" class="col-sm-2  control-label">Website</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="website" name="website" value=""
                                                   class="form-control text" placeholder="Website"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="logo" class="col-sm-2  control-label">Company Logo</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                            <input class="form-control" type="file" placeholder="Logo" id="logo" name="logo">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="thumbnail" class="col-sm-2  control-label">Company Thumbnail</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                            <input class="form-control" type="file" placeholder="Thumbnail" id="thumbnail" name="thumbnail">
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

<script type="text/javascript">
    $("[name='top'],[name='status']").bootstrapSwitch();
</script>

<script type="text/javascript">

    $(document).ready(function() {
        $('.select2').select2()
    });
</script>
    @endsection
