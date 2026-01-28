@extends('layouts.admin')
@section('title', 'Edit FAQ')

@section('content')
    <style>
        /* Add top spacing on mobile to prevent card from touching header */
        @media (max-width: 991px) {
            .faqs-container {
                padding-top: 1.5rem !important;
            }
        }
    </style>
    <div class="container faqs-container">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Edit FAQ</h3>
            </div>

            {{-- Action points to the custom POST route: admin.faqs.update --}}
            <form method="POST" action="{{ route('admin.faqs.update', $faq->id) }}">
                @csrf

                {{-- NOTE: Removed @method('PUT') because your route is defined as Route::post(...) --}}

                <div class="card-body">
                    <div class="form-group">
                        <label>Question <span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
                    </div>

                    <div class="form-group">
                        <label>Answer <span class="text-danger">*</span></label>
                        <textarea name="answer" class="form-control" rows="5" required>{{ $faq->answer }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $faq->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $faq->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="{{ route('admin.faqs.page') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection