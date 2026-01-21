@extends('layouts.public')

@section('title', 'Latest News & Updates - Gulf Medical Consultant')
@section('meta_description', 'Stay updated with the latest news, guidelines, and articles regarding GCC medical examinations and visa processes.')

@section('content')

    <!-- Hero Section -->
    <section class="page-title-section py-5"
        style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('assets/public/images/hero-bg.jpg') }}') center/cover no-repeat;">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-4 font-weight-bold text-white mb-3">Health & Travel Insights</h1>
                    <p class="lead text-white-50 mb-0">Your comprehensive guide to GCC medical procedures and visa
                        requirements.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-5 bg-light-grey">
        <div class="container">
            <div class="row">
                <!-- Main Listing -->
                <div class="col-lg-8 order-2 order-lg-1">
                    @if($blogs->count() > 0)
                        <div class="row">
                            @foreach($blogs as $blog)
                                <div class="col-md-6 mb-4">
                                    <div
                                        class="blog-entry-card h-100 bg-white rounded-lg shadow-sm overflow-hidden border-0 transition-hover">
                                        <div class="position-absolute p-3 z-index-1">
                                            @if($blog->category)
                                                <span
                                                    class="badge badge-theme px-3 py-2 shadow-sm font-weight-bold">{{ $blog->category->name }}</span>
                                            @endif
                                        </div>

                                        <div class="blog-thumb">
                                            <a href="{{ route('public.blogs.details', $blog->slug) }}"
                                                class="d-block overflow-hidden">
                                                @if($blog->image)
                                                    <img src="{{ asset($blog->image) }}" class="img-fluid transition-scale"
                                                        alt="{{ $blog->title }}" style="height: 240px; width: 100%; object-fit: cover;">
                                                @else
                                                    <div class="bg-dark d-flex align-items-center justify-content-center text-white-50"
                                                        style="height: 240px;">
                                                        <i class="fas fa-image fa-3x"></i>
                                                    </div>
                                                @endif
                                            </a>
                                        </div>

                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3 text-muted small">
                                                <span class="mr-3"><i class="far fa-calendar-alt mr-1 text-theme"></i>
                                                    {{ $blog->published_at->format('M d, Y') }}</span>
                                                <span><i class="far fa-user mr-1 text-theme"></i> Admin</span>
                                            </div>
                                            <h4 class="h5 font-weight-bold mb-3">
                                                <a href="{{ route('public.blogs.details', $blog->slug) }}"
                                                    class="text-dark hover-theme text-decoration-none">
                                                    {{ Str::limit($blog->title, 60) }}
                                                </a>
                                            </h4>
                                            <p class="text-muted mb-4 small">
                                                {{ Str::limit($blog->short_description, 120) }}
                                            </p>
                                            <a href="{{ route('public.blogs.details', $blog->slug) }}"
                                                class="btn btn-link text-theme font-weight-bold p-0 text-decoration-none">
                                                READ ARTICLE <i class="fas fa-long-arrow-alt-right ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Enhanced Pagination -->
                        <div class="mt-5">
                            {{ $blogs->appends(request()->input())->links() }}
                        </div>
                    @else
                        <div class="text-center py-5 bg-white rounded shadow-sm">
                            <i class="far fa-folder-open fa-4x text-muted mb-3"></i>
                            <h3 class="text-muted">No Articles Found</h3>
                            <p class="text-muted">Try adjusting your search or filters to find what you're looking for.</p>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 pl-lg-5 order-1 order-lg-2 mb-4 mb-lg-0">
                    <div class="sticky-top" style="top: 100px; z-index: 100;">

                        <!-- Search Widget -->
                        <div class="sidebar-widget mb-5">
                            <form action="{{ route('public.blogs') }}" method="GET">
                                <div class="search-box position-relative">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control form-control-lg border-0 shadow-sm pr-5"
                                        placeholder="Search articles...">
                                    <button type="submit" class="btn position-absolute pr-4 text-theme"
                                        style="right: 0; top: 50%; transform: translateY(-50%); background: none; border: none;">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Categories Widget -->
                        <div class="sidebar-widget mb-5 p-4 bg-white rounded shadow-sm">
                            <h5 class="font-weight-bold mb-4 position-relative pb-2 section-title-sm">Categories</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                                    <a href="{{ route('public.blogs') }}"
                                        class="text-dark hover-theme text-decoration-none {{ !request('category') ? 'font-weight-bold text-theme' : '' }}">
                                        <i class="fas fa-chevron-right mr-2 small text-theme"></i> All Categories
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                                        <a href="{{ route('public.blogs', ['category' => $category->id] + request()->except('category')) }}"
                                            class="text-dark hover-theme text-decoration-none {{ request('category') == $category->id ? 'font-weight-bold text-theme' : '' }}">
                                            <i class="fas fa-chevron-right mr-2 small text-theme"></i> {{ $category->name }}
                                        </a>
                                        <span class="badge badge-light badge-pill px-3">{{ $category->blogs_count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('head')
    <style>
        /* Modern Design System Tokens - Updated to Theme Color #FFC654 */
        :root {
            --theme-color: #FFC654;
            --dark-blue: #1a1a1a;
            --shadow-soft: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .bg-light-grey {
            background-color: #f8f9fa;
        }

        .text-theme {
            color: var(--theme-color) !important;
        }

        .bg-theme {
            background-color: var(--theme-color) !important;
        }

        .badge-theme {
            background-color: var(--theme-color);
            color: #000;
        }

        /* Card Interactions */
        .transition-hover {
            transition: var(--transition);
        }

        .transition-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12) !important;
        }

        .blog-thumb img {
            transition: transform 0.8s ease;
        }

        .blog-entry-card:hover .transition-scale {
            transform: scale(1.1);
        }

        .hover-theme:hover {
            color: var(--theme-color) !important;
        }

        /* Sidebar Accents */
        .section-title-sm::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 3px;
            background: var(--theme-color);
        }

        /* Custom Icon Circle */
        .icon-circle {
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Pagination Styling */
        .pagination .page-item.active .page-link {
            background-color: var(--theme-color);
            border-color: var(--theme-color);
            color: #000;
        }

        .pagination .page-link {
            color: var(--dark-blue);
            border: none;
            margin: 0 5px;
            border-radius: 4px !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .z-index-1 {
            z-index: 1;
        }

        .btn:focus {
            box-shadow: none !important;
        }

        /* Mobile Sidebar Adjustments */
        @media (max-width: 991px) {
            .sticky-top {
                position: relative !important;
                top: 0 !important;
                z-index: 1 !important;
            }
            .sidebar-widget {
                margin-bottom: 25px !important;
            }
        }
    </style>
@endpush