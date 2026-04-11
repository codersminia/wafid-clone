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
                    <div class="card-toolbar d-flex flex-wrap" style="gap:8px;">
                        {{-- Status Filter --}}
                        <select id="statusFilter" class="form-control form-control-sm" style="width:140px;">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        {{-- Service Filter --}}
                        <select id="serviceFilter" class="form-control form-control-sm" style="width:220px;">
                            <option value="">All Services</option>
                            @foreach($services as $svc)
                                <option value="{{ $svc }}">{{ $svc }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-head-custom table-checkable" id="kt_datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th style="display:none;">ID</th>
                                <th>Name</th>
                                <th>Service</th>
                                <th>Rating</th>
                                <th>Review</th>
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

{{-- Review Full Text Modal --}}
<div class="modal fade" id="reviewTextModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="reviewModalName"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="reviewModalText" style="white-space:pre-wrap;line-height:1.8;word-break:break-word;overflow-wrap:break-word;"></div>
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
            responsive: true,
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
                { data: 0, visible: false },
                { data: 1 },
                { data: 2 },
                { data: 3, orderable: false },
                { data: 4, orderable: false },
                { data: 5, orderable: false },
                { data: 6 },
                { data: 7, orderable: false, responsivePriority: -1 },
            ],
            order: [[6, 'desc']],
        });

        // Reload on filter change
        $('#statusFilter, #serviceFilter').on('change', function () {
            table.ajax.reload();
        });
    };

    return { init: function () { initTable(); } };
}();

jQuery(document).ready(function () {
    KTReviewsTable.init();

    // View full review
    $(document).on('click', '.view-review', function (e) {
        e.preventDefault();
        $('#reviewModalName').text($(this).data('name'));
        $('#reviewModalText').text($(this).data('review'));
        $('#reviewTextModal').modal('show');
    });

    // Approve
    $(document).on('click', '.review-approve', function () {
        var id  = $(this).data('id');
        var url = "{{ route('admin.reviews.approve', ':id') }}".replace(':id', id);
        $.post(url, { _token: '{{ csrf_token() }}' }, function (res) {
            if (res.status === 'success') {
                toastr.success(res.message);
                table.ajax.reload(null, false);
            }
        });
    });

    // Reject
    $(document).on('click', '.review-reject', function () {
        var id  = $(this).data('id');
        var url = "{{ route('admin.reviews.reject', ':id') }}".replace(':id', id);
        $.post(url, { _token: '{{ csrf_token() }}' }, function (res) {
            if (res.status === 'success') {
                toastr.warning(res.message);
                table.ajax.reload(null, false);
            }
        });
    });

    // Delete
    $(document).on('click', '.review-delete', function () {
        var id  = $(this).data('id');
        var url = "{{ route('admin.reviews.delete', ':id') }}".replace(':id', id);
        Swal.fire({
            title: 'Are you sure?',
            text: "This review will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: url, type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function (res) {
                        if (res.status === 'success') {
                            Swal.fire('Deleted!', res.message, 'success');
                            table.ajax.reload(null, false);
                        }
                    }
                });
            }
        });
    });
});
</script>
@endpush
