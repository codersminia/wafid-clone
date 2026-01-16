@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container">
        
        <div class="row">
            
            <!-- LEFT COLUMN: PERSONAL INFORMATION -->
            <div class="col-lg-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Personal Information</h3>
                        </div>
                    </div>
                    
                    <!-- FORM 1: INFO -->
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="action" value="info">
                        
                        <div class="card-body">                            

                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-lg-right">Full Name</label>
                                <div class="col-lg-6">
                                    <input type="text" required name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}"/>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-lg-right">Email Address</label>
                                <div class="col-lg-6">
                                    <input type="email" required name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"/>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Avatar Input -->
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-lg-right">Avatar</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-outline" id="kt_profile_avatar">
                                        <div class="image-input-wrapper" 
                                             style="background-image: url({{ $user->avatar ? asset($user->avatar) : asset('assets/admin/media/users/default.jpg') }})">
                                        </div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                    @error('avatar')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary mr-2">Save Information</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SECOND CARD: CHANGE PASSWORD -->
            <div class="col-lg-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Change Password</h3>
                        </div>
                    </div>

                    <!-- FORM 2: PASSWORD -->
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="action" value="password">

                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-lg-right">New Password</label>
                                <div class="col-lg-6">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="New password"/>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-lg-right">Confirm Password</label>
                                <div class="col-lg-6">
                                    <input type="password" required name="password_confirmation" class="form-control" placeholder="Verify password"/>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-danger mr-2">Update Password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize Metronic Image Input
    var avatar = new KTImageInput('kt_profile_avatar');

    $(document).ready(function() {
        var $firstError = $('.is-invalid').first();

        if ($firstError.length > 0) {
            // Animate scroll to the error location
            $('html, body').animate({
                // Scroll to the element's top position minus 200px (for sticky headers/spacing)
                scrollTop: $firstError.offset().top - 200
            }, 800); // 800ms animation speed
            
            // Optional: Focus on that input
            $firstError.focus();
        }
    });
</script>

<!-- SweetAlert Logic -->
@if(session('success'))
<script>
    $(document).ready(function() {
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
    });
</script>
@endif
@endpush