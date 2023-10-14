<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <!-- Bootstrap css-->
{{--        <link rel="stylesheet" type="text/css" href="{{asset('vendor/programmeruz/laravel-creator/css/vendors/bootstrap.css')}}">--}}
        <!-- App css-->
{{--        <link rel="stylesheet" type="text/css" href="{{asset('vendor/programmeruz/laravel-creator/css/style.css')}}">--}}
{{--        <link id="color" rel="stylesheet" href="{{asset('vendor/programmeruz/laravel-creator/css/color-1.css')}}" media="screen">--}}
        <!-- Responsive css-->
{{--        <link rel="stylesheet" type="text/css" href="{{asset('vendor/programmeruz/laravel-creator/css/responsive.css')}}">--}}
        <!-- Styles -->
        <style>

        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        <form class="theme-form login-form">
                            <h4>Login</h4>
                            <h6>Welcome back! Log in to your account.</h6>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="email" required="" placeholder="Test@gmail.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="login[password]" required="" placeholder="*********">
                                    <div class="show-hide"><span class="show">                         </span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">Remember password</label>
                                </div><a class="link" href="forget-password.html">Forgot password?</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                            </div>
                            <div class="login-social-title">
                                <h5>Sign in with</h5>
                            </div>
                            <div class="form-group">
                                <ul class="login-social">
                                    <li><a href="https://www.linkedin.com" target="_blank"><i data-feather="linkedin"></i></a></li>
                                    <li><a href="https://twitter.com" target="_blank"><i data-feather="twitter"></i></a></li>
                                    <li><a href="https://www.facebook.com" target="_blank"><i data-feather="facebook"></i></a></li>
                                    <li><a href="https://www.instagram.com" target="_blank"><i data-feather="instagram">                  </i></a></li>
                                </ul>
                            </div>
                            <p>Don't have account?<a class="ms-2" href="sign-up.html">Create Account</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
