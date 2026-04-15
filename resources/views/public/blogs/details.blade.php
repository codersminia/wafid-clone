@extends('layouts.public')

@section('title', ($blog->meta_title ?? $blog->title) . ' - Gulf Medical Consultant')
@section('meta_description', $blog->meta_description ?? Str::limit(strip_tags($blog->short_description ?? $blog->content), 160))
@section('meta_keywords', $blog->tags ?? $blog->meta_keywords)
@if($blog->image)
@section('og_image', asset($blog->image))
@endif

@section('content')

@push('schema')
    ,{
        "@type": "BlogPosting",
        "@id": "{{ url()->current() }}#blog",
        "headline": "{{ addslashes($blog->title) }}",
        "image": "{{ $blog->image ? asset($blog->image) : asset('assets/public/images/hero-bg.jpg') }}",
        "author": {
            "@type": "Person",
            "name": "{{ addslashes($blog->author ?? 'Editorial Team') }}"
        },
        "publisher": { "@id": "{{ url('/') }}#organization" },
        "datePublished": "{{ $blog->published_at->toIso8601String() }}",
        "dateModified": "{{ $blog->updated_at->toIso8601String() }}",
        "description": "{{ addslashes($blog->meta_description ?? Str::limit(strip_tags($blog->short_description ?? $blog->content), 160)) }}",
        "wordCount": {{ str_word_count(strip_tags($blog->content)) }},
        @if($blog->tags || $blog->meta_keywords)
        "keywords": "{{ addslashes($blog->tags ?? $blog->meta_keywords) }}",
        @endif
        "mainEntityOfPage": { "@id": "{{ url()->current() }}#webpage" },
        "url": "{{ url()->current() }}"
    },
    {
        "@type": "WebPage",
        "@id": "{{ url()->current() }}#webpage",
        "name": "{{ addslashes($blog->meta_title ?? $blog->title) }}",
        "url": "{{ url()->current() }}",
        "isPartOf": { "@id": "{{ url('/') }}#website" }
    }
@endpush

{{-- HERO --}}
<section class="bd-hero position-relative" aria-label="Article header">
    @if($blog->image)
    <div class="bd-hero-bg" style="background-image:url('{{ asset($blog->image) }}');"></div>
    @endif
    <div class="bd-hero-overlay"></div>
    <div class="container position-relative py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.8rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('public.blogs') }}" style="color:rgba(255,255,255,.6);">Blog</a></li>
                <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);" aria-current="page">{{ Str::limit($blog->title, 45) }}</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                @if($blog->category)
                <span class="bd-cat-badge mb-3 d-inline-block">{{ $blog->category->name }}</span>
                @endif
                <h1 class="bd-hero-title">{{ $blog->title }}</h1>
                @if($blog->short_description)
                <p class="bd-hero-desc">{{ $blog->short_description }}</p>
                @endif
                <div class="bd-meta-bar">
                    <span class="bd-meta-item"><i class="far fa-calendar-alt"></i><time datetime="{{ $blog->published_at->toIso8601String() }}">{{ $blog->published_at->format('d M Y') }}</time></span>
                    <span class="bd-meta-sep">·</span>
                    <span class="bd-meta-item"><i class="far fa-user"></i>{{ $blog->author ?? 'Editorial Team' }}</span>
                    <span class="bd-meta-sep">·</span>
                    <span class="bd-meta-item"><i class="far fa-clock"></i>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BODY --}}
