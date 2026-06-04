@extends('layouts.public')

@section('title', 'Terms & Conditions | Gulf Medical Consultants – GAMCA WAFID Booking')
@section('meta_description', 'Read the Terms & Conditions of Gulf Medical Consultants. Understand your rights and responsibilities when booking GAMCA/WAFID medical appointments in Pakistan.')
@section('meta_keywords', 'terms and conditions, Gulf Medical Consultants, GAMCA booking terms, WAFID appointment terms, GCC medical service Pakistan')

@push('head')
<style>
    .tc-hero {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        padding: 64px 0 48px;
    }
    .tc-hero h1 { color: #fff; font-size: 2.2rem; font-weight: 800; }
    .tc-hero p  { color: rgba(255,255,255,.75); font-size: 1rem; }
    .tc-badge {
        display: inline-block;
        background: var(--accent-gold);
        color: #0f1923;
        font-size: .72rem;
        font-weight: 700;
        padding: 4px 14px;
        border-radius: 20px;
        letter-spacing: .5px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }
    .tc-breadcrumb {
        background: #f7f8fc;
        border-bottom: 1px solid #e8ecf0;
        padding: 10px 0;
        font-size: .85rem;
    }
    .tc-breadcrumb a { color: var(--primary-slate); }

    /* Sidebar TOC */
    .tc-toc {
        position: sticky;
        top: 80px;
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 24px 20px;
    }
    .tc-toc h6 {
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        margin-bottom: 14px;
    }
    .tc-toc a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 7px 10px;
        border-radius: 8px;
        font-size: .82rem;
        color: #1a252f;
        text-decoration: none;
        transition: background .2s, color .2s;
        margin-bottom: 2px;
    }
    .tc-toc a:hover, .tc-toc a.active {
        background: #fff8e1;
        color: #0f1923;
        font-weight: 600;
    }
    .tc-toc a .toc-num {
        width: 22px; height: 22px;
        background: var(--accent-gold);
        color: #0f1923;
        border-radius: 50%;
        font-size: .68rem;
        font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    /* Content */
    .tc-content { font-size: .95rem; color: #3a4a5a; line-height: 1.8; }
    .tc-section {
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 32px 28px;
        margin-bottom: 20px;
        scroll-margin-top: 90px;
        transition: box-shadow .25s;
    }
    .tc-section:hover { box-shadow: 0 8px 28px rgba(0,0,0,.06); }
    .tc-section-num {
        width: 40px; height: 40px;
        background: var(--accent-gold);
        color: #0f1923;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .tc-section h2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1a252f;
        margin: 0;
    }
    .tc-section ul {
        padding-left: 0;
        list-style: none;
        margin: 0;
    }
    .tc-section ul li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 6px 0;
        border-bottom: 1px solid #f0f4f8;
        font-size: .9rem;
    }
    .tc-section ul li:last-child { border-bottom: none; }
    .tc-section ul li i { color: var(--accent-gold); margin-top: 3px; flex-shrink: 0; }
    .tc-section p { margin-bottom: .6rem; }
    .tc-section p:last-child { margin-bottom: 0; }

    /* Warning / notice boxes */
    .tc-notice {
        border-radius: 10px;
        padding: 12px 16px;
        font-size: .88rem;
        margin-top: 14px;
    }
    .tc-notice-warn  { background: #fff8e1; border-left: 4px solid var(--accent-gold); color: #5a4000; }
    .tc-notice-info  { background: #e8f5e9; border-left: 4px solid #27ae60; color: #1b5e20; }
    .tc-notice-alert { background: #fdecea; border-left: 4px solid #e74c3c; color: #7b1a1a; }

    /* Contact card */
    .tc-contact-card {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        border-radius: 14px;
        padding: 28px 24px;
        color: #fff;
    }
    .tc-contact-card a { color: var(--accent-gold); text-decoration: none; }
    .tc-contact-card a:hover { text-decoration: underline; }

    @media(max-width:991px) {
        .tc-toc { position: static; margin-bottom: 24px; }
        .tc-hero h1 { font-size: 1.7rem; }
    }
    @media(max-width:767px) {
        .tc-section { padding: 22px 16px; }
    }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="tc-hero">
    <div class="container">
        <span class="tc-badge">Legal</span>
        <h1>Terms &amp; Conditions</h1>
        <p class="mb-0">
            Effective Date: January 1, 2026 &nbsp;·&nbsp;
            <span>{{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}</span>
        </p>
    </div>
</section>

{{-- Breadcrumb --}}
<nav class="tc-breadcrumb" aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0 bg-transparent p-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Terms &amp; Conditions</li>
        </ol>
    </div>
</nav>

{{-- Body --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row">

            {{-- Sidebar TOC --}}
            <div class="col-lg-3 mb-4 mb-lg-0">
                <nav class="tc-toc" aria-label="Table of contents">
                    <h6>Contents</h6>
                    @php $toc = [
                        'tc-1'  => 'Nature of Service',
                        'tc-2'  => 'User Responsibilities',
                        'tc-3'  => 'Booking & Confirmation',
                        'tc-4'  => 'Fees & Payments',
                        'tc-5'  => 'Third-Party Services',
                        'tc-6'  => 'Appointment Changes',
                        'tc-7'  => 'Limitation of Liability',
                        'tc-8'  => 'Cancellation Policy',
                        'tc-9'  => 'Intellectual Property',
                        'tc-10' => 'Changes to Terms',
                        'tc-11' => 'Contact Information',
                    ]; @endphp
                    @foreach($toc as $id => $label)
                    @php $num = ltrim($id, 'tc-'); @endphp
                    <a href="#{{ $id }}">
                        <span class="toc-num">{{ $num }}</span>
                        {{ $label }}
                    </a>
                    @endforeach
                </nav>

                {{-- Quick agreement box --}}
                <div class="mt-3 p-3 text-center" style="background:#fff;border:1px solid #e8ecf0;border-radius:12px;">
                    <p class="small text-muted mb-2">By using our services you agree to these terms.</p>
                    <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-block btn-sm font-weight-bold">
                        <i class="fas fa-calendar-check mr-1"></i> Book Appointment
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-dark btn-block btn-sm mt-2">
                        <i class="fas fa-question-circle mr-1"></i> Have a Question?
                    </a>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-lg-9 tc-content">

                {{-- Intro --}}
                <div class="tc-section mb-4" style="background:linear-gradient(135deg,#fff8e1 0%,#fff 100%);border-color:#ffe082;">
                    <p class="mb-0">
                        Welcome to <strong>{{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}</strong>.
                        By using our <strong>GAMCA/WAFID medical appointment booking services</strong>, you agree to the
                        following Terms &amp; Conditions. Please read them carefully before using our services.
                    </p>
                </div>

                {{-- 1 --}}
                <div class="tc-section" id="tc-1">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">1</div>
                        <h2>Nature of Service <small class="text-muted font-weight-normal" style="font-size:.75rem;">(خدمات کی نوعیت)</small></h2>
                    </div>
                    <ul>
                        <li><i class="fas fa-concierge-bell fa-sm"></i> We provide appointment booking and coordination services for GAMCA/WAFID medical tests and related visa processes.</li>
                        <li><i class="fas fa-info-circle fa-sm"></i> We are not a government entity and are not directly affiliated with any embassy, GAMCA authority, or medical center.</li>
                    </ul>
                    <div class="tc-notice tc-notice-warn">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        We are a private consultancy service. We charge a service fee to assist users in booking appointments and processing paperwork.
                    </div>
                </div>

                {{-- 2 --}}
                <div class="tc-section" id="tc-2">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">2</div>
                        <h2>User Responsibilities</h2>
                    </div>
                    <p>By using our service, you agree to:</p>
                    <ul>
                        <li><i class="fas fa-check-circle fa-sm"></i> Provide accurate and complete personal information</li>
                        <li><i class="fas fa-passport fa-sm"></i> Ensure passport details match official records</li>
                        <li><i class="fas fa-clipboard-list fa-sm"></i> Follow appointment instructions provided</li>
                        <li><i class="fas fa-clock fa-sm"></i> Arrive at the medical center on time</li>
                    </ul>
                    <div class="tc-notice tc-notice-alert">
                        <i class="fas fa-times-circle mr-2"></i>
                        We are not responsible for issues caused by incorrect information provided by the user.
                    </div>
                </div>

                {{-- 3 --}}
                <div class="tc-section" id="tc-3">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">3</div>
                        <h2>Booking &amp; Confirmation</h2>
                    </div>
                    <ul>
                        <li><i class="fas fa-lock fa-sm"></i> Appointment booking is confirmed only after payment</li>
                        <li><i class="fab fa-whatsapp fa-sm"></i> Appointment slips are delivered via WhatsApp or email</li>
                        <li><i class="fas fa-hourglass-half fa-sm"></i> Processing time may vary depending on system availability</li>
                    </ul>
                    <div class="tc-notice tc-notice-info">
                        <i class="fas fa-check-circle mr-2"></i>
                        Once confirmed, your GAMCA/WAFID slip will be sent as a PDF to your WhatsApp — ready to print and use.
                    </div>
                </div>

                {{-- 4 --}}
                <div class="tc-section" id="tc-4">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">4</div>
                        <h2>Fees &amp; Payments</h2>
                    </div>
                    <ul>
                        <li><i class="fas fa-money-bill-wave fa-sm"></i> All service fees must be paid in advance</li>
                        <li><i class="fas fa-receipt fa-sm"></i> Fees include processing and coordination charges</li>
                        <li><i class="fas fa-hospital fa-sm"></i> Additional charges (if any) by medical centers are separate</li>
                        <li><i class="fas fa-sync-alt fa-sm"></i> We reserve the right to update pricing at any time without prior notice</li>
                    </ul>
                    <div class="tc-notice tc-notice-warn">
                        <i class="fas fa-info-circle mr-2"></i>
                        Accepted payment methods: JazzCash, Easypaisa, and bank transfer.
                    </div>
                </div>

                {{-- 5 --}}
                <div class="tc-section" id="tc-5">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">5</div>
                        <h2>Third-Party Services</h2>
                    </div>
                    <p>Our services involve coordination with:</p>
                    <ul>
                        <li><i class="fas fa-file-medical fa-sm"></i> GAMCA / WAFID systems</li>
                        <li><i class="fas fa-clinic-medical fa-sm"></i> Approved medical centers</li>
                        <li><i class="fas fa-credit-card fa-sm"></i> Payment providers</li>
                    </ul>
                    <div class="tc-notice tc-notice-alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        We are not responsible for delays, errors, or decisions made by these third parties.
                    </div>
                </div>

                {{-- 6 --}}
                <div class="tc-section" id="tc-6">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">6</div>
                        <h2>Appointment Changes &amp; Delays</h2>
                    </div>
                    <ul>
                        <li><i class="fas fa-calendar-alt fa-sm"></i> Appointment dates depend on system availability</li>
                        <li><i class="fas fa-redo fa-sm"></i> Rescheduling may be possible before the cutoff time</li>
                        <li><i class="fas fa-calendar-times fa-sm"></i> Missed appointments may require a new booking</li>
                    </ul>
                </div>

                {{-- 7 --}}
                <div class="tc-section" id="tc-7">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">7</div>
                        <h2>Limitation of Liability</h2>
                    </div>
                    <p>We are not liable for:</p>
                    <ul>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Medical test results (fit/unfit decisions)</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Visa approval or rejection</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Delays caused by government systems or medical centers</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Loss due to incorrect user information</li>
                    </ul>
                    <div class="tc-notice tc-notice-warn">
                        <i class="fas fa-balance-scale mr-2"></i>
                        Our liability is limited to the service fee paid. We are a coordination service, not a medical or government authority.
                    </div>
                </div>

                {{-- 8 --}}
                <div class="tc-section" id="tc-8">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">8</div>
                        <h2>Cancellation Policy</h2>
                    </div>
                    <p class="mb-0">
                        All cancellations and refunds are subject to our Refund Policy.
                        Please contact us via WhatsApp or email before your appointment date to discuss cancellation options.
                    </p>
                    <div class="tc-notice tc-notice-warn mt-3">
                        <i class="fas fa-info-circle mr-2"></i>
                        Service fees are generally non-refundable once the appointment slip has been issued.
                    </div>
                </div>

                {{-- 9 --}}
                <div class="tc-section" id="tc-9">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">9</div>
                        <h2>Intellectual Property</h2>
                    </div>
                    <p class="mb-0">
                        All website content, including text, design, logos, and branding, is the property of
                        <strong>{{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}</strong> and may not be
                        copied, reproduced, or distributed without prior written permission.
                    </p>
                </div>

                {{-- 10 --}}
                <div class="tc-section" id="tc-10">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">10</div>
                        <h2>Changes to Terms</h2>
                    </div>
                    <p class="mb-0">
                        We may update these Terms &amp; Conditions at any time. Changes will be posted on this page
                        with an updated effective date. Continued use of our website after changes are posted means
                        you accept the updated terms.
                    </p>
                </div>

                {{-- 11 --}}
                <div class="tc-section" id="tc-11">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="tc-section-num">11</div>
                        <h2>Contact Information</h2>
                    </div>
                    <p class="mb-3">For any questions or support regarding these Terms &amp; Conditions:</p>
                    <div class="tc-contact-card">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <p class="small mb-1" style="color:rgba(255,255,255,.6);">WhatsApp</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}" target="_blank">
                                    <i class="fab fa-whatsapp mr-1"></i>{{ $settings['site_whatsapp'] ?? '+92 XXX XXXXXXX' }}
                                </a>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <p class="small mb-1" style="color:rgba(255,255,255,.6);">Email</p>
                                <a href="mailto:{{ $settings['site_email'] ?? 'info@example.com' }}">
                                    <i class="fas fa-envelope mr-1"></i>{{ $settings['site_email'] ?? 'info@example.com' }}
                                </a>
                            </div>
                            <div class="col-md-4">
                                <p class="small mb-1" style="color:rgba(255,255,255,.6);">Phone</p>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['site_phone'] ?? '') }}">
                                    <i class="fas fa-phone mr-1"></i>{{ $settings['site_phone'] ?? '+92 XXX XXXXXXX' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Agreement --}}
                <div class="text-center py-4">
                    <p class="text-muted small mb-3">By using our website, you agree to these Terms &amp; Conditions.</p>
                    <a href="{{ route('home') }}" class="btn btn-dark px-4 py-2 font-weight-bold mr-2">
                        <i class="fas fa-home mr-1"></i> Back to Home
                    </a>
                    <a href="{{ route('privacy.policy') }}" class="btn btn-outline-dark px-4 py-2 font-weight-bold">
                        <i class="fas fa-shield-alt mr-1"></i> Privacy Policy
                    </a>
                </div>

            </div>{{-- /col --}}
        </div>{{-- /row --}}
    </div>
</section>

@push('scripts')
<script>
(function () {
    const sections = document.querySelectorAll('.tc-section[id]');
    const links    = document.querySelectorAll('.tc-toc a');
    if (!sections.length) return;

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(l => l.classList.remove('active'));
                const active = document.querySelector('.tc-toc a[href="#' + entry.target.id + '"]');
                if (active) active.classList.add('active');
            }
        });
    }, { rootMargin: '-30% 0px -60% 0px' });

    sections.forEach(s => observer.observe(s));
})();
</script>
@endpush

@endsection

@push('schema')
,{
    "@type": "WebPage",
    "@id": "{{ url()->current() }}#webpage",
    "name": "Terms & Conditions | {{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}",
    "url": "{{ url()->current() }}",
    "description": "Read the Terms & Conditions of Gulf Medical Consultants. Understand your rights and responsibilities when booking GAMCA/WAFID medical appointments in Pakistan.",
    "isPartOf": { "@id": "{{ url('/') }}#website" },
    "breadcrumb": { "@id": "{{ url()->current() }}#breadcrumb" }
}
@endpush
