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
        
        <link href="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />

        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/plugins/custom/prismjs/.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->

        <!--begin::Layout Themes(used by all pages)-->        
        <link href="{{ asset('assets/admin/css/themes/layout/header/base/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/css/themes/layout/header/menu/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/css/themes/layout/brand/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />        
        <link href="{{ asset('assets/admin/css/themes/layout/aside/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
        <!--end::Layout Themes-->

        <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/favicon.ico') }}" />
    </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

        <!--begin::Main-->
        <!--begin::Header Mobile-->
        <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
            <!--begin::Logo-->
            <a href="index.html">                        
                <img alt="Logo" src="{{ asset('assets/admin/media/logos/logo-light.png') }}" />
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
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path
                                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                    fill="#000000"
                                    fill-rule="nonzero"
                                />
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
                            <img alt="Logo" src="{{ asset('assets/admin/media/logos/logo-light.png') }}" />
                        </a>
                        <!--end::Logo-->

                        <!--begin::Toggle-->
                        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                            <span class="svg-icon svg-icon svg-icon-xl">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                            fill="#000000"
                                            fill-rule="nonzero"
                                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "
                                        />
                                        <path
                                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                            fill="#000000"
                                            fill-rule="nonzero"
                                            opacity="0.3"
                                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "
                                        />
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
                        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav">
                                <li class="menu-item menu-item-active" aria-haspopup="true">
                                    <a href="{{ route('admin.dashboard')}}" class="menu-link">
                                        <span class="svg-icon menu-icon">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <path
                                                        d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                        fill="#000000"
                                                        fill-rule="nonzero"
                                                    />
                                                    <path
                                                        d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                        fill="#000000"
                                                        opacity="0.3"
                                                    />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="menu-section">
                                    <h4 class="menu-text">Modules</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <!-- Wafid Appointments - Calendar Icon -->
                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{ route('admin.appointments') }}" class="menu-link menu-toggle">
                                        <span class="svg-icon menu-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M6,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,5 C4,3.8954305 4.8954305,3 6,3 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M10,12 L11,12 C11.5522847,12 12,12.4477153 12,13 L12,14 C12,14.5522847 11.5522847,15 11,15 L10,15 C9.44771525,15 9,14.5522847 9,14 L9,13 C9,12.4477153 9.44771525,12 10,12 Z M14,12 L15,12 C15.5522847,12 16,12.4477153 16,13 L16,14 C16,14.5522847 15.5522847,15 15,15 L14,15 C13.4477153,15 13,14.5522847 13,14 L13,13 C13,12.4477153 13.4477153,12 14,12 Z M10,16 L11,16 C11.5522847,16 12,16.4477153 12,17 L12,18 C12,18.5522847 11.5522847,19 11,19 L10,19 C9.44771525,19 9,18.5522847 9,18 L9,17 C9,16.4477153 9.44771525,16 10,16 Z M14,16 L15,16 C15.5522847,16 16,16.4477153 16,17 L16,18 C16,18.5522847 15.5522847,19 15,19 L14,19 C13.4477153,19 13,18.5522847 13,18 L13,17 C13,16.4477153 13.4477153,16 14,16 Z" fill="#000000" />
                                                    <rect fill="#000000" x="8" y="2" width="2" height="4" rx="1" />
                                                    <rect fill="#000000" x="14" y="2" width="2" height="4" rx="1" />
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="menu-text">Wafid Appointments</span>
                                    </a>                                    
                                </li>    

                                <!-- Special Appointments - Star/Featured Icon -->
                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{ route('admin.special.appointments') }}" class="menu-link menu-toggle">
                                        <span class="svg-icon menu-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                    <path d="M12,18 L7.91561965,20.1473306 C7.46691658,20.383193 6.92404156,20.2113514 6.68817915,19.7626483 C6.59905581,19.593134 6.5652611,19.3986421 6.59105509,19.2086909 L7.37084192,13.4756515 L3.18182788,9.39202111 C2.79375745,9.01368681 2.77884488,8.38053644 3.14833215,7.98394639 C3.28438268,7.8378516 3.46363065,7.74205513 3.66065586,7.71344406 L9.41685657,6.87700345 L11.9902641,1.66352016 C12.2217524,1.19476228 12.7876807,1.00684157 13.2564385,1.2383298 C13.435728,1.32655323 13.5833443,1.4741695 13.6715677,1.653459 L16.2449752,6.86694229 L22,7.70338291 C22.5186638,7.7787343 22.876793,8.26189912 22.7999948,8.78044733 C22.7713837,8.9736173 22.6775691,9.1501708 22.5332219,9.28441113 L18.3442079,13.1680415 L19.1239947,18.9010809 C19.1944888,19.4184714 18.8358461,19.8974558 18.3223007,19.9705988 C18.1306121,19.997871 17.9344473,19.965415 17.7632615,19.8775619 L12,16.8926944 L12,18 Z" fill="#000000" opacity="0.3"/>
                                                    <path d="M12,16.8926944 L7.91561965,19.0354153 C7.46691658,19.2712777 6.92404156,19.0994361 6.68817915,18.650733 C6.59905581,18.4812187 6.5652611,18.2867268 6.59105509,18.0967756 L7.37084192,12.3637362 L3.18182788,8.28010582 C2.79375745,7.90177152 2.77884488,7.26862115 3.14833215,6.87203109 C3.28438268,6.7259363 3.46363065,6.63013983 3.66065586,6.60152877 L9.41685657,5.76508816 L11.9902641,0.551604862 C12.2217524,0.0828469853 12.7876807,-0.105073719 13.2564385,0.126414515 C13.435728,0.214637949 13.5833443,0.362254212 13.6715677,0.54154371 L16.2449752,5.755027 L22,6.59146761 C22.5186638,6.66681901 22.876793,7.14998383 22.7999948,7.66853204 C22.7713837,7.86170201 22.6775691,8.03825551 22.5332219,8.17249583 L18.3442079,12.0561262 L19.1239947,17.7891656 C19.1944888,18.3065561 18.8358461,18.7855405 18.3223007,18.8586835 C18.1306121,18.8859557 17.9344473,18.8535 17.7632615,18.7656466 L12,15.7807792 L12,16.8926944 Z" fill="#000000"/>
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="menu-text">Special Appointments</span>
                                    </a>                                    
                                </li>                            

                                <!-- Medical Results Requests - Clipboard/Analysis Icon -->
                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{ route('admin.checkResults') }}" class="menu-link menu-toggle">
                                        <span class="svg-icon menu-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M11,19 L13,19 L13,17 L11,17 L11,19 Z M11,15 L13,15 L13,7 L11,7 L11,15 Z" fill="#000000" />
                                                    <rect fill="#000000" x="10" y="2" width="4" height="2" rx="1" />
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="menu-text">Medical Results Requests</span>
                                    </a>                                    
                                </li> 

                                <!-- NAVTTC Appointments - Education/Cap Icon -->
                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{ route('admin.navtech.appointments') }}" class="menu-link menu-toggle">
                                        <span class="svg-icon menu-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <path d="M12,2 L2,7 L12,12 L22,7 L12,2 Z" fill="#000000" />
                                                    <path d="M12,15 L2,10 L2,17 C2,18.7 6.5,22 12,22 C17.5,22 22,18.7 22,17 L22,10 L12,15 Z" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="menu-text">NAVTTC Appointments</span>
                                    </a>                                    
                                </li> 

                                <!-- Tasheer Appointments - Globe/Travel Icon -->
                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{ route('admin.tasheer.appointments') }}" class="menu-link menu-toggle">
                                        <span class="svg-icon menu-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M13,18.9450712 L13,20 L14,20 C14.5522847,20 15,20.4477153 15,21 C15,21.5522847 14.5522847,22 14,22 L10,22 C9.44771525,22 9,21.5522847 9,21 C9,20.4477153 9.44771525,20 10,20 L11,20 L11,18.9450712 C6.50326515,18.4585255 3,14.632911 3,10 C3,5.02943725 7.02943725,1 12,1 C16.9705627,1 21,5.02943725 21,10 C21,14.632911 17.4967348,18.4585255 13,18.9450712 Z" fill="#000000" opacity="0.3"/>
                                                    <path d="M12,5 C10.3431458,5 9,6.34314575 9,8 C9,9.65685425 10.3431458,11 12,11 C13.6568542,11 15,9.65685425 15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"/>
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="menu-text">Tasheer Appointments</span>
                                    </a>                                    
                                </li> 

                                <!-- Soft Skill Certificates - Award Icon -->
                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{ route('admin.softskill.appointments') }}" class="menu-link menu-toggle">
                                        <span class="svg-icon menu-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M12,11 C14.209139,11 16,9.209139 16,7 C16,4.790861 14.209139,3 12,3 C9.790861,3 8,4.790861 8,7 C8,9.209139 9.790861,11 12,11 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M10,13 C10,12.4477153 10.4477153,12 11,12 L13,12 C13.5522847,12 14,12.4477153 14,13 L14,21.4354132 L12.551699,20.501509 C12.2072615,20.2792945 11.7701764,20.2825852 11.4287813,20.5101815 L10,21.4627254 L10,13 Z" fill="#000000" />
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="menu-text">Soft Skill Certificates</span>
                                    </a>                                    
                                </li>

                                <!-- Payment Methods (Keeping your existing good one) -->
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ route('admin.payment.methods.index') }}" class="menu-link">
                                        <span class="svg-icon menu-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <rect fill="#000000" opacity="0.3" x="2" y="5" width="20" height="14" rx="2" />
                                                    <rect fill="#000000" x="2" y="8" width="20" height="3" />
                                                    <rect fill="#000000" opacity="0.3" x="16" y="14" width="4" height="2" rx="1" />
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="menu-text">Payment Methods</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ route('admin.fees.edit') }}" class="menu-link">
                                        <span class="svg-icon menu-icon">
                                            <!-- Banknote Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <!-- Faded Card Background -->
                                                    <rect fill="#000000" opacity="0.3" x="2" y="6" width="20" height="12" rx="2"/>
                                                    <!-- Solid Circle/Dollar Center -->
                                                    <circle fill="#000000" cx="12" cy="12" r="3"/>
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="menu-text">Appointment Fees</span>
                                    </a>
                                </li>

                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ route('admin.faqs.page') }}" class="menu-link">
                                        <span class="svg-icon menu-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <!-- The Bubble -->
                                                    <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776219,3 C21.8728676,3 23.0039377,4.13107011 23.0039377,5.52631579 L23.0039377,13.1052632 C23.0039377,14.5005089 21.8728676,15.6315789 20.4776219,15.6315789 L16,15.6315789 Z" fill="#000000"/>
                                                    <!-- The Question Mark / Dot -->
                                                    <rect fill="#000000" opacity="0.3" x="2" y="9" width="15" height="12" rx="2"/>
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="menu-text">FAQs</span>
                                    </a>
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
                        <div class="container-fluid d-flex align-items-stretch justify-content-end">
                            <!--begin::Topbar-->
                            <div class="topbar">

                                <!--begin::User-->
                                <div class="topbar-item">
                                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">Sean</span>
                                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                            <span class="symbol-label font-size-h5 font-weight-bold">S</span>
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
                        <div class="symbol-label" style="background-image: url('{{ asset('assets/admin/media/users/300_21.jpg')}}');"></div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                            James Jones
                        </a>
                        <div class="text-muted mt-1">
                            Admin 
                        </div>
                        <div class="navi mt-2">                        
                            <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</button>
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
                    <a href="custom/apps/user/profile-1/personal-information.html" class="navi-item">
                        <div class="navi-link">
                            <div class="symbol symbol-40 bg-light mr-3">
                                <div class="symbol-label">
                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                    fill="#000000"
                                                />
                                                <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
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

        <!--end::Page Scripts-->
    </body>
    <!--end::Body-->
</html>
