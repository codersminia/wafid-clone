@extends('layouts.public')

@section('title', 'GAMCA & WAFID Blog – Complete Guides for GCC Medical & Token Booking')
@section('meta_description', 'Gulf Medical Consultant Blog – Updated GAMCA/WAFID booking guides, fees, medical test tips, and country-specific GCC medical guides for Pakistan applicants.')
@section('meta_keywords', 'GAMCA blog Pakistan, WAFID guide 2026, GAMCA medical booking, WAFID token guide, GCC medical Pakistan, GAMCA fees 2026')

@section('content')

{{-- HERO SECTION --}}
<section class="blog-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">Blog</li>
            </ol>
        </nav>
        <span class="blog-badge">Expert Guides</span>
        <h1 class="mt-2 mb-3">GAMCA &amp; WAFID Blog</h1>
        <p class="mb-4" style="max-width:680px;">Your trusted resource for GAMCA (WAFID) medical guides, booking steps, fees, and expert tips for <strong style="color:var(--accent-gold)">Saudi Arabia, UAE, Oman, Kuwait, Qatar, and Bahrain</strong>.</p>
        <div class="d-flex flex-wrap" style="gap:10px;">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GAMCA+medical+booking." target="_blank" class="btn btn-warning font-weight-bold px-4 py-2" style="color:#0f1923;">
                <i class="fab fa-whatsapp mr-2"></i>Get Booking Help
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light px-4 py-2">
                <i class="fas fa-phone mr-2"></i>Contact Us
            </a>
        </div>
    </div>
</section>

