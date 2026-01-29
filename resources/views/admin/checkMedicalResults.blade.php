@extends('layouts.admin')

@section('title', 'Check Results')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header py-5">
                    <h3 class="card-title">Medical Results Requests</h3>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-head-custom table-checkable" id="kt_check_results">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Passport No</th>
                                <th>Phone</th>
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

<style>
/* Blue for new records */
.new-record {
    background-color: #cce5ff !important;
}
</style>

@endsection

@push('scripts')
<script src="{{ asset('assets/admin/js/pages/crud/datatables/advanced/result-check.js?v=7.0.6') }}"></script>
@endpush