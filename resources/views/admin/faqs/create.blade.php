@extends('layouts.admin')
@section('title', 'FAQs')

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
                <h3 class="card-title">Add New FAQ</h3>
            </div>

            <form method="POST" action="{{ route('admin.faqs.save') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Question <span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control" placeholder="Enter the question" required>
                    </div>

                    <div class="form-group">
                        <label>Answer <span class="text-danger">*</span></label>
                        <textarea name="answer" class="form-control" rows="5" placeholder="Enter the detailed answer"
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('admin.faqs.page') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection