@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Edit Blog</h3>
                    </div>
                    <!--begin::Form-->
                    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- We use POST for update with Laravel usually needing PUT/PATCH but standard form submission is POST. Route is POST. -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{ $blog->title }}"
                                            required id="title" />
                                    </div>
                                    <div class="form-group">
                                        <label>Slug <span class="text-danger">*</span></label>
                                        <input type="text" name="slug" class="form-control" value="{{ $blog->slug }}"
                                            required id="slug" />
                                    </div>
                                    <div class="form-group">
                                        <label>Content <span class="text-danger">*</span></label>
                                        <textarea name="content" class="form-control" rows="10"
                                            required>{{ $blog->content }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="short_description" class="form-control"
                                            rows="3">{{ $blog->short_description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Featured Image</label>
                                        @if($blog->image)
                                            <div class="mb-2">
                                                <img src="{{ asset($blog->image) }}" 
                                                class="img-thumbnail"
                                                width="150px"
                                                alt="Current Image">
                                            </div>
                                        @endif
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="image"
                                                accept="image/*" />
                                            <label class="custom-file-label" for="customFile">Choose new file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>
                                                Published</option>
                                            <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft
                                            </option>
                                        </select>
                                    </div>
                                    <div class="separator separator-dashed my-5"></div>
                                    <h5>SEO Settings</h5>
                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ $blog->meta_title }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea name="meta_description" class="form-control"
                                            rows="3">{{ $blog->meta_description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <textarea name="meta_keywords" class="form-control"
                                            rows="3">{{ $blog->meta_keywords }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#title').on('keyup', function () {
            var title = $(this).val();
            var slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#slug').val(slug);
        });
    </script>
@endpush