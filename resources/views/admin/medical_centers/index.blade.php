@extends('layouts.admin')

@section('title', 'Wafid - Medical Centers')

@section('content')

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
                            <a href="{{ route('admin.medical_centers.create') }}"
                                class="btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
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
                                    <!--end::Svg Icon-->
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
                    {data: 0},
                    {data: 1},
                    {data: 2, responsivePriority: 1},
                    {data: 3},
                    {data: 4, responsivePriority: -1},
                    ],
                    columnDefs: [
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