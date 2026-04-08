@extends('layouts.public')

@section('title', 'About Gulf Medical Consultant | GCC Medical & Skill Test Assistance Pakistan')
@section('meta_description', 'Gulf Medical Consultant helps Pakistan-based workers, students, and travelers navigate GCC medical bookings, WAFID/GAMCA guidance, and NAVTTC skill tests with expert support.')
@section('meta_keywords', 'about Gulf Medical Consultant, GCC medical assistance Pakistan, WAFID GAMCA expert, NAVTTC skill test help, Pakistan GCC consultancy')

@push('schema')
,{
    "@type": "AboutPage",
    "@id": "{{ url()->current() }}#about",
    "mainEntity": { "@id": "{{ url('/') }}#organization" }
},
{
    "@type": "Organization",
    "@id": "{{ url('/') }}#organization",
    "name": "{{ $settings['site_name'] ?? 'Gulf Medical Consultant' }}",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('assets/public/images/logo.png') }}",
    "description": "Expert consultancy for GCC medical bookings, WAFID/GAMCA appointments, and NAVTTC skill tests for Pakistan-based applicants.",
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "PK",
        "addressLocality": "Pakistan"
    },
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "{{ $settings['site_phone'] ?? '' }}",
        "contactType": "Customer Service",
        "availableLanguage": ["English", "Urdu"]
    }
}
@endpush

@push('head')
<style>
    /* Hero Section */
    .about-hero {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        padding: 80px 0 60px;
        position: relative;
        overflow: hidden;
    }
    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="rgba(255,198,84,0.03)"/></svg>');
        background-size: 100px;
        opacity: 0.3;
    }
    .about-hero h1 { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .about-hero p { color: rgba(255,255,255,.8); font-size: 1.1rem; }
    .about-badge {
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
    
    /* Section Styles */
    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a252f;
        margin-bottom: 1rem;
    }
    .section-subtitle {
        color: var(--accent-gold);
        font-size: .85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 12px;
    }
    
    /* Value Cards */
    .value-card {
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 16px;
        padding: 32px 24px;
        height: 100%;
        transition: all .3s ease;
        position: relative;
        overflow: hidden;
    }
    .value-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 0;
        background: var(--accent-gold);
        transition: height .3s ease;
    }
    .value-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,.1);
        border-color: var(--accent-gold);
    }
    .value-card:hover::before {
        height: 100%;
    }
    .value-icon {
        width: 70px;
        height: 70px;
        background: #fff8e1;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: var(--accent-gold);
        margin-bottom: 20px;
        transition: all .3s ease;
    }
    .value-card:hover .value-icon {
        background: var(--accent-gold);
        color: #fff;
        transform: scale(1.1);
    }
    
    /* Mission/Vision Cards */
    .mission-card {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        border-radius: 16px;
        padding: 40px;
        color: #fff;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .mission-card::after {
        content: '';
        position: absolute;
        bottom: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,198,84,.05);
        border-radius: 50%;
    }
    .mission-icon {
        width: 60px;
        height: 60px;
        background: rgba(255,198,84,.15);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--accent-gold);
        margin-bottom: 20px;
    }
    
    /* Service List */
    .service-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 12px;
        margin-bottom: 16px;
        transition: all .3s ease;
    }
    .service-item:hover {
        background: #fff;
        box-shadow: 0 8px 20px rgba(0,0,0,.06);
        transform: translateX(8px);
    }
    .service-icon {
        width: 48px;
        height: 48px;
        background: var(--accent-gold);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        flex-shrink: 0;
    }
    
    /* Stats */
    .stat-box {
        text-align: center;
        padding: 24px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,.05);
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
    
    /* Team Section */
    .team-card {
        background: #fff;
        border-radius: 16px;
        padding: 32px;
        text-align: center;
        border: 1px solid #e8ecf0;
        transition: all .3s ease;
    }
    .team-card:hover {
        box-shadow: 0 12px 30px rgba(0,0,0,.08);
        transform: translateY(-5px);
    }
    .team-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--accent-gold);
        margin: 0 auto 20px;
    }
    
    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--accent-gold) 0%, #f4b942 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }
    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255,255,255,.1);
        border-radius: 50%;
    }
    
    /* GCC Links */
    .gcc-country-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f8f9fa;
        border: 1px solid #e8ecf0;
        border-radius: 24px;
        padding: 8px 18px;
        font-size: .88rem;
        font-weight: 600;
        color: #1a252f;
        text-decoration: none;
        transition: all .2s ease;
        margin: 6px 4px;
    }
    .gcc-country-link:hover {
        background: var(--accent-gold);
        border-color: var(--accent-gold);
        color: #0f1923;
        text-decoration: none;
        transform: translateY(-2px);
    }
    
    @media(max-width:767px) {
        .about-hero h1 { font-size: 1.8rem; }
        .section-title { font-size: 1.5rem; }
    }
</style>
@endpush

@section('content')

