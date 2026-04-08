@extends('layouts.public')

@section('title', $data['title'])
@section('meta_description', $data['meta_desc'])
@section('meta_keywords', $data['name'] . ' GAMCA medical Pakistan, WAFID ' . $data['name'] . ', ' . $data['name'] . ' medical appointment Pakistan, GAMCA slip ' . $data['name'] . ', WAFID token ' . $data['name'] . ', Gulf medical test Pakistan 2026')

@push('schema')
,{
    "@type": "FAQPage",
    "mainEntity": [
        @foreach($data['faqs'] as $i => $faq)
        {
            "@type": "Question",
            "name": "{{ $faq['q'] }}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{ $faq['a'] }}"
            }
        }{{ $i < count($data['faqs']) - 1 ? ',' : '' }}
        @endforeach
    ]
},
{
    "@type": "Service",
    "@id": "{{ url()->current() }}#service",
    "name": "{{ $data['name'] }} GAMCA Medical Appointment Booking",
    "description": "{{ $data['meta_desc'] }}",
    "provider": { "@id": "{{ url('/') }}#organization" },
    "areaServed": {
        "@type": "Country",
        "name": "Pakistan"
    },
    "serviceType": "Medical Appointment Booking"
}
@endpush

@push('head')
<style>
    /* ── Hero ── */
    .gcc-hero {
        position: relative;
        min-height: 420px;
        display: flex;
        align-items: center;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    .gcc-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15,25,35,.82) 0%, rgba(15,25,35,.55) 100%);
    }
    .gcc-hero-content { position: relative; z-index: 1; }
    .gcc-flag { font-size: 3.5rem; line-height: 1; }
    .gcc-hero h1 { font-size: 2.6rem; font-weight: 800; color: #fff; }
    .gcc-hero .hero-badge {
        display: inline-block;
        background: var(--accent-gold);
        color: #0f1923;
        font-size: .75rem;
        font-weight: 700;
        padding: 4px 14px;
        border-radius: 20px;
        letter-spacing: .5px;
        text-transform: uppercase;
    }
    .gcc-hero p { color: rgba(255,255,255,.85); font-size: 1.05rem; max-width: 640px; }
    .gcc-hero .hero-cities span {
        display: inline-block;
        background: rgba(255,255,255,.12);
        color: #fff;
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 20px;
        padding: 3px 12px;
        font-size: .8rem;
        margin: 3px 2px;
    }
    @media(max-width:767px) {
        .gcc-hero { min-height: 320px; background-attachment: scroll; }
        .gcc-hero h1 { font-size: 1.8rem; }
    }

    /* ── Breadcrumb ── */
    .gcc-breadcrumb {
        background: #f7f8fc;
        border-bottom: 1px solid #e8ecf0;
        padding: 10px 0;
        font-size: .85rem;
    }
    .gcc-breadcrumb a { color: var(--primary-slate); }
    .gcc-breadcrumb .active { color: var(--text-muted); }

    /* ── Intro ── */
    .gcc-intro-section { background: #fff; }
    .gcc-intro-section .intro-icon-box {
        width: 64px; height: 64px;
        background: #fdf2f1;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        flex-shrink: 0;
    }

    /* ── Stats strip ── */
    .gcc-stats-strip {
        background: linear-gradient(90deg, #0f1923 0%, #1a252f 100%);
        padding: 28px 0;
    }
    .gcc-stat-item { text-align: center; }
    .gcc-stat-num { font-size: 2rem; font-weight: 800; color: var(--accent-gold); line-height: 1; }
    .gcc-stat-label { color: rgba(255,255,255,.75); font-size: .82rem; margin-top: 4px; }

    /* ── Services cards ── */
    .gcc-service-card {
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 28px 24px;
        height: 100%;
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }
    .gcc-service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,.08);
        border-color: var(--accent-gold);
    }
    .gcc-service-icon {
        width: 56px; height: 56px;
        background: #fdf2f1;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: var(--accent-gold);
        font-size: 1.4rem;
        margin-bottom: 16px;
    }
    .gcc-service-card h4 { font-size: 1rem; font-weight: 700; color: #1a252f; }
    .gcc-service-card p { font-size: .875rem; color: #6c757d; margin: 0; }

    /* ── Process steps ── */
    .gcc-step-num {
        width: 48px; height: 48px;
        background: var(--accent-gold);
        color: #0f1923;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        font-weight: 800;
        flex-shrink: 0;
    }

    /* ── Medical centers table ── */
    .gcc-centers-table th { background: #1a252f; color: #fff; font-size: .82rem; }
    .gcc-centers-table td { font-size: .85rem; vertical-align: middle; }
    .gcc-centers-table tbody tr:hover { background: #f7f8fc; }

    /* ── Visa types & jobs ── */
    .gcc-tag {
        display: inline-block;
        background: #f0f4f8;
        color: #1a252f;
        border: 1px solid #dde3ea;
        border-radius: 20px;
        padding: 5px 14px;
        font-size: .82rem;
        margin: 4px 3px;
        font-weight: 500;
    }

    /* ── FAQ ── */
    .gcc-faq .card { border: 1px solid #e8ecf0; border-radius: 10px; margin-bottom: 10px; overflow: hidden; }
    .gcc-faq .card-header {
        background: #fff;
        border: none;
        padding: 0;
    }
    .gcc-faq .faq-btn {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        padding: 16px 20px;
        font-weight: 600;
        font-size: .92rem;
        color: #1a252f;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }
    .gcc-faq .faq-btn .faq-icon { transition: transform .3s; color: var(--accent-gold); }
    .gcc-faq .faq-btn[aria-expanded="true"] .faq-icon { transform: rotate(180deg); }
    .gcc-faq .card-body { padding: 0 20px 16px; color: #6c757d; font-size: .9rem; }

    /* ── Other countries ── */
    .other-country-card {
        display: flex;
        align-items: center;
        gap: 14px;
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 12px;
        padding: 16px 20px;
        text-decoration: none;
        color: #1a252f;
        transition: all .25s ease;
        height: 100%;
    }
    .other-country-card:hover {
        border-color: var(--accent-gold);
        box-shadow: 0 8px 24px rgba(0,0,0,.07);
        text-decoration: none;
        color: #1a252f;
        transform: translateY(-3px);
    }
    .other-country-flag { font-size: 2.2rem; line-height: 1; }
    .other-country-name { font-weight: 700; font-size: .95rem; }
    .other-country-cities { font-size: .78rem; color: #6c757d; }

    /* ── CTA Banner ── */
    .gcc-cta-banner {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        border-radius: 16px;
        padding: 48px 40px;
    }
    @media(max-width:767px) { .gcc-cta-banner { padding: 32px 20px; } }
</style>
@endpush

@section('content')

{{-- ── HERO ── --}}
<section class="gcc-hero" style="background-image: url('{{ $data['hero_image'] }}');">
    <div class="container gcc-hero-content py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="gcc-flag mb-3 d-block">{{ $data['flag'] }}</span>
                <span class="hero-badge mb-3">GCC Medical Guide</span>
                <h1 class="mt-2 mb-3">{{ $data['page_heading'] ?? 'GAMCA Medical Appointment for ' . $data['name'] }}</h1>
                <p class="mb-4">{{ $data['intro'] }}</p>
                <div class="hero-cities mb-4">
                    @foreach($data['cities'] as $city)
                        <span><i class="fas fa-map-marker-alt mr-1" style="color:var(--accent-gold)"></i>{{ $city }}</span>
                    @endforeach
                </div>
                <div class="d-flex flex-wrap" style="gap:12px;">
                    <a href="{{ route('medicalExamination') }}" class="btn btn-warning font-weight-bold px-4 py-2" style="color:#0f1923;">
                        <i class="fas fa-calendar-check mr-2"></i>Book GAMCA Appointment
                    </a>
                    <a href="{{ route('ViewMedicalCenters') }}" class="btn btn-outline-light px-4 py-2">
                        <i class="fas fa-hospital mr-2"></i>Find Medical Centers
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── BREADCRUMB ── --}}
<nav class="gcc-breadcrumb" aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0 bg-transparent p-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><span class="text-muted">GCC Countries</span></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['name'] }}</li>
        </ol>
    </div>
</nav>

{{-- ── STATS STRIP ── --}}
<div class="gcc-stats-strip">
    <div class="container">
        <div class="row">
            <div class="col-4 gcc-stat-item">
                <div class="gcc-stat-num">10K+</div>
                <div class="gcc-stat-label">Appointments Booked</div>
            </div>
            <div class="col-4 gcc-stat-item">
                <div class="gcc-stat-num">99%</div>
                <div class="gcc-stat-label">Success Rate</div>
            </div>
            <div class="col-4 gcc-stat-item">
                <div class="gcc-stat-num">24/7</div>
                <div class="gcc-stat-label">WhatsApp Support</div>
            </div>
        </div>
    </div>
</div>

{{-- ── WHAT IS GAMCA ── --}}
<section class="gcc-intro-section py-5">    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h6 class="text-uppercase font-weight-bold" style="color:var(--accent-gold);letter-spacing:1px;">About GAMCA for {{ $data['name'] }}</h6>
                <h2 class="font-weight-bold text-dark mb-3">What is {{ $data['name'] }} GAMCA (Wafid) Medical Test?</h2>
                <p class="text-muted">GAMCA stands for <strong>Gulf Approved Medical Centers Association</strong>. It is the official body that manages medical fitness testing for workers traveling to GCC countries including {{ $data['name'] }}. The test is mandatory for all employment and residency visa applicants.</p>
                <p class="text-muted">The medical examination checks for infectious diseases such as tuberculosis, hepatitis, HIV, and other conditions that could affect public health in {{ $data['name'] }}. A clean medical report is required before your visa can be processed.</p>
                <p class="text-muted mb-4">At Gulf Medical Consultants, we simplify the entire GAMCA booking process. You fill out our form online, we assign you to the nearest authorized center, and you receive your appointment slip on WhatsApp — ready to print and use.</p>
                <div class="d-flex align-items-start mb-3">
                    <div class="intro-icon-box mr-3"><i class="fas fa-check-circle" style="color:var(--accent-gold)"></i></div>
                    <div>
                        <strong>Authorized GAMCA Centers</strong>
                        <p class="text-muted mb-0 small">We only work with officially approved GAMCA medical centers across Pakistan.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <div class="intro-icon-box mr-3"><i class="fas fa-bolt" style="color:var(--accent-gold)"></i></div>
                    <div>
                        <strong>Fast Processing</strong>
                        <p class="text-muted mb-0 small">Your appointment slip is delivered to WhatsApp within hours of booking.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="intro-icon-box mr-3"><i class="fas fa-shield-alt" style="color:var(--accent-gold)"></i></div>
                    <div>
                        <strong>Secure & Reliable</strong>
                        <p class="text-muted mb-0 small">Your data is handled with full confidentiality and care.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="gcc-service-card">
                            <div class="gcc-service-icon"><i class="fas fa-file-medical"></i></div>
                            <h4>Standard GAMCA</h4>
                            <p>Auto-assigned nearest authorized center in your city.</p>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="gcc-service-card">
                            <div class="gcc-service-icon"><i class="fas fa-hospital"></i></div>
                            <h4>Wafid Choice</h4>
                            <p>Select your preferred GAMCA-approved medical center.</p>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="gcc-service-card">
                            <div class="gcc-service-icon"><i class="fas fa-tools"></i></div>
                            <h4>NAVTTC Test</h4>
                            <p>Skill verification for Saudi Arabia employment visa.</p>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="gcc-service-card">
                            <div class="gcc-service-icon"><i class="fas fa-passport"></i></div>
                            <h4>Tasheer Visa</h4>
                            <p>Saudi visa biometric appointment booking service.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── VISA TYPES & JOBS ── --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="font-weight-bold text-dark mb-3">
                    <i class="fas fa-id-card mr-2" style="color:var(--accent-gold)"></i>Visa Types Covered
                </h3>
                <p class="text-muted mb-3">GAMCA medical is required for the following {{ $data['name'] }} visa categories:</p>
                <div>
                    @foreach($data['visa_types'] as $visa)
                        <span class="gcc-tag"><i class="fas fa-check mr-1" style="color:var(--accent-gold)"></i>{{ $visa }}</span>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="font-weight-bold text-dark mb-3">
                    <i class="fas fa-briefcase mr-2" style="color:var(--accent-gold)"></i>Common Job Categories
                </h3>
                <p class="text-muted mb-3">Workers in these occupations commonly travel to {{ $data['name'] }}:</p>
                <div>
                    @foreach($data['jobs'] as $job)
                        <span class="gcc-tag">{{ $job }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── HOW IT WORKS ── --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-uppercase font-weight-bold" style="color:var(--accent-gold);letter-spacing:1px;">Simple Process</h6>
            <h2 class="font-weight-bold text-dark">{{ $data['name'] }} GAMCA Medical Process – Step by Step</h2>
            <div class="theme-divider"></div>
        </div>

        @if(!empty($data['process_steps']))
        {{-- Rich step-by-step process (Saudi Arabia) --}}
        <div class="row">
            @foreach($data['process_steps'] as $i => $step)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="gcc-service-card d-flex align-items-start" style="gap:16px;">
                    <div class="gcc-step-num flex-shrink-0">{{ $i + 1 }}</div>
                    <div>
                        <h5 class="font-weight-bold text-dark mb-1" style="font-size:.95rem;">{{ $step['title'] }}</h5>
                        <p class="text-muted small mb-0">{{ $step['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if(!empty($data['documents']))
        <div class="row mt-4">
            <div class="col-lg-6 mb-4">
                <div class="gcc-service-card">
                    <h4 class="font-weight-bold text-dark mb-3">
                        <i class="fas fa-folder-open mr-2" style="color:var(--accent-gold)"></i>Documents Required
                    </h4>
                    <ul class="list-unstyled mb-0">
                        @foreach($data['documents'] as $doc)
                        <li class="d-flex align-items-start mb-2">
                            <i class="fas fa-check-circle mt-1 mr-2 flex-shrink-0" style="color:var(--accent-gold)"></i>
                            <span class="text-muted small">{{ $doc }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @if(!empty($data['tests']))
            <div class="col-lg-6 mb-4">
                <div class="gcc-service-card">
                    <h4 class="font-weight-bold text-dark mb-3">
                        <i class="fas fa-vials mr-2" style="color:var(--accent-gold)"></i>Medical Tests Included
                    </h4>
                    @foreach($data['tests'] as $category => $tests)
                    <p class="font-weight-bold text-dark mb-1 small text-uppercase" style="letter-spacing:.5px;">{{ $category }}</p>
                    <ul class="list-unstyled mb-3">
                        @foreach($tests as $test)
                        <li class="d-flex align-items-start mb-1">
                            <i class="fas fa-circle mr-2 flex-shrink-0" style="color:var(--accent-gold);font-size:.4rem;margin-top:6px;"></i>
                            <span class="text-muted small">{{ $test }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

        @else
        {{-- Generic 4-step process for other countries --}}
        <div class="row">
            @php
            $steps = [
                ['title'=>'Fill Online Form','desc'=>'Enter your passport details and personal information in our secure online form. Takes less than 5 minutes.'],
                ['title'=>'Pay the Fee','desc'=>'Pay securely via JazzCash, Easypaisa, or bank transfer. Your booking is confirmed instantly after payment.'],
                ['title'=>'Receive Slip on WhatsApp','desc'=>'Your official GAMCA appointment slip is sent as a PDF to your WhatsApp. Print it and visit the assigned center.'],
                ['title'=>'Attend Medical Test','desc'=>'Visit the assigned GAMCA-approved center on your appointment date with your passport and slip.'],
            ];
            @endphp
            @foreach($steps as $i => $step)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="d-flex align-items-start">
                    <div class="gcc-step-num mr-3 mt-1">{{ $i + 1 }}</div>
                    <div>
                        <h5 class="font-weight-bold text-dark mb-1">{{ $step['title'] }}</h5>
                        <p class="text-muted small mb-0">{{ $step['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('medicalExamination') }}" class="btn btn-dark px-5 py-3 font-weight-bold">
                <i class="fas fa-calendar-check mr-2"></i>Book Your GAMCA Appointment Now
            </a>
        </div>
    </div>
</section>

{{-- ── FEES & COMMON MISTAKES (Saudi-specific) ── --}}
@if(!empty($data['fees']))
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="font-weight-bold text-dark mb-1">
                    <i class="fas fa-receipt mr-2" style="color:var(--accent-gold)"></i>{{ $data['name'] }} GAMCA Medical Fees (2026)
                </h3>
                <p class="text-muted small mb-3">Latest updated fee breakdown for Pakistani applicants.</p>
                <div class="table-responsive">
                    <table class="table table-bordered mb-2" style="font-size:.9rem;">
                        <thead>
                            <tr style="background:#1a252f;color:#fff;">
                                <th>Fee Type</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['fees'] as $fee)
                            <tr @if(!empty($fee['highlight'])) style="background:#fff8e1;font-weight:700;" @endif>
                                <td>{{ $fee['label'] }}</td>
                                <td class="text-right">{{ $fee['amount'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(!empty($data['fee_note']))
                <p class="text-muted small"><i class="fas fa-info-circle mr-1" style="color:var(--accent-gold)"></i>{{ $data['fee_note'] }}</p>
                @endif
            </div>
            @if(!empty($data['common_mistakes']))
            <div class="col-lg-6">
                <h3 class="font-weight-bold text-dark mb-1">
                    <i class="fas fa-exclamation-triangle mr-2" style="color:#e74c3c"></i>Common Mistakes to Avoid
                </h3>
                <p class="text-muted small mb-3">Avoid these issues to ensure a smooth GAMCA process.</p>
                <ul class="list-unstyled mb-0">
                    @foreach($data['common_mistakes'] as $mistake)
                    <li class="d-flex align-items-start mb-3">
                        <span class="flex-shrink-0 mr-3" style="width:22px;height:22px;background:#fdecea;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-times" style="color:#e74c3c;font-size:.65rem;"></i>
                        </span>
                        <span class="text-muted small">{{ $mistake }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- ── WHY CHOOSE US ── --}}
@if(!empty($data['why_us']))
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h6 class="text-uppercase font-weight-bold" style="color:var(--accent-gold);letter-spacing:1px;">Why Us</h6>
                <h2 class="font-weight-bold text-dark mb-3">Why Choose Us for {{ $data['name'] }} GAMCA Booking?</h2>
                <p class="text-muted mb-4">Thousands of Pakistani workers trust us every month for their {{ $data['name'] }} GAMCA medical appointment. Here's why:</p>
                <a href="{{ route('medicalExamination') }}" class="btn btn-dark px-4 py-2 font-weight-bold">
                    <i class="fas fa-calendar-check mr-2"></i>Book Now
                </a>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    @foreach($data['why_us'] as $point)
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-start">
                            <span class="flex-shrink-0 mr-3" style="width:32px;height:32px;background:#e8f5e9;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-check" style="color:#27ae60;font-size:.75rem;"></i>
                            </span>
                            <span class="text-muted small" style="padding-top:6px;">{{ $point }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ── MEDICAL CENTERS TABLE ── --}}
@if($centers->count() > 0)
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="text-center mb-4">
            <h6 class="text-uppercase font-weight-bold" style="color:var(--accent-gold);letter-spacing:1px;">Authorized Centers</h6>
            <h2 class="font-weight-bold text-dark">{{ $data['name'] }} GAMCA Medical Centers in Pakistan</h2>
            <p class="text-muted">These are the authorized GAMCA-approved medical centers in Pakistan that process {{ $data['name'] }} visa medical tests.</p>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered gcc-centers-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Medical Center</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($centers as $i => $center)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="font-weight-bold">{{ $center->medical_center }}</td>
                        <td>{{ $center->city }}</td>
                        <td>{{ $center->address_line_1 }}{{ $center->address_line_2 ? ', '.$center->address_line_2 : '' }}</td>
                        <td>{{ $center->phone ?? '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('ViewMedicalCenters') }}" class="btn btn-outline-dark px-4 py-2">
                <i class="fas fa-search mr-2"></i>Search All Medical Centers
            </a>
        </div>
    </div>
</section>
@endif

{{-- ── MID-PAGE WHATSAPP CTA ── --}}
<section class="py-4" style="background:var(--accent-gold);">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:16px;">
            <div>
                <p class="font-weight-bold mb-0" style="color:#0f1923;font-size:1.05rem;">
                    <i class="fab fa-whatsapp mr-2" style="font-size:1.3rem;"></i>
                    Book Your {{ $data['name'] }} GAMCA Medical on WhatsApp – Instant Response
                </p>
                <p class="mb-0 small" style="color:#1a252f;">Fast booking · WhatsApp slip delivery · 99% success rate · Trusted by 10,000+ workers</p>
            </div>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+want+to+book+{{ urlencode($data['name']) }}+GAMCA+medical+appointment."
               target="_blank"
               class="btn font-weight-bold px-4 py-2 flex-shrink-0"
               style="background:#0f1923;color:#fff;border-radius:8px;white-space:nowrap;">
                <i class="fab fa-whatsapp mr-2"></i>Book Now on WhatsApp
            </a>
        </div>
    </div>
</section>

{{-- ── FAQ ── --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h6 class="text-uppercase font-weight-bold" style="color:var(--accent-gold);letter-spacing:1px;">FAQ</h6>
                    <h2 class="font-weight-bold text-dark">{{ $data['name'] }} GAMCA Medical – Frequently Asked Questions</h2>
                    <p class="text-muted">Common questions about GAMCA medical appointments for {{ $data['name'] }}.</p>
                </div>
                <div class="gcc-faq" id="gccFaqAccordion">
                    @foreach($data['faqs'] as $i => $faq)
                    <div class="card">
                        <div class="card-header" id="faqHead{{ $i }}">
                            <button class="faq-btn {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                                data-toggle="collapse" data-target="#faqBody{{ $i }}"
                                aria-expanded="{{ $i === 0 ? 'true' : 'false' }}"
                                aria-controls="faqBody{{ $i }}">
                                {{ $faq['q'] }}
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                        </div>
                        <div id="faqBody{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}"
                            aria-labelledby="faqHead{{ $i }}" data-parent="#gccFaqAccordion">
                            <div class="card-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── RELATED BLOGS ── --}}
@if($relatedBlogs->count() > 0)
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-uppercase font-weight-bold" style="color:var(--accent-gold);letter-spacing:1px;">Our Blog</h6>
            <h2 class="font-weight-bold text-dark">Latest News & Updates</h2>
            <div class="theme-divider"></div>
            <p class="text-muted">Stay informed with the latest updates on GAMCA, WAFID, and Gulf visa processes.</p>
        </div>
        <div class="row">
            @foreach($relatedBlogs as $blog)
            <div class="col-lg-4 col-md-6 mb-4">
                <article class="blog-home-card h-100">
                    <a href="{{ route('public.blogs.details', $blog->slug) }}" class="blog-home-img-link">
                        @if($blog->image)
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" loading="lazy" width="400" height="220">
                        @else
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=400&q=70" alt="{{ $blog->title }}" loading="lazy" width="400" height="220">
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
                            <a href="{{ route('public.blogs.details', $blog->slug) }}" class="blog-home-read-more">
                                Read More <i class="fas fa-arrow-right"></i>
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

{{-- ── OTHER COUNTRIES (Internal Linking) ── --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="text-center mb-4">
            <h6 class="text-uppercase font-weight-bold" style="color:var(--accent-gold);letter-spacing:1px;">Also Check</h6>
            <h2 class="font-weight-bold text-dark">Other GCC Country GAMCA Medical Guides</h2>
            <p class="text-muted">We cover GAMCA and WAFID medical booking for all GCC countries. Explore our complete guides:</p>
        </div>
        <div class="row">
            @foreach($otherCountries as $slug => $country)
            <div class="col-lg-4 col-md-6 mb-3">
                <a href="{{ route('public.gcc.country', $slug) }}" class="other-country-card">
                    <span class="other-country-flag">{{ $country['flag'] }}</span>
                    <div>
                        <div class="other-country-name">{{ $country['name'] }} GAMCA Medical Guide</div>
                        <div class="other-country-cities">
                            <i class="fas fa-map-marker-alt mr-1" style="color:var(--accent-gold)"></i>
                            {{ implode(', ', array_slice($country['cities'], 0, 2)) }}
                        </div>
                    </div>
                    <i class="fas fa-arrow-right ml-auto" style="color:var(--accent-gold)"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── URGENT BOOKING (Qatar-specific) ── --}}
@if(!empty($data['urgent_booking']))
<section class="py-5" style="background: linear-gradient(135deg,#1a0a10 0%,#2d1020 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <span class="hero-badge mb-3 d-inline-block">⚡ Urgent Service Available</span>
                <h2 class="font-weight-bold text-white mt-2 mb-3">Book {{ $data['name'] }} WAFID Medical Token Online – Fast & Verified</h2>
                <p style="color:rgba(255,255,255,.8);" class="mb-3">Need an urgent {{ $data['name'] }} WAFID token? We help you book your GAMCA (WAFID) appointment within minutes — with instant WhatsApp delivery and guaranteed accuracy.</p>
                <p style="color:rgba(255,255,255,.8);" class="mb-4">Avoid delays, rejection, or wrong clinic assignment. Our team ensures your {{ $data['name'] }} medical booking is 100% correct and accepted by GCC authorities.</p>
                <div class="row mb-4">
                    @php $urgentPoints = [
                        ['icon'=>'fas fa-bolt','text'=>'Instant Booking – GAMCA slip within minutes'],
                        ['icon'=>'fas fa-map-marker-alt','text'=>'Correct Sponsor City Matching (Doha / Al Khor)'],
                        ['icon'=>'fas fa-whatsapp','text'=>'WhatsApp PDF Delivery – Ready to print'],
                        ['icon'=>'fas fa-calendar-check','text'=>'Same-Day Slots Available'],
                        ['icon'=>'fas fa-shield-alt','text'=>'Error-Free Processing – No rejection risk'],
                        ['icon'=>'fas fa-headset','text'=>'24/7 Support on WhatsApp'],
                    ]; @endphp
                    @foreach($urgentPoints as $pt)
                    <div class="col-md-6 mb-2">
                        <div class="d-flex align-items-center">
                            <i class="{{ $pt['icon'] }} mr-2" style="color:var(--accent-gold);width:16px;"></i>
                            <span class="small" style="color:rgba(255,255,255,.85);">{{ $pt['text'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('medicalExamination') }}" class="btn btn-warning font-weight-bold px-4 py-2 mr-2" style="color:#0f1923;">
                        <i class="fas fa-calendar-check mr-2"></i>Get Your {{ $data['name'] }} WAFID Token Now
                    </a>
            </div>
            <div class="col-lg-5">
                <div style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:16px;padding:28px 24px;">
                    <h5 class="font-weight-bold text-white mb-4 text-center">
                        <i class="fas fa-mobile-alt mr-2" style="color:var(--accent-gold)"></i>Get Your GAMCA Slip in 3 Easy Steps
                    </h5>
                    @php $easySteps = [
                        ['num'=>'1','title'=>'Send Your Details','desc'=>'Share your passport and visa details via WhatsApp or our online form.'],
                        ['num'=>'2','title'=>'Confirm Payment','desc'=>'Pay via JazzCash, Easypaisa, or bank transfer. Instant confirmation.'],
                        ['num'=>'3','title'=>'Receive Your Slip','desc'=>'Get your ' . $data['name'] . ' WAFID QR slip PDF instantly on WhatsApp.'],
                    ]; @endphp
                    @foreach($easySteps as $es)
                    <div class="d-flex align-items-start mb-3">
                        <div class="gcc-step-num mr-3 flex-shrink-0" style="background:var(--accent-gold);color:#0f1923;width:36px;height:36px;font-size:1rem;">{{ $es['num'] }}</div>
                        <div>
                            <p class="font-weight-bold text-white mb-0 small">{{ $es['title'] }}</p>
                            <p class="small mb-0" style="color:rgba(255,255,255,.65);">{{ $es['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                    <div class="mt-4 p-3 text-center" style="background:rgba(255,198,84,.1);border:1px solid rgba(255,198,84,.3);border-radius:10px;">
                        <p class="mb-1 small font-weight-bold" style="color:var(--accent-gold);">🔥 Limited Slots Available</p>
                        <p class="mb-0 small" style="color:rgba(255,255,255,.7);">{{ $data['name'] }} GAMCA slots fill quickly. Delays can cause missed job deadlines and rebooking issues.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ── CTA BANNER ── --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="gcc-cta-banner text-center">
            <h2 class="font-weight-bold text-white mb-3">
                @if(!empty($data['urgent_booking']))
                    Book Your Qatar WAFID Medical Token Today
                @else
                    Ready to Book Your GAMCA Medical for {{ $data['name'] }}?
                @endif
            </h2>
            <p class="mb-4" style="color:rgba(255,255,255,.8);max-width:560px;margin:0 auto 24px;">
                @if(!empty($data['urgent_booking']))
                    Get your {{ $data['name'] }} GAMCA medical token quickly and avoid delays in your visa process. Fast confirmation, correct clinic assignment, and complete WhatsApp support.
                @else
                    Get your official GAMCA appointment slip delivered to WhatsApp within hours. Fast, secure, and hassle-free.
                @endif
            </p>
            <div class="d-flex flex-wrap justify-content-center" style="gap:12px;">
                <a href="{{ route('medicalExamination') }}" class="btn btn-warning font-weight-bold px-5 py-3" style="color:#0f1923;">
                    <i class="fas fa-calendar-check mr-2"></i>
                    @if(!empty($data['urgent_booking'])) Book {{ $data['name'] }} WAFID Token Now @else Book Standard GAMCA @endif
                </a>
                <a href="{{ route('special.appointment') }}" class="btn btn-outline-light px-5 py-3">
                    <i class="fas fa-hospital mr-2"></i>Choose Your Center
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
