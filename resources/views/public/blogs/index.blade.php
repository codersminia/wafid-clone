@extends('layouts.public')

@section('title', 'Latest News & Updates - Gulf Medical Consultant')
@section('meta_description', 'Stay updated with the latest news, guidelines, and articles regarding GCC medical examinations and visa processes.')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1 class="font-weight-bold">Latest News & Articles</h1>
            <p class="lead">Insights and updates for your journey abroad.</p>
        </div>
    </section>

    <!-- Blog Listing -->
    <section class="py-5 bg-light-grey">
        <div class="container">
            @if($blogs->count() > 0)
                <div class="row">
                    @foreach($blogs as $blog)
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                                @if($blog->image)
                                    <a href="{{ route('public.blogs.details', $blog->slug) }}">
                                        <img src="{{ asset($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}"
                                            style="height: 200px; object-fit: cover;">
                                    </a>
                                @else
                                    <a href="{{ route('public.blogs.details', $blog->slug) }}">
                                        <div class="bg-secondary d-flex align-items-center justify-content-center text-white"
                                            style="height: 200px;">
                                            <i class="fas fa-image fa-3x"></i>
                                        </div>
                                    </a>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        @if($blog->category)
                                            <span class="badge badge-primary">{{ $blog->category->name }}</span>
                                        @endif
                                        <span class="text-muted small ml-2"><i class="far fa-clock"></i>
                                            {{ $blog->published_at->format('M d, Y') }}</span>
                                    </div>
                                    <h5 class="card-title font-weight-bold">
                                        <a href="{{ route('public.blogs.details', $blog->slug) }}"
                                            class="text-dark text-decoration-none hover-primary">
                                            {{ Str::limit($blog->title, 60) }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ Str::limit($blog->short_description, 100) }}
                                    </p>
                                    <a href="{{ route('public.blogs.details', $blog->slug) }}"
                                        class="font-weight-bold text-primary mt-3">Read More <i
                                            class="fas fa-arrow-right small"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="far fa-newspaper fa-4x text-muted"></i>
                    </div>
                    <h3 class="text-muted">No articles found</h3>
                    <p class="text-muted">Check back later for updates.</p>
                </div>
            @endif
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .hover-primary:hover {
            color: #007bff !important;
            /* Adjust based on theme primary color */
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush