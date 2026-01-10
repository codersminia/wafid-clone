@extends('layouts.admin')
@section('title', 'Soft Skill Certificates')
@section('content')
<style>.new-record { background-color: #a9d3ff8a !important; }</style>
<div class="container">
    <div class="card card-custom">
        <div class="card-header flex-wrap py-5"><h3 class="card-title">Soft Skill Certificates</h3></div>
        <div class="card-body">
            <table class="table table-striped table-head-custom" id="softskill_datatable">
                <thead class="thead-dark">
                    <tr><th>ID</th><th>WhatsApp</th><th>Status</th><th>Date</th><th>Actions</th></tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/admin/js/pages/crud/datatables/advanced/softskill-appointments.js?v=7.0.6') }}"></script>
@endpush