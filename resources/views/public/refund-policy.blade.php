@extends('layouts.public')

@section('title', 'Refund Policy | Gulf Medical Consultants – GAMCA WAFID Booking')
@section('meta_description', 'Read the Refund Policy of Gulf Medical Consultants. Understand refund eligibility, non-refundable cases, and cancellation terms for GAMCA/WAFID bookings.')
@section('meta_keywords', 'refund policy, GAMCA refund, WAFID booking refund, Gulf Medical Consultants refund, cancellation policy Pakistan')

@push('head')
<style>
    .rp-hero {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        padding: 64px 0 48px;
    }
    .rp-hero h1 { color: #fff; font-size: 2.2rem; font-weight: 800; }
    .rp-hero p  { color: rgba(255,255,255,.75); font-size: 1rem; }
    .rp-badge {
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
    .rp-breadcrumb {
        background: #f7f8fc;
        border-bottom: 1px solid #e8ecf0;
        padding: 10px 0;
        font-size: .85rem;
    }
    .rp-breadcrumb a { color: var(--primary-slate); }
    .rp-toc {
        position: sticky;
        top: 80px;
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 24px 20px;
    }
    .rp-toc h6 {
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        margin-bottom: 14px;
    }
    .rp-toc a {
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
    .rp-toc a:hover, .rp-toc a.active { background: #fff8e1; color: #0f1923; font-weight: 600; }
    .rp-toc .toc-num {
        width: 22px; height: 22px;
        background: var(--accent-gold);
        color: #0f1923;
        border-radius: 50%;
        font-size: .68rem;
        font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .rp-content { font-size: .95rem; color: #3a4a5a; line-height: 1.8; }
    .rp-section {
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 32px 28px;
        margin-bottom: 20px;
        scroll-margin-top: 90px;
        transition: box-shadow .25s;
    }
    .rp-section:hover { box-shadow: 0 8px 28px rgba(0,0,0,.06); }
    .rp-section-num {
        width: 40px; height: 40px;
        background: var(--accent-gold);
        color: #0f1923;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .rp-section h2 { font-size: 1.15rem; font-weight: 700; color: #1a252f; margin: 0; }
    .rp-section ul { padding-left: 0; list-style: none; margin: 0; }
    .rp-section ul li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 6px 0;
        border-bottom: 1px solid #f0f4f8;
        font-size: .9rem;
    }
    .rp-section ul li:last-child { border-bottom: none; }
    .rp-section ul li i { margin-top: 3px; flex-shrink: 0; }
    .rp-section p { margin-bottom: .6rem; }
    .rp-section p:last-child { margin-bottom: 0; }
    .rp-notice {
        border-radius: 10px;
        padding: 12px 16px;
        font-size: .88rem;
        margin-top: 14px;
    }
    .rp-notice-warn  { background: #fff8e1; border-left: 4px solid var(--accent-gold); color: #5a4000; }
    .rp-notice-info  { background: #e8f5e9; border-left: 4px solid #27ae60; color: #1b5e20; }
    .rp-notice-alert { background: #fdecea; border-left: 4px solid #e74c3c; color: #7b1a1a; }
    .rp-contact-card {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        border-radius: 14px;
        padding: 28px 24px;
        color: #fff;
    }
    .rp-contact-card a { color: var(--accent-gold); text-decoration: none; }
    .rp-contact-card a:hover { text-decoration: underline; }
    @media(max-width:991px) { .rp-toc { position: static; margin-bottom: 24px; } .rp-hero h1 { font-size: 1.7rem; } }
    @media(max-width:767px) { .rp-section { padding: 22px 16px; } }
</style>
@endpush

@section('content')

<section class="rp-hero">
    <div class="container">
        <span class="rp-badge">Legal</span>
        <h1>Refund Policy</h1>
        <p class="mb-0">Effective Date: January 1, 2026 &nbsp;·&nbsp; {{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}</p>
    </div>
</section>

<nav class="rp-breadcrumb" aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0 bg-transparent p-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Refund Policy</li>
        </ol>
    </div>
</nav>

<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 mb-4 mb-lg-0">
                <nav class="rp-toc" aria-label="Table of contents">
                    <h6>Contents</h6>
                    @php $toc = [
                        'rp-1' => 'Service Nature',
                        'rp-2' => 'Refund Eligibility',
                        'rp-3' => 'Non-Refundable Cases',
                        'rp-4' => 'Cancellation Policy',
                        'rp-5' => 'Processing Time',
                        'rp-6' => 'Third-Party Charges',
                        'rp-7' => 'Contact for Refunds',
                    ]; @endphp
                    @foreach($toc as $id => $label)
                    @php $num = ltrim($id, 'rp-'); @endphp
                    <a href="#{{ $id }}"><span class="toc-num">{{ $num }}</span>{{ $label }}</a>
                    @endforeach
                </nav>
                <div class="mt-3 p-3 text-center" style="background:#fff;border:1px solid #e8ecf0;border-radius:12px;">
                    <p class="small text-muted mb-2">Questions about a refund?</p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}" target="_blank" class="btn btn-dark btn-block btn-sm font-weight-bold">
                        <i class="fab fa-whatsapp mr-1"></i> WhatsApp Us
                    </a>
                </div>
            </div>

            <div class="col-lg-9 rp-content">

                <div class="rp-section mb-4" style="background:linear-gradient(135deg,#fff8e1 0%,#fff 100%);border-color:#ffe082;">
                    <p class="mb-0">We aim to provide a smooth and reliable booking experience. Please read our Refund Policy carefully before making any payment.</p>
                </div>

                <div class="rp-section" id="rp-1">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="rp-section-num">1</div>
                        <h2>Service Nature</h2>
                    </div>
                    <p class="mb-0">Our service involves processing and booking GAMCA/WAFID appointments, which requires immediate system actions and coordination with third-party platforms. Due to the nature of this service, refunds are subject to the conditions below.</p>
                </div>

                <div class="rp-section" id="rp-2">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="rp-section-num">2</div>
                        <h2>Refund Eligibility</h2>
                    </div>
                    <p>Refunds may be provided in the following cases:</p>
                    <ul>
                        <li><i class="fas fa-check-circle fa-sm" style="color:#27ae60;"></i> Duplicate payment made by the user</li>
                        <li><i class="fas fa-check-circle fa-sm" style="color:#27ae60;"></i> Booking not processed due to system failure</li>
                        <li><i class="fas fa-check-circle fa-sm" style="color:#27ae60;"></i> Service not delivered within the promised time</li>
                    </ul>
                    <div class="rp-notice rp-notice-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        Eligible refunds are reviewed on a case-by-case basis. Contact us with proof of payment.
                    </div>
                </div>

                <div class="rp-section" id="rp-3">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="rp-section-num">3</div>
                        <h2>Non-Refundable Cases</h2>
                    </div>
                    <p>Refunds will <strong>NOT</strong> be provided in the following situations:</p>
                    <ul>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> User provides incorrect information (passport, visa, etc.)</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Appointment already booked and slip issued</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> User misses appointment</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Change of mind after booking</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Medical test result declared unfit</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Visa rejection by embassy</li>
                    </ul>
                    <div class="rp-notice rp-notice-alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Once your appointment slip has been issued, the service fee is non-refundable.
                    </div>
                </div>

                <div class="rp-section" id="rp-4">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="rp-section-num">4</div>
                        <h2>Cancellation Policy</h2>
                    </div>
                    <ul>
                        <li><i class="fas fa-calendar-times fa-sm" style="color:var(--accent-gold);"></i> Cancellation requests must be made before booking confirmation</li>
                        <li><i class="fas fa-lock fa-sm" style="color:var(--accent-gold);"></i> Once booking is confirmed, cancellation may not be possible</li>
                        <li><i class="fas fa-percentage fa-sm" style="color:var(--accent-gold);"></i> Some cases may allow partial refund depending on processing stage</li>
                    </ul>
                </div>

                <div class="rp-section" id="rp-5">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="rp-section-num">5</div>
                        <h2>Refund Processing Time</h2>
                    </div>
                    <ul>
                        <li><i class="fas fa-clock fa-sm" style="color:var(--accent-gold);"></i> Approved refunds are processed within <strong>5–10 working days</strong></li>
                        <li><i class="fas fa-university fa-sm" style="color:var(--accent-gold);"></i> Refunds are issued via the original payment method or bank transfer</li>
                    </ul>
                </div>

                <div class="rp-section" id="rp-6">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="rp-section-num">6</div>
                        <h2>Third-Party Charges</h2>
                    </div>
                    <p>Any fees charged by the following are <strong>non-refundable</strong> once processed:</p>
                    <ul>
                        <li><i class="fas fa-file-medical fa-sm" style="color:#e74c3c;"></i> GAMCA / WAFID system</li>
                        <li><i class="fas fa-hospital fa-sm" style="color:#e74c3c;"></i> Medical centers</li>
                    </ul>
                </div>

                <div class="rp-section" id="rp-7">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="rp-section-num">7</div>
                        <h2>Contact for Refunds</h2>
                    </div>
                    <p class="mb-3">To request a refund, contact us with the following details:</p>
                    <ul class="mb-4">
                        <li><i class="fas fa-user fa-sm" style="color:var(--accent-gold);"></i> Your full name</li>
                        <li><i class="fas fa-receipt fa-sm" style="color:var(--accent-gold);"></i> Payment proof (screenshot or transaction ID)</li>
                        <li><i class="fas fa-calendar-check fa-sm" style="color:var(--accent-gold);"></i> Booking details</li>
                    </ul>
                    <div class="rp-contact-card">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <p class="small mb-1" style="color:rgba(255,255,255,.6);">WhatsApp</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}" target="_blank">
                                    <i class="fab fa-whatsapp mr-1"></i>{{ $settings['site_whatsapp'] ?? '+92 XXX XXXXXXX' }}
                                </a>
                            </div>
                            <div class="col-md-6">
                                <p class="small mb-1" style="color:rgba(255,255,255,.6);">Email</p>
                                <a href="mailto:{{ $settings['site_email'] ?? 'info@example.com' }}">
                                    <i class="fas fa-envelope mr-1"></i>{{ $settings['site_email'] ?? 'info@example.com' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center py-4">
                    <p class="text-muted small mb-3">By using our services, you agree to this Refund Policy.</p>
                    <a href="{{ route('home') }}" class="btn btn-dark px-4 py-2 font-weight-bold mr-2">
                        <i class="fas fa-home mr-1"></i> Back to Home
                    </a>
                    <a href="{{ route('terms.conditions') }}" class="btn btn-outline-dark px-4 py-2 font-weight-bold">
                        <i class="fas fa-file-contract mr-1"></i> Terms &amp; Conditions
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function () {
    const sections = document.querySelectorAll('.rp-section[id]');
    const links    = document.querySelectorAll('.rp-toc a');
    if (!sections.length) return;
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(l => l.classList.remove('active'));
                const a = document.querySelector('.rp-toc a[href="#' + entry.target.id + '"]');
                if (a) a.classList.add('active');
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
    "name": "Refund Policy | {{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}",
    "url": "{{ url()->current() }}",
    "description": "Read the Refund Policy of Gulf Medical Consultants. Understand refund eligibility, non-refundable cases, and cancellation terms for GAMCA/WAFID bookings.",
    "isPartOf": { "@id": "{{ url('/') }}#website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
            { "@type": "ListItem", "position": 2, "name": "Refund Policy", "item": "{{ url()->current() }}" }
        ]
    }
}
@endpush