{{-- HERO SECTION --}}
<section class="about-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">About Us</li>
            </ol>
        </nav>
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="about-badge">Who We Are</span>
                <h1 class="mb-3">About Gulf Medical Consultant</h1>
                <p class="mb-4">Expert consultancy for GCC medical bookings, WAFID/GAMCA guidance, and NAVTTC skill tests — helping Pakistan-based workers, students, and travelers navigate complex application processes with confidence.</p>
                <div class="d-flex flex-wrap" style="gap:12px;">
                    <a href="{{ route('contact') }}" class="btn btn-warning font-weight-bold px-4 py-2" style="color:#0f1923;">
                        <i class="fas fa-phone mr-2"></i>Get Consultation
                    </a>
                    <a href="#services" class="btn btn-outline-light px-4 py-2">
                        <i class="fas fa-arrow-down mr-2"></i>Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- WHO WE ARE --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Gulf Medical Consultant Team" class="img-fluid rounded shadow-lg" style="border-radius:16px !important;">
            </div>
            <div class="col-lg-6 pl-lg-5">
                <span class="section-subtitle">Our Story</span>
                <h2 class="section-title">Who We Are</h2>
                <p class="text-muted mb-3">Gulf Medical Consultant is a private consultancy firm based in Pakistan, dedicated to helping workers, students, and travelers complete GCC-related medical and skill-test requirements smoothly.</p>
                <p class="text-muted mb-4">We provide expert guidance for processes like WAFID (GAMCA) medical appointments and NAVTTC skill tests, helping applicants overcome technical hurdles, confusing forms, and payment issues.</p>
                
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="stat-number">50K+</div>
                            <div class="stat-label">Happy Clients</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="stat-number">6+</div>
                            <div class="stat-label">GCC Countries</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MISSION & VISION --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-subtitle">Our Purpose</span>
            <h2 class="section-title">Mission & Vision</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="font-weight-bold mb-3" style="font-size:1.4rem;">Our Mission</h3>
                    <p class="mb-3" style="color:rgba(255,255,255,.85);line-height:1.8;">Our mission is to simplify complex application processes for GCC-bound applicants by:</p>
                    <ul style="color:rgba(255,255,255,.8);line-height:2;">
                        <li>Offering step-by-step guidance for medical and skill test registrations</li>
                        <li>Helping applicants avoid delays and mistakes in forms, documentation, or portal submissions</li>
                        <li>Providing real-time support in English and Urdu for Pakistan, India, Bangladesh, and GCC-based applicants</li>
                        <li>Empowering professionals to travel or work abroad with confidence and clarity</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="font-weight-bold mb-3" style="font-size:1.4rem;">Our Vision</h3>
                    <p style="color:rgba(255,255,255,.85);line-height:1.8;">To become the most trusted one-stop solution for all GCC visa-related medical and technical requirements across Pakistan and South Asia, recognized for our integrity, accuracy, and customer-centric approach.</p>
                    <div class="mt-4 pt-3" style="border-top:1px solid rgba(255,255,255,.1);">
                        <p class="mb-2" style="color:rgba(255,255,255,.7);font-size:.9rem;"><i class="fas fa-check-circle mr-2" style="color:var(--accent-gold);"></i>Transparent Services</p>
                        <p class="mb-2" style="color:rgba(255,255,255,.7);font-size:.9rem;"><i class="fas fa-check-circle mr-2" style="color:var(--accent-gold);"></i>Expert Guidance</p>
                        <p class="mb-0" style="color:rgba(255,255,255,.7);font-size:.9rem;"><i class="fas fa-check-circle mr-2" style="color:var(--accent-gold);"></i>Reliable Support</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- WHY CHOOSE US --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-subtitle">Our Advantages</span>
            <h2 class="section-title">Why Choose Gulf Medical Consultant?</h2>
            <p class="text-muted mx-auto" style="max-width:700px;">We understand the challenges faced by GCC-bound applicants and provide comprehensive support to ensure a smooth, hassle-free experience.</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3">Expert Guidance</h5>
                    <p class="text-muted small mb-0">Years of experience navigating GCC medical portals and skill-test systems. Our team knows every step of the process.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3">Step-by-Step Support</h5>
                    <p class="text-muted small mb-0">From form filling to document verification and payment instructions — we guide you through every stage.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3">Time-Saving Assistance</h5>
                    <p class="text-muted small mb-0">Avoid repeated trips and errors with our coordinated approach. Get it right the first time.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-language"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3">Bilingual Coordination</h5>
                    <p class="text-muted small mb-0">Support in English and Urdu for clear communication. We speak your language.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-shield-check"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3">Trusted Consultancy</h5>
                    <p class="text-muted small mb-0">Serving thousands of applicants with transparent, reliable assistance. Your success is our priority.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3">24/7 Support</h5>
                    <p class="text-muted small mb-0">Real-time assistance via WhatsApp, phone, and email. We're here when you need us.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- OUR SERVICES --}}
