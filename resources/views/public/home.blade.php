@extends('layouts.public')

@section('title', 'Gulf Medical Consultant - Wafid, NAVTTC & Tasheer Services')
@section('meta_description', 'Official assistance for Wafid (GAMCA) medical slips, NAVTTC skills verification, and Tasheer Saudi visa appointments. Fast processing.')

@section('content')
    <!-- Hero Section (Matches your css .hero-section) -->
    <section class="hero-section text-center" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)) , url('{{ asset('assets/public/images/hero-bg.jpg') }}') center/cover no-repeat;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">                    
                    <h1 class="hero-title">Gulf Medical Consultant</h1>
                    <p class="hero-subtitle mb-5">
                        We simplify the complex booking process for GCC countries. 
                        <strong>Wafid Medical</strong>, <strong>NAVTTC Tests</strong>, and <strong>Tasheer Appointments</strong> handled by experts.
                    </p>
                    <div class="hero-buttons d-flex flex-column flex-md-row justify-content-center align-items-center">
                        {{-- Button 1: Added mb-3 (margin bottom) for mobile, removed on desktop (mb-md-0) --}}
                        <a href="#services" class="btn btn-light text-dark font-weight-bold px-5 py-3 mb-3 mb-md-0 mr-md-3 shadow">
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
    <div class="container">
        <div class="stats-bar py-4">
            <div class="row align-items-center">
                
                <!-- Item 1 -->
                <div class="col-4 stat-item text-center">
                    <div class="stat-number">10k+</div>
                    <p class="stat-label">Appointments</p>
                </div>
                
                <!-- Item 2 -->
                <div class="col-4 stat-item text-center">
                    <div class="stat-number">99%</div>
                    <p class="stat-label">Success</p>
                </div>
                
                <!-- Item 3 -->
                <div class="col-4 stat-item text-center">
                    <div class="stat-number">24/7</div>
                    <p class="stat-label">Support</p>
                </div>

            </div>
        </div>
    </div>

    <!-- How It Works (Theme Colors) -->
    <section class="pt-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-accent-red font-weight-bold text-uppercase">Process</h6>
                <h2 class="font-weight-bold text-dark">Simple 3-Step Process</h2>
                <div class="theme-divider"></div>
            </div>

            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="process-step">
                        <div class="process-icon-circle">
                            <i class="fas fa-edit fa-2x text-accent-red"></i>
                        </div>
                        <h4 class="font-weight-bold text-dark">1. Fill Form</h4>
                        <p class="text-muted">Enter your passport details in our simplified online forms.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="process-step">
                        <div class="process-icon-circle">
                            <i class="fas fa-wallet fa-2x text-accent-red"></i>
                        </div>
                        <h4 class="font-weight-bold text-dark">2. Payment</h4>
                        <p class="text-muted">Pay the fee easily via JazzCash, Easypaisa, or Bank Transfer.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="process-step">
                        <div class="process-icon-circle">
                            <i class="fab fa-whatsapp fa-2x text-accent-red"></i>
                        </div>
                        <h4 class="font-weight-bold text-dark">3. Get PDF</h4>
                        <p class="text-muted">Receive your official appointment slip directly on WhatsApp.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Cards (Using your Buttons & Colors) -->
    <section class="services-section py-5 bg-light-grey" id="services">
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
                                <img src="{{asset('assets/public/images/wafid-logo.svg')}}" alt="Wafid" class="img-fluid">
                            </div>
                            <div>
                                <h4 class="font-weight-bold mb-1 text-dark">Wafid (GAMCA) Medical</h4>
                                <span class="badge badge-theme-green">Most Popular</span>
                            </div>
                        </div>
                        <p class="card-description text-muted mb-4">
                            Standard medical slip generation for GCC countries. The system automatically assigns the nearest medical center based on your city.
                        </p>
                        
                        {{-- UPDATED BUTTONS FOR MOBILE --}}
                        <div class="row">
                            {{-- Stack on Mobile (col-12), Side-by-side on Desktop (col-md-6) --}}
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <a href="{{ route('medicalExamination')}}" class="btn btn-dark btn-block">Book Now</a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{ route('ViewMedicalReport') }}" class="btn btn-outline-dark btn-block">Check Status</a>
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
                                <img src="{{asset('assets/public/images/wafid-logo.svg')}}" alt="Wafid Special" class="img-fluid">
                            </div>
                            <div>
                                <h4 class="font-weight-bold mb-1 text-dark">Wafid Choice Center</h4>
                                <span class="badge badge-theme-red">Premium Service</span>
                            </div>
                        </div>
                        <p class="card-description text-muted mb-4">
                            Do you need a specific hospital or want to change your city? Use this service to manually select your preferred medical center.
                        </p>
                        
                        {{-- UPDATED BUTTONS FOR MOBILE --}}
                        <div class="row">
                            {{-- Stack on Mobile (col-12), Side-by-side on Desktop (col-md-6) --}}
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <a href="{{ route('special.appointment')}}" class="btn btn-dark btn-block">Book Special</a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{ route('ViewMedicalCenters')}}" class="btn btn-outline-dark btn-block">Search Centers</a>
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
                                <img src="{{asset('assets/public/images/navttc-logo.png')}}" alt="NAVTTC" class="img-fluid">
                            </div>
                            <div>
                                <h4 class="font-weight-bold mb-1 text-dark">NAVTTC / Takamol Appointment</h4>
                                <span class="badge badge-theme-dark">Saudi Visa</span>
                            </div>
                        </div>
                        <p class="card-description text-muted mb-4">
                            Mandatory Skills Verification Program (SVP) test booking for technical trades (Electrician, Plumber, etc.) going to Saudi Arabia.
                        </p>
                        <a href="{{ route('navtechform')}}" class="btn btn-dark btn-block">Book Skill Test</a>
                    </div>
                </div> 

                <!-- Tasheer -->
                <div class="col-lg-6 mb-4">
                    <div class="service-card h-100 bg-white p-4 rounded shadow-sm">
                        <div class="d-flex align-items-center mb-4">
                            <div class="service-logo-box">
                                <img src="{{asset('assets/public/images/tasheer-logo.png')}}" alt="Tasheer" class="img-fluid">
                            </div>
                            <div>
                                <h4 class="font-weight-bold mb-1 text-dark">Tasheer Appointment</h4>
                                <span class="badge badge-theme-dark">Visa Center</span>
                            </div>
                        </div>
                        <p class="card-description text-muted mb-4">
                            Biometric enrollment and document submission appointments for Saudi Visa Centers (Tasheer / VFS).
                        </p>
                        <a href="{{ route('tasheer.form')}}" class="btn btn-dark btn-block">Book Tasheer</a>
                    </div>
                </div> 
                
                 <!-- Soft Skills -->
                <div class="col-lg-6 mb-4 mx-auto">
                    <div class="service-card h-100 bg-white p-4 rounded shadow-sm">
                        <div class="d-flex align-items-center mb-4">
                            <div class="service-logo-box">
                                <img src="{{asset('assets/public/images/soft-skill-logo.png')}}" alt="Certificate" class="img-fluid">
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
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="bg-light-grey rounded text-center">
                        <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Consultancy" class="img-fluid rounded shadow-lg">
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
                            <p class="text-muted">No credit card? No problem. Pay via JazzCash, Easypaisa, or local Bank Transfer.</p>
                        </div>
                    </div>

                    <div class="media">
                        <div class="icon-circle bg-light-grey text-primary-dark mr-3 p-3 rounded-circle">
                            <i class="fas fa-headset fa-lg"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 font-weight-bold text-dark">Manual Verification</h5>
                            <p class="text-muted">Our experts check your documents before applying to avoid rejection errors.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-light-grey">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold text-dark">What Our Clients Say</h2>
                <div class="theme-divider"></div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-accent-red mb-3">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="text-muted mb-4">"I was struggling with the credit card payment on the official Wafid site. Gulf Medical Consultant helped me book it using Easypaisa. Very fast service!"</p>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary-dark text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">M</div>
                                <div>
                                    <h6 class="mb-0 font-weight-bold text-dark">Muhammad Ali</h6>
                                    <small class="text-muted">From Lahore</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-accent-red mb-3">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="text-muted mb-4">"Booked my Takamol test through them. They guided me about the center and requirements. Received my slip on WhatsApp instantly."</p>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-accent-green text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">R</div>
                                <div>
                                    <h6 class="mb-0 font-weight-bold text-dark">Rizwan Ahmed</h6>
                                    <small class="text-muted">From Karachi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-accent-red mb-3">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="text-muted mb-4">"Excellent support for Tasheer appointment. Finding a slot was hard but they managed it professionally."</p>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary-dark text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px;">U</div>
                                <div>
                                    <h6 class="mb-0 font-weight-bold text-dark">Usman Khan</h6>
                                    <small class="text-muted">From Islamabad</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary-dark text-white text-center">
        <div class="container">
            <h2 class="font-weight-bold mb-3">Ready to Start Your Journey?</h2>
            <p class="lead mb-4" style="opacity: 0.8">Don't let technical issues delay your visa. Let us handle the appointments for you.</p>
            <a href="{{ route('medicalExamination')}}" class="btn btn-outline-light btn-lg px-5">Book Appointment Now</a>
        </div>
    </section>
@endsection