@extends('layouts.admin')

@section('title', 'Wafid - Appointments')

@section('content')

<style>
    .new-record {
        background-color: #a9d3ff8a !important; /* light blue */
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
                            Wafid Appointments
                        </h3>
                    </div>                    
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-striped table-head-custom table-checkable" id="kt_datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Passport No</th>
                                <th>Mobile</th>
                                <th>Traveling Country</th>
                                <th>Payment Status</th>
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
<!--end::Content-->
@endsection

@push('scripts')
<script src="{{ asset('assets/admin/js/pages/crud/datatables/advanced/column-rendering.js?v=7.0.6') }}"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Updated Successfully!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false,
        position: 'center', 
        customClass: {
            popup: 'swal2-border-radius' 
        },
        didOpen: () => {
            const icon = Swal.getIcon();
            if(icon) icon.style.margin = '0 auto';
        }
    });
</script>
@endif
@endpush