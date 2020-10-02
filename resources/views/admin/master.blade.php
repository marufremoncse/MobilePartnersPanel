<!DOCTYPE html>
<html>
<head>

@include('admin.header')

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div id="start_loader" class="class_start_loader"><img src="{{asset('dist/img/animated-loading-png-6.gif')}}" style="" alt="Loader"></div>
<div class="wrapper">
    <header class="main-header">
        @include('admin.top')
    </header>

    <!-- Left side column. contains the logo and sidebar -->

    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        @include('admin.navigation')
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        @include('admin.bottom')
    </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>

@include('admin.footer')

</body>
</html>
