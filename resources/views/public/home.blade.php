@extends('layouts.public')

@section('title', 'Gulf Medical Consultant - Wafid, NAVTTC & Tasheer Services')
@section('meta_description', 'Official assistance for Wafid (GAMCA) medical slips, NAVTTC skills verification, and Tasheer Saudi visa appointments. Fast processing.')

@push('head')
<style>
    .custom-location-tabs .nav-link { 
        background-color: #fff; 
        color: #333; 
        transition: all 0.3s; 
        border: 1px solid #eee;
        border-left: 5px solid transparent; 
    }
    .custom-location-tabs .nav-link:hover { 
        background-color: #f8f9fa; 
        transform: translateX(5px);
    }
    .custom-location-tabs .nav-link.active { 
        background-color: #2c3e50 !important; 
        color: #fff !important; 
        border-color: #2c3e50 !important;
        border-left: 5px solid #1a252f !important; 
        transform: translateX(5px); 
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .custom-location-tabs .nav-link.active small {
        color: rgba(255,255,255,0.8) !important;
    }
    .custom-location-tabs .nav-link.active h5 {
        color: #fff !important;
    }
    
    /* Slick Carousel Custom Adjustments */
    .testimonial-carousel .slick-track { display: flex; align-items: stretch; }
    .testimonial-carousel .slick-slide { height: inherit; margin: 0 10px; }
    .testimonial-carousel .testimonial-card { height: 100%; }
    .slick-dots li button:before { font-size: 12px; color: #2c3e50; }
    .slick-dots li.slick-active button:before { color: #e74c3c; }
    .slick-prev:before, .slick-next:before { color: #2c3e50; }

    .stats-bar-wrapper {
        position: relative;
        z-index: 99;
    }
    @media (max-width: 768px) {
        .stats-bar-wrapper { margin-top: 16px; }
    }

    /* Process Section Overhaul */
    .process-container {
        position: relative;
        z-index: 1;
    }
    .process-line {
        position: absolute;
        top: 25%;
        left: 0;
        width: 100%;
        height: 2px;
        background: repeating-linear-gradient(to right, #eee 0, #eee 10px, transparent 10px, transparent 20px);
        z-index: -1;
        display: none;
    }
    @media (min-width: 992px) {
        .process-line { display: block; }
    }
    .process-item {
        background: #fff;
        padding: 40px 30px;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(0,0,0,0.05);
        height: 100%;
    }
    .process-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border-color: #FFC654;
    }
    .process-icon-wrapper {
        width: 80px;
        height: 80px;
        background: #fdf2f1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        color: #FFC654;
        transition: all 0.3s ease;
    }
    .process-item:hover .process-icon-wrapper {
        background: #FFC654;
        color: #fff;
    }

    /* Banner Carousel */
    #heroBannerCarousel .hero-section {
        min-height: 65vh;
    }

    /* SEO Intro Section */
    .seo-intro-section { background-color: #f8f9fa; }
    .seo-img-wrapper { position: relative; }
    .seo-img-wrapper img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 12px;
    }
    .seo-intro-heading { font-size: 1.65rem; line-height: 1.35; }
    .btn-seo-cta {
        background-color: #e74c3c;
        color: #fff;
        border: none;
        border-radius: 6px;
        transition: background 0.25s ease;
        display: inline-block;
    }
    .btn-seo-cta:hover { background-color: #c0392b; color: #fff; text-decoration: none; }
    @media (max-width: 767px) {
        .seo-intro-heading { font-size: 1.35rem; }
        .btn-seo-cta { width: 100%; text-align: center; }
    }
    #heroBannerCarousel .carousel-control-prev,
    #heroBannerCarousel .carousel-control-next {
        width: 50px;
        height: 50px;
        background: rgba(0,0,0,0.4);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        bottom: auto;
        border: none;
        cursor: pointer;
    }
    #heroBannerCarousel .carousel-control-prev { left: 15px; }
    #heroBannerCarousel .carousel-control-next { right: 15px; }
    #heroBannerCarousel .carousel-indicators li {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin: 0 4px;
    }
    @media (max-width: 767px) {
        #heroBannerCarousel .carousel-control-prev,
        #heroBannerCarousel .carousel-control-next { width: 36px; height: 36px; }
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

{{-- Preload the first banner image so the browser fetches it ASAP --}}
@if($banners->count() > 0)
<link rel="preload" as="image" href="{{ asset($banners->first()->image) }}" fetchpriority="high">
@endif
@endpush

@section('content')
    <!-- Hero Banner Carousel -->
    @if($banners->count() > 0)
    <div id="heroBannerCarousel" class="carousel slide" data-ride="carousel" data-interval="5000" data-pause="hover">
        @if($banners->count() > 1)
        <ol class="carousel-indicators">
            @foreach($banners as $i => $banner)
            <li data-target="#heroBannerCarousel" data-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        @endif

        <div class="carousel-inner">
            @foreach($banners as $i => $banner)
            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                <div class="hero-section text-center" style="position:relative;overflow:hidden;">
                    {{-- Real <img> so browser can preload/prioritize it --}}
                    <img
                        src="{{ asset($banner->image) }}"
                        alt="{{ $banner->title ?? 'Banner' }}"
                        style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;"
                        @if($i === 0)
                            fetchpriority="high"
                            loading="eager"
                            decoding="sync"
                        @else
                            loading="lazy"
                            decoding="async"
                        @endif
                    >
                    {{-- Dark overlay --}}
                    <div style="position:absolute;inset:0;background:rgba(0,0,0,0.55);z-index:1;"></div>
                    {{-- Content --}}
                    <div class="container" style="position:relative;z-index:2;">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                @if($banner->title)
                                    <h1 class="hero-title">{{ $banner->title }}</h1>
                                @endif
                                @if($banner->subtitle)
                                    <p class="hero-subtitle mb-5">{{ $banner->subtitle }}</p>
                                @endif
                                <div class="hero-buttons d-flex flex-column flex-md-row justify-content-center align-items-center">
                                    @if($banner->button_text && $banner->button_url)
                                    <a href="{{ $banner->button_url }}" class="btn font-weight-bold px-5 py-3 mb-3 mb-md-0 mr-md-3 shadow" style="background:var(--accent-gold);color:#0f1923;border:none;">
                                        <i class="fas fa-calendar-check mr-2"></i>{{ $banner->button_text }}
                                    </a>
                                    @endif
                                    <a href="{{ route('contact') }}" class="btn font-weight-bold px-5 py-3" style="border:2px solid var(--accent-gold);color:var(--accent-gold);background:transparent;">
                                        <i class="fas fa-headset mr-2"></i>Contact Support
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($banners->count() > 1)
        <button class="carousel-control-prev" type="button" data-target="#heroBannerCarousel" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#heroBannerCarousel" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
        @endif
    </div>
    @else
    <!-- Fallback static hero if no banners -->
    <section class="hero-section text-center"
        style="background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="hero-title">Gulf Medical Consultants</h1>
                    <p class="hero-subtitle mb-5">
                        We simplify the complex booking process for GCC countries.
                        <strong>Wafid Medical</strong>, <strong>NAVTTC Tests</strong>, and <strong>Tasheer
                            Appointments</strong> handled by experts.
                    </p>
                    <div class="hero-buttons d-flex flex-column flex-md-row justify-content-center align-items-center">
                        <a href="#services" class="btn font-weight-bold px-5 py-3 mb-3 mb-md-0 mr-md-3 shadow" style="background:var(--accent-gold);color:#0f1923;border:none;">
                            <i class="fas fa-calendar-check mr-2"></i>Book Appointment
                        </a>
                        <a href="{{ route('contact') }}" class="btn font-weight-bold px-5 py-3" style="border:2px solid var(--accent-gold);color:var(--accent-gold);background:transparent;">
                            <i class="fas fa-headset mr-2"></i>Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Stats Bar (Updated Design) -->
    <div class="container stats-bar-wrapper" data-aos="fade-up">
        <div class="stats-bar py-4">
            <div class="row align-items-center">

                <!-- Item 1 -->
                <div class="col-4 stat-item text-center">
                    <div class="stat-number"><span class="counter" data-count="50000">0</span>+</div>
                    <p class="stat-label"><i class="fas fa-users mr-1" style="color:var(--accent-gold);"></i>Happy Clients</p>
                </div>

                <!-- Item 2 -->
                <div class="col-4 stat-item text-center">
                    <div class="stat-number"><span class="counter" data-count="99">0</span>%</div>
                    <p class="stat-label"><i class="fas fa-check-circle mr-1" style="color:var(--accent-gold);"></i>Success Rate</p>
                </div>

                <!-- Item 3 -->
                <div class="col-4 stat-item text-center">
                    <div class="stat-number"><span class="counter" data-count="24">0</span>/7</div>
                    <p class="stat-label"><i class="fas fa-headset mr-1" style="color:var(--accent-gold);"></i>Support</p>
                </div>

            </div>
        </div>
    </div>

    <!-- SEO Content Section -->
    <section class="seo-intro-section py-5 sec-bg-white-clean" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">

                <!-- Left: Image -->
                <div class="col-lg-5 col-md-5 mb-4 mb-md-0">
                    <div class="seo-img-wrapper">
                        <img
                            src="{{ asset('assets/public/images/gamca-medical-appointment-pic.webp') }}"
                            alt="GAMCA Medical Appointment Pakistan"
                            class="img-fluid rounded shadow"
                            loading="lazy"
                            width="540"
                            height="400"
                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=540&q=80';"
                        >
                    </div>
                </div>

                <!-- Right: SEO Text -->
                <div class="col-lg-7 col-md-7">
                    <h2 class="seo-intro-heading font-weight-bold text-dark mb-3">
                        Book GAMCA Medical Appointment Online with Trusted Experts
                    </h2>

                    <p class="text-muted mb-3">
                        Welcome to <strong>GAMCA Medical Appointments</strong>, your reliable source for GAMCA (WAFID) medical registration in Pakistan. If you are searching for a secure and genuine platform to book your GCC medical test online, you're in the right place.
                    </p>

                    <p class="text-muted mb-3">
                        Planning to travel to GCC countries like <strong>Saudi Arabia, UAE, Qatar, or Oman</strong>? A valid GAMCA medical fitness certificate is mandatory for your visa approval. This test confirms that you are medically fit and free from infectious diseases as required by GCC authorities.
                    </p>

                    <p class="text-muted mb-4">
                        Don't stress about the process — we make it simple and fast. Just fill out our online GAMCA registration form, and we will handle your appointment with authorized GAMCA-approved medical centers. Start your journey with confidence and avoid unnecessary delays in your visa process.
                    </p>

                    <a href="{{ route('medicalExamination') }}" class="btn btn-dark px-5 py-3 font-weight-bold">
                        Book Your GAMCA Medical Appointment Online Today
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section py-5 sec-bg-light-warm" id="services" data-aos="fade-up">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-accent-red font-weight-bold text-uppercase mb-1" style="font-size:.85rem;">Our Services</p>
                <h2 class="font-weight-bold text-dark">Hassle-Free GAMCA WAFID &amp; Gulf Employment Appointments</h2>
                <div class="theme-divider"></div>
                <p class="text-muted mx-auto" style="max-width:620px;">At Gulf Medical Consultants, we make your medical, visa, and skill verification appointments for Gulf countries effortless, fast, and reliable. From GCC medical slips to Saudi visa appointments, our streamlined system ensures you save time and avoid errors.</p>
            </div>

            <div class="row">

                <!-- 1. GAMCA Standard -->
                <div class="col-lg-6 mb-4">
                    <div class="svc-card h-100">
                        <div class="svc-card-header">
                            <div class="svc-logo-box">
                                <img src="{{ asset('assets/public/images/wafid-logo.svg') }}" alt="GAMCA Medical Slip WAFID" loading="lazy" decoding="async">
                            </div>
                            <div>
                                <h3 class="svc-card-title">GAMCA Medical Appointment Slip</h3>
                                <span class="svc-badge svc-badge-green">Most Popular</span>
                            </div>
                        </div>
                        <p class="svc-card-desc">Secure your official GAMCA medical appointment slip quickly. Our system automatically assigns the nearest GAMCA-approved medical center in your city. Once confirmed, your appointment slip is sent as a high-quality PDF directly to WhatsApp, ready to print and use.</p>
                        <div class="svc-keywords">
                            <span>GAMCA medical slip</span><span>GCC medical appointment</span><span>Gulf medical test</span><span>Wafid GAMCA</span>
                        </div>
                        <div class="svc-card-actions">
                            <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-block">Book Now</a>
                            <a href="{{ route('ViewMedicalReport') }}" class="btn btn-outline-dark btn-block">Check Status</a>
                        </div>
                    </div>
                </div>

                <!-- 2. Wafid Choice -->
                <div class="col-lg-6 mb-4">
                    <div class="svc-card h-100">
                        <div class="svc-card-header">
                            <div class="svc-logo-box">
                                <img src="{{ asset('assets/public/images/wafid-logo.svg') }}" alt="Wafid Choice Medical Center Selection" loading="lazy" decoding="async">
                            </div>
                            <div>
                                <h3 class="svc-card-title">Wafid Choice Medical Center Selection</h3>
                                <span class="svc-badge svc-badge-red">Premium Service</span>
                            </div>
                        </div>
                        <p class="svc-card-desc">Prefer a specific hospital or need to change your city? With our Wafid Choice Service, you can manually select your preferred medical center for your GAMCA medical appointment. Perfect for those seeking flexibility and control over their medical testing location.</p>
                        <div class="svc-keywords">
                            <span>GAMCA hospital selection</span><span>Premium medical slip</span><span>GCC appointment customization</span>
                        </div>
                        <div class="svc-card-actions">
                            <a href="{{ route('special.appointment') }}" class="btn btn-dark btn-block">Book Special</a>
                            <a href="{{ route('ViewMedicalCenters') }}" class="btn btn-outline-dark btn-block">Search Centers</a>
                        </div>
                    </div>
                </div>

                <!-- 3. NAVTTC -->
                <div class="col-lg-6 mb-4">
                    <div class="svc-card h-100">
                        <div class="svc-card-header">
                            <div class="svc-logo-box">
                                <img src="{{ asset('assets/public/images/navttc-logo.png') }}" alt="NAVTTC Takamol Skill Verification Saudi Visa" loading="lazy" decoding="async">
                            </div>
                            <div>
                                <h3 class="svc-card-title">NAVTTC / Takamol Skill Verification</h3>
                                <span class="svc-badge svc-badge-dark">Saudi Visa</span>
                            </div>
                        </div>
                        <p class="svc-card-desc">Booking your mandatory Skills Verification Program (SVP) test has never been easier. Whether you're an electrician, plumber, or technician, we handle the booking for your NAVTTC / Takamol skill verification test required for Saudi employment.</p>
                        <div class="svc-keywords">
                            <span>NAVTTC skill test</span><span>Saudi visa SVP</span><span>Gulf job skill verification</span><span>Technical trades test</span>
                        </div>
                        <div class="svc-card-actions">
                            <a href="{{ route('navtechform') }}" class="btn btn-dark btn-block">Book Skill Test</a>
                        </div>
                    </div>
                </div>

                <!-- 4. Tasheer -->
                <div class="col-lg-6 mb-4">
                    <div class="svc-card h-100">
                        <div class="svc-card-header">
                            <div class="svc-logo-box">
                                <img src="{{ asset('assets/public/images/tasheer-logo.png') }}" alt="Tasheer Saudi Visa Biometric Appointment VFS" loading="lazy" decoding="async">
                            </div>
                            <div>
                                <h3 class="svc-card-title">Tasheer / Saudi Visa Biometric Appointment</h3>
                                <span class="svc-badge svc-badge-dark">Visa Center</span>
                            </div>
                        </div>
                        <p class="svc-card-desc">Complete your Saudi Visa biometric enrollment and document submission effortlessly. We handle appointments for Tasheer / VFS visa centers, ensuring your application process is smooth and timely.</p>
                        <div class="svc-keywords">
                            <span>Saudi visa appointment</span><span>Tasheer visa booking</span><span>VFS biometric appointment</span><span>Gulf visa services</span>
                        </div>
                        <div class="svc-card-actions">
                            <a href="{{ route('tasheer.form') }}" class="btn btn-dark btn-block">Book Tasheer</a>
                        </div>
                    </div>
                </div>

                <!-- 5. Soft Skills -->
                <div class="col-lg-6 mb-4 mx-auto">
                    <div class="svc-card h-100">
                        <div class="svc-card-header">
                            <div class="svc-logo-box">
                                <img src="{{ asset('assets/public/images/soft-skill-logo.png') }}" alt="Gulf Employment Soft Skill Certificate GCC" loading="lazy" decoding="async">
                            </div>
                            <div>
                                <h3 class="svc-card-title">Gulf Employment Soft Skill Certificates</h3>
                                <span class="svc-badge svc-badge-green">Career Enhancement</span>
                            </div>
                        </div>
                        <p class="svc-card-desc">Enhance your career opportunities in the Gulf with verifiable soft skill certifications. Our certificates are designed to make your resume stand out to GCC employers and improve your job prospects.</p>
                        <div class="svc-keywords">
                            <span>Gulf soft skills certificate</span><span>Career enhancement GCC</span><span>Employment soft skills</span>
                        </div>
                        <div class="svc-card-actions">
                            <a href="{{ route('softskill.form') }}" class="btn btn-dark btn-block">Apply For Certificate</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- GCC Countries Section -->
    <section class="gcc-countries-section py-5" data-aos="fade-up">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold text-white">GCC Countries We Support</h2>
                <p class="gcc-subtitle">GAMCA and WAFID medical guidance for Pakistan workers going to Saudi Arabia and other Gulf countries.</p>
            </div>
            <div class="row">

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('public.gcc.country', 'saudi-arabia') }}" class="gcc-card-wrap">
                    <div class="gcc-card">
                        <img
                                src="https://images.unsplash.com/photo-1586724237569-f3d0c1dee8c6?auto=format&fit=crop&w=525&q=55"
                                srcset="https://images.unsplash.com/photo-1586724237569-f3d0c1dee8c6?auto=format&fit=crop&w=350&q=55 350w,
                                        https://images.unsplash.com/photo-1586724237569-f3d0c1dee8c6?auto=format&fit=crop&w=525&q=55 525w"
                                sizes="(max-width: 767px) 90vw, (max-width: 991px) 45vw, 350px"
                                alt="GAMCA Medical Centers Saudi Arabia" loading="lazy" decoding="async">
                        <div class="gcc-card-overlay">
                            <h3 class="gcc-card-title">Saudi Arabia</h3>
                            <p class="gcc-card-cities">Major cities: Riyadh, Jeddah, Dammam</p>
                            <span class="gcc-card-link">View Details <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('public.gcc.country', 'qatar') }}" class="gcc-card-wrap">
                    <div class="gcc-card">
                        <img
                                src="https://images.unsplash.com/photo-1553697388-94e804e2f0f6?auto=format&fit=crop&w=525&q=55"
                                srcset="https://images.unsplash.com/photo-1553697388-94e804e2f0f6?auto=format&fit=crop&w=350&q=55 350w,
                                        https://images.unsplash.com/photo-1553697388-94e804e2f0f6?auto=format&fit=crop&w=525&q=55 525w"
                                sizes="(max-width: 767px) 90vw, (max-width: 991px) 45vw, 350px"
                                alt="GAMCA Medical Centers Qatar" loading="lazy" decoding="async">
                        <div class="gcc-card-overlay">
                            <h3 class="gcc-card-title">Qatar</h3>
                            <p class="gcc-card-cities">Major cities: Doha, Al Khor</p>
                            <span class="gcc-card-link">View Details <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('public.gcc.country', 'oman') }}" class="gcc-card-wrap">
                    <div class="gcc-card">
                        <img
                                src="https://images.unsplash.com/photo-1578895101408-1a36b834405b?auto=format&fit=crop&w=525&q=55"
                                srcset="https://images.unsplash.com/photo-1578895101408-1a36b834405b?auto=format&fit=crop&w=350&q=55 350w,
                                        https://images.unsplash.com/photo-1578895101408-1a36b834405b?auto=format&fit=crop&w=525&q=55 525w"
                                sizes="(max-width: 767px) 90vw, (max-width: 991px) 45vw, 350px"
                                alt="GAMCA Medical Centers Oman" loading="lazy" decoding="async">
                        <div class="gcc-card-overlay">
                            <h3 class="gcc-card-title">Oman</h3>
                            <p class="gcc-card-cities">Major cities: Muscat, Sohar</p>
                            <span class="gcc-card-link">View Details <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('public.gcc.country', 'uae') }}" class="gcc-card-wrap">
                    <div class="gcc-card">
                        <img
                                src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=525&q=55"
                                srcset="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=350&q=55 350w,
                                        https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=525&q=55 525w"
                                sizes="(max-width: 767px) 90vw, (max-width: 991px) 45vw, 350px"
                                alt="GAMCA Medical Centers UAE" loading="lazy" decoding="async">
                        <div class="gcc-card-overlay">
                            <h3 class="gcc-card-title">UAE</h3>
                            <p class="gcc-card-cities">Major cities: Dubai, Abu Dhabi</p>
                            <span class="gcc-card-link">View Details <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('public.gcc.country', 'kuwait') }}" class="gcc-card-wrap">
                    <div class="gcc-card">
                        <img
                                src="https://images.unsplash.com/photo-1559329007-40df8a9345d8?auto=format&fit=crop&w=525&q=55"
                                srcset="https://images.unsplash.com/photo-1559329007-40df8a9345d8?auto=format&fit=crop&w=350&q=55 350w,
                                        https://images.unsplash.com/photo-1559329007-40df8a9345d8?auto=format&fit=crop&w=525&q=55 525w"
                                sizes="(max-width: 767px) 90vw, (max-width: 991px) 45vw, 350px"
                                alt="GAMCA Medical Centers Kuwait" loading="lazy" decoding="async">
                        <div class="gcc-card-overlay">
                            <h3 class="gcc-card-title">Kuwait</h3>
                            <p class="gcc-card-cities">Major cities: Kuwait City</p>
                            <span class="gcc-card-link">View Details <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('public.gcc.country', 'bahrain') }}" class="gcc-card-wrap">
                    <div class="gcc-card">
                        <img
                                src="https://images.unsplash.com/photo-1580674684081-7617fbf3d745?auto=format&fit=crop&w=525&q=55"
                                srcset="https://images.unsplash.com/photo-1580674684081-7617fbf3d745?auto=format&fit=crop&w=350&q=55 350w,
                                        https://images.unsplash.com/photo-1580674684081-7617fbf3d745?auto=format&fit=crop&w=525&q=55 525w"
                                sizes="(max-width: 767px) 90vw, (max-width: 991px) 45vw, 350px"
                                alt="GAMCA Medical Centers Bahrain" loading="lazy" decoding="async">
                        <div class="gcc-card-overlay">
                            <h3 class="gcc-card-title">Bahrain</h3>
                            <p class="gcc-card-cities">Major cities: Manama</p>
                            <span class="gcc-card-link">View Details <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- Simple 3-Step Process (Premium Revamp) -->
    <section class="py-5 sec-bg-white-clean" data-aos="fade-up">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-accent-red font-weight-extrabold text-uppercase letter-spacing-2 mb-1" style="font-size:.85rem;">How it works</p>
                <h2 class="font-weight-bold text-dark">Book GAMCA Medical Appointment in 3 Easy Steps</h2>
                <div class="theme-divider"></div>
                <p class="text-muted">We make your GAMCA medical appointment booking in Pakistan quick, secure, and stress-free. Follow these 3 simple steps to complete your GCC medical registration online without any confusion.</p>
            </div>

            <div class="process-container">
                <div class="process-line"></div>
                <div class="row">
                    <!-- Step 1 -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="process-item text-center">
                            <div class="process-icon-wrapper">
                                <i class="fas fa-file-contract fa-2x"></i>
                            </div>
                            <h3 class="h4 font-weight-bold text-dark mt-4">Step 1: Provide Your Details</h3>
                            <p class="text-muted mb-0">Fill out our quick online form with your passport information and personal details. Our team carefully reviews and verifies your data to ensure accurate GAMCA (WAFID) registration and avoid any errors.</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="process-item text-center">
                            <div class="process-icon-wrapper">
                                <i class="fas fa-money-check-alt fa-2x"></i>
                            </div>
                            <h3 class="h4 font-weight-bold text-dark mt-4">Step 2: Easy & Secure Payment</h3>
                            <p class="text-muted mb-2">Confirm your GAMCA medical booking by paying through convenient local options. Your payment is processed securely and your appointment is confirmed instantly.</p>
                            <div class="d-flex flex-wrap justify-content-center" style="gap:6px;">
                                <span class="badge badge-light border px-2 py-1 small"><i class="fas fa-mobile-alt mr-1 text-warning"></i>Easypaisa</span>
                                <span class="badge badge-light border px-2 py-1 small"><i class="fas fa-mobile-alt mr-1 text-success"></i>JazzCash</span>
                                <span class="badge badge-light border px-2 py-1 small"><i class="fas fa-university mr-1 text-primary"></i>Bank Transfer</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="col-lg-4 col-md-12 mb-5 mx-auto">
                        <div class="process-item text-center">
                            <div class="process-icon-wrapper">
                                <i class="fab fa-whatsapp-square fa-2x"></i>
                            </div>
                            <h3 class="h4 font-weight-bold text-dark mt-4">Step 3: Get Your Appointment Slip</h3>
                            <p class="text-muted mb-0">Once confirmed, you'll receive your official GAMCA medical appointment slip as a high-quality PDF directly on your WhatsApp. Simply download and print it for your visit to the GAMCA-approved medical center.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5 sec-bg-why-us" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                        alt="GAMCA Medical Appointment Pakistan"
                        class="img-fluid rounded shadow-lg w-100 h-100"
                        style="object-fit: cover; min-height: 400px;"
                        loading="lazy" decoding="async">
                </div>
                <div class="col-lg-7 pl-lg-5">
                    <p class="text-accent-red font-weight-bold text-uppercase mb-1" style="font-size:.85rem;">Why Choose Us</p>
                    <h2 class="font-weight-bold mb-2 text-dark">Why Choose Us for GAMCA Medical Appointment in Pakistan</h2>
                    <p class="text-muted mb-3">Booking your GAMCA (WAFID) medical appointment can be confusing — we simplify the entire process to make it smooth, secure, and hassle-free.</p>
                    <div class="theme-divider mx-0 mb-3"></div>

                    <div class="media mb-3">
                        <div class="icon-circle bg-light-grey text-accent-red mr-3 p-3 rounded-circle flex-shrink-0">
                            <i class="fas fa-bolt fa-lg"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 font-weight-bold text-dark">Fast GAMCA Appointment Processing</h5>
                            <p class="text-muted mb-0 small">Most GAMCA registrations processed within <strong>1–2 hours</strong> after payment — no delays in your visa process.</p>
                        </div>
                    </div>

                    <div class="media mb-3">
                        <div class="icon-circle bg-light-grey text-accent-green mr-3 p-3 rounded-circle flex-shrink-0">
                            <i class="fas fa-wallet fa-lg"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 font-weight-bold text-dark">Easy Local Payment Options</h5>
                            <p class="text-muted mb-2 small">No international card needed. Pay via local methods accessible to everyone in Pakistan.</p>
                            <div class="d-flex flex-wrap" style="gap: 6px;">
                                <span class="badge badge-light border px-2 py-1 small"><i class="fas fa-mobile-alt mr-1 text-success"></i>JazzCash</span>
                                <span class="badge badge-light border px-2 py-1 small"><i class="fas fa-mobile-alt mr-1 text-warning"></i>Easypaisa</span>
                                <span class="badge badge-light border px-2 py-1 small"><i class="fas fa-university mr-1 text-primary"></i>Bank Transfer</span>
                            </div>
                        </div>
                    </div>

                    <div class="media">
                        <div class="icon-circle bg-light-grey text-primary-dark mr-3 p-3 rounded-circle flex-shrink-0">
                            <i class="fas fa-shield-alt fa-lg"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 font-weight-bold text-dark">Manual Verification by Experts</h5>
                            <p class="text-muted mb-0 small">Our team carefully reviews your details before submitting your GAMCA / WAFID application — reducing errors and preventing rejection.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 sec-bg-testimonials" data-aos="fade-up">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-accent-red font-weight-bold text-uppercase mb-1" style="font-size:.85rem;">Testimonials</p>
                <h2 class="font-weight-bold text-dark">What Our Clients Say</h2>
                <div class="theme-divider"></div>
            </div>

            @if(count($testimonials) > 0)
                <div class="testimonial-carousel mb-4">
                    @foreach($testimonials as $tm)
                        <div class="px-2 pb-4">
                            <div class="card border-0 shadow-sm h-100 testimonial-card">
                                <div class="card-body p-4">
                                    @if($tm->source == 'google')
                                        <div class="google-badge mb-3 d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg"
                                                width="60" alt="Google" class="mr-2" style="opacity: 0.7;"
                                                loading="lazy" decoding="async">
                                            <span class="badge badge-light text-muted small">Google Review</span>
                                        </div>
                                    @endif
                                    <div class="text-accent-red mb-3">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $tm->rating ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                    </div>
                                    <p class="text-muted mb-4 italic">"{{ Str::limit($tm->content, 150) }}"</p>
                                    <div class="d-flex align-items-center mt-auto">
                                        <div class="symbol symbol-40 mr-3">
                                            @if($tm->client_image)
                                                <img src="{{ asset($tm->client_image) }}" class="rounded-circle" width="40" height="40"
                                                    alt="{{ $tm->client_name }}" loading="lazy" decoding="async">
                                            @else
                                                <div class="rounded-circle bg-primary-dark text-white d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;">
                                                    {{ substr($tm->client_name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold text-dark">{{ $tm->client_name }}</h6>
                                            <small
                                                class="text-muted">{{ $tm->client_position ?? ($tm->office_city ? 'From ' . $tm->office_city : '') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

@push('schema')
            ,{
              "@type": "Service",
              "@id": "{{ url('/') }}#service-gamca",
              "name": "Gulf Medical Consultants – GAMCA/WAFID Booking Services",
              "provider": { "@id": "{{ url('/') }}#organization" },
              "areaServed": "PK"
            }
@endpush
            @endif

            @php
                $offices = isset($settings['office_locations']) ? json_decode($settings['office_locations'], true) : [];
                $hasOfficeReviews = false;
            @endphp

            <div class="text-center mt-5">
                <div class="d-flex flex-wrap justify-content-center">
                    @foreach($offices as $office)
                        @if(!empty($office['google_review_url']))
                            @php $hasOfficeReviews = true; @endphp
                            <a href="{{ $office['google_review_url'] }}" target="_blank"
                                class="btn btn-outline-dark m-2 shadow-sm border-secondary d-flex align-items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Google_Favicon_2025.svg/960px-Google_Favicon_2025.svg.png" width="20" height="20" class="mr-2" alt="Google" loading="lazy" decoding="async">
                                <span class="font-weight-bold">Reviews: {{ $office['title'] ?? $office['city'] }}</span>
                            </a>
                        @endif
                    @endforeach

                    @if(!$hasOfficeReviews)
                        <a href="https://www.google.com/search?q=Gulf+Medical+Consultant" target="_blank"
                            class="btn btn-outline-dark d-flex align-items-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Google_Favicon_2025.svg/960px-Google_Favicon_2025.svg.png" width="20" height="20" class="mr-2" alt="Google" loading="lazy" decoding="async">
                             View all reviews on Google
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Office Locations Section -->
    <section class="py-5 sec-bg-white-clean" id="locations">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-accent-red font-weight-bold text-uppercase mb-1" style="font-size:.85rem;">Find Us</p>
                <h2 class="font-weight-bold text-dark">Visit Our Offices</h2>
                <p class="text-muted">We have physical presence in multiple cities for your convenience.</p>
                <div class="theme-divider"></div>
            </div>

            <div class="row">
                @php
                    $colors = ['text-danger', 'text-primary', 'text-success', 'text-warning', 'text-info'];
                    $bg_colors = ['bg-light-red', 'bg-light-blue', 'bg-light-green', 'bg-light-orange', 'bg-light-info'];
                    $icons = ['fa-map-marker-alt', 'fa-building', 'fa-landmark', 'fa-star', 'fa-map'];
                @endphp

                @if(count($offices) > 0)
                    <!-- Location Tabs (Left Side) -->
                    <div class="col-md-4 mb-4">
                        <div class="nav flex-column nav-pills custom-location-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($offices as $index => $office)
                                @php
                                    $color = $colors[$index % count($colors)];
                                    $bg = $bg_colors[$index % count($bg_colors)];
                                    $icon = $icons[$index % count($icons)];
                                    $activeClass = ($index === 0) ? 'active' : '';
                                    $ariaSelected = ($index === 0) ? 'true' : 'false';
                                @endphp
                                <a class="nav-link {{ $activeClass }} p-4 shadow-sm mb-3 border rounded" id="v-pills-office{{ $index }}-tab" data-toggle="pill" href="#v-pills-office{{ $index }}" role="tab" aria-controls="v-pills-office{{ $index }}" aria-selected="{{ $ariaSelected }}">
                                    <div class="d-flex align-items-center">
                                        <div class=" {{ $bg }} {{ $color }} rounded-circle mr-3" style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                            <i class="fas {{ $icon }}"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-dark font-weight-bold">{{ $office['title'] ?? 'Office' }}</h5>
                                            <small class="text-muted">{{ $office['city'] ?? 'Branch' }}</small>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Map Content (Right Side) -->
                    <div class="col-md-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach($offices as $index => $office)
                                @php
                                    $activeClass = ($index === 0) ? 'show active' : '';
                                @endphp
                                <div class="tab-pane fade {{ $activeClass }}" id="v-pills-office{{ $index }}" role="tabpanel">
                                    <div class="card border-0 shadow-lg">
                                        <div class="card-body p-0">
                                            <!-- Embedded Map -->
                                            @if(!empty($office['map_url']))
                                                <iframe src="{{ $office['map_url'] }}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" title="Office location map"></iframe>
                                            @else
                                                <div style="height: 400px; display: flex; align-items: center; justify-content: center; background: #eee;">
                                                    <p class="text-muted">Map URL not provided.</p>
                                                </div>
                                            @endif
                                            
                                            <div class="p-4 bg-light">
                                                <h4 class="font-weight-bold">{{ $office['title'] ?? 'Our Office' }}</h4>
                                                <p><i class="fas fa-map-pin text-danger mr-2"></i> {{ $office['address'] ?? '' }}</p>
                                                <p><i class="fas fa-phone text-success mr-2"></i> {{ $office['phone'] ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-12 text-center">
                        <p class="text-muted">No office locations configured yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Latest Blog Posts -->
    @if($latestBlogs->count() > 0)
    <section class="blog-home-section py-5 sec-bg-light-warm">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-accent-red font-weight-bold text-uppercase mb-1" style="font-size:.85rem;">Our Blog</p>
                <h2 class="font-weight-bold text-dark">Latest News & Updates</h2>
                <div class="theme-divider"></div>
                <p class="text-muted">Stay informed with the latest updates on GAMCA, WAFID, and Gulf visa processes.</p>
            </div>
            <div class="row">
                @foreach($latestBlogs as $blog)
                <div class="col-lg-4 col-md-6 mb-4">
                    <article class="blog-home-card h-100">
                        <a href="{{ route('public.blogs.details', $blog->slug) }}" class="blog-home-img-link">
                            @if($blog->image)
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" loading="lazy" decoding="async" width="400" height="220">
                            @else
                                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=400&q=70" alt="{{ $blog->title }}" loading="lazy" decoding="async" width="400" height="220">
                            @endif
                        </a>
                        <div class="blog-home-body">
                            @if($blog->category)
                                <span class="blog-home-category">{{ $blog->category->name }}</span>
                            @endif
                            <h3 class="blog-home-title">
                                <a href="{{ route('public.blogs.details', $blog->slug) }}">{{ $blog->title }}</a>
                            </h3>
                            @if($blog->short_description)
                                <p class="blog-home-excerpt">{{ Str::limit($blog->short_description, 100) }}</p>
                            @endif
                            <div class="blog-home-footer">
                                <span class="blog-home-date">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ $blog->published_at ? $blog->published_at->format('d M Y') : $blog->created_at->format('d M Y') }}
                                </span>
                                <a href="{{ route('public.blogs.details', $blog->slug) }}" class="blog-home-read-more" aria-label="Read more about {{ $blog->title }}">
                                    Read More <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('public.blogs') }}" class="btn btn-outline-dark px-5 py-2 font-weight-bold">
                    View All Posts
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- FAQ Section -->
    @if($homeFaqs->count() > 0)
    <section class="home-faq-section py-5 sec-bg-gradient-blue">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="home-faq-left">
                        <p class="text-accent-red font-weight-bold text-uppercase mb-1" style="font-size:.85rem;">FAQ</p>
                        <h2 class="font-weight-bold text-white mb-3">Frequently Asked Questions</h2>
                        <p style="color:rgba(255,255,255,0.75);" class="mb-4">Everything you need to know about GAMCA medical appointments, WAFID registration, and our booking process.</p>
                        <a href="{{ route('faq') }}" class="btn btn-light px-4 py-2 font-weight-bold text-dark">
                            View All FAQs <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="accordion home-faq-accordion" id="homeFaqAccordion">
                        @foreach($homeFaqs as $i => $faq)
                        <div class="home-faq-item">
                            <div class="home-faq-question {{ $i === 0 ? '' : 'collapsed' }}"
                                data-toggle="collapse"
                                data-target="#faq{{ $faq->id }}"
                                aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                                <span>{{ $faq->question }}</span>
                                <i class="fas fa-chevron-down home-faq-icon"></i>
                            </div>
                            <div id="faq{{ $faq->id }}"
                                class="collapse {{ $i === 0 ? 'show' : '' }}"
                                data-parent="#homeFaqAccordion">
                                <div class="home-faq-answer">{{ $faq->answer }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Call to Action -->
    <section class="sec-cta-section py-5 text-center">
        <div class="container">
            <h2 class="font-weight-bold mb-3 text-dark">Ready to Start Your Journey?</h2>
            <p class="lead mb-4 text-muted">Don't let technical issues delay your visa. Let us handle the appointments for you.</p>
            <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-lg px-5">Book Appointment Now</a>
        </div>
    </section>
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
$(document).ready(function(){
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });

    // Counter Animation Logic
    const animateCounters = () => {
        $('.counter').each(function() {
            const $this = $(this);
            const countTo = parseInt($this.attr('data-count'));
            
            $({ countNum: $this.text() }).animate({
                countNum: countTo
            }, {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    let val = Math.floor(this.countNum);
                    if (countTo >= 1000) {
                        $this.text((val/1000).toFixed(0) + 'k');
                    } else {
                        $this.text(val);
                    }
                },
                complete: function() {
                    if (countTo >= 1000) {
                        $this.text((this.countNum/1000).toFixed(0) + 'k');
                    } else {
                        $this.text(this.countNum);
                    }
                }
            });
        });
    };

    // Trigger counter when it enters viewport
    let counterStarted = false;
    const checkViewport = function() {
        const statsSection = $('.stats-bar');
        if (statsSection.length) {
            const hT = statsSection.offset().top,
                  hH = statsSection.outerHeight(),
                  wH = $(window).height(),
                  wS = $(window).scrollTop();
            
            // If the top of the stats bar is within the viewport
            if (wS + wH > hT && !counterStarted){
                animateCounters();
                counterStarted = true;
            }
        }
    };

    $(window).on('scroll load', checkViewport);
    
    // Final check after short delay for dynamic layouts
    setTimeout(checkViewport, 500);

    $('.testimonial-carousel').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }
        ]
    });
});
</script>
@endpush

