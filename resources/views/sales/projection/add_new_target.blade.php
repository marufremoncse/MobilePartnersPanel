@extends('admin.master')
@section('content')
<div id="app">
    <section class="content-header">
        <h1>
            <i class="fa fa-plus" aria-hidden="true"></i> Add {{$page_name}}
            <small></small>
        </h1>
        <div class="more_info"></div>
        <!-- breadcrumb start -->
        <ol class="breadcrumb">
            <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li> Add {{$page_name}}</li>
        </ol>
        <!-- breadcrumb end -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="box-title"> {{$page_name}}</h2>

                        <div class="box-tools">
                            <div class="btn-group pull-right" style="margin-right: 5px">
                                <a href="{{url('sales/projection')}}" class="btn  btn-flat btn-default"
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
                    <form action="{{url('sales/projection/store')}}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"
                          enctype="multipart/form-data">
                    @csrf
                        <div class="box-body">
                            <div class="fields-group">

                                <div class="form-group  ">
                                    <label for="roles" class="col-sm-2  control-label">Brand</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                            <select class="form-control input-sm roles "
                                                    data-placeholder="Select Brand" style="width: 100%;" name="brand_select" >
                                                @foreach($brand_all as $brands)
                                                    <option value="{{$brands->brand}}">{{$brands->brand}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group   ">
                                    <label for="model" class="col-sm-2  control-label">Model</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="model" name="model" value=""
                                                   class="form-control text" placeholder="Model"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group   ">
                                    <label for="target" class="col-sm-2  control-label">Target</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                            <input type="number" id="target" name="target" value=""
                                                   class="form-control text" placeholder="Target"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="lot_number" class="col-sm-2  control-label">Lot Number</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                            <input type="number" id="lot_number" name="lot_number" value=""
                                                   class="form-control text" placeholder="Lot Number"/>
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
