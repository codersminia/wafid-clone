@extends('layouts.admin')
@section('title', 'Add Payment Method')

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">Add Payment Method</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.payment.methods.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Account Name (Bank/App):</label>
                        <input type="text" name="account_name" class="form-control" placeholder="e.g. Easypaisa, HBL" required>
                    </div>
                    <div class="col-lg-6">
                        <label>Account Title:</label>
                        <input type="text" name="account_title" class="form-control" placeholder="Account Holder Name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Account Number:</label>
                        <input type="text" name="account_number" class="form-control" placeholder="Enter number" required>
                    </div>
                    <div class="col-lg-6">
                        <label>IBAN Number (Optional):</label>
                        <input type="text" name="iban" class="form-control" placeholder="Enter IBAN">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="d-block">QR Code Image:</label>
                        <!-- Metronic Image Input -->
                        <div class="image-input image-input-empty image-input-outline" id="kt_image_qr" style="background-image: url({{ asset('assets/admin/media/bg/bg-3.jpg') }})">
                            <div class="image-input-wrapper"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="Change QR Code">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="qr_code" accept=".png, .jpg, .jpeg" required />
                                <input type="hidden" name="qr_code_remove"/>
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Save Method</button>
                <a href="{{ route('admin.payment.methods.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var avatar = new KTImageInput('kt_image_qr');

    avatar.on('change', function(imageInput) {
        swal.fire({
            title: 'Image uploaded successfully!',
            icon: 'success',
            buttonsStyling: false,
            confirmButtonText: 'OK',
            customClass: { confirmButton: 'btn btn-primary font-weight-bold' }
        });
    });
</script>
@endpush