@push('schema')
,{
    "@type": "LocalBusiness",
    "@id": "{{ url('/') }}#localbusiness",
    "name": "{{ $settings['site_name'] ?? '' }}",
    "url": "{{ url('/') }}",
    "telephone": "{{ $settings['site_phone'] ?? '' }}",
    "email": "{{ $settings['site_email'] ?? '' }}",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $settings['site_address'] ?? '' }}",
        "addressCountry": "PK"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "30.3753",
        "longitude": "69.3451"
    },
    "parentOrganization": { "@id": "{{ url('/') }}#organization" }
    <?php
        $numericRatings = $testimonials->pluck('rating')->filter(fn($r) => is_numeric($r));
    ?>
    @if($testimonials->count() > 0 && $numericRatings->isNotEmpty())
    ,"aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ round($numericRatings->avg(), 1) }}",
        "reviewCount": {{ $testimonials->count() }},
        "bestRating": 5,
        "worstRating": 1
    }
    ,"review": [
        @foreach($testimonials as $index => $tm)
            {
              "@type": "Review",
              "reviewRating": {
                "@type": "Rating",
                "ratingValue": "{{ $tm->rating }}"
              },
              "author": {
                "@type": "Person",
                "name": "{{ $tm->client_name }}"
              },
              "reviewBody": "{{ addslashes(Str::limit($tm->content, 150)) }}"
            }{{ $index < count($testimonials) - 1 ? ',' : '' }}
        @endforeach
    ]
    @endif
}
,{
    "@type": "Service",
    "@id": "{{ url('/') }}#service-wafid",
    "name": "Wafid (GAMCA) Medical Appointment",
    "description": "Book your official GAMCA medical appointment slip online. Fast processing with delivery to WhatsApp.",
    "mainEntityOfPage": "{{ route('medicalExamination') }}",
    "areaServed": { "@type": "Country", "name": "Pakistan" },
    "provider": { "@id": "{{ url('/') }}#organization" }
}
,{
    "@type": "Service",
    "@id": "{{ url('/') }}#service-wafid-choice",
    "name": "Wafid Choice Medical Center Selection",
    "description": "Choose your preferred GAMCA-approved medical center for your GCC medical appointment.",
    "mainEntityOfPage": "{{ route('special.appointment') }}",
    "areaServed": { "@type": "Country", "name": "Pakistan" },
    "provider": { "@id": "{{ url('/') }}#organization" }
}
,{
    "@type": "Service",
    "@id": "{{ url('/') }}#service-navttc",
    "name": "NAVTTC / Takamol Skill Verification",
    "description": "Book your NAVTTC Takamol skill verification test for Saudi Arabia employment.",
    "mainEntityOfPage": "{{ route('navtechform') }}",
    "areaServed": { "@type": "Country", "name": "Pakistan" },
    "provider": { "@id": "{{ url('/') }}#organization" }
}
,{
    "@type": "Service",
    "@id": "{{ url('/') }}#service-tasheer",
    "name": "Tasheer Saudi Visa Appointment",
    "description": "Schedule your Tasheer Saudi visa appointment quickly and securely online.",
    "mainEntityOfPage": "{{ route('tasheer.form') }}",
    "areaServed": { "@type": "Country", "name": "Pakistan" },
    "provider": { "@id": "{{ url('/') }}#organization" }
}
,{
    "@type": "Service",
    "@id": "{{ url('/') }}#service-softskill",
    "name": "Soft Skill Certificate",
    "description": "Obtain your soft skill certificate for Gulf employment requirements.",
    "mainEntityOfPage": "{{ route('softskill.form') }}",
    "areaServed": { "@type": "Country", "name": "Pakistan" },
    "provider": { "@id": "{{ url('/') }}#organization" }
}
@if($homeFaqs->count() > 0)
,{
    "@type": "FAQPage",
    "@id": "{{ url('/') }}#faqpage",
    "mainEntity": [
        @foreach($homeFaqs as $faq)
        {
            "@type": "Question",
            "name": "{{ addslashes(str_replace(["\r\n", "\n", "\r"], ' ', $faq->question)) }}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{ addslashes(str_replace(["\r\n", "\n", "\r"], ' ', $faq->answer)) }}"
            }
        }{{ !$loop->last ? ',' : '' }}
        @endforeach
    ]
}
@endif
@endpush