{{-- SEO INTRO SECTION --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <span class="blog-section-label">Welcome to Our Blog</span>
                <h2 class="blog-section-title">Complete Guides for GCC Medical &amp; Token Booking</h2>
                <p class="text-muted mb-3">Welcome to the Gulf Medical Consultant Blog — your trusted resource for GAMCA (WAFID) medical guides, booking steps, fees, and expert tips for GCC countries.</p>
                <p class="text-muted mb-4">We publish regularly updated, Pakistan-focused guides to help workers, students, and travelers successfully complete their GCC medical and token booking process without errors or delays.</p>
                <div class="row">
                    <div class="col-6 col-md-3 mb-3">
                        <div class="blog-stat-box">
                            <div class="blog-stat-num">2026</div>
                            <div class="blog-stat-lbl">Updated</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="blog-stat-box">
                            <div class="blog-stat-num">6</div>
                            <div class="blog-stat-lbl">GCC Countries</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="blog-stat-box">
                            <div class="blog-stat-num">50K+</div>
                            <div class="blog-stat-lbl">Helped</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="blog-stat-box">
                            <div class="blog-stat-num">24/7</div>
                            <div class="blog-stat-lbl">Support</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="blog-topics-card">
                    <h5 class="font-weight-bold mb-4" style="color:#1a252f;">What You'll Learn in Our Blog</h5>
                    @php $topics = [
                        ['icon'=>'fas fa-calendar-check', 'title'=>'GAMCA / WAFID Booking Guides',    'desc'=>'Book correctly, avoid mistakes, secure earliest slots'],
                        ['icon'=>'fas fa-money-bill-wave','title'=>'Fees & Cost Breakdown (2026)',     'desc'=>'Token fees, clinic charges, total cost in Pakistan'],
                        ['icon'=>'fas fa-stethoscope',    'title'=>'Medical Test Preparation Tips',   'desc'=>'Documents, fasting, clinic process, avoid rejection'],
                        ['icon'=>'fas fa-tools',          'title'=>'Problem Solving Guides',          'desc'=>'Payment failures, expired tokens, rescheduling'],
                        ['icon'=>'fas fa-globe',          'title'=>'Country-Specific Guides',         'desc'=>'Detailed guides for all 6 GCC countries'],
                    ]; @endphp
                    @foreach($topics as $t)
                    <div class="blog-topic-item">
                        <div class="blog-topic-icon"><i class="{{ $t['icon'] }}"></i></div>
                        <div>
                            <div class="font-weight-bold small" style="color:#1a252f;">{{ $t['title'] }}</div>
                            <div class="text-muted" style="font-size:.8rem;">{{ $t['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- POPULAR TOPICS STRIP --}}
<div style="background:var(--accent-gold);padding:18px 0;">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center" style="gap:8px;">
            <span class="font-weight-bold mr-2" style="color:#0f1923;font-size:.9rem;white-space:nowrap;"><i class="fas fa-fire mr-1"></i>Popular Topics:</span>
            @php $popular = ['GAMCA Token Guide 2026','WAFID Booking Process','GAMCA Medical Fees 2026','How to Pass GAMCA Medical','Expired Token Fix','Payment Issues','Best Time to Book']; @endphp
            @foreach($popular as $tag)
            <span class="blog-popular-tag">{{ $tag }}</span>
            @endforeach
        </div>
    </div>
</div>

{{-- MAIN BLOG CONTENT --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row">

            {{-- Blog Listing --}}
            <div class="col-lg-8 order-2 order-lg-1">

                @if($blogs->count() > 0)
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="font-weight-bold mb-0" style="font-size:1.2rem;color:#1a252f;">
                            Latest Articles
                            @if(request('search') || request('category'))
                                <span class="text-muted font-weight-normal" style="font-size:.9rem;"> — filtered results</span>
                            @endif
                        </h2>
                        <span class="text-muted small">{{ $blogs->total() }} articles</span>
                    </div>
                    <div class="row">
                        @foreach($blogs as $blog)
                        <div class="col-md-6 mb-4">
                            <div class="blog-card h-100">
                                <div class="blog-card-thumb">
                                    <a href="{{ route('public.blogs.details', $blog->slug) }}">
                                        @if($blog->image)
                                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
                                        @else
                                            <div class="blog-card-thumb-placeholder">
                                                <i class="fas fa-newspaper"></i>
                                            </div>
                                        @endif
                                    </a>
                                    @if($blog->category)
                                    <span class="blog-card-cat">{{ $blog->category->name }}</span>
                                    @endif
                                </div>
                                <div class="blog-card-body">
                                    <div class="blog-card-meta">
                                        <span><i class="far fa-calendar-alt mr-1"></i>{{ $blog->published_at->format('M d, Y') }}</span>
                                        <span><i class="far fa-user mr-1"></i>{{ $blog->author ?? 'Editorial Team' }}</span>
                                    </div>
                                    <h3 class="blog-card-title">
                                        <a href="{{ route('public.blogs.details', $blog->slug) }}">{{ Str::limit($blog->title, 65) }}</a>
                                    </h3>
                                    <p class="blog-card-excerpt">{{ Str::limit($blog->short_description, 110) }}</p>
                                    <a href="{{ route('public.blogs.details', $blog->slug) }}" class="blog-card-link" aria-label="Read article: {{ $blog->title }}">
                                        Read Article <i class="fas fa-arrow-right ml-1" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">{{ $blogs->appends(request()->input())->links() }}</div>
                @else
                    <div class="blog-empty">
                        <div class="blog-empty-icon"><i class="far fa-newspaper"></i></div>
                        <h3 class="font-weight-bold mb-2">No Articles Found</h3>
                        <p class="text-muted mb-4">Try adjusting your search or browse all categories.</p>
                        <a href="{{ route('public.blogs') }}" class="btn btn-dark px-4 font-weight-bold">View All Articles</a>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="sticky-top" style="top:100px;z-index:100;">

                    {{-- Search --}}
                    <div class="blog-sidebar-widget mb-4">
                        <form action="{{ route('public.blogs') }}" method="GET">
                            <div class="blog-search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles...">
                                <button type="submit"><i class="fas fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>

                    {{-- Categories --}}
                    <div class="blog-sidebar-widget mb-4">
                        <h5 class="blog-sidebar-title">Categories</h5>
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="{{ route('public.blogs') }}" class="blog-cat-link {{ !request('category') ? 'active' : '' }}">
                                    <i class="fas fa-chevron-right"></i> All Categories
                                </a>
                            </li>
                            @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('public.blogs', ['category' => $cat->id] + request()->except('category')) }}" class="blog-cat-link {{ request('category') == $cat->id ? 'active' : '' }}">
                                    <i class="fas fa-chevron-right"></i> {{ $cat->name }}
                                    <span class="blog-cat-count">{{ $cat->blogs_count }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- GCC Country Guides --}}
                    <div class="blog-sidebar-widget mb-4">
                        <h5 class="blog-sidebar-title">Country Guides</h5>
                        @php $countries = [
                            ['flag'=>'🇸🇦','name'=>'Saudi Arabia','slug'=>'saudi-arabia'],
                            ['flag'=>'🇦🇪','name'=>'UAE',         'slug'=>'uae'],
                            ['flag'=>'🇶🇦','name'=>'Qatar',       'slug'=>'qatar'],
                            ['flag'=>'🇴🇲','name'=>'Oman',        'slug'=>'oman'],
                            ['flag'=>'🇰🇼','name'=>'Kuwait',      'slug'=>'kuwait'],
                            ['flag'=>'🇧🇭','name'=>'Bahrain',     'slug'=>'bahrain'],
                        ]; @endphp
                        <div class="d-flex flex-wrap" style="gap:8px;">
                            @foreach($countries as $c)
                            <a href="{{ route('public.gcc.country', $c['slug']) }}" class="blog-country-pill">
                                {{ $c['flag'] }} {{ $c['name'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Pakistan Cities --}}
                    <div class="blog-sidebar-widget mb-4">
                        <h5 class="blog-sidebar-title">Pakistan City Guides</h5>
                        <p class="text-muted small mb-3">Find nearest approved GAMCA centers:</p>
                        @php $cities = ['Karachi','Lahore','Islamabad','Rawalpindi','Peshawar','Quetta']; @endphp
                        <ul class="list-unstyled mb-0">
                            @foreach($cities as $city)
                            <li class="blog-city-item">
                                <i class="fas fa-map-marker-alt mr-2" style="color:var(--accent-gold);"></i>
                                <span class="small">GAMCA Medical {{ $city }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- WhatsApp CTA --}}
                    <div class="blog-wa-cta">
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3" style="width:48px;height:48px;background:rgba(255,198,84,.15);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <i class="fab fa-whatsapp" style="color:var(--accent-gold);font-size:1.5rem;"></i>
                            </div>
                            <h6 class="text-white font-weight-bold mb-0">Need Booking Help?</h6>
                        </div>
                        <p class="small mb-3" style="color:rgba(255,255,255,.8);">Get step-by-step guidance for your GAMCA/WAFID medical booking via WhatsApp.</p>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GAMCA+medical+booking." target="_blank" class="btn btn-warning btn-block font-weight-bold" style="color:#0f1923;">
                            <i class="fab fa-whatsapp mr-2"></i>Chat on WhatsApp
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- WHY OUR BLOG IS DIFFERENT --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="blog-section-label">Our Advantage</span>
            <h2 class="blog-section-title">Why Our Blog is Different</h2>
            <p class="text-muted mx-auto" style="max-width:650px;">At Gulf Medical Consultant, we focus on real-world problems faced by applicants in Pakistan.</p>
        </div>
        <div class="row">
            @php $whys = [
                ['icon'=>'fas fa-list-ol',      'color'=>'#fff8e1','ic'=>'var(--accent-gold)', 'title'=>'Step-by-Step Instructions', 'desc'=>'Easy for beginners — every guide walks you through the process from start to finish.'],
                ['icon'=>'fas fa-sync-alt',     'color'=>'#e8f5e9','ic'=>'#4caf50',            'title'=>'Always Updated',            'desc'=>'Updated according to latest WAFID system changes and 2026 policies.'],
                ['icon'=>'fas fa-flag',         'color'=>'#e3f2fd','ic'=>'#2196f3',            'title'=>'Pakistan-Focused',          'desc'=>'Pakistan-specific examples, fees, and city-based guides for local applicants.'],
                ['icon'=>'fas fa-mobile-alt',   'color'=>'#fce4ec','ic'=>'#e91e63',            'title'=>'Mobile-Friendly',           'desc'=>'Quick access on any device — read guides on the go.'],
                ['icon'=>'fab fa-whatsapp',     'color'=>'#e8f5e9','ic'=>'#25d366',            'title'=>'WhatsApp Support',          'desc'=>'Personalized help available via WhatsApp for any booking question.'],
                ['icon'=>'fas fa-shield-alt',   'color'=>'#fff8e1','ic'=>'var(--accent-gold)', 'title'=>'Trusted & Reliable',        'desc'=>'Serving 50,000+ applicants with transparent, accurate guidance.'],
            ]; @endphp
            @foreach($whys as $w)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="blog-why-card">
                    <div class="blog-why-icon" style="background:{{ $w['color'] }};color:{{ $w['ic'] }};">
                        <i class="{{ $w['icon'] }}"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">{{ $w['title'] }}</h5>
                    <p class="text-muted small mb-0">{{ $w['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FAQ SECTION --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="blog-section-label">Quick Answers</span>
                    <h2 class="blog-section-title">Frequently Asked Questions</h2>
                </div>
                @php $blogFaqs = [
                    ['q'=>'What is GAMCA/WAFID?',           'a'=>'GAMCA (now WAFID) is the system used for booking medical tests required for GCC visas. It is mandatory for workers, students, and travelers heading to Saudi Arabia, UAE, Oman, Kuwait, Qatar, or Bahrain.'],
                    ['q'=>'Are your blog guides updated?',  'a'=>'Yes, all guides are updated based on the latest 2026 policies and Pakistan-specific requirements. We review and update content every 2–3 weeks to reflect any WAFID portal changes.'],
                    ['q'=>'Can I book my medical through you?','a'=>'Yes, Gulf Medical Consultant provides complete guidance and support for GAMCA/WAFID booking. Contact us via WhatsApp or our contact page for personalized step-by-step assistance.'],
                    ['q'=>'Which cities in Pakistan do you cover?','a'=>'We provide guides for all major cities including Karachi, Lahore, Islamabad, Rawalpindi, Peshawar, and Quetta — helping you find the nearest approved GAMCA medical center.'],
                ]; @endphp
                <div id="blogFaqAccordion">
                    @foreach($blogFaqs as $i => $faq)
                    <div class="blog-faq-item">
                        <button class="blog-faq-btn {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#bfaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                            {{ $faq['q'] }}
                            <div class="blog-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div>
                        </button>
                        <div id="bfaq{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}" data-parent="#blogFaqAccordion">
                            <div class="blog-faq-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('faq') }}" class="btn btn-outline-dark px-4 font-weight-bold">View All FAQs →</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BOTTOM CTA --}}
<section style="background:linear-gradient(135deg,var(--accent-gold) 0%,#f4b942 100%);padding:60px 0;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-80px;right:-80px;width:300px;height:300px;background:rgba(255,255,255,.1);border-radius:50%;"></div>
    <div class="container text-center position-relative" style="z-index:1;">
        <h2 class="font-weight-bold mb-3" style="color:#0f1923;font-size:2rem;">Need Help with Your Booking?</h2>
        <p class="mb-4" style="color:#1a252f;font-size:1.05rem;max-width:600px;margin:0 auto 24px;">Get step-by-step guidance for your GAMCA/WAFID medical booking. Avoid mistakes that can delay your visa process.</p>
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center" style="gap:12px;">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GAMCA+medical+booking." target="_blank" class="btn btn-dark btn-lg px-5 py-3 font-weight-bold">
                <i class="fab fa-whatsapp mr-2"></i>WhatsApp Now
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-dark btn-lg px-5 py-3 font-weight-bold">
                <i class="fas fa-envelope mr-2"></i>Contact Us
            </a>
        </div>
    </div>
</section>

@endsection

@push('pagination_links')
@if($blogs->previousPageUrl())
<link rel="prev" href="{{ $blogs->previousPageUrl() }}">
@endif
@if($blogs->nextPageUrl())
<link rel="next" href="{{ $blogs->nextPageUrl() }}">
@endif
@endpush

@push('head')
<style>
    /* ── Hero ── */
    .blog-hero {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        padding: 70px 0 55px;
        position: relative;
        overflow: hidden;
    }
    .blog-hero::before {
        content: '';
        position: absolute;
        top: -100px; right: -100px;
        width: 400px; height: 400px;
        background: rgba(255,198,84,.04);
        border-radius: 50%;
    }
    .blog-hero h1 { color: #fff; font-size: 2.4rem; font-weight: 800; }
    .blog-hero p  { color: rgba(255,255,255,.8); font-size: 1rem; }
    .blog-badge {
        display: inline-block;
        background: var(--accent-gold);
        color: #0f1923;
        font-size: .72rem;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 20px;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    /* ── Section Labels ── */
    .blog-section-label {
        display: block;
        color: var(--accent-gold);
        font-size: .8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 10px;
    }
    .blog-section-title {
        font-size: 1.9rem;
        font-weight: 800;
        color: #1a252f;
        margin-bottom: 1rem;
    }

    /* ── Stats ── */
    .blog-stat-box {
        background: #f7f8fc;
        border-radius: 12px;
        padding: 16px;
        text-align: center;
    }
    .blog-stat-num { font-size: 1.6rem; font-weight: 800; color: var(--accent-gold); line-height: 1; }
    .blog-stat-lbl { font-size: .75rem; color: #6c757d; text-transform: uppercase; letter-spacing: .5px; margin-top: 4px; }

    /* ── Topics Card ── */
    .blog-topics-card {
        background: #f7f8fc;
        border-radius: 16px;
        padding: 28px;
        border: 1px solid #e8ecf0;
    }
    .blog-topic-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px solid #e8ecf0;
    }
    .blog-topic-item:last-child { border-bottom: none; }
    .blog-topic-icon {
        width: 38px; height: 38px;
        background: var(--accent-gold);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #fff;
        font-size: .9rem;
        flex-shrink: 0;
    }

    /* ── Popular Tags ── */
    .blog-popular-tag {
        background: rgba(0,0,0,.12);
        color: #0f1923;
        font-size: .78rem;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 20px;
        cursor: default;
    }

    /* ── Blog Cards ── */
    .blog-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #e8ecf0;
        transition: all .3s ease;
    }
    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,.1);
        border-color: var(--accent-gold);
    }
    .blog-card-thumb { position: relative; overflow: hidden; height: 220px; }
    .blog-card-thumb img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .6s ease;
    }
    .blog-card:hover .blog-card-thumb img { transform: scale(1.07); }
    .blog-card-thumb-placeholder {
        width: 100%; height: 100%;
        background: #1a252f;
        display: flex; align-items: center; justify-content: center;
        color: rgba(255,255,255,.2);
        font-size: 3rem;
    }
    .blog-card-cat {
        position: absolute;
        top: 14px; left: 14px;
        background: var(--accent-gold);
        color: #0f1923;
        font-size: .72rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
    }
    .blog-card-body { padding: 24px; }
    .blog-card-meta {
        display: flex;
        gap: 16px;
        font-size: .8rem;
        color: #adb5bd;
        margin-bottom: 12px;
    }
    .blog-card-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 10px;
        line-height: 1.5;
    }
    .blog-card-title a { color: #1a252f; text-decoration: none; transition: color .2s; }
    .blog-card-title a:hover { color: var(--accent-gold); }
    .blog-card-excerpt { font-size: .85rem; color: #6c757d; margin-bottom: 16px; line-height: 1.6; }
    .blog-card-link {
        font-size: .85rem;
        font-weight: 700;
        color: #1a252f;
        text-decoration: none;
        transition: color .2s;
    }
    .blog-card-link:hover { color: var(--accent-gold); text-decoration: none; }

    /* ── Empty State ── */
    .blog-empty {
        background: #fff;
        border-radius: 14px;
        padding: 80px 20px;
        text-align: center;
        border: 1px solid #e8ecf0;
    }
    .blog-empty-icon {
        width: 90px; height: 90px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 2.5rem;
        color: #dee2e6;
        margin: 0 auto 20px;
    }

    /* ── Sidebar ── */
    .blog-sidebar-widget {
        background: #fff;
        border-radius: 14px;
        padding: 24px;
        border: 1px solid #e8ecf0;
    }
    .blog-sidebar-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1a252f;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--accent-gold);
    }
    .blog-search-box {
        display: flex;
        align-items: center;
        background: #f7f8fc;
        border-radius: 10px;
        padding: 10px 16px;
        gap: 10px;
        border: 1px solid #e8ecf0;
    }
    .blog-search-box i { color: #adb5bd; }
    .blog-search-box input {
        border: none; background: transparent;
        outline: none; flex: 1; font-size: .9rem;
    }
    .blog-search-box button {
        background: var(--accent-gold);
        border: none;
        width: 32px; height: 32px;
        border-radius: 8px;
        color: #0f1923;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
    }
    .blog-cat-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f4f8;
        color: #495057;
        text-decoration: none;
        font-size: .9rem;
        transition: color .2s;
    }
    .blog-cat-link:last-child { border-bottom: none; }
    .blog-cat-link i { color: var(--accent-gold); margin-right: 8px; font-size: .75rem; }
    .blog-cat-link:hover, .blog-cat-link.active { color: var(--accent-gold); text-decoration: none; font-weight: 600; }
    .blog-cat-count {
        background: #f0f4f8;
        border-radius: 20px;
        padding: 2px 10px;
        font-size: .75rem;
        color: #6c757d;
    }
    .blog-country-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #f0f4f8;
        border: 1px solid #dde3ea;
        border-radius: 20px;
        padding: 5px 12px;
        font-size: .78rem;
        font-weight: 600;
        color: #1a252f;
        text-decoration: none;
        transition: all .2s ease;
    }
    .blog-country-pill:hover {
        background: var(--accent-gold);
        border-color: var(--accent-gold);
        color: #0f1923;
        text-decoration: none;
    }
    .blog-city-item {
        padding: 8px 0;
        border-bottom: 1px solid #f0f4f8;
        color: #495057;
        font-size: .88rem;
    }
    .blog-city-item:last-child { border-bottom: none; }
    .blog-wa-cta {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        border-radius: 14px;
        padding: 24px;
    }

    /* ── Why Cards ── */
    .blog-why-card {
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 28px 24px;
        height: 100%;
        transition: all .3s ease;
    }
    .blog-why-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 36px rgba(0,0,0,.08);
        border-color: var(--accent-gold);
    }
    .blog-why-icon {
        width: 60px; height: 60px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 18px;
        transition: transform .3s ease;
    }
    .blog-why-card:hover .blog-why-icon { transform: scale(1.1); }

    /* ── FAQ ── */
    .blog-faq-item {
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 12px;
        margin-bottom: 12px;
        overflow: hidden;
        transition: border-color .3s;
    }
    .blog-faq-item:hover { border-color: var(--accent-gold); }
    .blog-faq-btn {
        width: 100%; text-align: left; background: transparent; border: none;
        padding: 20px 24px; font-weight: 600; font-size: .95rem; color: #1a252f;
        display: flex; justify-content: space-between; align-items: center; cursor: pointer;
    }
    .blog-faq-icon {
        width: 30px; height: 30px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: var(--accent-gold);
        flex-shrink: 0;
        margin-left: 12px;
        transition: all .3s ease;
    }
    .blog-faq-btn[aria-expanded="true"] .blog-faq-icon {
        background: var(--accent-gold);
        color: #fff;
        transform: rotate(180deg);
    }
    .blog-faq-body { padding: 0 24px 20px; color: #6c757d; font-size: .9rem; line-height: 1.8; }

    /* ── Pagination ── */
    .pagination .page-item.active .page-link {
        background-color: var(--accent-gold);
        border-color: var(--accent-gold);
        color: #0f1923;
    }
    .pagination .page-link { color: #1a252f; border-radius: 8px !important; margin: 0 3px; }

    @media(max-width:767px) {
        .blog-hero h1 { font-size: 1.7rem; }
        .blog-section-title { font-size: 1.4rem; }
        .sticky-top { position: relative !important; top: 0 !important; }
    }
</style>
@endpush

@push('schema')
,{
    "@type": "CollectionPage",
    "@id": "{{ url()->current() }}#webpage",
    "name": "GAMCA & WAFID Blog – Complete Guides for GCC Medical & Token Booking",
    "url": "{{ url()->current() }}",
    "description": "Gulf Medical Consultant Blog – Updated GAMCA/WAFID booking guides, fees, medical test tips, and country-specific GCC medical guides for Pakistan applicants.",
    "isPartOf": { "@id": "{{ url('/') }}#website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
            { "@type": "ListItem", "position": 2, "name": "Blog", "item": "{{ url()->current() }}" }
        ]
    }
}
,{
    "@type": "FAQPage",
    "@id": "{{ url()->current() }}#faqpage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "What is GAMCA/WAFID?",
            "acceptedAnswer": { "@type": "Answer", "text": "GAMCA (now WAFID) is the system used for booking medical tests required for GCC visas. It is mandatory for workers, students, and travelers heading to Saudi Arabia, UAE, Oman, Kuwait, Qatar, or Bahrain." }
        },
        {
            "@type": "Question",
            "name": "Are your blog guides updated?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, all guides are updated based on the latest 2026 policies and Pakistan-specific requirements. We review and update content every 2-3 weeks to reflect any WAFID portal changes." }
        },
        {
            "@type": "Question",
            "name": "Can I book my medical through you?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, Gulf Medical Consultant provides complete guidance and support for GAMCA/WAFID booking. Contact us via WhatsApp or our contact page for personalized step-by-step assistance." }
        },
        {
            "@type": "Question",
            "name": "Which cities in Pakistan do you cover?",
            "acceptedAnswer": { "@type": "Answer", "text": "We provide guides for all major cities including Karachi, Lahore, Islamabad, Rawalpindi, Peshawar, and Quetta - helping you find the nearest approved GAMCA medical center." }
        }
    ]
}
@endpush
