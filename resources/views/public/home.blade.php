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
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Hero Section (Matches your css .hero-section) -->
    <section class="hero-section text-center"
        style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)) , url('{{ asset('assets/public/images/hero-bg.jpg') }}') center/cover no-repeat;">
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
                        {{-- Button 1: Added mb-3 (margin bottom) for mobile, removed on desktop (mb-md-0) --}}
                        <a href="#services"
                            class="btn btn-light text-dark font-weight-bold px-5 py-3 mb-3 mb-md-0 mr-md-3 shadow">
                            Book Appointment
                        </a>

                        {{-- Button 2: Transparent outline --}}
                        <a href="{{ route('contact') }}" class="btn btn-outline-light font-weight-bold px-5 py-3">
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar (Updated Design) -->
    <div class="container stats-bar-wrapper" data-aos="fade-up">
        <div class="stats-bar py-4">
            <div class="row align-items-center">

                <!-- Item 1 -->
                <div class="col-4 stat-item text-center">
                    <div class="stat-number"><span class="counter" data-count="10000">0</span>+</div>
                    <p class="stat-label">Appointments</p>
                </div>

                <!-- Item 2 -->
                <div class="col-4 stat-item text-center">
                    <div class="stat-number"><span class="counter" data-count="99">0</span>%</div>
                    <p class="stat-label">Success</p>
                </div>

                <!-- Item 3 -->
                <div class="col-4 stat-item text-center">
                    <div class="stat-number"><span class="counter" data-count="24">0</span>/7</div>
                    <p class="stat-label">Support</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Simple 3-Step Process (Premium Revamp) -->
    <section class="py-5 bg-white" data-aos="fade-up">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-accent-red font-weight-extrabold text-uppercase letter-spacing-2">How it works</h6>
                <h2 class="font-weight-bold text-dark">Easy 3-Step Support</h2>
                <div class="theme-divider"></div>
                <p class="text-muted">We make Gulf medical and skill test bookings effortless for you.</p>
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
                            <h3 class="h4 font-weight-bold text-dark mt-4">Provide Details</h3>
                            <p class="text-muted mb-0">Simply fill out our short form with your basic passport information. Our team cross-checks everything for accuracy.</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="process-item text-center">
                            <div class="process-icon-wrapper">
                                <i class="fas fa-money-check-alt fa-2x"></i>
                            </div>
                            <h3 class="h4 font-weight-bold text-dark mt-4">Easy Payment</h3>
                            <p class="text-muted mb-0">Confirm your booking by paying via any local method (EasyPaisa, JazzCash, or Bank). Instant confirmation guaranteed.</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="col-lg-4 col-md-12 mb-5 mx-auto">
                        <div class="process-item text-center">
                            <div class="process-icon-wrapper">
                                <i class="fab fa-whatsapp-square fa-2x"></i>
                            </div>
                            <h3 class="h4 font-weight-bold text-dark mt-4">Instant PDF</h3>
                            <p class="text-muted mb-0">Your high-resolution official appointment slip is delivered directly to your WhatsApp as a ready-to-print PDF.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Cards (Using your Buttons & Colors) -->
    <section class="services-section py-5 bg-light-grey" id="services" data-aos="fade-up">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-accent-red font-weight-bold text-uppercase">Services</h6>
                <h2 class="font-weight-bold text-dark">Choose Your Appointment</h2>
                <div class="theme-divider"></div>
                <p class="text-muted">We handle the technical part so you can focus on travel.</p>
            </div>

            <div class="row">
                <!-- Wafid Regular -->
                <div class="col-lg-6 mb-4">
                    <div class="service-card h-100 bg-white p-4 rounded shadow-sm">
                        <div class="d-flex align-items-center mb-4">
                            <div class="service-logo-box">
                                {{-- Replace with asset('assets/public/images/wafid-logo.png') --}}
                                <img src="{{asset('assets/public/images/wafid-logo.svg')}}" alt="Wafid GAMCA Medical Slip Logo" class="img-fluid">
                            </div>
                            <div>
                                <h4 class="font-weight-bold mb-1 text-dark">Wafid (GAMCA) Medical</h4>
                                <span class="badge badge-theme-green">Most Popular</span>
                            </div>
                        </div>
                        <p class="card-description text-muted mb-4">
                            Standard medical slip generation for GCC countries. The system automatically assigns the nearest
                            medical center based on your city.
                        </p>

                        {{-- UPDATED BUTTONS FOR MOBILE --}}
                        <div class="row">
                            {{-- Stack on Mobile (col-12), Side-by-side on Desktop (col-md-6) --}}
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <a href="{{ route('medicalExamination')}}" class="btn btn-dark btn-block">Book Now</a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{ route('ViewMedicalReport') }}" class="btn btn-outline-dark btn-block">Check
                                    Status</a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Wafid Special -->
                <div class="col-lg-6 mb-4">
                    <div class="service-card h-100 bg-white p-4 rounded shadow-sm">
                        <div class="d-flex align-items-center mb-4">
                            <div class="service-logo-box">
                                {{-- Replace with asset('assets/public/images/wafid-logo.png') --}}
                                <img src="{{asset('assets/public/images/wafid-logo.svg')}}" alt="Wafid Choice Medical Center Selection"
                                    class="img-fluid">
                            </div>
                            <div>
                                <h4 class="font-weight-bold mb-1 text-dark">Wafid Choice Center</h4>
                                <span class="badge badge-theme-red">Premium Service</span>
                            </div>
                        </div>
                        <p class="card-description text-muted mb-4">
                            Do you need a specific hospital or want to change your city? Use this service to manually select
                            your preferred medical center.
                        </p>

                        {{-- UPDATED BUTTONS FOR MOBILE --}}
                        <div class="row">
                            {{-- Stack on Mobile (col-12), Side-by-side on Desktop (col-md-6) --}}
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <a href="{{ route('special.appointment')}}" class="btn btn-dark btn-block">Book Special</a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{ route('ViewMedicalCenters')}}" class="btn btn-outline-dark btn-block">Search
                                    Centers</a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- NAVTTC -->
                <div class="col-lg-6 mb-4">
                    <div class="service-card h-100 bg-white p-4 rounded shadow-sm">
                        <div class="d-flex align-items-center mb-4">
                            <div class="service-logo-box">
                                {{-- Replace with asset('assets/public/images/navttc-logo.png') --}}
                                <img src="{{asset('assets/public/images/navttc-logo.png')}}" alt="NAVTTC Takamol Skill Verification" class="img-fluid">
                            </div>
                            <div>
                                <h4 class="font-weight-bold mb-1 text-dark">NAVTTC / Takamol Appointment</h4>
                                <span class="badge badge-theme-dark">Saudi Visa</span>
                            </div>
                        </div>
                        <p class="card-description text-muted mb-4">
                            Mandatory Skills Verification Program (SVP) test booking for technical trades (Electrician,
                            Plumber, etc.) going to Saudi Arabia.
                        </p>
                        <a href="{{ route('navtechform')}}" class="btn btn-dark btn-block">Book Skill Test</a>
                    </div>
                </div>

                <!-- Tasheer -->
                <div class="col-lg-6 mb-4">
                    <div class="service-card h-100 bg-white p-4 rounded shadow-sm">
                        <div class="d-flex align-items-center mb-4">
                            <div class="service-logo-box">
                                <img src="{{asset('assets/public/images/tasheer-logo.png')}}" alt="Tasheer Saudi Visa Biometric Appointment"
                                    class="img-fluid">
                            </div>
                            <div>
                                <h4 class="font-weight-bold mb-1 text-dark">Tasheer Appointment</h4>
                                <span class="badge badge-theme-dark">Visa Center</span>
                            </div>
                        </div>
                        <p class="card-description text-muted mb-4">
                            Biometric enrollment and document submission appointments for Saudi Visa Centers (Tasheer /
                            VFS).
                        </p>
                        <a href="{{ route('tasheer.form')}}" class="btn btn-dark btn-block">Book Tasheer</a>
                    </div>
                </div>

                <!-- Soft Skills -->
                <div class="col-lg-6 mb-4 mx-auto">
                    <div class="service-card h-100 bg-white p-4 rounded shadow-sm">
                        <div class="d-flex align-items-center mb-4">
                            <div class="service-logo-box">
                                <img src="{{asset('assets/public/images/soft-skill-logo.png')}}" alt="Gulf Employment Soft Skill Certificate"
                                    class="img-fluid">
                            </div>
                            <div>
                                <h4 class="font-weight-bold mb-1 text-dark">Soft Skill Certificates</h4>
                                <span class="badge badge-theme-green">Career</span>
                            </div>
                        </div>
                        <p class="card-description text-muted mb-4">
                            Enhance your CV with verifiable soft skill certifications tailored for the Gulf job market.
                        </p>
                        <a href="{{ route('softskill.form')}}" class="btn btn-dark btn-block">Apply For Certificate</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5 bg-white" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="bg-light-grey rounded text-center">
                        <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                            alt="Consultancy" class="img-fluid rounded shadow-lg">
                    </div>
                </div>
                <div class="col-lg-6 pl-lg-5">
                    <h6 class="text-accent-red font-weight-bold text-uppercase">Why Choose Us</h6>
                    <h2 class="font-weight-bold mb-4 text-dark">We Make It Easy & Secure</h2>
                    <div class="theme-divider mx-0 mb-4"></div>

                    <div class="media mb-4">
                        <div class="icon-circle bg-light-grey text-accent-red mr-3 p-3 rounded-circle">
                            <i class="fas fa-bolt fa-lg"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 font-weight-bold text-dark">Fast Processing</h5>
                            <p class="text-muted">We process most applications within 1-2 hours of payment confirmation.</p>
                        </div>
                    </div>

                    <div class="media mb-4">
                        <div class="icon-circle bg-light-grey text-accent-green mr-3 p-3 rounded-circle">
                            <i class="fas fa-wallet fa-lg"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 font-weight-bold text-dark">Local Payment Methods</h5>
                            <p class="text-muted">No credit card? No problem. Pay via JazzCash, Easypaisa, or local Bank
                                Transfer.</p>
                        </div>
                    </div>

                    <div class="media">
                        <div class="icon-circle bg-light-grey text-primary-dark mr-3 p-3 rounded-circle">
                            <i class="fas fa-headset fa-lg"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 font-weight-bold text-dark">Manual Verification</h5>
                            <p class="text-muted">Our experts check your documents before applying to avoid rejection
                                errors.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-light-grey" data-aos="fade-up">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-accent-red font-weight-bold text-uppercase">Testimonials</h6>
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
                                                width="60" alt="Google" class="mr-2" style="opacity: 0.7;">
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
                                                    alt="{{ $tm->client_name }}">
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
              "@type": "Product",
              "@id": "{{ url('/') }}#product",
              "name": "Gulf Medical Consultants",
              "mainEntityOfPage": { "@id": "{{ url('/') }}#website" },
              "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "4.9",
                "reviewCount": "1500"
              },
              "review": [
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
                      "reviewBody": "{{ Str::limit($tm->content, 150) }}"
                    }{{ $index < count($testimonials) - 1 ? ',' : '' }}
                @endforeach
              ]
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
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Google_Favicon_2025.svg/960px-Google_Favicon_2025.svg.png" width="20" height="20" class="mr-2" alt="Google">
                                <span class="font-weight-bold">Reviews: {{ $office['title'] ?? $office['city'] }}</span>
                            </a>
                        @endif
                    @endforeach

                    @if(!$hasOfficeReviews)
                        <a href="https://www.google.com/search?q=Gulf+Medical+Consultant" target="_blank"
                            class="btn btn-outline-dark d-flex align-items-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Google_Favicon_2025.svg/960px-Google_Favicon_2025.svg.png" width="20" height="20" class="mr-2" alt="Google">
                             View all reviews on Google
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Office Locations Section -->
    <section class="py-5 bg-white" id="locations">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-accent-red font-weight-bold text-uppercase">Find Us</h6>
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
                                                <iframe src="{{ $office['map_url'] }}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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

    <!-- Call to Action -->
    <section class="py-5 bg-primary-dark text-white text-center">
        <div class="container">
            <h2 class="font-weight-bold mb-3">Ready to Start Your Journey?</h2>
            <p class="lead mb-4" style="opacity: 0.8">Don't let technical issues delay your visa. Let us handle the
                appointments for you.</p>
            <a href="{{ route('medicalExamination')}}" class="btn btn-outline-light btn-lg px-5">Book Appointment Now</a>
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
        duration: 1000,
        once: true,
        offset: 100
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