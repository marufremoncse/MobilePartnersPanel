<section class="sidebar">
    <form action="" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
        <li class="active"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span>
                <span class="pull-right-container">     </span></a></li>

        @role('Company Admin|Super Admin')
        <li class="header">ADMINISTRATION</li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-adn"></i>
                <span>Admin</span>
                <span class="pull-right-container">  <i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('user.index')}}"><i class="fa fa-users"></i>Users</a></li>
                @role('Super Admin')
                <li><a href="{{route('role.index')}}"><i class="fa fa-user"></i>Roles</a></li>
                <li><a href="{{route('permission.index')}}"><i class="fa fa-ban"></i>Permissions</a></li>
                @endrole
            </ul>
        </li>
        @endrole

        @role('Super Admin|Integration')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i>
                <span>Editor</span>
                <span class="pull-right-container">  <i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{url('/editor-inhouse')}}"><i class="fa fa-star"></i>Activation</a></li>
                <li><a href="{{url('/editor-inhouse-search-list')}}"><i class="fa fa-search"></i>MO Search</a></li>
            </ul>
        </li>


        <li class="treeview">
            <a href="#">
                <i class="fa fa-circle-o-notch"></i>
                <span>Configurations</span>
                <span class="pull-right-container">  <i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('games-details.index')}}"><i class="fa fa-users"></i>Game Keyword Conf</a></li>
                <li><a href="{{route('config.index')}}"><i class="fa fa-cog"></i>OEM Rev Conf</a></li>
            </ul>
        </li>
        @endrole

        @role('Super Admin')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-shopping-bag"></i>
                <span>Business Organization</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('organise.index')}}"><i class="fa fa-object-group"></i>Manage Organization</a></li>
                <li><a href="#"><i class="fa fa-address-card"></i>Device Activation</a></li>
                <li><a href="#"><i class="fa fa-money"></i>Revenue</a></li>

            </ul>
        </li>
        @endrole

        @can('Company Can View')
        <li class="header">REPORTS MANAGEMENT</li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Device Activation</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{url('sales/projection')}}"><i class="fa fa-bar-chart"></i>Projection</a></li>
                <li><a href="{{url('sales/activation')}}"><i class="fa fa-signal"></i>Activation Dashboard</a></li>
                <li class="treeview"><a href="#"><i class="fa fa-line-chart"></i> <span>Reports</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('downloads')}}"><i class="fa fa-download"></i>Downloads</a></li>
                        <li><a href="{{route('active')}}"><i class="fa fa-star"></i>Total Active</a></li>
                        <li><a href="{{route('models')}}"><i class="fa fa-plus-square"></i>Total Models</a></li>
                        <li><a href="{{route('smart')}}"><i class="fa fa-tablet"></i>Total Smart Phones</a></li>
                        <li><a href="{{route('feature')}}"><i class="fa fa-calculator"></i>Total Feature Phones</a></li>

                    </ul></li>

            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-money"></i>
                <span>Revenue</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{url('revenue/games')}}"><i class="fa fa-dollar"></i>Revenue Dashboard</a></li>
                <li class="treeview"><a href="#"><i class="fa fa-line-chart"></i> <span>Reports</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('/revenue/report')}}"><i class="fa fa-money"></i>Revenue Details</a></li>
                        <li><a href="{{url('/revenue/total-game')}}"><i class="fa fa-gamepad"></i>Game Wise Revenue</a></li>
                        <li><a href="{{url('/revenue/total-revenue')}}"><i class="fa fa-bar-chart"></i>Month Wise Revenue</a></li>
                    </ul></li>
            </ul>
        </li>
        @endcan

    </ul>
</section>
<div class="control-sidebar-bg"></div>