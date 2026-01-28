@extends('layouts.admin')

@section('content')
    <style>
        /* Add top spacing on mobile to prevent card from touching header */
        @media (max-width: 991px) {
            .analytics-container {
                padding-top: 1.5rem !important;
            }
        }
    </style>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container analytics-container">
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
                                <table class="table table-head-custom table-vertical-center" id="visitors_datatable"
                                    style="width:100%">
                                    <thead class="thead-dark">
                                        <tr class="text-left">
                                            <th>Date & Time</th>
                                            <th>Page Viewed</th>
                                            <th>Location/IP</th>
                                            <th>Referrer</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <!-- WhatsApp Tab -->
                            <div class="tab-pane fade" id="kt_tab_whatsapp" role="tabpanel">
                                <table class="table table-head-custom table-vertical-center" id="whatsapp_datatable"
                                    style="width:100%">
                                    <thead class="thead-dark">
                                        <tr class="text-left">
                                            <th>Click Time</th>
                                            <th>Source Page</th>
                                            <th>Location/IP</th>
                                            <th>Device (User Agent)</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Visitors Table
            $('#visitors_datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.analytics.visitors.data') }}",
                order: [[0, 'desc']],
                columns: [
                    { data: 0, responsivePriority: 3 },
                    { data: 1, responsivePriority: 1 },
                    { data: 2, responsivePriority: 2 },
                    { data: 3, responsivePriority: 4 }
                ],
                language: {
                    'paginate': {
                        'previous': '<i class="la la-angle-left"></i>',
                        'next': '<i class="la la-angle-right"></i>'
                    }
                }
            });

            // WhatsApp Table
            $('#whatsapp_datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.analytics.whatsapp.data') }}",
                order: [[0, 'desc']],
                columns: [
                    { data: 0, responsivePriority: 3 },
                    { data: 1, responsivePriority: 1 },
                    { data: 2, responsivePriority: 2 },
                    { data: 3, responsivePriority: 4 }
                ],
                language: {
                    'paginate': {
                        'previous': '<i class="la la-angle-left"></i>',
                        'next': '<i class="la la-angle-right"></i>'
                    }
                }
            });

            // Adjust columns on tab switch
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
            });
        });
    </script>
@endpush