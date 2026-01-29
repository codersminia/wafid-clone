@extends('layouts.admin')

@section('title', 'Blog Categories')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Edit Category</h3>
                    </div>
                    <form action="{{ route('admin.blog.categories.update', $category->id) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required
                                    id="cat_name">
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ $category->slug }}" required
                                    id="cat_slug">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                            <a href="{{ route('admin.blog.categories') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#cat_name').on('keyup', function () {
            var name = $(this).val();
            var slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#cat_slug').val(slug);
        });
    </script>
@endpush