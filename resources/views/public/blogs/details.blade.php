@extends('layouts.public')

@section('title', $blog->meta_title ?? $blog->title . ' - Gulf Medical Consultant')
@section('meta_description', $blog->meta_description ?? Str::limit($blog->short_description, 160))
@section('meta_keywords', $blog->meta_keywords)
@if($blog->image)
@section('og_image', asset($blog->image))
@endif

@section('content')

    @push('schema')
        ,{
            "@type": "BlogPosting",
            "@id": "{{ url()->current() }}#blog",
            "headline": "{{ $blog->title }}",
            "image": "{{ $blog->image ? asset($blog->image) : asset('assets/public/images/hero-bg.jpg') }}",
            "author": { "@id": "{{ url('/') }}#organization" },
            "publisher": { "@id": "{{ url('/') }}#organization" },
            "datePublished": "{{ $blog->published_at->toIso8601String() }}",
            "description": "{{ $blog->meta_description ?? Str::limit($blog->short_description, 160) }}"
        }
    @endpush

    <!-- Article Header -->
    <section class="article-hero py-5 position-relative bg-dark" style="min-height: 400px;">
        @if($blog->image)
            <div class="position-absolute w-100 h-100 top-0 left-0"
                style="background: url('{{ asset($blog->image) }}') center/cover no-repeat; opacity: 0.4;"></div>
        @endif
        <div class="position-absolute w-100 h-100 top-0 left-0 bg-gradient-to-bottom"></div>

        <div class="container position-relative py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center text-white">
                    <div class="mb-4">
                        @if($blog->category)
                            <span
                                class="badge badge-theme px-4 py-2 border-0 shadow-sm font-weight-bold">{{ $blog->category->name }}</span>
                        @endif
                    </div>
                    <h1 class="display-4 font-weight-bold mb-4 line-height-sm text-theme">{{ $blog->title }}</h1>

                    <div class="d-flex align-items-center justify-content-center text-white-50">
                        <div class="d-flex align-items-center mx-3">
                            <i class="far fa-calendar-alt mr-2 text-theme"></i>
                            <span>Published on {{ $blog->published_at->format('F d, Y') }}</span>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                            <i class="far fa-clock mr-2 text-theme"></i>
                            <span>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb Bar -->
    <div class="bg-white border-bottom py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 m-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('public.blogs') }}" class="text-muted">Blogs</a></li>
                    <li class="breadcrumb-item active text-theme font-weight-bold" aria-current="page">
                        {{ Str::limit($blog->title, 40) }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Article Body -->
    <section class="py-5 bg-light-grey">
        <div class="container">
            <div class="row">
                <!-- Main Reading Area -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-lg overflow-hidden mb-5">
                        <div class="card-body p-4 p-md-5 bg-white">

                            <!-- Full Image in Content if needed -->
                            @if($blog->image)
                                <div class="mb-5">
                                    <img src="{{ asset($blog->image) }}" class="img-fluid rounded shadow-lg w-100"
                                        alt="{{ $blog->title }}">
                                </div>
                            @endif

                            <div class="blog-reading-content">
                                @if(strip_tags($blog->content) == $blog->content)
                                    {!! nl2br(e($blog->content)) !!}
                                @else
                                    {!! $blog->content !!}
                                @endif
                            </div>

                            <!-- Social Sharing -->
                            <div
                                class="article-footer mt-5 pt-5 border-top d-flex flex-wrap align-items-center justify-content-between">
                                <div class="mb-3 mb-md-0">
                                    <h6 class="font-weight-bold mb-2">Share this insight:</h6>
                                    <div class="share-buttons">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                            target="_blank" class="share-btn fb"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}"
                                            target="_blank" class="share-btn tw"><i class="fab fa-twitter"></i></a>
                                        <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->fullUrl()) }}"
                                            target="_blank" class="share-btn wa"><i class="fab fa-whatsapp"></i></a>
                                        <a href="mailto:?subject={{ $blog->title }}&body={{ request()->fullUrl() }}"
                                            class="share-btn mail"><i class="far fa-envelope"></i></a>
                                    </div>
                                </div>
                                <div class="tags-cloud">
                                    @if($blog->meta_keywords)
                                        @foreach(explode(',', $blog->meta_keywords) as $tag)
                                            <span class="badge badge-light px-3 py-2 mr-1">#{{ trim($tag) }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 pl-lg-5">
                    <div class="sticky-top" style="top: 100px; z-index: 100;">

                        <!-- CTA Widget -->
                        <div class="card bg-theme text-dark border-0 shadow-lg mb-5 overflow-hidden">
                            <div class="position-absolute w-100 h-100"
                                style="background: url('{{ asset('assets/public/images/hero-bg.jpg') }}') center/cover; opacity: 0.1;">
                            </div>
                            <div class="card-body position-relative p-4 text-center">
                                <h4 class="font-weight-bold mb-3">Book Your Medical Slip</h4>
                                <p class="small text-dark-50 mb-4 font-weight-bold">Official Wafid/GAMCA appointments with
                                    100% security and fast delivery.</p>
                                <a href="{{ route('medicalExamination') }}"
                                    class="btn btn-dark btn-block font-weight-bold py-3">BOOK INSTANTLY</a>
                            </div>
                        </div>

                        <!-- Recent Posts -->
                        @if($recentBlogs->count() > 0)
                            <div class="sidebar-widget mb-5 p-4 bg-white rounded shadow-sm">
                                <h5 class="font-weight-bold mb-4 position-relative pb-2 section-title-sm">Related Articles</h5>
                                @foreach($recentBlogs as $recent)
                                    <div class="media mb-4 align-items-center">
                                        <div class="recent-thumb mr-3">
                                            <a href="{{ route('public.blogs.details', $recent->slug) }}"
                                                class="d-block overflow-hidden rounded">
                                                @if($recent->image)
                                                    <img src="{{ asset($recent->image) }}" alt="{{ $recent->title }}"
                                                        style="width: 70px; height: 70px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center text-muted"
                                                        style="width: 70px; height: 70px;">
                                                        <i class="far fa-image"></i>
                                                    </div>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="font-weight-bold mb-1 small">
                                                <a href="{{ route('public.blogs.details', $recent->slug) }}"
                                                    class="text-dark text-decoration-none hover-theme">
                                                    {{ Str::limit($recent->title, 45) }}
                                                </a>
                                            </h6>
                                            <small class="text-muted"><i class="far fa-calendar-alt text-theme mr-1"></i>
                                                {{ $recent->published_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('head')
    <style>
        /* Article specific styling - Updated to Yellow Theme #FFC654 */
        :root {
            --theme-color: #FFC654;
            --dark-blue: #1a1a1a;
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

        .article-hero {
            display: flex;
            align-items: center;
        }

        .bg-gradient-to-bottom {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.8) 100%);
        }

        .line-height-sm {
            line-height: 1.2;
        }

        .blog-reading-content {
            font-size: 1.15rem;
            line-height: 1.9;
            color: #2c3e50;
        }

        .blog-reading-content p {
            margin-bottom: 25px;
        }

        .blog-reading-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 30px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .blog-reading-content h2,
        .blog-reading-content h3 {
            font-weight: 700;
            margin-top: 50px;
            margin-bottom: 20px;
            color: #1a1a1a;
        }

        /* Share Buttons */
        .share-btn {
            display: inline-block;
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            color: #fff !important;
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .share-btn:hover {
            transform: translateY(-3px);
            opacity: 0.9;
        }

        .share-btn.fb {
            background: #3b5998;
        }

        .share-btn.tw {
            background: #1da1f2;
        }

        .share-btn.wa {
            background: #25d366;
        }

        .share-btn.mail {
            background: #7f8c8d;
        }

        .section-title-sm::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 3px;
            background: var(--theme-color);
        }

        .hover-theme:hover {
            color: var(--theme-color) !important;
        }

        .recent-thumb img {
            transition: transform 0.4s ease;
        }

        .recent-thumb:hover img {
            transform: scale(1.1);
        }

        blockquote {
            background: #f8f9fa;
            border-left: 4px solid var(--theme-color);
            padding: 20px 30px;
            font-style: italic;
            margin: 40px 0;
            border-radius: 0 8px 8px 0;
        }

        /* Mobile Adjustments for Blog Detail */
        @media (max-width: 768px) {
            .article-hero {
                min-height: 300px !important;
                padding: 40px 0 !important;
            }

            .article-hero h1 {
                font-size: 1.75rem !important;
                line-height: 1.3 !important;
            }

            .article-hero .py-5 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }

            .article-hero .d-flex.text-white-50 {
                flex-direction: column;
            }

            .article-hero .mx-3 {
                margin: 5px 0 !important;
            }
        }
    </style>
@endpush