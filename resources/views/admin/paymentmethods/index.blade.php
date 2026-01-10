@extends('layouts.admin')
@section('title', 'Payment Methods')
@section('content')
<div class="container">
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
                    <tr><th>ID</th><th>Bank/Account</th><th>Title</th><th>Number</th><th>Status</th><th>Actions</th></tr>
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
    $('#payment_methods_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url: "{{ route('admin.payment.methods.data') }}", type: "GET" },
        columns: [
            { data: 0 }, { data: 1 }, { data: 2 }, { data: 3 }, { data: 4 }, { data: 6 }
        ],
        columnDefs: [
            {
                targets: 4,
                render: function(data) {
                    return data == 1 ? '<span class="label label-light-success label-inline">Active</span>' : '<span class="label label-light-danger label-inline">Inactive</span>';
                }
            },
            {
                targets: 5,
                render: function (data, type, full) {
                    return `<a href="/admin/payment-methods/${data}/edit" class="btn btn-sm btn-clean btn-icon"><i class="la la-edit"></i></a>
                            <button class="btn btn-sm btn-clean btn-icon delete-btn" data-id="${data}"><i class="la la-trash"></i></button>`;
                }
            }
        ]
    });

    $(document).on("click", ".delete-btn", function () {
        let id = $(this).data("id");
        if(confirm("Are you sure?")) {
            $.ajax({
                url: `/admin/payment-methods/${id}`,
                type: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: function () { $('#payment_methods_datatable').DataTable().ajax.reload(); }
            });
        }
    });
});
</script>
@endpush