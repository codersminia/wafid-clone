<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Admin Login - Gulf Medical Consultants</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

    <!-- Page Custom Styles (Updated to Login-1) -->
    <link href="{{ asset('assets/admin/css/pages/login/classic/login-1.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Global Styles -->
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="{{ asset('assets/public/images/favicon.png') }}"/>
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
            
            <!--begin::Aside (Left Side Image)-->
            <div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10" style="background-color: #1e1e2d;">
                <div class="d-flex flex-row-fluid flex-column justify-content-between">
                    <!-- Logo -->
                    <a href="{{ route('admin.dashboard') }}" class="flex-column-auto mt-5 pb-lg-0 pb-10">
                        <img src="{{ asset('assets/public/images/gulf-medical-logo.png') }}" width="200px" class="max-h-70px" alt="Logo"/>
                    </a>

                    <!-- Welcome Text -->
                    <div class="flex-column-fluid d-flex flex-column justify-content-center">
                        <h3 class="font-size-h1 mb-5 text-white">Welcome to Dashboard!</h3>
                        <p class="font-weight-lighter text-white opacity-80">
                            Admin Management Dashboard.<br>Please login to continue.
                        </p>
                    </div>

                    <!-- Footer -->
                    <div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
                        <div class="opacity-70 font-weight-bold text-white">
                            &copy; {{ date('Y') }} GMC
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Aside-->

            <!--begin::Content (Right Side Form)-->
            <div class="flex-row-fluid d-flex flex-column position-relative p-7 overflow-hidden">
                
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
                    
                    <!--begin::Signin-->
                    <div class="login-form login-signin">
                        <div class="text-center mb-10 mb-lg-20">
                            <h3 class="font-size-h1">Sign In</h3>
                            <p class="text-muted font-weight-bold">Enter your email and password</p>
                        </div>

                        <!-- Global Error Message -->
                        @error('credential')
                            <div class="alert alert-custom alert-light-danger fade show mb-5 p-2" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                <div class="alert-text">{{ $message }}</div>
                            </div>
                        @enderror

                        <!--begin::Form-->
                        <form class="form" id="kt_login_signin_form" method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf
                            
                            <!-- Email -->
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-5 px-6 @error('email') is-invalid @enderror" type="text" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off"/>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-5 px-6 @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" autocomplete="off"/>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Actions (Remember Me & Forgot Password) -->
                            <div class="form-group d-flex flex-wrap justify-content-end align-items-center">
                                <!-- <a href="javascript:;" class="text-dark-50 text-hover-primary my-3 mr-2" id="kt_login_forgot">
                                    Forgot Password ?
                                </a> -->
                                <button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Sign In</button>
                            </div>

                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->

                    <!--begin::Forgot Password-->
                    <div class="login-form login-forgot d-none">
                        <div class="text-center mb-10 mb-lg-20">
                            <h3 class="font-size-h1">Forgotten Password ?</h3>
                            <p class="text-muted font-weight-bold">Enter your email to reset your password</p>
                        </div>

                        <form class="form" id="kt_login_forgot_form">
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-5 px-6" type="email" placeholder="Email" name="email" autocomplete="off"/>
                            </div>
                            <div class="form-group d-flex flex-wrap flex-center">
                                <button id="kt_login_forgot_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Submit</button>
                                <button id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-4">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!--end::Forgot Password-->

                </div>
                <!--end::Content body-->

                <!--begin::Content footer for mobile-->
                <div class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
                    <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">
                        &copy; {{ date('Y') }} GMC
                    </div>
                </div>
                <!--end::Content footer for mobile-->

            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->

    <!-- Scripts -->
    <script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js?v=7.0.6') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts.bundle.js?v=7.0.6') }}"></script>

    <!-- Custom Logic to handle Form Toggles and Submit (No Animations) -->
    <script>
        "use strict";
        jQuery(document).ready(function() {
            
            var login = $('#kt_login');
            var signinForm = $('.login-signin');
            var forgotForm = $('.login-forgot');

            // 1. Handle Sign In Submit
            $('#kt_login_signin_submit').on('click', function(e) {
                e.preventDefault();
                $('#kt_login_signin_form').submit(); 
            });

            // 2. Show Forgot Password Form (Instant Switch)
            $('#kt_login_forgot').on('click', function(e) {
                e.preventDefault();
                
                // Hide Sign In
                signinForm.addClass('d-none');
                
                // Show Forgot
                forgotForm.removeClass('d-none');
                
                // Switch Parent Class
                login.removeClass('login-signin-on').addClass('login-forgot-on');
            });

            // 3. Cancel Forgot Password (Back to Login - Instant Switch)
            $('#kt_login_forgot_cancel').on('click', function(e) {
                e.preventDefault();

                // Hide Forgot
                forgotForm.addClass('d-none');

                // Show Sign In
                signinForm.removeClass('d-none');

                // Switch Parent Class
                login.removeClass('login-forgot-on').addClass('login-signin-on');
            });

        });
    </script>

</body>
</html>