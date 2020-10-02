<!DOCTYPE html>
<html>
<head>
    <title>Xosh Partner | Dashboard</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- Custom Theme files -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->

    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
    <!-- //web font -->

</head>
<body>

<!-- main -->
<div class="w3layouts-main">
    <div class="bg-layer">
        <h1>Partner Login</h1>
        <div class="header-main">
            <div class="main-icon">
                <img src="{{asset('dist/img/mmbd.png')}}">
            </div>
            <div class="header-left-bottom">
                <form action="{{ route('login') }}" method="POST">
                    @csrf


                    <div class="icon1">
                        <span class="fa fa-user"></span>
                        <input id="email" type="text" placeholder="Email or Phone" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:white">{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="icon1">
                        <span class="fa fa-lock"></span>
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="login-check">
                        <label class="checkbox"><input class="form-check-input" type="checkbox" name="remember" id="remember" checked {{ old('remember') ? 'checked' : '' }}><i> </i> Keep me logged in</label>
                    </div>
                    <div class="bottom">
                        <button type="submit" class="btn">Log In</button>
                    </div>
                    <div class="links">
                        @if (Route::has('password.request'))
                            <p><a href="{{ route('password.request') }}">Forgot Your Password?</a></p>
                        @endif
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- //main -->

</body>
</html>
