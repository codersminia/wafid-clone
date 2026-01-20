@extends('layouts.admin')

@section('title', 'Wafid - Contact Inquiries')

@section('content')

<style>
    .new-record {
        background-color: #d1ecf1 !important; /* Bootstrap's alert-info color or similar */
        font-weight: bold;
    }
</style>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">
                            Contact Inquiries
                        </h3>
                    </div>                    
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-striped table-head-custom table-checkable" id="kt_datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th style="display:none;">ID</th> 
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Leave empty; DataTables will populate via AJAX -->
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

<!-- Modal for Viewing Message -->
<div class="modal fade" id="viewMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inquiry Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalMessageBody" style="white-space: pre-wrap;">
                <!-- Message content will be injected here -->
            </div>
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
    var KTDatatablesDataSourceAjaxServer = function() {
        var initTable1 = function() {
            var table = $('#kt_datatable');

            // begin first table
            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.contacts.data") }}',
                    type: 'POST', // Changed to POST as per routes
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
                columns: [
                    {data: 0, visible: false}, // Hide ID column but keep data availability
                    {data: 1},
                    {data: 2},
                    {data: 3},
                    {data: 4},
                    {data: 5, responsivePriority: -1},
                ],
                columnDefs: [
                    {
                        targets: -1,
                        title: 'Actions',
                        orderable: false,
                    },
                ],
                order: [[ 4, "desc" ]] // Default sort by Date DESC
            });
        };

        return {
            init: function() {
                initTable1();
            },
        };
    }();

    jQuery(document).ready(function() {
        KTDatatablesDataSourceAjaxServer.init();

        // View Message Modal
        $(document).on('click', '.view-contact', function() {
            var btn = $(this);
            var id = btn.data('id');
            var msg = btn.data('msg');
            
            $('#modalMessageBody').html(msg); 
            $('#viewMessageModal').modal('show');

            // Mark as read AJAX
            $.ajax({
                url: '/admin/contacts/read/' + id,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // 1. Remove highlight
                        btn.closest('tr').removeClass('new-record');

                        // 2. Update Sidebar Badge
                        var $badge = $("a[href*='admin/contacts'] .label-danger");

                        if ($badge.length > 0) {
                            var currentCount = parseInt($badge.text());
                            if (!isNaN(currentCount) && currentCount > 0) {
                                var newCount = currentCount - 1;
                                if (newCount <= 0) {
                                    $badge.parent().remove();
                                } else {
                                    $badge.text(newCount);
                                }
                            }
                        }
                    }
                }
            });
        });

        // Delete Contact
        $(document).on('click', '.delete-contact', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.contacts.delete', ':id') }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(result) {
                            if (result.status == 'success') {
                                Swal.fire(
                                    "Deleted!",
                                    "Inquiry has been deleted.",
                                    "success"
                                );
                                $('#kt_datatable').DataTable().ajax.reload(); 
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
