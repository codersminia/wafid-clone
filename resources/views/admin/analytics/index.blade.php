@extends('layouts.admin')
@section('title', 'Analytics')
@section('content')
<style>
/* ── Page wrapper ── */
.analytics-container { padding-top: 1rem; }
@media (max-width: 991px) { .analytics-container { padding-top: 1.5rem !important; } }

/* ── Stat cards (matching dashboard style) ── */
.analytics-stat-card {
    border-radius: 16px;
    border: none;
    overflow: hidden;
    position: relative;
    box-shadow: 0 4px 20px rgba(0,0,0,0.10);
    transition: transform .25s ease, box-shadow .25s ease;
    margin-bottom: 20px;
}
.analytics-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 36px rgba(0,0,0,0.16);
}
.analytics-stat-card .asc-top {
    padding: 20px 20px 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.asc-icon {
    width: 52px; height: 52px;
    border-radius: 14px;
    background: rgba(255,255,255,0.18);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; color: #fff;
    flex-shrink: 0;
}
.asc-icon i { font-size: 1.5rem; color: #fff; }
.asc-trend {
    background: rgba(255,255,255,0.2);
    color: #fff;
    font-size: .75rem; font-weight: 700;
    padding: 4px 10px; border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.3);
    white-space: nowrap;
}
.analytics-stat-card .asc-bottom { padding: 0 20px 18px; }
.asc-number {
    font-size: 2.2rem; font-weight: 800;
    color: #fff; line-height: 1; margin-bottom: 4px;
}
.asc-label { font-size: .85rem; font-weight: 600; color: rgba(255,255,255,.75); }
/* decorative circles */
.analytics-stat-card::before {
    content:''; position:absolute;
    width:110px; height:110px; border-radius:50%;
    background:rgba(255,255,255,.07);
    bottom:-25px; right:-15px; pointer-events:none;
}
.analytics-stat-card::after {
    content:''; position:absolute;
    width:60px; height:60px; border-radius:50%;
    background:rgba(255,255,255,.05);
    bottom:28px; right:55px; pointer-events:none;
}

/* ── Date filter bar ── */
.filter-card {
    background: #fff;
    border: 1px solid #ebedf3;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.filter-card .filter-title {
    font-weight: 700; font-size: .82rem;
    text-transform: uppercase; letter-spacing: .5px;
    color: #7e8299; margin-bottom: 12px;
    display: flex; align-items: center; gap: 6px;
}
.filter-inputs {
    display: flex; align-items: center;
    flex-wrap: wrap; gap: 8px; margin-bottom: 10px;
}
.filter-inputs input[type="date"] {
    border: 1px solid #e4e6ef; border-radius: 8px;
    padding: 7px 12px; font-size: .875rem;
    color: #3f4254; background: #f8f9fa;
    height: 38px; min-width: 130px; flex: 1; max-width: 160px;
}
.filter-inputs input[type="date"]:focus {
    outline: none; border-color: #3699ff;
    background: #fff; box-shadow: 0 0 0 3px rgba(54,153,255,.12);
}
.filter-inputs .btn-apply {
    height: 38px; padding: 0 18px;
    background: #3699ff; color: #fff; border: none;
    border-radius: 8px; font-size: .85rem; font-weight: 600;
    white-space: nowrap; transition: background .2s;
}
.filter-inputs .btn-apply:hover { background: #187de4; }
.filter-inputs .btn-clear {
    height: 38px; padding: 0 14px;
    background: #f5f8fa; color: #7e8299; border: 1px solid #e4e6ef;
    border-radius: 8px; font-size: .85rem; font-weight: 600;
    white-space: nowrap; transition: all .2s;
}
.filter-inputs .btn-clear:hover { background: #ffe2e5; color: #f64e60; border-color: #f64e60; }
.filter-presets { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; }
.filter-presets span { font-size: .75rem; color: #b5b5c3; font-weight: 600; }
.preset-btn {
    height: 28px; padding: 0 12px;
    border-radius: 20px; font-size: .76rem; font-weight: 600;
    border: 1px solid #e4e6ef; background: #f5f8fa; color: #3f4254;
    cursor: pointer; transition: all .2s; white-space: nowrap;
}
.preset-btn:hover, .preset-btn.active-preset {
    background: #3699ff; color: #fff; border-color: #3699ff;
}
.filter-active-badge {
    display: none; align-items: center; gap: 5px;
    background: #e8fff3; color: #1bc5bd;
    border-radius: 20px; padding: 3px 12px;
    font-size: .76rem; font-weight: 700;
    border: 1px solid #c9f7f5;
}
.filter-active-badge.visible { display: inline-flex; }

/* ── Mobile responsiveness for tables ── */
@media (max-width: 767px) {
    .filter-inputs input[type="date"] { max-width: 100%; flex: 1 1 120px; }
    .filter-inputs .filter-sep { display: none; }
    .filter-card { padding: 12px 14px; }
    .asc-number { font-size: 1.8rem; }
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter { text-align: left !important; }
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate { text-align: center !important; float: none !important; }
    .dataTables_wrapper .dataTables_paginate { margin-top: 10px; }
    table.dataTable td, table.dataTable th { padding: 8px 6px !important; font-size: .8rem; }
}
@media (max-width: 480px) {
    .filter-inputs { gap: 6px; }
    .filter-inputs .btn-apply,
    .filter-inputs .btn-clear { flex: 1; justify-content: center; }
    .preset-btn { font-size: .72rem; padding: 0 9px; }
}
</style>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container analytics-container">

            <!-- ── Stat Cards ── -->
            <div class="row mb-2">
                <div class="col-6 col-xl-3">
                    <div class="analytics-stat-card" style="background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);">
                        <div class="asc-top">
                            <div class="asc-icon"><i class="flaticon2-group"></i></div>
                            <span class="asc-trend">All Time</span>
                        </div>
                        <div class="asc-bottom">
                            <div class="asc-number" id="stat-total-visitors">{{ $stats['total_visitors'] }}</div>
                            <div class="asc-label">Total Visitors</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="analytics-stat-card" style="background:linear-gradient(135deg,#0f9b8e 0%,#14c9a0 100%);">
                        <div class="asc-top">
                            <div class="asc-icon"><i class="flaticon2-checking"></i></div>
                            <span class="asc-trend">Today</span>
                        </div>
                        <div class="asc-bottom">
                            <div class="asc-number" id="stat-today-visitors">{{ $stats['today_visitors'] }}</div>
                            <div class="asc-label">Visitors Today</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="analytics-stat-card" style="background:linear-gradient(135deg,#2980b9 0%,#6dd5fa 100%);">
                        <div class="asc-top">
                            <div class="asc-icon"><i class="fab fa-whatsapp"></i></div>
                            <span class="asc-trend">All Time</span>
                        </div>
                        <div class="asc-bottom">
                            <div class="asc-number" id="stat-total-wa">{{ $stats['total_whatsapp'] }}</div>
                            <div class="asc-label">Total WA Clicks</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="analytics-stat-card" style="background:linear-gradient(135deg,#e67e22 0%,#f1c40f 100%);">
                        <div class="asc-top">
                            <div class="asc-icon"><i class="fab fa-whatsapp"></i></div>
                            <span class="asc-trend">Today</span>
                        </div>
                        <div class="asc-bottom">
                            <div class="asc-number" id="stat-today-wa">{{ $stats['today_whatsapp'] }}</div>
                            <div class="asc-label">WA Clicks Today</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Main Card ── -->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line flex-wrap" style="min-height:auto;padding-top:10px;">
                    <div class="card-toolbar w-100">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line w-100">
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
                <div class="card-body px-3 px-md-5">
                    <div class="tab-content">

                        <!-- Visitors Tab -->
                        <div class="tab-pane fade show active" id="kt_tab_visitors" role="tabpanel">
                            <div class="filter-card">
                                <div class="filter-title">
                                    <i class="la la-filter"></i> Filter Visitors
                                    <span class="filter-active-badge ml-2" id="v_filter_badge">
                                        <i class="la la-check-circle"></i> Active
                                    </span>
                                </div>
                                <div class="filter-inputs">
                                    <input type="date" id="v_date_from" title="From date">
                                    <span class="text-muted filter-sep">—</span>
                                    <input type="date" id="v_date_to" title="To date">
                                    <button class="btn-apply" id="v_apply_filter">
                                        <i class="la la-search"></i> Apply
                                    </button>
                                    <button class="btn-clear" id="v_clear_filter">
                                        <i class="la la-times"></i> Clear
                                    </button>
                                </div>
                                <div class="filter-presets">
                                    <span>Quick:</span>
                                    <button class="preset-btn" data-table="v" data-preset="today">Today</button>
                                    <button class="preset-btn" data-table="v" data-preset="yesterday">Yesterday</button>
                                    <button class="preset-btn" data-table="v" data-preset="last7">Last 7 Days</button>
                                    <button class="preset-btn" data-table="v" data-preset="last30">Last 30 Days</button>
                                    <button class="preset-btn" data-table="v" data-preset="thismonth">This Month</button>
                                </div>
                                <div class="filter-result" id="v_result_bar" style="display:none;margin-top:10px;padding-top:10px;border-top:1px solid #ebedf3;">
                                    <span style="font-size:.82rem;color:#3f4254;">
                                        <i class="la la-users text-primary mr-1"></i>
                                        Showing <strong id="v_result_count" class="text-primary">0</strong> visitor records
                                        <span id="v_result_range" class="text-muted ml-1"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="visitors_datatable" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Page Viewed</th>
                                            <th>Location / IP</th>
                                            <th>Referrer</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- WhatsApp Tab -->
                        <div class="tab-pane fade" id="kt_tab_whatsapp" role="tabpanel">
                            <div class="filter-card">
                                <div class="filter-title">
                                    <i class="la la-filter"></i> Filter WhatsApp Leads
                                    <span class="filter-active-badge ml-2" id="w_filter_badge">
                                        <i class="la la-check-circle"></i> Active
                                    </span>
                                </div>
                                <div class="filter-inputs">
                                    <input type="date" id="w_date_from" title="From date">
                                    <span class="text-muted filter-sep">—</span>
                                    <input type="date" id="w_date_to" title="To date">
                                    <button class="btn-apply" id="w_apply_filter">
                                        <i class="la la-search"></i> Apply
                                    </button>
                                    <button class="btn-clear" id="w_clear_filter">
                                        <i class="la la-times"></i> Clear
                                    </button>
                                </div>
                                <div class="filter-presets">
                                    <span>Quick:</span>
                                    <button class="preset-btn" data-table="w" data-preset="today">Today</button>
                                    <button class="preset-btn" data-table="w" data-preset="yesterday">Yesterday</button>
                                    <button class="preset-btn" data-table="w" data-preset="last7">Last 7 Days</button>
                                    <button class="preset-btn" data-table="w" data-preset="last30">Last 30 Days</button>
                                    <button class="preset-btn" data-table="w" data-preset="thismonth">This Month</button>
                                </div>
                                <div class="filter-result" id="w_result_bar" style="display:none;margin-top:10px;padding-top:10px;border-top:1px solid #ebedf3;">
                                    <span style="font-size:.82rem;color:#3f4254;">
                                        <i class="fab fa-whatsapp text-success mr-1"></i>
                                        Showing <strong id="w_result_count" class="text-success">0</strong> WhatsApp lead records
                                        <span id="w_result_range" class="text-muted ml-1"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="whatsapp_datatable" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Click Time</th>
                                            <th>Source Page</th>
                                            <th>Location / IP</th>
                                            <th>Device</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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

@push('scripts')
<script>
$(document).ready(function () {

    var vDateFrom = '', vDateTo = '';
    var wDateFrom = '', wDateTo = '';

    /* ── Date helpers (local time, no UTC shift) ── */
    function localDate(d) {
        return d.getFullYear() + '-'
            + String(d.getMonth() + 1).padStart(2, '0') + '-'
            + String(d.getDate()).padStart(2, '0');
    }
    function dateOffset(days) {
        var d = new Date(); d.setDate(d.getDate() + days); return localDate(d);
    }
    function today()      { return localDate(new Date()); }
    function yesterday()  { return dateOffset(-1); }
    function firstOfMonth() {
        var d = new Date();
        return localDate(new Date(d.getFullYear(), d.getMonth(), 1));
    }

    /* ── Apply / clear helpers ── */
    function applyFilter(prefix, table, from, to) {
        if (from && !to) to = from;   // single day: to = from
        if (to && !from) from = to;

        if (prefix === 'v') { vDateFrom = from; vDateTo = to; }
        else                { wDateFrom = from; wDateTo = to; }

        $('#' + prefix + '_date_from').val(from);
        $('#' + prefix + '_date_to').val(to);
        $('#' + prefix + '_filter_badge').addClass('visible');
        table.ajax.reload();
    }

    function clearFilter(prefix, table) {
        if (prefix === 'v') { vDateFrom = ''; vDateTo = ''; }
        else                { wDateFrom = ''; wDateTo = ''; }
        $('#' + prefix + '_date_from, #' + prefix + '_date_to').val('');
        $('#' + prefix + '_filter_badge').removeClass('visible');
        $('#' + prefix + '_result_bar').hide();
        $('.preset-btn[data-table="' + prefix + '"]').removeClass('active-preset');
        table.ajax.reload();
    }

    function handlePreset(prefix, preset, table) {
        var from, to;
        switch (preset) {
            case 'today':     from = today();        to = today();       break;
            case 'yesterday': from = yesterday();    to = yesterday();   break;
            case 'last7':     from = dateOffset(-6); to = today();       break;
            case 'last30':    from = dateOffset(-29); to = today();      break;
            case 'thismonth': from = firstOfMonth(); to = today();       break;
        }
        $('.preset-btn[data-table="' + prefix + '"]').removeClass('active-preset');
        $('.preset-btn[data-table="' + prefix + '"][data-preset="' + preset + '"]').addClass('active-preset');
        applyFilter(prefix, table, from, to);
    }

    /* ── DataTable config ── */
    var dtConfig = function(url, getFrom, getTo) {
        return {
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: url,
                data: function (d) {
                    d.date_from = getFrom();
                    d.date_to   = getTo();
                }
            },
            order: [[0, 'desc']],
            columns: [
                { data: 0, responsivePriority: 1 },
                { data: 1, responsivePriority: 2 },
                { data: 2, responsivePriority: 3 },
                { data: 3, responsivePriority: 4 }
            ],
            language: {
                processing: '<div class="d-flex justify-content-center align-items-center py-4"><div class="spinner-border text-primary" role="status"></div><span class="ml-3 text-muted">Loading...</span></div>',
                emptyTable: '<div class="text-center py-5 text-muted"><i class="la la-inbox font-size-h1 d-block mb-2"></i>No records found for this date range.</div>',
                paginate: {
                    previous: '<i class="la la-angle-left"></i>',
                    next:     '<i class="la la-angle-right"></i>'
                }
            },
            drawCallback: function() {
                // make sure tables look good on mobile after draw
                $(this).DataTable().columns.adjust();

                // show count result bar when filter is active
                var api    = this.api();
                var prefix = this.attr('id') === 'visitors_datatable' ? 'v' : 'w';
                var isFiltered = (prefix === 'v')
                    ? (vDateFrom !== '' || vDateTo !== '')
                    : (wDateFrom !== '' || wDateTo !== '');

                if (isFiltered) {
                    var total = api.page.info().recordsTotal;
                    var from  = $('#' + prefix + '_date_from').val();
                    var to    = $('#' + prefix + '_date_to').val();
                    var rangeHtml = (from === to)
                        ? 'for <strong>' + from + '</strong>'
                        : 'from <strong>' + from + '</strong> to <strong>' + to + '</strong>';
                    $('#' + prefix + '_result_count').text(total.toLocaleString());
                    $('#' + prefix + '_result_range').html(rangeHtml);
                    $('#' + prefix + '_result_bar').show();
                } else {
                    $('#' + prefix + '_result_bar').hide();
                }
            }
        };
    };

    var visitorsTable = $('#visitors_datatable').DataTable(
        dtConfig(
            "{{ route('admin.analytics.visitors.data') }}",
            function(){ return vDateFrom; },
            function(){ return vDateTo; }
        )
    );

    var whatsappTable = $('#whatsapp_datatable').DataTable(
        dtConfig(
            "{{ route('admin.analytics.whatsapp.data') }}",
            function(){ return wDateFrom; },
            function(){ return wDateTo; }
        )
    );

    /* ── Button events ── */
    $('#v_apply_filter').on('click', function () {
        var from = $('#v_date_from').val(), to = $('#v_date_to').val();
        if (!from && !to) return;
        $('.preset-btn[data-table="v"]').removeClass('active-preset');
        applyFilter('v', visitorsTable, from, to);
    });
    $('#v_clear_filter').on('click', function () { clearFilter('v', visitorsTable); });

    $('#w_apply_filter').on('click', function () {
        var from = $('#w_date_from').val(), to = $('#w_date_to').val();
        if (!from && !to) return;
        $('.preset-btn[data-table="w"]').removeClass('active-preset');
        applyFilter('w', whatsappTable, from, to);
    });
    $('#w_clear_filter').on('click', function () { clearFilter('w', whatsappTable); });

    $(document).on('click', '.preset-btn', function () {
        var prefix = $(this).data('table');
        var table  = prefix === 'v' ? visitorsTable : whatsappTable;
        handlePreset(prefix, $(this).data('preset'), table);
    });

    /* ── Tab switch: recalc columns ── */
    $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
    });
});
</script>
@endpush
