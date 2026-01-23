@extends('layouts.admin')

@section('title', 'Wafid - Add City Media')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Add City Hero Image</h3>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.city_media.index') }}"
                                class="btn btn-light-primary font-weight-bolder">
                                <i class="la la-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <form class="form" method="POST" action="{{ route('admin.city_media.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>City Name <span class="text-danger">*</span></label>
                                    <select name="city_name" class="form-control" required>
                                        <option value="">Select a City</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    </select>
                                    <span class="form-text text-muted">Select city to set its header hero image</span>
                                    @error('city_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Hero Image <span class="text-danger">*</span></label>
                                    <input type="file" name="hero_image" class="dropify" data-height="200" accept="image/*"
                                        required />
                                    <span class="form-text text-muted">Recommended: 1920x600 for high resolution</span>
                                    @error('hero_image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>SEO Description (Optional)</label>
                                    <textarea name="description" class="form-control" rows="3"
                                        placeholder="Short description for the city page hero section"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Save City Media</button>
                            <a href="{{ route('admin.city_media.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
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