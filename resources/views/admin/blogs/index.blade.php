@extends('layouts.admin')

@section('title', 'Blogs')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                Blogs
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary font-weight-bolder">
                                <i class="la la-plus"></i> New Blog
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-head-custom" id="kt_datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#kt_datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.blogs.data') }}",
                columns: [
                    { data: 0 },
                    { data: 1 },
                    { data: 2, responsivePriority: 1 },
                    { data: 3 },
                    { data: 4 },
                    { data: 5 },
                    { data: 6, orderable: false, searchable: false, responsivePriority: -1 }
                ],
                columnDefs: [
                    {
                        targets: 1,
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
                ],
                order: [[0, "desc"]]
            });

            // Delete
            $(document).on('click', '.delete-blog', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/blogs/" + id,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (response) {
                                Swal.fire('Deleted!', response.message, 'success');
                                table.ajax.reload();
                            }
                        });
                    }
                })
            });
        });
    </script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
@endpush