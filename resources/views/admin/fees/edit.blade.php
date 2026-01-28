@extends('layouts.admin')

@section('content')
    <style>
        /* Add top spacing on mobile to prevent card from touching header */
        @media (max-width: 991px) {
            .fees-container {
                padding-top: 1.5rem !important;
            }
        }
    </style>
    <div class="container fees-container">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Manage Appointment Fees</h3>
            </div>
            <form method="POST" action="{{ route('admin.fees.update') }}">
                @csrf
                <div class="card-body">

                    <h5 class="text-primary mb-4">Standard Appointments</h5>
                    <div class="form-group row mb-lg-4">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <label>Wafid Appointment Fee:</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">PKR</span></div>
                                <input type="number" name="wafid_fee" class="form-control"
                                    value="{{ $fees['wafid_fee'] ?? 4500 }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>NAVTTC Appointment Fee:</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">PKR</span></div>
                                <input type="number" name="navtech_fee" class="form-control"
                                    value="{{ $fees['navtech_fee'] ?? 18000 }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-lg-4">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <label>Tasheer Appointment Fee:</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">PKR</span></div>
                                <input type="number" name="tasheer_fee" class="form-control"
                                    value="{{ $fees['tasheer_fee'] ?? 500 }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Soft Skill Certificate Fee:</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">PKR</span></div>
                                <input type="number" name="softskill_fee" class="form-control"
                                    value="{{ $fees['softskill_fee'] ?? 1500 }}" required>
                            </div>
                        </div>
                    </div>

                    <hr class="my-6">

                    <h5 class="text-primary mb-4">Special Appointments (City Based)</h5>
                    <div class="form-group row mb-lg-4">
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <label>Gujranwala:</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">PKR</span></div>
                                <input type="number" name="special_gujranwala" class="form-control"
                                    value="{{ $fees['special_gujranwala'] ?? 7000 }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <label>Lahore:</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">PKR</span></div>
                                <input type="number" name="special_lahore" class="form-control"
                                    value="{{ $fees['special_lahore'] ?? 12000 }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>Other Cities (Default):</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">PKR</span></div>
                                <input type="number" name="special_default" class="form-control"
                                    value="{{ $fees['special_default'] ?? 4500 }}" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary font-weight-bold">Update Fees</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @if(session('success'))
        <script>
            $(document).ready(function () {
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
                        if (icon) icon.style.margin = '0 auto';
                    }
                });
            });
        </script>
    @endif
@endpush