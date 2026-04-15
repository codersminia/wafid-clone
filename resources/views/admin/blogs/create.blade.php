@extends('layouts.admin')

@section('title', 'Blogs')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Add New Blog</h3>
                    </div>
                    <!--begin::Form-->
                    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data"
                        id="blogForm">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}" placeholder="Enter title" id="title" required />
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Slug <span class="text-danger">*</span></label>
                                        <input type="text" name="slug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            value="{{ old('slug') }}" placeholder="Enter slug" id="slug" required />
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Content <span class="text-danger">*</span></label>
                                        <textarea name="content" id="summernote"
                                            class="form-control @error('content') is-invalid @enderror"
                                            rows="10">{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="text-danger mt-2 breadcrumb-item active" style="font-size: 0.9rem;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="short_description" class="form-control" rows="3"
                                            placeholder="Brief summary">{{ old('short_description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Featured Image <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="dropify @error('image') is-invalid @enderror"
                                            accept=".png, .jpg, .jpeg" data-height="200" required />
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
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="published">Published</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>

                                    <div class="separator separator-dashed my-5"></div>
                                    <h5>SEO Settings</h5>
                                    <div class="form-group">
                                        <label>Focus Keyword</label>
                                        <input type="text" name="focus_keyword" class="form-control"
                                            value="{{ old('focus_keyword') }}" placeholder="e.g. gamca medical test" />
                                    </div>
                                    <div class="form-group">
                                        <label>Featured Image ALT</label>
                                        <input type="text" name="featured_image_alt" class="form-control"
                                            value="{{ old('featured_image_alt') }}" placeholder="Describe the image" />
                                    </div>
                                    <div class="form-group">
                                        <label>Author</label>
                                        <input type="text" name="author" class="form-control"
                                            value="{{ old('author', 'Editorial Team') }}" placeholder="Editorial Team" />
                                    </div>
                                    <div class="form-group">
                                        <label>Tags</label>
                                        <input type="text" name="tags" class="form-control"
                                            value="{{ old('tags') }}" placeholder="gamca, wafid, gcc medical" />
                                        <span class="form-text text-muted">Comma separated tags.</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <textarea name="meta_keywords" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
                            text: 'Blog created successfully',
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