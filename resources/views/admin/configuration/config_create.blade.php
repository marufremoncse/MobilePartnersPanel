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
                                    <a href="{{route('config.index')}}" class="btn  btn-flat btn-default"
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
                        <form action="{{route('config.store')}}" method="post"
                              accept-charset="UTF-8" class="form-horizontal" id="form-main"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="fields-group">

                                    <div class="form-group">
                                        <label for="org_id" class="col-sm-2  control-label">Organization ID</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="org_id" name="org_id" value=""
                                                       class="form-control number" placeholder="Organization ID"/>
                                            </div>
                                        </div>

                                        <label for="btrc" class="col-sm-2  control-label">BTRC Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="btrc" name="btrc" value=""
                                                       class="form-control name" placeholder="BTRC Share"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group   ">
                                        <label for="gp_share" class="col-sm-2  control-label">Grameenphone Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="gp_share" name="gp_share" value=""
                                                       class="form-control number" placeholder="Grameenphone Share"/>
                                            </div>
                                        </div>

                                        <label for="airtel_share" class="col-sm-2  control-label">Airtel Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="airtel_share" name="airtel_share" value=""
                                                       class="form-control number" placeholder="Airtel Share"/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="robi_share" class="col-sm-2  control-label">Robi Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="robi_share" name="robi_share" value=""
                                                       class="form-control number" placeholder="Robi Share"/>
                                            </div>
                                        </div>

                                        <label for="bl_share" class="col-sm-2  control-label">Banglalink Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="bl_share" name="bl_share" value=""
                                                       class="form-control number" placeholder="Banglalink Share"/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="teletalk_share" class="col-sm-2  control-label">Teletalk Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="teletalk_share" name="teletalk_share" value=""
                                                       class="form-control number" placeholder="Teletalk Share"/>
                                            </div>
                                        </div>

                                        <label for="discrepancy" class="col-sm-2  control-label">Discrepancy</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="discrepancy" name="discrepancy" value=""
                                                       class="form-control number" placeholder="Discrepancy"/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="ait" class="col-sm-2  control-label">AIT</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="ait" name="ait" value=""
                                                       class="form-control number" placeholder="AIT"/>
                                            </div>
                                        </div>

                                        <label for="billing_fee" class="col-sm-2  control-label">Billing Fee</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="billing_fee" name="billing_fee" value=""
                                                       class="form-control number" placeholder="Billing Fee"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="partner_share" class="col-sm-2  control-label">Partner Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="partner_share" name="partner_share" value=""
                                                       class="form-control number" placeholder="Partner Share"/>
                                            </div>
                                        </div>

                                        <label for="vat" class="col-sm-2  control-label">VAT</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="vat" name="vat" value=""
                                                       class="form-control number" placeholder="VAT"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label for="gp_grand_share" class="col-sm-2  control-label">Grameenphone Grand Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="gp_grand_share" name="gp_grand_share" value=""
                                                       class="form-control number" placeholder="Grameenphone Grand Share"/>
                                            </div>
                                        </div>

                                        <label for="airtel_grand_share" class="col-sm-2  control-label">Airtel Grand Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="airtel_grand_share" name="airtel_grand_share" value=""
                                                       class="form-control number" placeholder="Airtel Grand Share"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">


                                        <label for="robi_grand_share" class="col-sm-2  control-label">Robi Grand Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="robi_grand_share" name="robi_grand_share" value=""
                                                       class="form-control number" placeholder="Robi Grand Share"/>
                                            </div>
                                        </div>

                                        <label for="bl_grand_share" class="col-sm-2  control-label">Banglalink Grand Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="bl_grand_share" name="bl_grand_share" value=""
                                                       class="form-control number" placeholder="Banglalink Grand Share"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="teletalk_grand_share" class="col-sm-2  control-label">Teletalk Grand Share</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="teletalk_grand_share" name="teletalk_grand_share" value=""
                                                       class="form-control number" placeholder="Teletalk Grand Share"/>
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
