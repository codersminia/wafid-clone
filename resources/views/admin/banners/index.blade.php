@extends('layouts.admin')

@section('title', 'Banners')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">Homepage Banners</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary font-weight-bolder">
                            <i class="la la-plus"></i> Add Banner
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($banners as $banner)
                        <div class="col-md-4 mb-5">
                            <div class="card border {{ $banner->is_active ? 'border-success' : 'border-secondary' }}">
                                <img src="{{ asset($banner->image) }}" class="card-img-top" style="height:180px; object-fit:cover;">
                                <div class="card-body p-3">
                                    <h6 class="font-weight-bold mb-1">{{ $banner->title ?? '(No Title)' }}</h6>
                                    <p class="text-muted small mb-2">{{ $banner->subtitle ?? '' }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge {{ $banner->is_active ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                        <span class="text-muted small">Order: {{ $banner->sort_order }}</span>
                                    </div>
                                </div>
                                <div class="card-footer p-2 d-flex justify-content-between">
                                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-light-primary">
                                        <i class="la la-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-light-danger delete-banner" data-id="{{ $banner->id }}">
                                        <i class="la la-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info">No banners yet. <a href="{{ route('admin.banners.create') }}">Add your first banner</a>.</div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.delete-banner', function () {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Delete this banner?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/banners/' + id,
                    type: 'DELETE',
                    data: { "_token": "{{ csrf_token() }}" },
                    success: function (res) {
                        Swal.fire('Deleted!', res.message, 'success').then(() => location.reload());
                    }
                });
            }
        });
    });

    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Success!', text: "{{ session('success') }}", timer: 2000, showConfirmButton: false });
    @endif
</script>
@endpush
