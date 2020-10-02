<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Xosh Partner | {{$page_name}}</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<style>
    th { font-size: 14px; }
    td { 
         font-size: 12px;
         padding-top: 1px !important;
         padding-bottom: 1px !important;
        }

    #start_loader{
        position: fixed;
        width: 100%;
        height: 100vh;
        background-color: rgb(184,199,206);
        z-index: 999999999;
    }
    .class_start_loader img{
        opacity: 0.7;
        width:5%;
        position:absolute;
        left: 45%;
        top: 45%;
    }

    .rTable {
        display: table;

    }
    .rTableRow {
        display: table-row;
    }
    .rTableHeading {
        display: table-header-group;
        background-color: #ddd;
    }
    .rTableCell, .rTableHead {
        display: table-cell;
        padding: 1px 10px;
        border: 1px solid #999999;
    }
    .rTableHeading {
        display: table-header-group;
        background-color: #ddd;
        font-weight: bold;
    }
    .rTableFoot {
        display: table-footer-group;
        font-weight: bold;
        background-color: #ddd;
    }
    .rTableHeading, .rTableBody, .rTableFoot, .rTableRow{
        clear: both;
    }
    .rTableHead, .rTableFoot{
        background-color: #DDD;
        font-weight: bold;
    }
    .rTableCell, .rTableHead {
        border: 1px solid #999999;
        height: 30px;

    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

</style>
<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/AdminLTE.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<!-- daterange picker -->
<link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">