<section class="bd-body-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5">
                @if($blog->image)
                <div class="bd-featured-img mb-4">
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->featured_image_alt ?? $blog->title }}" class="img-fluid w-100" loading="eager" fetchpriority="high">
                </div>
                @endif
                <article class="bd-article-card" itemscope itemtype="https://schema.org/BlogPosting">
                    <meta itemprop="headline" content="{{ $blog->title }}">
                    <meta itemprop="datePublished" content="{{ $blog->published_at->toIso8601String() }}">
                    <meta itemprop="dateModified" content="{{ $blog->updated_at->toIso8601String() }}">
                    <meta itemprop="author" content="{{ $blog->author ?? 'Editorial Team' }}">
                    <div class="bd-article-body" itemprop="articleBody">
                        @if(strip_tags($blog->content) == $blog->content)
                            {!! nl2br(e($blog->content)) !!}
                        @else
                            {!! $blog->content !!}
                        @endif
                    </div>
                    @php $tagSource = $blog->tags ?: $blog->meta_keywords; @endphp
                    @if($tagSource)
                    <div class="bd-tags mt-4">
                        <span class="bd-tags-label"><i class="fas fa-tags mr-1"></i>Tags:</span>
                        @foreach(explode(',', $tagSource) as $tag)
                            <span class="bd-tag">{{ trim($tag) }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="bd-share-bar mt-4 pt-4">
                        <span class="bd-share-label">Share this article:</span>
                        <div class="bd-share-btns">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener" class="bd-share-btn bd-share-fb" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}" target="_blank" rel="noopener" class="bd-share-btn bd-share-tw" aria-label="Share on Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->fullUrl()) }}" target="_blank" rel="noopener" class="bd-share-btn bd-share-wa" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($blog->title) }}" target="_blank" rel="noopener" class="bd-share-btn bd-share-li" aria-label="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="mailto:?subject={{ rawurlencode($blog->title) }}&body={{ rawurlencode(request()->fullUrl()) }}" class="bd-share-btn bd-share-mail" aria-label="Share via Email"><i class="far fa-envelope"></i></a>
                        </div>
                    </div>
                </article>
                <div class="bd-author-box mt-4">
                    <div class="bd-author-avatar"><i class="fas fa-user-tie"></i></div>
                    <div class="bd-author-info">
                        <span class="bd-author-role">Written by</span>
                        <strong class="bd-author-name">{{ $blog->author ?? 'Editorial Team' }}</strong>
                        <p class="bd-author-bio">Gulf Medical Consultant — Trusted guides for GAMCA/WAFID medical bookings, GCC visa processes, and Pakistan applicant support.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bd-sidebar">
                    <div class="bd-cta-widget mb-4">
                        <div class="bd-cta-icon"><i class="fas fa-file-medical"></i></div>
                        <h4 class="bd-cta-title">Book Your GAMCA Medical Slip</h4>
                        <p class="bd-cta-desc">Official Wafid/GAMCA appointments. Fast processing, WhatsApp delivery.</p>
                        <a href="{{ route('medicalExamination') }}" class="btn btn-warning btn-block font-weight-bold py-3" style="color:#0f1923;">
                            <i class="fas fa-calendar-check mr-2"></i>Book Instantly
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GAMCA+medical+booking." target="_blank" class="btn btn-outline-light btn-block font-weight-bold mt-2">
                            <i class="fab fa-whatsapp mr-2"></i>WhatsApp Us
                        </a>
                    </div>
                    @if($recentBlogs->count() > 0)
                    <div class="bd-sidebar-widget mb-4">
                        <h5 class="bd-sidebar-title">Related Articles</h5>
                        @foreach($recentBlogs as $recent)
                        <a href="{{ route('public.blogs.details', $recent->slug) }}" class="bd-related-item">
                            <div class="bd-related-thumb">
                                @if($recent->image)
                                    <img src="{{ asset($recent->image) }}" alt="{{ $recent->featured_image_alt ?? $recent->title }}" loading="lazy">
                                @else
                                    <div class="bd-related-thumb-placeholder"><i class="far fa-newspaper"></i></div>
                                @endif
                            </div>
                            <div class="bd-related-info">
                                <span class="bd-related-title">{{ Str::limit($recent->title, 50) }}</span>
                                <span class="bd-related-date"><i class="far fa-calendar-alt mr-1"></i>{{ $recent->published_at->format('d M Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                    <div class="bd-sidebar-widget mb-4">
                        <h5 class="bd-sidebar-title">Our Services</h5>
                        <ul class="bd-service-links">
                            <li><a href="{{ route('medicalExamination') }}"><i class="fas fa-chevron-right mr-2"></i>GAMCA Medical Slip</a></li>
                            <li><a href="{{ route('special.appointment') }}"><i class="fas fa-chevron-right mr-2"></i>Wafid Choice Center</a></li>
                            <li><a href="{{ route('navtechform') }}"><i class="fas fa-chevron-right mr-2"></i>NAVTTC / Takamol</a></li>
                            <li><a href="{{ route('tasheer.form') }}"><i class="fas fa-chevron-right mr-2"></i>Tasheer Appointment</a></li>
                            <li><a href="{{ route('ViewMedicalReport') }}"><i class="fas fa-chevron-right mr-2"></i>Check Medical Status</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- RELATED POSTS SECTION --}}
@if($recentBlogs->count() > 0)
<section class="bd-related-section">
    <div class="container">
        <div class="bd-related-header">
            <div>
                <span class="bd-related-label">Keep Reading</span>
                <h2 class="bd-related-heading">Related Articles</h2>
            </div>
            <a href="{{ route('public.blogs') }}" class="bd-related-all">View All Articles <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
        <div class="row">
            @foreach($recentBlogs as $recent)
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('public.blogs.details', $recent->slug) }}" class="bd-rp-card">
                    <div class="bd-rp-thumb">
                        @if($recent->image)
                            <img src="{{ asset($recent->image) }}"
                                 alt="{{ $recent->featured_image_alt ?? $recent->title }}"
                                 loading="lazy">
                        @else
                            <div class="bd-rp-thumb-placeholder"><i class="fas fa-newspaper"></i></div>
                        @endif
                        @if($recent->category)
                        <span class="bd-rp-cat">{{ $recent->category->name }}</span>
                        @endif
                    </div>
                    <div class="bd-rp-body">
                        <div class="bd-rp-meta">
                            <span><i class="far fa-calendar-alt mr-1"></i>{{ $recent->published_at->format('d M Y') }}</span>
                            <span><i class="far fa-user mr-1"></i>{{ $recent->author ?? 'Editorial Team' }}</span>
                        </div>
                        <h3 class="bd-rp-title">{{ Str::limit($recent->title, 65) }}</h3>
                        @if($recent->short_description)
                        <p class="bd-rp-excerpt">{{ Str::limit($recent->short_description, 100) }}</p>
                        @endif
                        <span class="bd-rp-link">Read Article <i class="fas fa-arrow-right ml-1"></i></span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('head')
