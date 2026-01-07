@extends('layouts.admin')
@section('title', 'Tasheer Appointments')
@section('content')
<style>.new-record { background-color: #a9d3ff8a !important; }</style>
<div class="container">
    <div class="card card-custom">
        <div class="card-header flex-wrap py-5"><h3 class="card-title">Tasheer Appointments</h3></div>
        <div class="card-body">
            <table class="table table-striped table-head-custom table-checkable" id="tasheer_datatable">
                <thead class="thead-dark">
                    <tr><th>ID</th><th>Embassy</th><th>WhatsApp</th><th>Status</th><th>Date</th><th>Actions</th></tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/admin/js/pages/crud/datatables/advanced/tasheer-appointments.js?v=7.0.6') }}"></script>
@if(session('success'))
<script>Swal.fire({ icon: 'success', title: 'Updated!', text: "{{ session('success') }}", timer: 2000, showConfirmButton: false });</script>
@endif
@endpush