@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <style>
            .hover-shadow-lg:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
            }
            .transition-all {
                transition: all 0.3s ease-in-out !important;
            }
        </style>
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">

                <!--begin::Dashboard Header-->
                <div class="d-flex align-items-center justify-content-between mb-8">
                    <div>
                        <h1 class="font-weight-bolder text-dark mb-1">Administrative Overview</h1>
                        <p class="text-muted font-size-lg mb-0">Track your business performance and pending tasks at a glance.</p>
                    </div>
                    <div class="d-flex align-items-center bg-white rounded-pill px-6 py-3 shadow-sm border">
                        <i class="flaticon2-calendar-3 text-primary mr-3 font-size-h4"></i>
                        <span class="text-dark-75 font-weight-bolder font-size-lg">{{ date('F d, Y') }}</span>
                    </div>
                </div>

                <!-- PRIMARY STATS SECTION (Gradients) -->
                <div class="row">
                    <!-- Wafid Appointments -->
                    <div class="col-xl-3 col-sm-6">
                        <a href="{{ route('admin.appointments') }}" class="card card-custom gutter-b stretch-card hover-shadow-lg transition-all" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                            <div class="card-body p-8">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="symbol symbol-50 symbol-light-white alpha-20">
                                        <span class="symbol-label">
                                            <i class="flaticon-calendar-with-a-clock-time-tools text-dark font-size-h1"></i>
                                        </span>
                                    </div>
                                    @if($stats['wafid']['new'] > 0)
                                        <span class="badge badge-pill badge-white text-primary font-weight-bold px-4 py-2">+{{ $stats['wafid']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="text-white font-weight-bolder font-size-h1 mt-6">{{ number_format($stats['wafid']['total']) }}</div>
                                <div class="text-white-50 font-weight-bold font-size-lg mt-1">Wafid Appointments</div>
                            </div>
                        </a>
                    </div>

                    <!-- Tasheer Appointments -->
                    <div class="col-xl-3 col-sm-6">
                        <a href="{{ route('admin.tasheer.appointments') }}" class="card card-custom gutter-b stretch-card hover-shadow-lg transition-all" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none;">
                            <div class="card-body p-8">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="symbol symbol-50 symbol-light-white alpha-20">
                                        <span class="symbol-label">
                                            <i class="flaticon2-world text-dark font-size-h1"></i>
                                        </span>
                                    </div>
                                    @if($stats['tasheer']['new'] > 0)
                                        <span class="badge badge-pill badge-white text-success font-weight-bold px-4 py-2">+{{ $stats['tasheer']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="text-white font-weight-bolder font-size-h1 mt-6">{{ number_format($stats['tasheer']['total']) }}</div>
                                <div class="text-white-50 font-weight-bold font-size-lg mt-1">Tasheer Appointments</div>
                            </div>
                        </a>
                    </div>

                    <!-- Special Appointments -->
                    <div class="col-xl-3 col-sm-6">
                        <a href="{{ route('admin.special.appointments') }}" class="card card-custom gutter-b stretch-card hover-shadow-lg transition-all" style="background: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%); border: none;">
                            <div class="card-body p-8">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="symbol symbol-50 symbol-light-white alpha-20">
                                        <span class="symbol-label">
                                            <i class="flaticon-star text-dark font-size-h1"></i>
                                        </span>
                                    </div>
                                    @if($stats['special']['new'] > 0)
                                        <span class="badge badge-pill badge-white text-warning font-weight-bold px-4 py-2">+{{ $stats['special']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="text-white font-weight-bolder font-size-h1 mt-6">{{ number_format($stats['special']['total']) }}</div>
                                <div class="text-white-50 font-weight-bold font-size-lg mt-1">Special Appointments</div>
                            </div>
                        </a>
                    </div>

                    <!-- Contact Inquiries -->
                    <div class="col-xl-3 col-sm-6">
                        <a href="{{ route('admin.contacts') }}" class="card card-custom gutter-b stretch-card hover-shadow-lg transition-all" style="background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%); border: none;">
                            <div class="card-body p-8">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="symbol symbol-50 symbol-light-white alpha-20">
                                        <span class="symbol-label">
                                            <i class="flaticon2-mail text-dark font-size-h1"></i>
                                        </span>
                                    </div>
                                    @if($stats['contact']['new'] > 0)
                                        <span class="badge badge-pill badge-white text-info font-weight-bold px-4 py-2">+{{ $stats['contact']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="text-white font-weight-bolder font-size-h1 mt-6">{{ number_format($stats['contact']['total']) }}</div>
                                <div class="text-white-50 font-weight-bold font-size-lg mt-1">Contact Inquiries</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- SECONDARY STATS SECTION (More Gradients) -->
                <div class="row">
                    <!-- Medical Results -->
                    <div class="col-xl-3 col-sm-6">
                        <a href="{{ route('admin.checkResults') }}" class="card card-custom gutter-b stretch-card hover-shadow-lg transition-all" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border: none;">
                            <div class="card-body p-8">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="symbol symbol-50 symbol-light-white alpha-20">
                                        <span class="symbol-label">
                                            <i class="flaticon2-cardiogram text-dark font-size-h1"></i>
                                        </span>
                                    </div>
                                    @if($stats['medical']['new'] > 0)
                                        <span class="badge badge-pill badge-white text-primary font-weight-bold px-4 py-2">+{{ $stats['medical']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="text-white font-weight-bolder font-size-h1 mt-6">{{ number_format($stats['medical']['total']) }}</div>
                                <div class="text-white-50 font-weight-bold font-size-lg mt-1">Medical Results</div>
                            </div>
                        </a>
                    </div>

                    <!-- NAVTTC -->
                    <div class="col-xl-3 col-sm-6">
                        <a href="{{ route('admin.navtech.appointments') }}" class="card card-custom gutter-b stretch-card hover-shadow-lg transition-all" style="background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%); border: none;">
                            <div class="card-body p-8">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="symbol symbol-50 symbol-light-white alpha-20">
                                        <span class="symbol-label">
                                            <i class="flaticon-calendar-with-a-clock-time-tools text-dark font-size-h1"></i>
                                        </span>
                                    </div>
                                    @if($stats['navtech']['new'] > 0)
                                        <span class="badge badge-pill badge-white text-success font-weight-bold px-4 py-2">+{{ $stats['navtech']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="text-white font-weight-bolder font-size-h1 mt-6">{{ number_format($stats['navtech']['total']) }}</div>
                                <div class="text-white-50 font-weight-bold font-size-lg mt-1">NAVTTC Training</div>
                            </div>
                        </a>
                    </div>

                    <!-- Soft Skills -->
                    <div class="col-xl-3 col-sm-6">
                        <a href="{{ route('admin.softskill.appointments') }}" class="card card-custom gutter-b stretch-card hover-shadow-lg transition-all" style="background: linear-gradient(135deg, #8E2DE2 0%, #4A00E0 100%); border: none;">
                            <div class="card-body p-8">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="symbol symbol-50 symbol-light-white alpha-20">
                                        <span class="symbol-label">
                                            <i class="flaticon-users-1 text-dark font-size-h1"></i>
                                        </span>
                                    </div>
                                    @if($stats['softskill']['new'] > 0)
                                        <span class="badge badge-pill badge-white text-primary font-weight-bold px-4 py-2">+{{ $stats['softskill']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="text-white font-weight-bolder font-size-h1 mt-6">{{ number_format($stats['softskill']['total']) }}</div>
                                <div class="text-white-50 font-weight-bold font-size-lg mt-1">Soft Skills</div>
                            </div>
                        </a>
                    </div>

                    <!-- Private Feedback -->
                    <div class="col-xl-3 col-sm-6">
                        <a href="{{ route('admin.settings.index', ['active_tab' => '#kt_tab_feedback']) }}" class="card card-custom gutter-b stretch-card hover-shadow-lg transition-all" style="background: linear-gradient(135deg, #FF512F 0%, #DD2476 100%); border: none;">
                            <div class="card-body p-8">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="symbol symbol-50 symbol-light-white alpha-20">
                                        <span class="symbol-label">
                                            <i class="flaticon-chat-1 text-dark font-size-h1"></i>
                                        </span>
                                    </div>
                                    @if($stats['feedback']['new'] > 0)
                                        <span class="badge badge-pill badge-white text-danger font-weight-bold px-4 py-2">+{{ $stats['feedback']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="text-white font-weight-bolder font-size-h1 mt-6">{{ number_format($stats['feedback']['total']) }}</div>
                                <div class="text-white-50 font-weight-bold font-size-lg mt-1">Private Feedback</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- RECENT TABLE SECTION -->
                <div class="row mt-5">
                    <div class="col-xl-12">
                        <div class="card card-custom gutter-b shadow-sm border-0">
                            <div class="card-header border-0 py-5 bg-light-primary">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark font-size-h3">Recent Wafid Appointments</span>
                                    <span class="text-muted mt-2 font-weight-bold font-size-sm">Monitoring the latest 5 applications</span>
                                </h3>
                                <div class="card-toolbar">
                                    <a href="{{ route('admin.appointments') }}" class="btn btn-primary font-weight-bolder font-size-sm px-6">Explore All Records</a>
                                </div>
                            </div>
                            <div class="card-body py-4">
                                <div class="table-responsive">
                                    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                                        <thead>
                                            <tr class="text-left bg-light">
                                                <th class="pl-7" style="min-width: 150px">Applicant Name</th>
                                                <th style="min-width: 120px">Passport</th>
                                                <th style="min-width: 120px">Country</th>
                                                <th style="min-width: 120px">Payment Status</th>
                                                <th style="min-width: 120px">Date Created</th>
                                                <th class="text-right pr-7" style="min-width: 100px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recent_appointments as $appt)
                                                <tr>
                                                    <td class="pl-7">
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40 symbol-light-primary mr-4">
                                                                <span class="symbol-label font-weight-bolder">{{ substr($appt->first_name, 0, 1) }}</span>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('admin.appointments.edit', $appt->id) }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg d-block">
                                                                    {{ $appt->first_name }} {{ $appt->last_name }}
                                                                </a>
                                                                <span class="text-muted font-weight-bold">{{ $appt->phone }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $appt->passport_no }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="label label-inline label-light-info font-weight-bold">{{ $appt->country_traveling_to }}</span>
                                                    </td>
                                                    <td>
                                                        @if($appt->payment)
                                                            <span class="label label-lg label-light-success label-inline font-weight-bold">PAID</span>
                                                        @else
                                                            <span class="label label-lg label-light-danger label-inline font-weight-bold">UNPAID</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $appt->created_at->format('d M Y') }}</span>
                                                        <small class="text-muted">{{ $appt->created_at->diffForHumans() }}</small>
                                                    </td>
                                                    <td class="text-right pr-7">
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
    <!--end::Content-->
@endsection