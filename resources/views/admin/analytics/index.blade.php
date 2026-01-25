@extends('layouts.admin')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <!-- Stats Overview -->
                <div class="row mb-5">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-custom gutter-b bg-light-primary">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-primary svg-icon-3x ml-n1">
                                    <i class="flaticon2-group text-primary"></i>
                                </span>
                                <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $stats['total_visitors'] }}
                                </div>
                                <a href="#" class="text-primary font-weight-bold font-size-lg mt-1">Total Visitors</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-custom gutter-b bg-light-success">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-success svg-icon-3x ml-n1">
                                    <i class="flaticon2-checking text-success"></i>
                                </span>
                                <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $stats['today_visitors'] }}
                                </div>
                                <a href="#" class="text-success font-weight-bold font-size-lg mt-1">Visitors Today</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-custom gutter-b bg-light-info">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
                                    <i class="fab fa-whatsapp text-info" style="font-size: 2rem;"></i>
                                </span>
                                <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $stats['total_whatsapp'] }}
                                </div>
                                <a href="#" class="text-info font-weight-bold font-size-lg mt-1">Total WA Clicks</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-custom gutter-b bg-light-warning">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-warning svg-icon-3x ml-n1">
                                    <i class="fab fa-whatsapp text-warning" style="font-size: 2rem;"></i>
                                </span>
                                <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $stats['today_whatsapp'] }}
                                </div>
                                <a href="#" class="text-warning font-weight-bold font-size-lg mt-1">WA Clicks Today</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-custom">
                    <div class="card-header card-header-tabs-line">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_visitors">
                                        <span class="nav-icon"><i class="flaticon2-group"></i></span>
                                        <span class="nav-text">Site Visitors</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_whatsapp">
                                        <span class="nav-icon"><i class="fab fa-whatsapp"></i></span>
                                        <span class="nav-text">WhatsApp Leads</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Visitors Tab -->
                            <div class="tab-pane fade show active" id="kt_tab_visitors" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-head-custom table-vertical-center">
                                        <thead>
                                            <tr class="text-left">
                                                <th style="min-width: 150px">Date & Time</th>
                                                <th style="min-width: 200px">Page Viewed</th>
                                                <th>Location/IP</th>
                                                <th style="min-width: 150px">Referrer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($visitor_logs as $log)
                                                <tr>
                                                    <td><span
                                                            class="text-dark-75 font-weight-bolder">{{ $log->created_at->format('d M, h:i A') }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $log->page_url }}" target="_blank"
                                                            class="text-primary small text-truncate d-block"
                                                            style="max-width: 250px;">
                                                            {{ str_replace(url('/'), '', $log->page_url) ?: '/' }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($log->country)
                                                            <div class="text-dark-75 font-weight-bold">{{ $log->city }}, {{ $log->region }}</div>
                                                            <div class="text-muted small">{{ $log->country }}</div>
                                                        @else
                                                            <span class="text-muted small">Location Unknown</span>
                                                        @endif
                                                        <span class="label label-light-info label-inline font-weight-bold mt-1">{{ $log->ip_address }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted small text-truncate d-block"
                                                            style="max-width: 150px;" title="{{ $log->referrer }}">
                                                            {{ $log->referrer ?: 'Direct' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-5">No visitor data found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $visitor_logs->links() }}
                                </div>
                            </div>

                            <!-- WhatsApp Tab -->
                            <div class="tab-pane fade" id="kt_tab_whatsapp" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-head-custom table-vertical-center">
                                        <thead>
                                            <tr class="text-left">
                                                <th style="min-width: 150px">Click Time</th>
                                                <th style="min-width: 200px">Source Page</th>
                                                <th>Location/IP</th>
                                                <th>Device (User Agent)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($whatsapp_tracks as $track)
                                                <tr>
                                                    <td><span
                                                            class="text-dark-75 font-weight-bolder text-info">{{ $track->created_at->format('d M, h:i A') }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $track->page_url }}" target="_blank"
                                                            class="text-primary small text-truncate d-block"
                                                            style="max-width: 250px;">
                                                            {{ str_replace(url('/'), '', $track->page_url) ?: '/' }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($track->country)
                                                            <div class="text-dark-75 font-weight-bold">{{ $track->city }}, {{ $track->region }}</div>
                                                            <div class="text-muted small">{{ $track->country }}</div>
                                                        @else
                                                            <span class="text-muted small">Location Unknown</span>
                                                        @endif
                                                        <span class="label label-light-dark label-inline font-weight-bold mt-1">{{ $track->ip_address }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted small text-truncate d-block"
                                                            style="max-width: 200px;" title="{{ $track->user_agent }}">
                                                            {{ $track->user_agent }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-5">No WhatsApp tracking data
                                                        available.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $whatsapp_tracks->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection