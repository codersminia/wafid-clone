<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

    <!-- Page Custom Styles -->
    <link href="{{ asset('assets/admin/css/pages/login/classic/login-4.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/favicon.ico') }}"/>
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

<div class="d-flex flex-column flex-root">
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('assets/admin/media/bg/bg-3.jpg') }}');">
            <div class="login-form text-center p-7 position-relative overflow-hidden">

                <!-- Logo -->
                <div class="d-flex flex-center">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('assets/admin/media/logos/gmc_logo.png') }}" width="150px" height="150px" alt=""/>
                    </a>
                </div>

                <!-- Sign In Form -->
                <div class="login-signin">
                    <div class="mb-20">
                        <h3>Sign In To Admin</h3>
                        <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                    </div>
                        
                    @error('credential')
                        <div class="alert alert-danger">
                            <span class="d-block">{{ $message }}</span>
                        </div>
                    @enderror                                                                    

                    <form class="form" id="kt_login_signin_form" method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror" type="text" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off" />
                            @error('email')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" />
                            @error('password')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                            <div class="checkbox-inline">
                                <label class="checkbox m-0 text-muted">
                                    <input type="checkbox" name="remember" /> <span></span> Remember me
                                </label>
                            </div>
                            <a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary">Forget Password ?</a>
                        </div>

                        <button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
                    </form>
                </div>

                <!-- Forgot Password Form -->
                <div class="login-forgot">
                    <div class="mb-20">
                        <h3>Forgotten Password ?</h3>
                        <div class="text-muted font-weight-bold">Enter your email to reset your password</div>
                    </div>
                    <form class="form" id="kt_login_forgot_form">
                        <div class="form-group mb-10">
                            <input class="form-control form-control-solid h-auto py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off"/>
                        </div>
                        <div class="form-group d-flex flex-wrap flex-center mt-10">
                            <button id="kt_login_forgot_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Request</button>
                            <button id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js?v=7.0.6') }}"></script>
<script src="{{ asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
<script src="{{ asset('assets/admin/js/scripts.bundle.js?v=7.0.6') }}"></script>

<script>
    "use strict";
    jQuery(document).ready(function() {
        // Remove JS SweetAlert interception for sign-in
        $('#kt_login_signin_submit').on('click', function() {
            $('#kt_login_signin_form').submit(); // normal Laravel form submit
        });

        // Handle forgot password form toggle
        $('#kt_login_forgot').on('click', function(e) {
            e.preventDefault();
            $('#kt_login').removeClass('login-signin-on').addClass('login-forgot-on');
        });
        $('#kt_login_forgot_cancel').on('click', function(e) {
            e.preventDefault();
            $('#kt_login').removeClass('login-forgot-on').addClass('login-signin-on');
        });
    });
</script>

</body>
</html>
