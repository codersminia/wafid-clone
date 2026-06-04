@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <style>
            /* ── Stat Card Redesign ── */
            .stat-card {
                border-radius: 16px;
                border: none;
                text-decoration: none;
                display: block;
                overflow: hidden;
                position: relative;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
                box-shadow: 0 4px 20px rgba(0,0,0,0.10);
            }
            .stat-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 16px 40px rgba(0,0,0,0.18);
                text-decoration: none;
            }
            .stat-card .card-body { padding: 0; }

            /* Top section: logo area */
            .stat-card-top {
                padding: 22px 22px 16px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .stat-logo-wrap {
                width: 56px;
                height: 56px;
                border-radius: 14px;
                background: rgba(255,255,255,0.18);
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                backdrop-filter: blur(4px);
            }
            .stat-logo-wrap img {
                width: 36px;
                height: 36px;
                object-fit: contain;
                filter: brightness(0) invert(1);
            }
            .stat-logo-wrap i {
                font-size: 1.6rem;
                color: #fff;
            }
            .stat-new-badge {
                background: rgba(255,255,255,0.22);
                color: #fff;
                font-size: 0.78rem;
                font-weight: 700;
                padding: 5px 12px;
                border-radius: 20px;
                border: 1px solid rgba(255,255,255,0.35);
                white-space: nowrap;
            }

            /* Bottom section: number + label */
            .stat-card-bottom {
                padding: 0 22px 20px;
            }
            .stat-card-number {
                font-size: 2.6rem;
                font-weight: 800;
                color: #fff;
                line-height: 1;
                margin-bottom: 4px;
            }
            .stat-card-label {
                font-size: 0.9rem;
                font-weight: 600;
                color: rgba(255,255,255,0.78);
                letter-spacing: 0.3px;
            }

            /* Decorative circle */
            .stat-card::before {
                content: '';
                position: absolute;
                width: 130px;
                height: 130px;
                border-radius: 50%;
                background: rgba(255,255,255,0.07);
                bottom: -30px;
                right: -20px;
                pointer-events: none;
            }
            .stat-card::after {
                content: '';
                position: absolute;
                width: 70px;
                height: 70px;
                border-radius: 50%;
                background: rgba(255,255,255,0.05);
                bottom: 30px;
                right: 60px;
                pointer-events: none;
            }

            /* ── Sidebar logo icons — defined globally in layouts/admin.blade.php ── */
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

                <!-- STATS ROW 1 -->
                <div class="row">
                    <!-- Wafid Appointments -->
                    <div class="col-xl-3 col-sm-6 gutter-b">
                        <a href="{{ route('admin.appointments') }}" class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="card-body">
                                <div class="stat-card-top">
                                    <div class="stat-logo-wrap">
                                        <img src="{{ asset('assets/public/images/wafid-logo.svg') }}" alt="Wafid">
                                    </div>
                                    @if($stats['wafid']['new'] > 0)
                                        <span class="stat-new-badge">+{{ $stats['wafid']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="stat-card-bottom">
                                    <div class="stat-card-number">{{ number_format($stats['wafid']['total']) }}</div>
                                    <div class="stat-card-label">Wafid Appointments</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Tasheer Appointments -->
                    <div class="col-xl-3 col-sm-6 gutter-b">
                        <a href="{{ route('admin.tasheer.appointments') }}" class="stat-card" style="background: linear-gradient(135deg, #0f9b8e 0%, #14c9a0 100%);">
                            <div class="card-body">
                                <div class="stat-card-top">
                                    <div class="stat-logo-wrap">
                                        <img src="{{ asset('assets/public/images/tasheer-logo.png') }}" alt="Tasheer">
                                    </div>
                                    @if($stats['tasheer']['new'] > 0)
                                        <span class="stat-new-badge">+{{ $stats['tasheer']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="stat-card-bottom">
                                    <div class="stat-card-number">{{ number_format($stats['tasheer']['total']) }}</div>
                                    <div class="stat-card-label">Tasheer Appointments</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Special Appointments -->
                    <div class="col-xl-3 col-sm-6 gutter-b">
                        <a href="{{ route('admin.special.appointments') }}" class="stat-card" style="background: linear-gradient(135deg, #e67e22 0%, #f1c40f 100%);">
                            <div class="card-body">
                                <div class="stat-card-top">
                                    <div class="stat-logo-wrap">
                                        <img src="{{ asset('assets/public/images/wafid-logo.svg') }}" alt="Wafid Choice">
                                    </div>
                                    @if($stats['special']['new'] > 0)
                                        <span class="stat-new-badge">+{{ $stats['special']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="stat-card-bottom">
                                    <div class="stat-card-number">{{ number_format($stats['special']['total']) }}</div>
                                    <div class="stat-card-label">Special Appointments</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Contact Inquiries -->
                    <div class="col-xl-3 col-sm-6 gutter-b">
                        <a href="{{ route('admin.contacts') }}" class="stat-card" style="background: linear-gradient(135deg, #2980b9 0%, #6dd5fa 100%);">
                            <div class="card-body">
                                <div class="stat-card-top">
                                    <div class="stat-logo-wrap">
                                        <i class="flaticon2-mail"></i>
                                    </div>
                                    @if($stats['contact']['new'] > 0)
                                        <span class="stat-new-badge">+{{ $stats['contact']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="stat-card-bottom">
                                    <div class="stat-card-number">{{ number_format($stats['contact']['total']) }}</div>
                                    <div class="stat-card-label">Contact Inquiries</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- STATS ROW 2 -->
                <div class="row">
                    <!-- Medical Results -->
                    <div class="col-xl-3 col-sm-6 gutter-b">
                        <a href="{{ route('admin.checkResults') }}" class="stat-card" style="background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%);">
                            <div class="card-body">
                                <div class="stat-card-top">
                                    <div class="stat-logo-wrap">
                                        <img src="{{ asset('assets/public/images/wafid-logo.svg') }}" alt="Medical Results">
                                    </div>
                                    @if($stats['medical']['new'] > 0)
                                        <span class="stat-new-badge">+{{ $stats['medical']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="stat-card-bottom">
                                    <div class="stat-card-number">{{ number_format($stats['medical']['total']) }}</div>
                                    <div class="stat-card-label">Medical Results</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- NAVTTC -->
                    <div class="col-xl-3 col-sm-6 gutter-b">
                        <a href="{{ route('admin.navtech.appointments') }}" class="stat-card" style="background: linear-gradient(135deg, #007991 0%, #78ffd6 100%);">
                            <div class="card-body">
                                <div class="stat-card-top">
                                    <div class="stat-logo-wrap">
                                        <img src="{{ asset('assets/public/images/navttc-logo.png') }}" alt="NAVTTC">
                                    </div>
                                    @if($stats['navtech']['new'] > 0)
                                        <span class="stat-new-badge">+{{ $stats['navtech']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="stat-card-bottom">
                                    <div class="stat-card-number">{{ number_format($stats['navtech']['total']) }}</div>
                                    <div class="stat-card-label">NAVTTC Training</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Soft Skills -->
                    <div class="col-xl-3 col-sm-6 gutter-b">
                        <a href="{{ route('admin.softskill.appointments') }}" class="stat-card" style="background: linear-gradient(135deg, #6a11cb 0%, #a855f7 100%);">
                            <div class="card-body">
                                <div class="stat-card-top">
                                    <div class="stat-logo-wrap">
                                        <img src="{{ asset('assets/public/images/soft-skill-logo.png') }}" alt="Soft Skills">
                                    </div>
                                    @if($stats['softskill']['new'] > 0)
                                        <span class="stat-new-badge">+{{ $stats['softskill']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="stat-card-bottom">
                                    <div class="stat-card-number">{{ number_format($stats['softskill']['total']) }}</div>
                                    <div class="stat-card-label">Soft Skill Certificates</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Private Feedback -->
                    <div class="col-xl-3 col-sm-6 gutter-b">
                        <a href="{{ route('admin.settings.index', ['active_tab' => '#kt_tab_feedback']) }}" class="stat-card" style="background: linear-gradient(135deg, #c0392b 0%, #f953c6 100%);">
                            <div class="card-body">
                                <div class="stat-card-top">
                                    <div class="stat-logo-wrap">
                                        <i class="flaticon-chat-1"></i>
                                    </div>
                                    @if($stats['feedback']['new'] > 0)
                                        <span class="stat-new-badge">+{{ $stats['feedback']['new'] }} New</span>
                                    @endif
                                </div>
                                <div class="stat-card-bottom">
                                    <div class="stat-card-number">{{ number_format($stats['feedback']['total']) }}</div>
                                    <div class="stat-card-label">Private Feedback</div>
                                </div>
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