<style>
:root { --gold:#FFC654; --dark:#0f1923; --dark2:#1a252f; }

/* Hero */
.bd-hero { background:var(--dark); min-height:420px; display:flex; align-items:center; padding:60px 0 50px; overflow:hidden; }
.bd-hero-bg { position:absolute; inset:0; background-size:cover; background-position:center; opacity:.18; }
.bd-hero-overlay { position:absolute; inset:0; background:linear-gradient(to bottom,rgba(15,25,35,.3) 0%,rgba(15,25,35,.85) 100%); }
.bd-cat-badge { background:var(--gold); color:#0f1923; font-size:.72rem; font-weight:700; padding:5px 16px; border-radius:20px; text-transform:uppercase; letter-spacing:.5px; }
.bd-hero-title { color:#fff; font-size:2.1rem; font-weight:800; line-height:1.25; margin-bottom:16px; }
.bd-hero-desc { color:rgba(255,255,255,.75); font-size:1rem; max-width:680px; margin:0 auto 20px; line-height:1.7; }
.bd-meta-bar { display:flex; flex-wrap:wrap; align-items:center; justify-content:center; gap:6px 4px; font-size:.82rem; color:rgba(255,255,255,.6); }
.bd-meta-item { display:flex; align-items:center; gap:5px; }
.bd-meta-item i { color:var(--gold); }
.bd-meta-sep { color:rgba(255,255,255,.3); }

/* Body */
.bd-body-section { background:#f4f6f9; padding:48px 0 60px; }

/* Featured image */
.bd-featured-img { border-radius:14px; overflow:hidden; box-shadow:0 8px 30px rgba(0,0,0,.12); }
.bd-featured-img img { display:block; width:100%; max-height:480px; object-fit:cover; }

/* Article card */
.bd-article-card { background:#fff; border-radius:14px; padding:36px 40px; box-shadow:0 2px 16px rgba(0,0,0,.06); border:1px solid #e8ecf0; }
.bd-article-body { font-size:1.08rem; line-height:1.9; color:#2c3e50; }
.bd-article-body p { margin-bottom:22px; }
.bd-article-body h2,.bd-article-body h3 { font-weight:700; color:var(--dark); margin-top:40px; margin-bottom:16px; padding-bottom:8px; border-bottom:2px solid #f0f4f8; }
.bd-article-body h2 { font-size:1.45rem; }
.bd-article-body h3 { font-size:1.2rem; }
.bd-article-body img { max-width:100%; border-radius:10px; margin:28px 0; box-shadow:0 4px 14px rgba(0,0,0,.08); }
.bd-article-body ul,.bd-article-body ol { padding-left:22px; margin-bottom:22px; }
.bd-article-body li { margin-bottom:8px; }
.bd-article-body blockquote { background:#fff8e8; border-left:4px solid var(--gold); padding:18px 24px; border-radius:0 10px 10px 0; font-style:italic; margin:32px 0; color:#555; }
.bd-article-body a { color:var(--dark2); text-decoration:underline; }
.bd-article-body a:hover { color:var(--gold); }

/* Tags */
.bd-tags { display:flex; flex-wrap:wrap; align-items:center; gap:8px; }
.bd-tags-label { font-size:.82rem; font-weight:600; color:#6c757d; }
.bd-tag { background:#f0f4f8; border:1px solid #dde3ea; color:var(--dark2); font-size:.78rem; font-weight:600; padding:4px 12px; border-radius:20px; transition:all .2s; }
.bd-tag:hover { background:var(--gold); border-color:var(--gold); color:#0f1923; }

/* Share */
.bd-share-bar { display:flex; flex-wrap:wrap; align-items:center; gap:10px; border-top:1px solid #e8ecf0; }
.bd-share-label { font-size:.85rem; font-weight:600; color:#495057; }
.bd-share-btns { display:flex; gap:8px; }
.bd-share-btn { width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff !important; font-size:.85rem; transition:transform .25s,opacity .25s; text-decoration:none !important; }
.bd-share-btn:hover { transform:translateY(-3px); opacity:.88; }
.bd-share-fb { background:#3b5998; }
.bd-share-tw { background:#1da1f2; }
.bd-share-wa { background:#25d366; }
.bd-share-li { background:#0077b5; }
.bd-share-mail { background:#6c757d; }

/* Author box */
.bd-author-box { background:#fff; border-radius:14px; padding:24px 28px; display:flex; align-items:flex-start; gap:18px; box-shadow:0 2px 16px rgba(0,0,0,.06); border:1px solid #e8ecf0; border-left:4px solid var(--gold); }
.bd-author-avatar { width:56px; height:56px; background:var(--dark); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--gold); font-size:1.4rem; flex-shrink:0; }
.bd-author-role { display:block; font-size:.75rem; color:#adb5bd; text-transform:uppercase; letter-spacing:.5px; }
.bd-author-name { display:block; font-size:1rem; font-weight:700; color:var(--dark); margin-bottom:6px; }
.bd-author-bio { font-size:.85rem; color:#6c757d; margin:0; line-height:1.6; }

/* Sidebar */
.bd-sidebar { position:sticky; top:100px; }
.bd-cta-widget { background:linear-gradient(135deg,var(--dark) 0%,var(--dark2) 100%); border-radius:14px; padding:28px 24px; text-align:center; border:1px solid rgba(255,198,84,.2); }
.bd-cta-icon { width:56px; height:56px; background:rgba(255,198,84,.15); border-radius:12px; display:flex; align-items:center; justify-content:center; color:var(--gold); font-size:1.4rem; margin:0 auto 16px; }
.bd-cta-title { color:#fff; font-size:1.1rem; font-weight:700; margin-bottom:8px; }
.bd-cta-desc { color:rgba(255,255,255,.7); font-size:.85rem; margin-bottom:20px; line-height:1.6; }
.bd-sidebar-widget { background:#fff; border-radius:14px; padding:24px; border:1px solid #e8ecf0; box-shadow:0 2px 12px rgba(0,0,0,.05); }
.bd-sidebar-title { font-size:.95rem; font-weight:700; color:var(--dark); margin-bottom:18px; padding-bottom:12px; border-bottom:2px solid var(--gold); }
.bd-related-item { display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid #f0f4f8; text-decoration:none !important; }
.bd-related-item:last-child { border-bottom:none; }
.bd-related-item:hover .bd-related-title { color:var(--gold); }
.bd-related-thumb { width:68px; height:68px; border-radius:8px; overflow:hidden; flex-shrink:0; }
.bd-related-thumb img { width:100%; height:100%; object-fit:cover; }
.bd-related-thumb-placeholder { width:100%; height:100%; background:#f0f4f8; display:flex; align-items:center; justify-content:center; color:#adb5bd; font-size:1.2rem; }
.bd-related-title { display:block; font-size:.82rem; font-weight:600; color:var(--dark); line-height:1.4; margin-bottom:4px; transition:color .2s; }
.bd-related-date { font-size:.75rem; color:#adb5bd; }
.bd-service-links { list-style:none; padding:0; margin:0; }
.bd-service-links li { border-bottom:1px solid #f0f4f8; }
.bd-service-links li:last-child { border-bottom:none; }
.bd-service-links a { display:block; padding:10px 0; font-size:.88rem; color:#495057; text-decoration:none; transition:color .2s,padding-left .2s; }
.bd-service-links a i { color:var(--gold); font-size:.7rem; }
.bd-service-links a:hover { color:var(--gold); padding-left:4px; }

/* Responsive */
@media (max-width:991px) { .bd-sidebar { position:static; } }
@media (max-width:767px) {
    .bd-hero { min-height:auto; padding:40px 0 36px; }
    .bd-hero-title { font-size:1.55rem; }
    .bd-article-card { padding:22px 18px; }
    .bd-author-box { flex-direction:column; }
    .bd-meta-sep { display:none; }
}

/* Related Posts Section */
.bd-related-section { background:#fff; padding:60px 0; border-top:1px solid #e8ecf0; }
.bd-related-header { display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:32px; flex-wrap:wrap; gap:12px; }
.bd-related-label { display:block; color:var(--gold); font-size:.75rem; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; margin-bottom:6px; }
.bd-related-heading { font-size:1.6rem; font-weight:800; color:var(--dark); margin:0; }
.bd-related-all { font-size:.85rem; font-weight:700; color:var(--dark); text-decoration:none; border:2px solid var(--dark); padding:8px 20px; border-radius:8px; transition:all .2s; white-space:nowrap; }
.bd-related-all:hover { background:var(--dark); color:var(--gold); text-decoration:none; }

.bd-rp-card { display:block; background:#fff; border-radius:14px; overflow:hidden; border:1px solid #e8ecf0; text-decoration:none !important; transition:transform .3s,box-shadow .3s,border-color .3s; height:100%; }
.bd-rp-card:hover { transform:translateY(-6px); box-shadow:0 16px 40px rgba(0,0,0,.1); border-color:var(--gold); }
.bd-rp-thumb { position:relative; height:210px; overflow:hidden; }
.bd-rp-thumb img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
.bd-rp-card:hover .bd-rp-thumb img { transform:scale(1.06); }
.bd-rp-thumb-placeholder { width:100%; height:100%; background:var(--dark); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,.2); font-size:2.5rem; }
.bd-rp-cat { position:absolute; top:14px; left:14px; background:var(--gold); color:#0f1923; font-size:.7rem; font-weight:700; padding:4px 12px; border-radius:20px; text-transform:uppercase; letter-spacing:.4px; }
.bd-rp-body { padding:22px 24px; }
.bd-rp-meta { display:flex; gap:14px; font-size:.78rem; color:#adb5bd; margin-bottom:10px; flex-wrap:wrap; }
.bd-rp-meta i { color:var(--gold); }
.bd-rp-title { font-size:1rem; font-weight:700; color:var(--dark); line-height:1.5; margin-bottom:10px; }
.bd-rp-card:hover .bd-rp-title { color:var(--dark2); }
.bd-rp-excerpt { font-size:.84rem; color:#6c757d; line-height:1.6; margin-bottom:14px; }
.bd-rp-link { font-size:.82rem; font-weight:700; color:var(--dark); transition:color .2s; }
.bd-rp-card:hover .bd-rp-link { color:var(--gold); }

@media (max-width:767px) {
    .bd-related-header { flex-direction:column; align-items:flex-start; }
    .bd-related-heading { font-size:1.3rem; }
}
</style>
@endpush