<section class="py-5" style="background:#f7f8fc;" id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <span class="section-subtitle">What We Offer</span>
                <h2 class="section-title mb-4">Our Services</h2>
                <p class="text-muted mb-4">We provide consultancy and support for all GCC-related medical and skill test requirements, ensuring you're fully prepared for your journey abroad.</p>
                <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Our Services" class="img-fluid rounded shadow" style="border-radius:16px !important;">
            </div>
            <div class="col-lg-7">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="fas fa-hospital-user"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-2">GCC Medical Booking Assistance</h6>
                        <p class="text-muted small mb-0">Guidance for WAFID (GAMCA) medical appointments in Saudi Arabia, UAE, Oman, Kuwait, Qatar, and Bahrain.</p>
                    </div>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-2">Skill Test Registration</h6>
                        <p class="text-muted small mb-0">Help with NAVTTC and other required skill certifications for GCC work visas.</p>
                    </div>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        <i class="fas fa-file-check"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-2">Document Verification</h6>
                        <p class="text-muted small mb-0">Ensure passports, visa categories, medical reports, photos, and vaccination records are correct.</p>
                    </div>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-2">Reminders and Coordination</h6>
                        <p class="text-muted small mb-0">Time-zone aware notifications, reporting instructions, and preparation checklists.</p>
                    </div>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-2">Problem Resolution</h6>
                        <p class="text-muted small mb-0">Assistance for portal errors, payment issues, and expired tokens.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- OUR VALUES --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-subtitle">What Drives Us</span>
            <h2 class="section-title">Our Core Values</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="value-icon mx-auto">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Integrity</h5>
                    <p class="text-muted small">Transparent, honest consultancy services you can trust.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="value-icon mx-auto">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Accuracy</h5>
                    <p class="text-muted small">Every form, document, and appointment detail is verified.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="value-icon mx-auto">
                        <i class="fas fa-award"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Reliability</h5>
                    <p class="text-muted small">Prompt support and real-time updates you can count on.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="value-icon mx-auto">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Customer-Centric</h5>
                    <p class="text-muted small">Personalized guidance tailored to your situation.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- OUR TEAM --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-subtitle">The People Behind Our Success</span>
            <h2 class="section-title">Meet Our Team</h2>
            <p class="text-muted mx-auto" style="max-width:700px;">Our consultants are experienced in GCC medical systems and skill-test procedures. They are trained to handle queries, verify documents, and ensure applicants are fully prepared.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Medical Consultants</h5>
                    <p class="text-muted small mb-0">Expert guidance for WAFID/GAMCA medical appointments across all GCC countries.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Document Specialists</h5>
                    <p class="text-muted small mb-0">Thorough verification of all required documents and certifications.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-icon">
                        <i class="fas fa-headphones-alt"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Support Team</h5>
                    <p class="text-muted small mb-0">24/7 bilingual support via WhatsApp, phone, and email.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- GCC COUNTRIES --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="text-center mb-4">
            <span class="section-subtitle">Countries We Serve</span>
            <h2 class="section-title mb-3">GCC Medical Booking Support</h2>
            <p class="text-muted mb-4">We provide expert assistance for medical appointments in all GCC countries:</p>
            <div class="d-flex flex-wrap justify-content-center">
                <a href="{{ route('public.gcc.country', 'saudi-arabia') }}" class="gcc-country-link">🇸🇦 Saudi Arabia</a>
                <a href="{{ route('public.gcc.country', 'uae') }}" class="gcc-country-link">🇦🇪 UAE</a>
                <a href="{{ route('public.gcc.country', 'qatar') }}" class="gcc-country-link">🇶🇦 Qatar</a>
                <a href="{{ route('public.gcc.country', 'oman') }}" class="gcc-country-link">🇴🇲 Oman</a>
                <a href="{{ route('public.gcc.country', 'kuwait') }}" class="gcc-country-link">🇰🇼 Kuwait</a>
                <a href="{{ route('public.gcc.country', 'bahrain') }}" class="gcc-country-link">🇧🇭 Bahrain</a>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="cta-section">
    <div class="container text-center position-relative" style="z-index:1;">
        <h2 class="font-weight-bold mb-3" style="color:#0f1923;font-size:2rem;">Need Assistance with Your GCC Medical or Skill Test?</h2>
        <p class="mb-4" style="color:#1a252f;font-size:1.1rem;">Our team is ready to help you navigate the process smoothly. Get in touch today!</p>
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center" style="gap:12px;">
            <a href="{{ route('contact') }}" class="btn btn-dark btn-lg px-5 py-3 font-weight-bold">
                <i class="fas fa-phone mr-2"></i>Contact Us Today
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GCC+medical+booking." target="_blank" class="btn btn-outline-dark btn-lg px-5 py-3 font-weight-bold">
                <i class="fab fa-whatsapp mr-2"></i>WhatsApp Now
            </a>
        </div>
    </div>
</section>

@endsection