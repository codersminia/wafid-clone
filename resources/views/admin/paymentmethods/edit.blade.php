@extends('layouts.admin')
@section('title', 'Edit Payment Method')

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header"><h3 class="card-title">Edit Method: {{ $method->account_name }}</h3></div>
        
        <form method="POST" action="{{ route('admin.payment.methods.update', $method->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Account Name:</label>
                        <input type="text" name="account_name" class="form-control" value="{{ $method->account_name }}" required>
                    </div>
                    <div class="col-lg-6">
                        <label>Account Title:</label>
                        <input type="text" name="account_title" class="form-control" value="{{ $method->account_title }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Account Number:</label>
                        <input type="text" name="account_number" class="form-control" value="{{ $method->account_number }}" required>
                    </div>
                    <div class="col-lg-6">
                        <label>IBAN Number:</label>
                        <input type="text" name="account_number" class="form-control" value="{{ $method->iban }}">
                    </div>                    
                </div>

                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Status:</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $method->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $method->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="d-block">QR Code Image:</label>
                        @php
                            $bgImg = $method->qr_code ? asset('uploads/qr/' . $method->qr_code) : asset('assets/media/users/blank.png');
                        @endphp
                        
                        <div class="image-input image-input-outline" id="kt_image_qr" style="background-image: url({{ asset('assets/media/users/blank.png') }})">
                            <div class="image-input-wrapper" style="background-image: url({{ $bgImg }})"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="Change QR Code">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="qr_code" accept=".png, .jpg, .jpeg"/>
                                <input type="hidden" name="qr_code_remove"/>
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Update Method</button>
                <a href="{{ route('admin.payment.methods.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    new KTImageInput('kt_image_qr');
</script>
@endpush