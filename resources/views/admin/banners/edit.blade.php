@extends('layouts.admin')

@section('title', 'Edit Banner')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header py-5">
                    <div class="card-title">
                        <h3 class="card-label">Edit Banner</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Current Image</label>
                            <div class="mb-3">
                                <img src="{{ asset($banner->image) }}" class="img-fluid rounded shadow-sm" style="max-height:200px;">
                            </div>
                            <label>Replace Image <span class="text-muted">(optional)</span></label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Leave empty to keep current image. Recommended: 1920×600px.</small>
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Subtitle</label>
                            <input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button Text</label>
                                    <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button URL</label>
                                    <input type="text" name="button_url" value="{{ old('button_url', $banner->button_url) }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" class="form-control" min="0">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center pt-4">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-success">
                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                                        <span></span> Active (show on homepage)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
