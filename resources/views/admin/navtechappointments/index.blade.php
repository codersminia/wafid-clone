@extends('layouts.admin')
@section('title', 'Navtech Appointments')

@section('content')
<style>
    .new-record { background-color: #a9d3ff8a !important; }
    
    /* Add top spacing on mobile to prevent card from touching header */
    @media (max-width: 991px) {
        .container {
            padding-top: 1.5rem !important;
        }
    }
</style>

<div class="content d-flex flex-column flex-column-fluid">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title"><h3 class="card-label">NAVTTC Appointments</h3></div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-head-custom table-checkable" id="navtech_datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Occupation</th>
                                <th>WhatsApp</th>
                                <th>Country</th>
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
@endsection

@push('scripts')
<script src="{{ asset('assets/admin/js/pages/crud/datatables/advanced/navtech-appointments.js?v=7.0.6') }}"></script>

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