@extends('layouts.public')

@section('title', $blog->meta_title ?? $blog->title . ' - Gulf Medical Consultant')
@section('meta_description', $blog->meta_description ?? Str::limit($blog->short_description, 160))
@section('meta_keywords', $blog->meta_keywords)

@section('content')

    <!-- Page Header (Optional, maybe smaller or just breadcrumb) -->
    <div class="bg-light py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('public.blogs') }}">Blogs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 30) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <article>
                        @if($blog->image)
                            <img src="{{ asset($blog->image) }}" class="img-fluid rounded shadow-sm mb-4 w-100"
                                alt="{{ $blog->title }}">
                        @endif

                        <div class="mb-3">
                            @if($blog->category)
                                <span class="badge badge-primary px-3 py-2 mr-2">{{ $blog->category->name }}</span>
                            @endif
                            <span class="text-muted"><i class="far fa-calendar-alt mr-1"></i>
                                {{ $blog->published_at->format('F d, Y') }}</span>
                        </div>

                        <h1 class="font-weight-bold mb-4">{{ $blog->title }}</h1>

                        <div class="blog-content text-justify">
                            {!! nl2br(e($blog->content)) !!}
                            <!-- Note: If using WYSIWYG, remove e() and use valid HTML purifier if possible, or just {!! $blog->content !!} if trusted admin. 
                                     Given user requested simple controller, assuming raw or basic html. I will use {!! $blog->content !!} assuming admin is trusted source. 
                                     Wait, if I used textarea, it's plain text with newlines. So nl2br is safer if no editor.
                                     Let's assume trusted Admin and they might paste HTML or use an editor I hope they have.
                                     If they use textarea without editor, nl2br is needed.
                                     I'll use {!! $blog->content !!} effectively assuming HTML or pre-formatted text.
                                -->
                            @if(strip_tags($blog->content) == $blog->content)
                                {!! nl2br(e($blog->content)) !!}
                            @else
                                {!! $blog->content !!}
                            @endif
                        </div>
                    </article>

                    <!-- Share (Optional) -->
                    <div class="mt-5 py-4 border-top border-bottom">
                        <span class="font-weight-bold mr-3">Share this article:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                            target="_blank" class="btn btn-sm btn-outline-primary mr-2"><i class="fab fa-facebook-f"></i>
                            Facebook</a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}"
                            target="_blank" class="btn btn-sm btn-outline-info mr-2"><i class="fab fa-twitter"></i>
                            Twitter</a>
                        <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->fullUrl()) }}"
                            target="_blank" class="btn btn-sm btn-outline-success"><i class="fab fa-whatsapp"></i>
                            WhatsApp</a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 pl-lg-5 mt-5 mt-lg-0">
                    <div class="sticky-top" style="top: 100px;">

                        <!-- Search/About/etc could go here -->

                        <!-- Recent Posts -->
                        @if($recentBlogs->count() > 0)
                            <div class="mb-5">
                                <h4 class="font-weight-bold mb-4">Recent Articles</h4>
                                @foreach($recentBlogs as $recent)
                                    <div class="media mb-4 align-items-center">
                                        @if($recent->image)
                                            <img src="{{ asset($recent->image) }}" class="mr-3 rounded" alt="{{ $recent->title }}"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <div class="mr-3 rounded bg-light d-flex align-items-center justify-content-center"
                                                style="width: 80px; height: 80px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="media-body">
                                            <h6 class="mt-0 font-weight-bold mb-1">
                                                <a href="{{ route('public.blogs.details', $recent->slug) }}"
                                                    class="text-dark text-decoration-none">{{ Str::limit($recent->title, 40) }}</a>
                                            </h6>
                                            <small class="text-muted">{{ $recent->published_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- CTA Widget -->
                        <div class="card bg-primary text-white border-0 shadow">
                            <div class="card-body text-center p-4">
                                <h4 class="font-weight-bold mb-3">Need a Medical Appointment?</h4>
                                <p class="mb-4 small">Book your Wafid/GAMCA appointment instantly with our secure service.
                                </p>
                                <a href="{{ route('medicalExamination') }}"
                                    class="btn btn-light font-weight-bold btn-block">Book Now</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin: 20px 0;
        }

        .blog-content h2,
        .blog-content h3 {
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .blog-content p {
            margin-bottom: 20px;
            line-height: 1.8;
            color: #555;
        }
    </style>
@endpush