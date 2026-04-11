@extends('layouts.admin')
@section('title', 'Service Reviews')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">
                            Service Reviews
                            @if($pending > 0)
                                <span class="label label-warning label-inline font-weight-bold ml-2">{{ $pending }} Pending</span>
                            @endif
                        </h3>
                    </div>
                    <div class="card-toolbar d-flex flex-wrap mt-3 mt-md-0" style="gap:8px;width:100%;max-width:460px;">
                        <select id="statusFilter" class="form-control form-control-sm flex-fill" style="min-width:120px;">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <select id="serviceFilter" class="form-control form-control-sm flex-fill" style="min-width:160px;">
                            <option value="">All Services</option>
                            @foreach($services as $svc)
                                <option value="{{ $svc }}">{{ $svc }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-head-custom table-checkable" id="kt_datatable" style="min-width:600px;">
                        <thead class="thead-dark">
                            <tr>
                                <th style="display:none;">ID</th>
                                <th>Reviewer</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
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

{{-- Detail Modal --}}
<div class="modal fade" id="reviewDetailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Review Details</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="reviewDetailBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
"use strict";

var table;

var KTReviewsTable = function () {
    var initTable = function () {
        table = $('#kt_datatable').DataTable({
            responsive: false,
            scrollX: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.reviews.data") }}',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: function (d) {
                    d.status_filter  = $('#statusFilter').val();
                    d.service_filter = $('#serviceFilter').val();
                }
            },
            columns: [
                { data: 0, visible: false },  // hidden ID placeholder
                { data: 1 },                  // Reviewer (name + service + avatar)
                { data: 2, orderable: false }, // Rating
                { data: 3, orderable: false }, // Status
                { data: 4 },                  // Date
                { data: 5, orderable: false, responsivePriority: -1 }, // Actions
            ],
            order: [[4, 'desc']],
        });

        $('#statusFilter, #serviceFilter').on('change', function () {
            table.ajax.reload();
        });
    };

    return { init: function () { initTable(); } };
}();

jQuery(document).ready(function () {
    KTReviewsTable.init();

    // View detail
    $(document).on('click', '.review-view', function () {
        var d = $(this).data();
        var stars = '';
        for (var i = 1; i <= 5; i++) {
            stars += i <= d.rating
                ? '<i class="fas fa-star" style="color:#FFC654;"></i>'
                : '<i class="far fa-star" style="color:#FFC654;"></i>';
        }
        var photo = d.photo
            ? '<img src="' + d.photo + '" style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid #FFC654;" class="mb-3">'
            : '<div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#0f1923,#1a252f);display:flex;align-items:center;justify-content:center;color:#FFC654;font-weight:700;font-size:1.8rem;margin:0 auto 12px;">' + d.initial + '</div>';

        var statusColors = { pending: 'warning', approved: 'success', rejected: 'danger' };
        var badge = '<span class="label label-' + (statusColors[d.status] || 'secondary') + ' label-inline font-weight-bold">' + d.status.charAt(0).toUpperCase() + d.status.slice(1) + '</span>';

        $('#reviewDetailBody').html(
            '<div class="text-center mb-4">' + photo +
            '<h5 class="font-weight-bold mb-1">' + $('<div>').text(d.name).html() + '</h5>' +
            '<div class="mb-2">' + stars + '</div>' +
            '<span class="label label-light-primary label-inline font-weight-bold">' + $('<div>').text(d.service).html() + '</span>' +
            '</div>' +
            '<hr>' +
            '<div class="row">' +
            '<div class="col-md-6"><strong>Email:</strong> <span class="text-muted">' + (d.email || '—') + '</span></div>' +
            '<div class="col-md-6"><strong>Status:</strong> ' + badge + '</div>' +
            '<div class="col-md-6 mt-2"><strong>Date:</strong> <span class="text-muted">' + d.date + '</span></div>' +
            '</div>' +
            '<hr>' +
            '<div><strong>Review:</strong><p class="text-muted mt-2" style="word-break:break-word;line-height:1.8;">' + $('<div>').text(d.review || '—').html() + '</p></div>'
        );
        $('#reviewDetailModal').modal('show');
    });

    // Approve
    $(document).on('click', '.review-approve', function () {
        var id  = $(this).data('id');
        var url = "{{ route('admin.reviews.approve', ':id') }}".replace(':id', id);
        $.post(url, { _token: '{{ csrf_token() }}' }, function (res) {
            if (res.status === 'success') { toastr.success(res.message); table.ajax.reload(null, false); }
        });
    });

    // Reject
    $(document).on('click', '.review-reject', function () {
        var id  = $(this).data('id');
        var url = "{{ route('admin.reviews.reject', ':id') }}".replace(':id', id);
        $.post(url, { _token: '{{ csrf_token() }}' }, function (res) {
            if (res.status === 'success') { toastr.warning(res.message); table.ajax.reload(null, false); }
        });
    });

    // Delete
    $(document).on('click', '.review-delete', function () {
        var id  = $(this).data('id');
        var url = "{{ route('admin.reviews.delete', ':id') }}".replace(':id', id);
        Swal.fire({ title: 'Are you sure?', text: 'This review will be permanently deleted.', icon: 'warning', showCancelButton: true, confirmButtonText: 'Yes, delete it!' })
        .then(function (result) {
            if (result.value) {
                $.ajax({ url: url, type: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function (res) {
                        if (res.status === 'success') { Swal.fire('Deleted!', res.message, 'success'); table.ajax.reload(null, false); }
                    }
                });
            }
        });
    });
});
</script>
@endpush
