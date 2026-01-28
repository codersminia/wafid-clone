@extends('layouts.admin')
@section('title', 'Payment Methods')
@section('content')
    <style>
        /* Add top spacing on mobile to prevent card from touching header */
        @media (max-width: 991px) {
            .payment-methods-container {
                padding-top: 1.5rem !important;
            }
        }
    </style>
    <div class="container payment-methods-container">
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <h3 class="card-title">Payment Methods</h3>
                <div class="card-toolbar">
                    <a href="{{ route('admin.payment.methods.create') }}" class="btn btn-primary font-weight-bolder">
                        <i class="la la-plus"></i> Add New Method
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-head-custom" id="payment_methods_datatable">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Bank/Account</th>
                            <th>Title</th>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // 1. Success Alert for Add/Update
            @if(session('success'))
                Swal.fire({
                    text: "{{ session('success') }}",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                });
            @endif

        var table = $('#payment_methods_datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: {
                    url: "{{ route('admin.payment.methods.data') }}",
                    type: "GET",
                },
                columns: [
                    { data: 0, responsivePriority: 5 }, // ID
                    { data: 1, responsivePriority: 1 }, // Bank/Account
                    { data: 2, responsivePriority: 3 }, // Title
                    { data: 3, responsivePriority: 2 }, // Number
                    { data: 4, responsivePriority: 4 }, // Status
                    { data: 6, responsivePriority: 1 }  // Actions
                ],
                columnDefs: [
                    {
                        targets: 4,
                        render: function (data) {
                            return data == 1
                                ? '<span class="label label-light-success label-inline">Active</span>'
                                : '<span class="label label-light-danger label-inline">Inactive</span>';
                        }
                    },
                    {
                        targets: 5,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, full) {
                            return `<a href="/admin/payment-methods/${data}/edit" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="la la-edit"></i></a>
                                <button class="btn btn-sm btn-clean btn-icon delete-btn" data-id="${data}" title="Delete"><i class="la la-trash"></i></button>`;
                        }
                    }
                ]
            });

            // 2. Delete Confirmation with Swal
            $(document).on("click", ".delete-btn", function () {
                let id = $(this).data("id");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: `/admin/payment-methods/${id}`,
                            type: "DELETE",
                            data: { _token: "{{ csrf_token() }}" },
                            success: function (response) {
                                table.ajax.reload();
                                Swal.fire(
                                    "Deleted!",
                                    "Your payment method has been deleted.",
                                    "success"
                                );
                            },
                            error: function () {
                                Swal.fire(
                                    "Error!",
                                    "Something went wrong while deleting.",
                                    "error"
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush