@extends('layouts.admin')

@section('title', 'Wafid - City Media Management')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">City Hero Images
                                <span class="d-block text-muted pt-2 font-size-sm">Manage dynamic hero images for city
                                    pages</span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.medical_centers.index') }}"
                                class="btn btn-light-primary font-weight-bolder mr-2">
                                <i class="la la-arrow-left"></i> Back to Medical Centers
                            </a>
                            <a href="{{ route('admin.city_media.create') }}" class="btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <i class="la la-plus"></i>
                                </span>Add City Hero Image</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-head-custom" id="kt_datatable">
                            <thead>
                                <tr class="thead-dark">
                                    <th>ID</th>
                                    <th>City Name</th>
                                    <th>Hero Image</th>
                                    <th>Created At</th>
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
@endsection

@push('scripts')
    <script>
        var table = $('#kt_datatable').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.city_media.data') }}",
                type: 'GET',
            },
            columns: [
                { data: '0' },
                { data: '1' },
                { data: '2' },
                { data: '3' },
                { data: '4', responsivePriority: -1 },
            ],
            columnDefs: [
                {
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return `
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-btn" data-id="${full[5]}" title="Delete">
                                    <i class="la la-trash text-danger"></i>
                                </a>
                            `;
                    },
                },
            ],
        });

        $(document).on('click', '.delete-btn', function () {
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('admin/city-media') }}/" + id,
                        type: 'DELETE',
                        data: { _token: "{{ csrf_token() }}" },
                        success: function () {
                            table.draw();
                            Swal.fire("Deleted!", "City Media has been deleted.", "success");
                        }
                    });
                }
            });
        });
    </script>
@endpush