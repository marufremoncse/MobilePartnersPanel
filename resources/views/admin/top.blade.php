<!-- Logo -->
<a href="{{url('/dashboard')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="{{asset(\App\Organization::where(['id'=>Auth::user()->organization_id])->pluck('organization_thumbnail')->first())}}" class="img-circle"
                                 alt="User Image"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="{{asset(\App\Organization::where(['id'=>Auth::user()->organization_id])->pluck('organization_logo')->first())}}"  alt="User Image"></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Xosh Partner</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="@php
                        if (File::exists(asset(Auth::user()->image))) {
                            echo asset(Auth::user()->image);
                        }
                        else{
                         echo asset('dist/img/avatar5.png');
                        }
                    @endphp" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{Auth::user()->first_name}}&nbsp{{Auth::user()->last_name}}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="@php
                            if (File::exists(asset(Auth::user()->image))) {
                                echo asset(Auth::user()->image);
                            }
                            else{
                             echo asset('dist/img/avatar5.png');
                            }
                        @endphp" class="img-circle" alt="User Image">
                        <p>
                            {{Auth::user()->first_name}}&nbsp{{Auth::user()->last_name}}
                        <small>{{\App\Organization::where(['id'=>Auth::user()->organization_id])->pluck('organization_name')->first()}}</small>
                        </p>
                    </li>

                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{{url('profile/'.Auth::user()->id)}}" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" >Log Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
        </ul>
    </div>
</nav>
