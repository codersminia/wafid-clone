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
                    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data"
                        id="blogForm">
                        @csrf
                        <!-- We use POST for update with Laravel usually needing PUT/PATCH but standard form submission is POST. Route is POST. -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title', $blog->title) }}" placeholder="Enter title" id="title"
                                            required />
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Slug <span class="text-danger">*</span></label>
                                        <input type="text" name="slug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            value="{{ old('slug', $blog->slug) }}" placeholder="Enter slug" id="slug"
                                            required />
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Content <span class="text-danger">*</span></label>
                                        <textarea name="content" id="summernote"
                                            class="form-control @error('content') is-invalid @enderror"
                                            rows="10">{{ old('content', $blog->content) }}</textarea>
                                        @error('content')
                                            <div class="text-danger mt-2 breadcrumb-item active" style="font-size: 0.9rem;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="short_description" class="form-control"
                                            rows="3">{{ old('short_description', $blog->short_description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Featured Image <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="dropify @error('image') is-invalid @enderror"
                                            accept=".png, .jpg, .jpeg" data-height="200" @if($blog->image)
                                            data-default-file="{{ asset($blog->image) }}" @endif />
                                        @error('image')
                                            <div class="text-danger mt-2" style="font-size: 0.9rem;">{{ $message }}</div>
                                        @enderror
                                        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span></label>
                                        <select name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>
                                                Published
                                            </option>
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

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 300,
                tabsize: 2
            });

            $('.dropify').dropify();

            $('#title').on('keyup', function () {
                var title = $(this).val();
                var slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $('#slug').val(slug);
            });

            // AJAX Submission
            $('#blogForm').on('submit', function (e) {
                e.preventDefault();
                var form = $(this);

                // Sync Summernote content
                $('#summernote').val($('#summernote').summernote('code'));

                var formData = new FormData(this);
                var submitBtn = form.find('button[type="submit"]');

                submitBtn.addClass('spinner spinner-white spinner-right').attr('disabled', true);
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');
                $('.text-danger.mt-2').remove();

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Blog updated successfully',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "{{ route('admin.blogs.index') }}";
                        });
                    },
                    error: function (xhr) {
                        submitBtn.removeClass('spinner spinner-white spinner-right').attr('disabled', false);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, messages) {
                                var input = $('[name="' + key + '"]');
                                input.addClass('is-invalid');

                                // Handling for Summernote
                                if (key === 'content') {
                                    $('#summernote').parent().append('<div class="text-danger mt-2" style="font-size: 0.9rem;">' + messages[0] + '</div>');
                                } else if (key === 'image') {
                                    $('.dropify').parent().after('<div class="text-danger mt-2" style="font-size: 0.9rem;">' + messages[0] + '</div>');
                                } else {
                                    input.parent().append('<div class="invalid-feedback">' + messages[0] + '</div>');
                                }
                            });

                            // Scroll to first error
                            var $firstError = $('.is-invalid, .text-danger').filter(':visible').first();
                            if ($firstError.length > 0) {
                                $('html, body').animate({
                                    scrollTop: $firstError.offset().top - 150
                                }, 500);
                            }
                        } else {
                            Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
                        }
                    }
                });
            });
        });
    </script>
@endpush