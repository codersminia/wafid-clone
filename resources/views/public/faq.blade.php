@extends('layouts.public')

@section('title', 'Frequently Asked Questions | GAMCA WAFID Medical & NAVTTC Support')
@section('meta_description', 'Get answers to common questions about GAMCA/WAFID medical appointments, NAVTTC skill tests, payment methods, and GCC visa requirements. Expert guidance for Pakistan applicants.')
@section('meta_keywords', 'GAMCA FAQ, WAFID questions, NAVTTC help, GCC medical FAQ, Pakistan visa questions, medical appointment help')

@push('head')
<style>
    /* Hero Section */
    .faq-hero {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        padding: 80px 0 60px;
        position: relative;
        overflow: hidden;
    }
    .faq-hero::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: rgba(255,198,84,.05);
        border-radius: 50%;
    }
    .faq-hero h1 { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .faq-hero p { color: rgba(255,255,255,.8); font-size: 1.1rem; }
    .faq-badge {
        display: inline-block;
        background: var(--accent-gold);
        color: #0f1923;
        font-size: .75rem;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 20px;
        letter-spacing: .5px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    
    /* Search Box */
    .faq-search-box {
        background: #fff;
        border-radius: 50px;
        padding: 8px 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,.15);
        display: flex;
        align-items: center;
        max-width: 600px;
        margin: 30px auto 0;
    }
    .faq-search-box input {
        border: none;
        outline: none;
        flex: 1;
        padding: 8px 12px;
        font-size: 1rem;
    }
    .faq-search-box i {
        color: var(--accent-gold);
        font-size: 1.2rem;
    }
    
    /* Category Tabs */
    .faq-category-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        margin-bottom: 40px;
    }
    .faq-category-btn {
        background: #fff;
        border: 2px solid #e8ecf0;
        border-radius: 24px;
        padding: 10px 24px;
        font-size: .9rem;
        font-weight: 600;
        color: #1a252f;
        cursor: pointer;
        transition: all .3s ease;
    }
    .faq-category-btn:hover,
    .faq-category-btn.active {
        background: var(--accent-gold);
        border-color: var(--accent-gold);
        color: #0f1923;
        transform: translateY(-2px);
    }
    
    /* FAQ Items */
    .faq-item {
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        margin-bottom: 16px;
        overflow: hidden;
        transition: all .3s ease;
    }
    .faq-item:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,.08);
        border-color: var(--accent-gold);
    }
    .faq-question {
        width: 100%;
        text-align: left;
        background: transparent;
        border: none;
        padding: 24px 28px;
        font-weight: 600;
        font-size: 1rem;
        color: #1a252f;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: all .3s ease;
    }
    .faq-question:hover {
        color: var(--accent-gold);
    }
    .faq-question .faq-icon {
        width: 32px;
        height: 32px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-gold);
        transition: all .3s ease;
        flex-shrink: 0;
        margin-left: 16px;
    }
    .faq-question[aria-expanded="true"] .faq-icon {
        background: var(--accent-gold);
        color: #fff;
        transform: rotate(180deg);
    }
    .faq-answer {
        padding: 0 28px 24px;
        color: #6c757d;
        line-height: 1.8;
        font-size: .95rem;
    }
    .faq-answer ul {
        padding-left: 20px;
        margin-top: 12px;
    }
    .faq-answer ul li {
        margin-bottom: 8px;
    }
    
    /* Stats Section */
    .faq-stats {
        background: #f7f8fc;
        padding: 50px 0;
    }
    .stat-card {
        text-align: center;
        padding: 24px;
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--accent-gold);
        line-height: 1;
        margin-bottom: 8px;
    }
    .stat-label {
        font-size: .85rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: .5px;
    }
    
    /* CTA Box */
    .faq-cta-box {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        border-radius: 16px;
        padding: 40px;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .faq-cta-box::before {
        content: '';
        position: absolute;
        bottom: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,198,84,.08);
        border-radius: 50%;
    }
    
    /* Empty State */
    .faq-empty {
        text-align: center;
        padding: 80px 20px;
    }
    .faq-empty-icon {
        width: 100px;
        height: 100px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #dee2e6;
        margin: 0 auto 24px;
    }
    
    @media(max-width:767px) {
        .faq-hero h1 { font-size: 1.8rem; }
        .faq-question { font-size: .9rem; padding: 20px; }
        .faq-answer { padding: 0 20px 20px; }
    }
</style>
@endpush

@section('content')

