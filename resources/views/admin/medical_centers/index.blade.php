@extends('layouts.admin')

@section('title', 'Wafid - Medical Centers')

@section('content')

    <style>
        /* Add top spacing on mobile to prevent card from touching header */
        @media (max-width: 991px) {
            .container {
                padding-top: 1.5rem !important;
            }
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
                                Medical Centers
                                <span class="d-block text-muted pt-2 font-size-sm">Manage medical centers across countries
                                    and cities</span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="{{ route('admin.city_media.index') }}"
                                class="btn btn-light-primary font-weight-bolder mr-2">
                                <span class="svg-icon svg-icon-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M2,13 L15,13 C15.5522847,13 16,13.4477153 16,14 L16,21 C16,21.5522847 15.5522847,22 15,22 L2,22 C1.44771525,22 1,21.5522847 1,21 L1,14 C1,13.4477153 1.44771525,13 2,13 Z M2,3 L15,3 C15.5522847,3 16,3.44771525 16,4 L16,11 C16,11.5522847 15.5522847,12 15,12 L2,12 C1.44771525,12 1,11.5522847 1,11 L1,4 C1,3.44771525 1.44771525,3 2,3 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M11,17 L13,17 L13,19 L15,19 L15,21 L13,21 L13,23 L11,23 L11,21 L9,21 L9,19 L11,19 L11,17 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M5,10 C6.65685425,10 8,8.65685425 8,7 C8,5.34314575 6.65685425,4 5,4 C3.34314575,4 2,5.34314575 2,7 C2,8.65685425 3.34314575,10 5,10 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                </span>City Hero Images</a>

                            <a href="{{ route('admin.medical_centers.create') }}"
                                class="btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <circle fill="#000000" cx="9" cy="15" r="6" />
                                            <path
                                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                                fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>New Medical Center</a>
                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-striped table-head-custom" id="kt_datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>City</th>
                                    <th>Center Name</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
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

@endsection

@push('scripts')
    <script>
        var KTDatatablesDataSourceAjaxServer = function () {
            var initTable1 = function () {
                var table = $('#kt_datatable');

                // begin first table
                table.DataTable({
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.medical_centers.data') }}",
                        type: 'GET',
                    },
                    columns: [
                        { data: 0 },
                        { data: 1 },
                        { data: 2 },
                        { data: 3, responsivePriority: 1 },
                        { data: 4 },
                        { data: 5, responsivePriority: -1 },
                    ],
                    columnDefs: [
                        {
                            targets: 1,
                            title: 'Image',
                            orderable: false,
                            render: function (data, type, full, meta) {
                                if (data) {
                                    return '<div class="symbol symbol-50 symbol-light mr-4">\
                                                            <div class="symbol-label" style="background-image: url(\'' + data + '\'); background-size: cover; background-position: center;"></div>\
                                                        </div>';
                                } else {
                                    return '<div class="symbol symbol-50 symbol-light mr-4">\
                                                            <div class="symbol-label">No Img</div>\
                                                        </div>';
                                }
                            },
                        },
                        {
                            targets: -1,
                            title: 'Actions',
                            orderable: false,
                            render: function (data, type, full, meta) {
                                return '\
                                                            <a href="/admin/medical-centers/' + data + '/edit" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
                                                                <i class="la la-edit"></i>\
                                                            </a>\
                                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-center" data-id="' + data + '" title="Delete">\
                                                                <i class="la la-trash"></i>\
                                                            </a>\
                                                        ';
                            },
                        },
                    ],
                });
            };

            return {
                init: function () {
                    initTable1();
                },
            };
        }();

        jQuery(document).ready(function () {
            KTDatatablesDataSourceAjaxServer.init();

            $(document).on('click', '.delete-center', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/medical-centers/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                if (response.status === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    );
                                    $('#kt_datatable').DataTable().ajax.reload();
                                }
                            }
                        });
                    }
                });
            });
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                });
            @endif
                            });
    </script>
@endpush