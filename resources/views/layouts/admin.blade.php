<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <meta charset="utf-8" />
    <title>Metronic | Dashboard</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:prismjs300,400,500,600,700" />

    <link href="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.css?v=7.0.6') }}" rel="stylesheet"
        type="text/css" />

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('assets/admin/css/themes/layout/header/base/light.css?v=7.0.6') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/header/menu/light.css?v=7.0.6') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/brand/dark.css?v=7.0.6') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/aside/dark.css?v=7.0.6') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="{{ asset('assets/public/images/favicon.png') }}" />

    <style>
        #kt_wrapper {
            padding-bottom: 60px !important;
        }

        /* Prevent horizontal overflow that reveals the offcanvas sidebar */
        html,
        body {
            overflow-x: hidden !important;
            position: relative;
        }

        .flex-root {
            overflow-x: hidden !important;
        }
    </style>
    @stack('styles')
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <!--begin::Logo-->
        <a href="{{ route('admin.dashboard')}}">
            <img alt="Logo" width="130px" src="{{ asset('assets/public/images/gulf-medical-logo.png') }}" />
        </a>
        <!--end::Logo-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle-->

            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                <!--begin::Brand-->
                <div class="brand flex-column-auto" id="kt_brand">
                    <!--begin::Logo-->
                    <a href="{{ route('admin.dashboard')}}" class="brand-logo">
                        <img alt="Logo" width="150px" src="{{ asset('assets/public/images/gulf-medical-logo.png') }}" />
                    </a>
                    <!--end::Logo-->

                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                    <path
                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </button>
                    <!--end::Toolbar-->
                </div>
                <!--end::Brand-->

                <!--begin::Aside Menu-->
                <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                    <!--begin::Menu Container-->
                    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
                        data-menu-dropdown-timeout="500">
                        <!--begin::Menu Nav-->
                        <ul class="menu-nav">
                            <!-- ========================================================= -->
                            <!-- DASHBOARD -->
                            <!-- ========================================================= -->
                            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.dashboard')}}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <!-- Dashboard Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                <path
                                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Dashboard</span>
                                </a>
                            </li>

                            <!-- ========================================================= -->
                            <!-- SECTION: VISA & APPOINTMENTS -->
                            <!-- ========================================================= -->
                            <li class="menu-section">
                                <h4 class="menu-text">Visa & Appointments</h4>
                                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                            </li>

                            <!-- Wafid Appointments -->
                            <li class="menu-item menu-item-submenu {{ request()->routeIs('admin.appointments*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('admin.appointments') }}" class="menu-link menu-toggle">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M6,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,5 C4,3.8954305 4.8954305,3 6,3 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M10,12 L11,12 C11.5522847,12 12,12.4477153 12,13 L12,14 C12,14.5522847 11.5522847,15 11,15 L10,15 C9.44771525,15 9,14.5522847 9,14 L9,13 C9,12.4477153 9.44771525,12 10,12 Z M14,12 L15,12 C15.5522847,12 16,12.4477153 16,13 L16,14 C16,14.5522847 15.5522847,15 15,15 L14,15 C13.4477153,15 13,14.5522847 13,14 L13,13 C13,12.4477153 13.4477153,12 14,12 Z M10,16 L11,16 C11.5522847,16 12,16.4477153 12,17 L12,18 C12,18.5522847 11.5522847,19 11,19 L10,19 C9.44771525,19 9,18.5522847 9,18 L9,17 C9,16.4477153 9.44771525,16 10,16 Z M14,16 L15,16 C15.5522847,16 16,16.4477153 16,17 L16,18 C16,18.5522847 15.5522847,19 15,19 L14,19 C13.4477153,19 13,18.5522847 13,18 L13,17 C13,16.4477153 13.4477153,16 14,16 Z"
                                                    fill="#000000" />
                                                <rect fill="#000000" x="8" y="2" width="2" height="4" rx="1" />
                                                <rect fill="#000000" x="14" y="2" width="2" height="4" rx="1" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Wafid Appointments</span>
                                    @if($wafid_new > 0)
                                        <span class="menu-label">
                                            <span
                                                class="label label-danger label-inline font-weight-bold">{{ $wafid_new }}</span>
                                        </span>
                                    @endif
                                </a>
                            </li>

                            <!-- Special Appointments -->
                            <li class="menu-item menu-item-submenu {{ request()->routeIs('admin.special.appointments*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('admin.special.appointments') }}" class="menu-link menu-toggle">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path
                                                    d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path
                                                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Special Appointments</span>
                                    @if($special_new > 0)
                                        <span class="menu-label">
                                            <span
                                                class="label label-danger label-inline font-weight-bold">{{ $special_new }}</span>
                                        </span>
                                    @endif
                                </a>
                            </li>

                            <!-- Tasheer Appointments -->
                            <li class="menu-item menu-item-submenu {{ request()->routeIs('admin.tasheer.appointments*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('admin.tasheer.appointments') }}" class="menu-link menu-toggle">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M13,18.9450712 L13,20 L14,20 C14.5522847,20 15,20.4477153 15,21 C15,21.5522847 14.5522847,22 14,22 L10,22 C9.44771525,22 9,21.5522847 9,21 C9,20.4477153 9.44771525,20 10,20 L11,20 L11,18.9450712 C6.50326515,18.4585255 3,14.632911 3,10 C3,5.02943725 7.02943725,1 12,1 C16.9705627,1 21,5.02943725 21,10 C21,14.632911 17.4967348,18.4585255 13,18.9450712 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M12,5 C10.3431458,5 9,6.34314575 9,8 C9,9.65685425 10.3431458,11 12,11 C13.6568542,11 15,9.65685425 15,8 C15,6.34314575 13.6568542,5 12,5 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Tasheer Appointments</span>
                                    @if($tasheer_new > 0)
                                        <span class="menu-label">
                                            <span
                                                class="label label-danger label-inline font-weight-bold">{{ $tasheer_new }}</span>
                                        </span>
                                    @endif
                                </a>
                            </li>

                            <!-- NAVTTC Appointments -->
                            <li class="menu-item menu-item-submenu {{ request()->routeIs('admin.navtech.appointments*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('admin.navtech.appointments') }}" class="menu-link menu-toggle">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <path d="M12,2 L2,7 L12,12 L22,7 L12,2 Z" fill="#000000" />
                                                <path
                                                    d="M12,15 L2,10 L2,17 C2,18.7 6.5,22 12,22 C17.5,22 22,18.7 22,17 L22,10 L12,15 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">NAVTTC Appointments</span>
                                    @if($navtech_new > 0)
                                        <span class="menu-label">
                                            <span
                                                class="label label-danger label-inline font-weight-bold">{{ $navtech_new }}</span>
                                        </span>
                                    @endif
                                </a>
                            </li>

                            <!-- ========================================================= -->
                            <!-- SECTION: REQUESTS & CERTIFICATES -->
                            <!-- ========================================================= -->
                            <li class="menu-section">
                                <h4 class="menu-text">Requests & Certificates</h4>
                                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                            </li>

                            <!-- Medical Results Requests -->
                            <li class="menu-item menu-item-submenu {{ request()->routeIs('admin.checkResults*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('admin.checkResults') }}" class="menu-link menu-toggle">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M11,19 L13,19 L13,17 L11,17 L11,19 Z M11,15 L13,15 L13,7 L11,7 L11,15 Z"
                                                    fill="#000000" />
                                                <rect fill="#000000" x="10" y="2" width="4" height="2" rx="1" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Medical Results</span>
                                    @if($medical_new > 0)
                                        <span class="menu-label">
                                            <span
                                                class="label label-danger label-inline font-weight-bold">{{ $medical_new }}</span>
                                        </span>
                                    @endif
                                </a>
                            </li>

                            <!-- Soft Skill Certificates -->
                            <li class="menu-item menu-item-submenu {{ request()->routeIs('admin.softskill.appointments*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('admin.softskill.appointments') }}" class="menu-link menu-toggle">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M12,11 C14.209139,11 16,9.209139 16,7 C16,4.790861 14.209139,3 12,3 C9.790861,3 8,4.790861 8,7 C8,9.209139 9.790861,11 12,11 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M10,13 C10,12.4477153 10.4477153,12 11,12 L13,12 C13.5522847,12 14,12.4477153 14,13 L14,21.4354132 L12.551699,20.501509 C12.2072615,20.2792945 11.7701764,20.2825852 11.4287813,20.5101815 L10,21.4627254 L10,13 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Soft Skill Certificates</span>
                                    @if($softskill_new > 0)
                                        <span class="menu-label">
                                            <span
                                                class="label label-danger label-inline font-weight-bold">{{ $softskill_new }}</span>
                                        </span>
                                    @endif
                                </a>
                            </li>

                            <!-- Contact Inquiries -->
                            <li class="menu-item {{ request()->routeIs('admin.contacts') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.contacts')}}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <!-- Mail Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M5.90869686,5.09311267 C5.59005085,5.27503164 5.48011276,5.67988358 5.66203173,5.99852959 L11.1620317,15.6318629 C11.370211,15.9965042 11.8384214,16.0827181 12.1629858,15.8239019 L18.1629858,11.0399019 C18.4529007,10.8087053 18.528343,10.3860088 18.3312015,10.0682619 L12.3312015,3.96826192 C12.0292523,3.66129992 11.5363388,3.66649836 11.2396102,3.97992982 L5.90869686,5.09311267 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path d="M12,14.6 L6.5,8 L17.5,8 L12,14.6 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Contact Inquiries</span>
                                    @if($contact_new > 0)
                                        <span class="menu-label">
                                            <span
                                                class="label label-danger label-inline font-weight-bold">{{ $contact_new }}</span>
                                        </span>
                                    @endif
                                </a>
                            </li>

                            <li class="menu-section">
                                <h4 class="menu-text">Medical Centers</h4>
                                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                            </li>

                            <!-- Medical Centers -->
                            <li class="menu-item {{ (request()->routeIs('admin.medical_centers*') || request()->routeIs('admin.city_media*')) ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.medical_centers.index') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M5,21 L19,21 C19.5522847,21 20,20.5522847 20,20 L20,8 L18,8 L18,20 L6,20 L6,5 L11,5 L11,3 L5,3 C4.44771525,3 4,3.44771525 4,4 L4,20 C4,20.5522847 4.44771525,21 5,21 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path d="M14,3 L14,7 C14,7.55228475 14.4477153,8 15,8 L19,8 L14,3 Z"
                                                    fill="#000000" />
                                                <path
                                                    d="M11,11 L13,11 L13,13 L15,13 L15,15 L13,15 L13,17 L11,17 L11,15 L9,15 L9,13 L11,13 L11,11 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Medical Centers</span>
                                </a>
                            </li>


                            <li class="menu-section">
                                <h4 class="menu-text">Blogs Management</h4>
                                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                            </li>

                            <!-- Blog Categories -->
                            <li class="menu-item {{ request()->routeIs('admin.blog.categories*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.blog.categories') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                <path
                                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Categories</span>
                                </a>
                            </li>

                            <!-- Blogs -->
                            <li class="menu-item {{ request()->routeIs('admin.blogs*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.blogs.index') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M3,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,18 C22,19.1045695 21.1045695,20 20,20 L3,20 C1.8954305,20 1,19.1045695 1,18 L1,6 C1,4.8954305 1.8954305,4 3,4 Z M3,6 L3,18 L20,18 L20,6 L3,6 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M4,8 L10,8 L10,14 L4,14 L4,8 Z M12,8 L19,8 L19,10 L12,10 L12,8 Z M12,12 L19,12 L19,14 L12,14 L12,12 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Blogs</span>
                                </a>
                            </li>

                            <!-- ========================================================= -->
                            <!-- SECTION: SETTINGS -->
                            <!-- ========================================================= -->
                            <li class="menu-section">
                                <h4 class="menu-text">Settings</h4>
                                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                            </li>

                            <!-- Website Settings -->
                            <li class="menu-item {{ request()->routeIs('admin.settings*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.settings.index') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                                                    fill="#000000" />
                                                <path
                                                    d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Website Settings</span>
                                    @if($feedback_new > 0)
                                        <span class="menu-label">
                                            <span
                                                class="label label-danger label-inline font-weight-bold sidebar-feedback-badge">{{ $feedback_new }}</span>
                                        </span>
                                    @endif
                                </a>
                            </li>

                            <!-- Traffic Analytics -->
                            <li class="menu-item {{ request()->routeIs('admin.analytics') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.analytics') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                                <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Traffic Analytics</span>
                                </a>
                            </li>

                            <!-- Payment Methods -->
                            <li class="menu-item {{ request()->routeIs('admin.payment.methods*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.payment.methods.index') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="2" y="5" width="20" height="14"
                                                    rx="2" />
                                                <rect fill="#000000" x="2" y="8" width="20" height="3" />
                                                <rect fill="#000000" opacity="0.3" x="16" y="14" width="4" height="2"
                                                    rx="1" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Payment Methods</span>
                                </a>
                            </li>

                            <!-- Appointment Fees -->
                            <li class="menu-item {{ request()->routeIs('admin.fees*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.fees.edit') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="2" y="6" width="20" height="12"
                                                    rx="2" />
                                                <circle fill="#000000" cx="12" cy="12" r="3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Appointment Fees</span>
                                </a>
                            </li>

                            <!-- FAQs -->
                            <li class="menu-item {{ request()->routeIs('admin.faqs*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.faqs.page') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776219,3 C21.8728676,3 23.0039377,4.13107011 23.0039377,5.52631579 L23.0039377,13.1052632 C23.0039377,14.5005089 21.8728676,15.6315789 20.4776219,15.6315789 L16,15.6315789 Z"
                                                    fill="#000000" />
                                                <rect fill="#000000" opacity="0.3" x="2" y="9" width="15" height="12"
                                                    rx="2" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">FAQs</span>
                                </a>
                            </li>

                            <!-- My Profile -->
                            <li class="menu-item {{ request()->routeIs('admin.profile*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.profile.edit') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path
                                                    d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path
                                                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">My Profile</span>
                                </a>
                            </li>

                            <!-- Sign Out -->
                            <li class="menu-item" aria-haspopup="true">
                                <a href="javascript:;"
                                    onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();"
                                    class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55835733 13.0069431,6.00607258 C13.0069431,5.45378783 13.4546584,5.00607258 14.0069431,5.00607258 L14.0069431,5.00607258 L19.0069431,5.00607258 C20.1115126,5.00607258 21.0069431,5.90150308 21.0069431,7.00607258 L21.0069431,17.0060726 C21.0069431,18.1106421 20.1115126,19.0060726 19.0069431,19.0060726 L14.0069431,19.0060726 C13.4546584,19.0060726 13.0069431,18.5583573 13.0069431,18.0060726 C13.0069431,17.4537878 13.4546584,17.0060726 14.0069431,17.0060726 L19.0069431,17.0060726 L19.0069431,7.00607258 L14.0069431,7.00607258 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path
                                                    d="M10.1260846,12.4285741 L7.0347394,12.4285741 C6.48245465,12.4285741 6.0347394,11.9808589 6.0347394,11.4285741 C6.0347394,10.8762894 6.48245465,10.4285741 7.0347394,10.4285741 L10.1260846,10.4285741 L10.1260846,7.40455919 C10.1260846,6.85227444 10.5737998,6.40455919 11.1260846,6.40455919 C11.3912198,6.40455919 11.6455113,6.5099307 11.83305,6.69746944 L15.7563148,10.6207343 C15.9383679,10.8027874 16.0347394,11.0453775 16.0347394,11.2941011 C16.0347394,11.5428247 15.9383679,11.7854148 15.7563148,11.9674679 L11.83305,15.8907328 C11.4425257,16.2812571 10.8093608,16.2812571 10.4188365,15.8907328 C10.2312977,15.7031941 10.1260846,15.4489026 10.1260846,15.1837674 L10.1260846,12.4285741 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="menu-text">Sign Out</span>
                                </a>
                                <form id="sidebar-logout-form" action="{{ route('admin.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>


                        </ul>
                        <!--end::Menu Nav-->
                    </div>
                    <!--end::Menu Container-->
                </div>
                <!--end::Aside Menu-->
            </div>
            <!--end::Aside-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header header-fixed">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">

                        <!-- START: Global Greeting Message -->
                        <div class="align-items-center mr-4 d-none d-sm-none d-md-flex" style="display: none;">
                            <span class="text-dark-75 font-weight-bolder font-size-h5">
                                @php
                                    date_default_timezone_set('Asia/Karachi');
                                    $hour = date('H');
                                    $greeting = ($hour < 12) ? 'Good Morning' : (($hour < 18) ? 'Good Afternoon' : 'Good Evening');
                                @endphp
                                {{ $greeting }}, {{ Auth::user()->name }}
                            </span>
                        </div>
                        <style>
                            @media (min-width: 768px) {
                                .d-md-flex[style*="display: none"] {
                                    display: flex !important;
                                }
                            }
                        </style>

                        <!--begin::Topbar-->
                        <div class="topbar">

                            <!--begin::User-->
                            <div class="topbar-item">
                                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                                    id="kt_quick_user_toggle">
                                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                        @if(Auth::user()->avatar)
                                            <img src="{{ asset(Auth::user()->avatar) }}" class="h-100 align-self-end"
                                                alt="" />
                                        @else
                                            <span
                                                class="symbol-label font-size-h5 font-weight-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->

                @yield('content')

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->

    <!-- begin::User Panel-->
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
        <!--begin::Header-->
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0">
                User Profile
            </h3>
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <!--end::Header-->

        <!--begin::Content-->
        <div class="offcanvas-content pr-5 mr-n5">
            <!--begin::Header-->
            <div class="d-flex align-items-center mt-5">
                <div class="symbol symbol-100 mr-5">
                    <!-- Dynamic Avatar -->
                    <div class="symbol-label"
                        style="background-image: url('{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('assets/admin/media/users/default.jpg') }}');">
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <!-- Dynamic Name and Link to Profile -->
                    <a href="{{ route('admin.profile.edit') }}"
                        class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                        {{ Auth::user()->name }}
                    </a>

                    <!-- Role or Email -->
                    <div class="text-muted mt-1">
                        Admin
                    </div>

                    <div class="navi mt-2">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign
                                Out</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Separator-->
            <div class="separator separator-dashed mt-8 mb-5"></div>
            <!--end::Separator-->

            <!--begin::Nav-->
            <div class="navi navi-spacer-x-0 p-0">
                <!--begin::Item-->
                <a href="{{ route('admin.profile.edit') }}" class="navi-item">
                    <div class="navi-link">
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-success">
                                    <!-- Svg Icon... (Keep your existing SVG here) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                fill="#000000" />
                                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold">
                                My Profile
                            </div>
                            <div class="text-muted">
                                Account settings and more
                            </div>
                        </div>
                    </div>
                </a>
                <!--end:Item-->

            </div>
            <!--end::Nav-->
        </div>
        <!--end::Content-->
    </div>
    <!-- end::User Panel-->

    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            breakpoints: {
                sm: 576,
                md: 768,
                lg: 992,
                xl: 1200,
                xxl: 1400,
            },
            colors: {
                theme: {
                    base: {
                        white: "#ffffff",
                        primary: "#3699FF",
                        secondary: "#E5EAEE",
                        success: "#1BC5BD",
                        info: "#8950FC",
                        warning: "#FFA800",
                        danger: "#F64E60",
                        light: "#E4E6EF",
                        dark: "#181C32",
                    },
                    light: {
                        white: "#ffffff",
                        primary: "#E1F0FF",
                        secondary: "#EBEDF3",
                        success: "#C9F7F5",
                        info: "#EEE5FF",
                        warning: "#FFF4DE",
                        danger: "#FFE2E5",
                        light: "#F3F6F9",
                        dark: "#D6D6E0",
                    },
                    inverse: {
                        white: "#ffffff",
                        primary: "#ffffff",
                        secondary: "#3F4254",
                        success: "#ffffff",
                        info: "#ffffff",
                        warning: "#ffffff",
                        danger: "#ffffff",
                        light: "#464E5F",
                        dark: "#ffffff",
                    },
                },
                gray: {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32",
                },
            },
            "font-family": "Poppins",
        };
    </script>
    <!--end::Global Config-->

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js?v=7.0.6') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts.bundle.js?v=7.0.6') }}"></script>
    <!--end::Global Theme Bundle-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/admin/js/pages/widgets.js?v=7.0.6') }}"></script>
    <!--end::Page Scripts-->

    <script src="{{asset('assets/admin/plugins/custom/datatables/datatables.bundle.js?v=7.0.6')}}"></script>
    <!--begin::Page Scripts(used by this page)-->

    @stack('scripts')

    <!-- START: Auto-Scroll Sidebar Script -->
    <script>
        $(document).ready(function () {
            // 1. Identify the Sidebar Container
            var $sidebar = $('#kt_aside_menu');

            // 2. Identify the Active Menu Item
            var $activeItem = $sidebar.find('.menu-item-active');

            // 3. If an active item exists, scroll to it
            if ($activeItem.length > 0) {
                // Calculate the position:
                // (Item's position inside sidebar) + (Current Sidebar Scroll) - (Half of Sidebar Height to center it)
                var scrollTo = $activeItem.offset().top - $sidebar.offset().top + $sidebar.scrollTop() - ($sidebar.height() / 2);

                // Animate the scroll
                $sidebar.animate({
                    scrollTop: scrollTo
                }, 300); // 300ms animation speed
            }
        });
    </script>

    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>