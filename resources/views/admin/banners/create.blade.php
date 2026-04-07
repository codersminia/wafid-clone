@extends('layouts.admin')

@section('title', 'Add Banner')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header py-5">
                    <div class="card-title">
                        <h3 class="card-label">Add New Banner</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Banner Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                            <small class="text-muted">Recommended size: 1920×600px. JPG, PNG, WEBP. Max 5MB.</small>
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Title <span class="text-muted">(optional)</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="e.g. Gulf Medical Consultants">
                        </div>

                        <div class="form-group">
                            <label>Subtitle <span class="text-muted">(optional)</span></label>
                            <input type="text" name="subtitle" value="{{ old('subtitle') }}" class="form-control" placeholder="e.g. Fast & Reliable Service">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button Text <span class="text-muted">(optional)</span></label>
                                    <input type="text" name="button_text" value="{{ old('button_text') }}" class="form-control" placeholder="e.g. Book Now">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button URL <span class="text-muted">(optional)</span></label>
                                    <input type="text" name="button_url" value="{{ old('button_url') }}" class="form-control" placeholder="e.g. /wafid-appointment">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control" min="0">
                                    <small class="text-muted">Lower number = shown first.</small>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center pt-4">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-success">
                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                        <span></span> Active (show on homepage)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