{{-- HERO SECTION --}}
<section class="faq-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">FAQ</li>
            </ol>
        </nav>
        <div class="text-center position-relative" style="z-index:1;">
            <span class="faq-badge">Help Center</span>
            <h1 class="mb-3">Frequently Asked Questions</h1>
            <p class="mb-0">Find answers to common questions about GAMCA/WAFID medical appointments,<br class="d-none d-md-block"> NAVTTC skill tests, and GCC visa requirements.</p>
            
            {{-- Search Box --}}
            <div class="faq-search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="faqSearch" placeholder="Search for answers..." />
            </div>
        </div>
    </div>
</section>

{{-- FAQ CONTENT --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @forelse($faqs as $faq)
                    <div class="faq-item" data-category="{{ $faq->category ?? 'general' }}">
                        <button class="faq-question collapsed" type="button" data-toggle="collapse" data-target="#faq{{ $faq->id }}" aria-expanded="false">
                            <span>{{ $faq->question }}</span>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down" style="font-size:.8rem;"></i>
                            </div>
                        </button>
                        <div id="faq{{ $faq->id }}" class="collapse">
                            <div class="faq-answer">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="faq-empty">
                        <div class="faq-empty-icon">
                            <i class="far fa-question-circle"></i>
                        </div>
                        <h3 class="font-weight-bold mb-3">No FAQs Available</h3>
                        <p class="text-muted mb-4">We're working on adding helpful content. In the meantime, feel free to contact our support team.</p>
                        <a href="{{ route('contact') }}" class="btn btn-dark px-5 py-2 font-weight-bold">
                            <i class="fas fa-headset mr-2"></i>Contact Support
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="faq-cta-box position-relative" style="z-index:1;">
                    <h3 class="font-weight-bold mb-3" style="font-size:1.6rem;">Still Have Questions?</h3>
                    <p class="mb-4" style="color:rgba(255,255,255,.85);">Our expert team is available 24/7 to help you with GAMCA/WAFID medical bookings, NAVTTC skill tests, and all GCC visa requirements.</p>
                    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center" style="gap:12px;">
                        <a href="{{ route('contact') }}" class="btn btn-warning btn-lg px-5 py-3 font-weight-bold" style="color:#0f1923;">
                            <i class="fas fa-envelope mr-2"></i>Contact Us
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+have+a+question+about+GAMCA+medical+booking." target="_blank" class="btn btn-outline-light btn-lg px-5 py-3 font-weight-bold">
                            <i class="fab fa-whatsapp mr-2"></i>WhatsApp Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- HELPFUL RESOURCES --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold mb-3">Helpful Resources</h2>
            <p class="text-muted">Explore more information about our services</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3" style="width:50px;height:50px;background:#fff8e1;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-globe" style="color:var(--accent-gold);font-size:1.3rem;"></i>
                            </div>
                            <h5 class="font-weight-bold mb-0">GCC Countries</h5>
                        </div>
                        <p class="text-muted small mb-3">Learn about medical requirements for each GCC country.</p>
                        <a href="{{ route('public.gcc.country', 'saudi-arabia') }}" class="btn btn-sm btn-outline-dark">View Countries →</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3" style="width:50px;height:50px;background:#e8f5e9;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-info-circle" style="color:#4caf50;font-size:1.3rem;"></i>
                            </div>
                            <h5 class="font-weight-bold mb-0">About Us</h5>
                        </div>
                        <p class="text-muted small mb-3">Discover who we are and how we can help you.</p>
                        <a href="{{ route('about') }}" class="btn btn-sm btn-outline-dark">Learn More →</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3" style="width:50px;height:50px;background:#e3f2fd;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-phone-alt" style="color:#2196f3;font-size:1.3rem;"></i>
                            </div>
                            <h5 class="font-weight-bold mb-0">Contact Support</h5>
                        </div>
                        <p class="text-muted small mb-3">Get in touch with our expert support team.</p>
                        <a href="{{ route('contact') }}" class="btn btn-sm btn-outline-dark">Contact Us →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('schema')
    @if(count($faqs) > 0)
    ,{
        "@type": "FAQPage",
        "@id": "{{ url()->current() }}#faq",
        "mainEntity": [
            @foreach($faqs as $index => $faq)
            {
                "@type": "Question",
                "name": "{{ $faq->question }}",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ strip_tags($faq->answer) }}"
                }
            }{{ $index < count($faqs) - 1 ? ',' : '' }}
            @endforeach
        ]
    }
    @endif
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Search Functionality
    const searchInput = document.getElementById('faqSearch');
    const faqItems = document.querySelectorAll('.faq-item');
    
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endpush