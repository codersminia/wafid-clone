@extends('layouts.admin')

@section('title', 'Medical Centers')

@section('content')

    <style>
        /* Reduce spacing between form rows on mobile devices */
        @media (max-width: 991px) {
            .form-group.row {
                margin-bottom: 0.5rem !important;
            }

            /* Add top spacing on mobile to prevent card from touching header */
            .container {
                padding-top: 1.5rem !important;
            }
        }
    </style>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class=" container ">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Edit Medical Center: {{ $center->medical_center }}</h3>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.medical_centers.index') }}"
                                class="btn btn-light-primary font-weight-bolder">
                                <i class="la la-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="form" method="POST" action="{{ route('admin.medical_centers.update', $center->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <input type="text" name="country" class="form-control" placeholder="Enter country"
                                        value="{{ old('country', $center->country) }}" required />
                                    @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" class="form-control" placeholder="Enter city"
                                        value="{{ old('city', $center->city) }}" required />
                                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Medical Center Name <span class="text-danger">*</span></label>
                                    <input type="text" name="medical_center" class="form-control"
                                        placeholder="Enter center name"
                                        value="{{ old('medical_center', $center->medical_center) }}" required />
                                    @error('medical_center') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email"
                                        value="{{ old('email', $center->email) }}" />
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter phone number"
                                        value="{{ old('phone', $center->phone) }}" />
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <label>Address Line 1</label>
                                    <textarea name="address_line_1" class="form-control" rows="2"
                                        placeholder="Enter address line 1">{{ old('address_line_1', $center->address_line_1) }}</textarea>
                                    @error('address_line_1') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <label>Address Line 2</label>
                                    <textarea name="address_line_2" class="form-control" rows="2"
                                        placeholder="Enter address line 2">{{ old('address_line_2', $center->address_line_2) }}</textarea>
                                    @error('address_line_2') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 mb-3 mb-lg-0">
                                    <label>Website URL</label>
                                    <input type="url" name="website" class="form-control" placeholder="https://example.com"
                                        value="{{ old('website', $center->website) }}" />
                                    @error('website') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Rating (0-5)</label>
                                    <input type="number" step="0.1" min="0" max="5" name="rating" class="form-control"
                                        placeholder="0.0" value="{{ old('rating', $center->rating) }}" />
                                    @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Center Image (Recommended: 800x600)</label>
                                    <input type="file" name="image" class="dropify" data-height="200" accept="image/*"
                                        @if($center->image) data-default-file="{{ asset($center->image) }}" @endif />
                                    <span class="form-text text-muted">Upload a new photo to replace the current one.</span>
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary mr-2">Update Medical Center</button>
                                    <a href="{{ route('admin.medical_centers.index') }}"
                                        class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endpush