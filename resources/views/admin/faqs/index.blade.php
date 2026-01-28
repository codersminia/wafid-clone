@extends('layouts.admin')
@section('title', 'FAQs')
@section('content')
    <style>
        /* Add top spacing on mobile to prevent card from touching header */
        @media (max-width: 991px) {
            .faqs-container {
                padding-top: 1.5rem !important;
            }
        }
    </style>
    <div class="container faqs-container">
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <h3 class="card-title">Frequently Asked Questions</h3>
                <div class="card-toolbar">
                    {{-- Corrected Route: admin.faqs.add --}}
                    <a href="{{ route('admin.faqs.add') }}" class="btn btn-primary font-weight-bolder">
                        <i class="la la-plus"></i> Add New FAQ
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-head-custom" id="faqs_datatable">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Answer (Preview)</th>
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
            // 1. Success Alert
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

        var table = $('#faqs_datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: {
                    url: "{{ route('admin.faqs.data') }}",
                    type: "GET",
                },
                columns: [
                    { data: 0, responsivePriority: 5 }, // ID
                    { data: 1, responsivePriority: 1 }, // Question
                    { data: 2, responsivePriority: 3 }, // Answer
                    { data: 3, responsivePriority: 4 }, // Status
                    { data: 4, responsivePriority: 2 }  // Actions
                ],
                columnDefs: [
                    {
                        targets: 4, // Actions is the 5th column (index 4)
                        orderable: false, // Cannot sort by buttons
                        searchable: false // Cannot search by buttons
                    },
                    {
                        targets: 2, // Optional: Disable sorting on Answer if it's too long/heavy
                        orderable: false
                    }
                ]
            });

            // 2. Delete Confirmation
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
                            // Corrected URL to match custom route: Route::delete('faq-remove/{id}')
                            url: `/admin/faq-remove/${id}`,
                            type: "DELETE",
                            data: { _token: "{{ csrf_token() }}" },
                            success: function (response) {
                                table.ajax.reload();
                                Swal.fire("Deleted!", "The FAQ has been deleted.", "success");
                            },
                            error: function () {
                                Swal.fire("Error!", "Something went wrong.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush