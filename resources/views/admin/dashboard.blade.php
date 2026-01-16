@extends('layouts.admin')
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            
            <!--begin::Dashboard Header-->
            <div class="d-flex align-items-center justify-content-between mb-5">
                <div>
                    <h3 class="font-weight-bolder text-dark mb-0">Overview</h3>
                    <small class="text-muted font-size-lg">Here is what's happening today</small>
                </div>
                <!-- Optional: Date Widget -->
                <div class="d-flex align-items-center">
                    <span class="text-muted font-weight-bold mr-2">{{ date('F d, Y') }}</span>
                    <span class="symbol symbol-light-primary symbol-35">
                        <span class="symbol-label font-weight-bolder">{{ date('D') }}</span>
                    </span>
                </div>
            </div>

            <!-- ROW 1: Primary Modules (Solid Backgrounds) -->
            <div class="row">
                <!-- Wafid Appointments -->
                <div class="col-xl-4 col-md-6">
                    <div class="card card-custom bg-primary card-stretch gutter-b">
                        <!-- Background Shape -->
                        <div class="position-absolute right-0 top-0 h-100 w-100 bgi-no-repeat bgi-position-y-top bgi-position-x-right" 
                             style="background-image: url({{ asset('assets/admin/media/svg/shapes/abstract-1.svg') }}); opacity: 0.1;"></div>
                        
                        <div class="card-body">
                            <a href="{{ route('admin.appointments') }}" class="card-title font-weight-bold text-white font-size-h4 mb-3 d-block hover-white">
                                Wafid Appointments
                            </a>
                            <div class="d-flex align-items-center justify-content-between mt-5">
                                <div class="">
                                    <span class="text-white-50 font-weight-bold d-block">Total Records</span>
                                    <span class="text-white font-weight-bolder font-size-h1">{{ $stats['wafid']['total'] }}</span>
                                </div>
                                <div class="">
                                    @if($stats['wafid']['new'] > 0)
                                        <span class="label label-white label-text-primary label-inline font-weight-bolder py-4 px-5 font-size-h6">
                                            +{{ $stats['wafid']['new'] }} New
                                        </span>
                                    @else
                                        <span class="symbol symbol-light-white symbol-45">
                                            <span class="symbol-label">
                                                <i class="flaticon2-check-mark text-primary"></i>
                                            </span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tasheer Appointments -->
                <div class="col-xl-4 col-md-6">
                    <div class="card card-custom bg-success card-stretch gutter-b">
                         <div class="position-absolute right-0 top-0 h-100 w-100 bgi-no-repeat bgi-position-y-top bgi-position-x-right" 
                             style="background-image: url({{ asset('assets/admin/media/svg/shapes/abstract-2.svg') }}); opacity: 0.1;"></div>

                        <div class="card-body">
                            <a href="{{ route('admin.tasheer.appointments') }}" class="card-title font-weight-bold text-white font-size-h4 mb-3 d-block hover-white">
                                Tasheer Appointments
                            </a>
                            <div class="d-flex align-items-center justify-content-between mt-5">
                                <div class="">
                                    <span class="text-white-50 font-weight-bold d-block">Total Records</span>
                                    <span class="text-white font-weight-bolder font-size-h1">{{ $stats['tasheer']['total'] }}</span>
                                </div>
                                <div class="">
                                    @if($stats['tasheer']['new'] > 0)
                                        <span class="label label-white label-text-success label-inline font-weight-bolder py-4 px-5 font-size-h6">
                                            +{{ $stats['tasheer']['new'] }} New
                                        </span>
                                    @else
                                        <span class="symbol symbol-light-white symbol-45">
                                            <span class="symbol-label">
                                                <i class="flaticon2-check-mark text-success"></i>
                                            </span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Special Appointments -->
                <div class="col-xl-4 col-md-6">
                    <div class="card card-custom bg-warning card-stretch gutter-b">
                         <div class="position-absolute right-0 top-0 h-100 w-100 bgi-no-repeat bgi-position-y-top bgi-position-x-right" 
                             style="background-image: url({{ asset('assets/admin/media/svg/shapes/abstract-4.svg') }}); opacity: 0.2;"></div>

                        <div class="card-body">
                            <a href="{{ route('admin.special.appointments') }}" class="card-title font-weight-bold text-white font-size-h4 mb-3 d-block hover-white">
                                Special Appointments
                            </a>
                            <div class="d-flex align-items-center justify-content-between mt-5">
                                <div class="">
                                    <span class="text-white-50 font-weight-bold d-block">Total Records</span>
                                    <span class="text-white font-weight-bolder font-size-h1">{{ $stats['special']['total'] }}</span>
                                </div>
                                <div class="">
                                    @if($stats['special']['new'] > 0)
                                        <span class="label label-white label-text-warning label-inline font-weight-bolder py-4 px-5 font-size-h6">
                                            +{{ $stats['special']['new'] }} New
                                        </span>
                                    @else
                                        <span class="symbol symbol-light-white symbol-45">
                                            <span class="symbol-label">
                                                <i class="flaticon2-check-mark text-warning"></i>
                                            </span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row 1 -->

            <!-- ROW 2: Secondary Modules (White BG with Colored Icons) -->
            <div class="row">
                <!-- NAVTTC -->
                <div class="col-xl-4 col-md-6">
                    <div class="card card-custom gutter-b card-stretch">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center p-5 card-rounded-top bgi-no-repeat bgi-position-y-top bgi-position-x-right" 
                                 style="background-size: 100% auto; background-image: url({{ asset('assets/admin/media/svg/shapes/abstract-4.svg') }})">
                                <!-- Icon Box -->
                                <span class="symbol symbol-50 symbol-light-primary mr-5">
                                    <span class="symbol-label">
                                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                                            <!-- SVG: Suitcase -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M4,9 L20,9 C20.5522847,9 21,9.44771525 21,10 L21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,10 C3,9.44771525 3.44771525,9 4,9 Z M12,12 C12.5522847,12 13,12.4477153 13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 C11,12.4477153 11.4477153,12 12,12 Z" fill="#000000"/>
                                                    <path d="M7.5,6 L16.5,6 C17.3284271,6 18,6.67157288 18,7.5 C18,7.77614237 17.7761424,8 17.5,8 L6.5,8 C6.22385763,8 6,7.77614237 6,7.5 C6,6.67157288 6.67157288,6 7.5,6 Z" fill="#000000" opacity="0.3"/>
                                                </g>
                                            </svg>
                                        </span>
                                    </span>
                                </span>
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="{{ route('admin.navtech.appointments') }}" class="text-dark-75 text-hover-primary font-weight-bold font-size-h4 mb-1">NAVTTC</a>
                                    <span class="text-muted font-weight-bold">Vocational Training</span>
                                </div>
                            </div>
                            
                            <!-- Stats Grid -->
                            <div class="row m-0 bg-light-primary border-top border-primary-o-10">
                                <div class="col-6 px-0 border-right border-primary-o-10">
                                    <div class="py-4 text-center">
                                        <div class="font-size-h3 font-weight-bolder text-primary">{{ $stats['navtech']['total'] }}</div>
                                        <div class="text-muted font-size-xs font-weight-bold">Total</div>
                                    </div>
                                </div>
                                <div class="col-6 px-0">
                                    <div class="py-4 text-center">
                                        @if($stats['navtech']['new'] > 0)
                                            <div class="font-size-h3 font-weight-bolder text-danger">{{ $stats['navtech']['new'] }}</div>
                                            <div class="text-danger font-size-xs font-weight-bold">Action Needed</div>
                                        @else
                                            <div class="font-size-h3 font-weight-bolder text-muted">-</div>
                                            <div class="text-muted font-size-xs font-weight-bold">No New</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medical Results -->
                <div class="col-xl-4 col-md-6">
                    <div class="card card-custom gutter-b card-stretch">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center p-5 card-rounded-top bgi-no-repeat bgi-position-y-top bgi-position-x-right" 
                                 style="background-size: 100% auto; background-image: url({{ asset('assets/admin/media/svg/shapes/abstract-2.svg') }})">
                                <span class="symbol symbol-50 symbol-light-info mr-5">
                                    <span class="symbol-label">
                                        <i class="flaticon2-cardiogram text-info font-size-h2"></i>
                                    </span>
                                </span>
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="{{ route('admin.checkResults') }}" class="text-dark-75 text-hover-info font-weight-bold font-size-h4 mb-1">Medical</a>
                                    <span class="text-muted font-weight-bold">Test Results</span>
                                </div>
                            </div>
                            
                            <!-- Stats Grid -->
                            <div class="row m-0 bg-light-info border-top border-info-o-10">
                                <div class="col-6 px-0 border-right border-info-o-10">
                                    <div class="py-4 text-center">
                                        <div class="font-size-h3 font-weight-bolder text-info">{{ $stats['medical']['total'] }}</div>
                                        <div class="text-muted font-size-xs font-weight-bold">Total</div>
                                    </div>
                                </div>
                                <div class="col-6 px-0">
                                    <div class="py-4 text-center">
                                        @if($stats['medical']['new'] > 0)
                                            <div class="font-size-h3 font-weight-bolder text-danger">{{ $stats['medical']['new'] }}</div>
                                            <div class="text-danger font-size-xs font-weight-bold">New Results</div>
                                        @else
                                            <div class="font-size-h3 font-weight-bolder text-muted">-</div>
                                            <div class="text-muted font-size-xs font-weight-bold">Caught Up</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Soft Skills -->
                <div class="col-xl-4 col-md-6">
                    <div class="card card-custom gutter-b card-stretch">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center p-5 card-rounded-top bgi-no-repeat bgi-position-y-top bgi-position-x-right" 
                                 style="background-size: 100% auto; background-image: url({{ asset('assets/admin/media/svg/shapes/abstract-1.svg') }})">
                                <span class="symbol symbol-50 symbol-light-success mr-5">
                                    <span class="symbol-label">
                                        <i class="flaticon-users text-success font-size-h2"></i>
                                    </span>
                                </span>
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="{{ route('admin.softskill.appointments') }}" class="text-dark-75 text-hover-success font-weight-bold font-size-h4 mb-1">Soft Skills</a>
                                    <span class="text-muted font-weight-bold">Candidate Training</span>
                                </div>
                            </div>
                            
                            <!-- Stats Grid -->
                            <div class="row m-0 bg-light-success border-top border-success-o-10">
                                <div class="col-6 px-0 border-right border-success-o-10">
                                    <div class="py-4 text-center">
                                        <div class="font-size-h3 font-weight-bolder text-success">{{ $stats['softskill']['total'] }}</div>
                                        <div class="text-muted font-size-xs font-weight-bold">Total</div>
                                    </div>
                                </div>
                                <div class="col-6 px-0">
                                    <div class="py-4 text-center">
                                        @if($stats['softskill']['new'] > 0)
                                            <div class="font-size-h3 font-weight-bolder text-danger">{{ $stats['softskill']['new'] }}</div>
                                            <div class="text-danger font-size-xs font-weight-bold">Pending</div>
                                        @else
                                            <div class="font-size-h3 font-weight-bolder text-muted">-</div>
                                            <div class="text-muted font-size-xs font-weight-bold">Caught Up</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row 2 -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Recent Wafid Appointments</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">Latest 5 records received</span>
                            </h3>
                            <div class="card-toolbar">
                                <a href="{{ route('admin.appointments') }}" class="btn btn-info font-weight-bolder font-size-sm">View All Records</a>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                                    <thead>
                                        <tr class="text-left">
                                            <th style="min-width: 150px">Applicant Name</th>
                                            <th style="min-width: 120px">Passport</th>
                                            <th style="min-width: 120px">Country</th>
                                            <th style="min-width: 120px">Status</th>
                                            <th style="min-width: 120px">Date</th>
                                            <th class="text-right" style="min-width: 100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recent_appointments as $appt)
                                        <tr>
                                            <td class="pl-0">
                                                <a href="{{ route('admin.appointments.edit', $appt->id) }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                    {{ $appt->first_name }} {{ $appt->last_name }}
                                                </a>
                                                <span class="text-muted font-weight-bold text-muted d-block">{{ $appt->phone }}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $appt->passport_no }}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $appt->country_traveling_to }}</span>
                                            </td>
                                            <td>
                                                @if($appt->payment)
                                                    <span class="label label-lg label-light-success label-inline">Paid</span>
                                                @else
                                                    <span class="label label-lg label-light-danger label-inline">Unpaid</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $appt->created_at->format('d M Y') }}</span>
                                                <span class="text-muted font-weight-bold">{{ $appt->created_at->diffForHumans() }}</span>
                                            </td>
                                            <td class="text-right pr-0">
                                                <a href="{{ route('admin.appointments.edit', $appt->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114732 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection