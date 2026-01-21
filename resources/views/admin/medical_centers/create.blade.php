@extends('layouts.admin')

@section('title', 'Wafid - Add Medical Center')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class=" container ">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Add New Medical Center</h3>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.medical_centers.index') }}"
                                class="btn btn-light-primary font-weight-bolder">
                                <i class="la la-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="form" method="POST" action="{{ route('admin.medical_centers.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <input type="text" name="country" class="form-control" placeholder="Enter country"
                                        value="{{ old('country', 'Pakistan') }}" required />
                                    @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" class="form-control" placeholder="Enter city"
                                        value="{{ old('city') }}" required />
                                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>Medical Center Name <span class="text-danger">*</span></label>
                                    <input type="text" name="medical_center" class="form-control"
                                        placeholder="Enter center name" value="{{ old('medical_center') }}" required />
                                    @error('medical_center') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email"
                                        value="{{ old('email') }}" />
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter phone number"
                                        value="{{ old('phone') }}" />
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Address Line 1</label>
                                    <textarea name="address_line_1" class="form-control" rows="2"
                                        placeholder="Enter address line 1">{{ old('address_line_1') }}</textarea>
                                    @error('address_line_1') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>Address Line 2</label>
                                    <textarea name="address_line_2" class="form-control" rows="2"
                                        placeholder="Enter address line 2">{{ old('address_line_2') }}</textarea>
                                    @error('address_line_2') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8">
                                    <label>Website URL</label>
                                    <input type="url" name="website" class="form-control" placeholder="https://example.com"
                                        value="{{ old('website') }}" />
                                    @error('website') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>Rating (0-5)</label>
                                    <input type="number" step="0.1" min="0" max="5" name="rating" class="form-control"
                                        placeholder="0.0" value="{{ old('rating', '0.0') }}" />
                                    @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary mr-2">Save Medical Center</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
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