@extends('layouts.public')

@section('title', 'Privacy Policy | Gulf Medical Consultants – GAMCA WAFID Booking')
@section('meta_description', 'Read the Privacy Policy of Gulf Medical Consultants. Learn how we collect, use, and protect your personal data when booking GAMCA/WAFID medical appointments.')
@section('meta_keywords', 'privacy policy, Gulf Medical Consultants, GAMCA data privacy, WAFID booking privacy, personal data protection Pakistan')

@push('head')
<style>
    .pp-hero {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        padding: 64px 0 48px;
    }
    .pp-hero h1 { color: #fff; font-size: 2.2rem; font-weight: 800; }
    .pp-hero p  { color: rgba(255,255,255,.75); font-size: 1rem; }
    .pp-badge {
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
    .pp-breadcrumb {
        background: #f7f8fc;
        border-bottom: 1px solid #e8ecf0;
        padding: 10px 0;
        font-size: .85rem;
    }
    .pp-breadcrumb a { color: var(--primary-slate); }

    /* Sidebar TOC */
    .pp-toc {
        position: sticky;
        top: 80px;
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 24px 20px;
    }
    .pp-toc h6 {
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        margin-bottom: 14px;
    }
    .pp-toc a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 7px 10px;
        border-radius: 8px;
        font-size: .85rem;
        color: #1a252f;
        text-decoration: none;
        transition: background .2s, color .2s;
        margin-bottom: 2px;
    }
    .pp-toc a:hover, .pp-toc a.active {
        background: #fff8e1;
        color: #0f1923;
        font-weight: 600;
    }
    .pp-toc a .toc-num {
        width: 22px; height: 22px;
        background: var(--accent-gold);
        color: #0f1923;
        border-radius: 50%;
        font-size: .7rem;
        font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    /* Content */
    .pp-content { font-size: .95rem; color: #3a4a5a; line-height: 1.8; }
    .pp-section {
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 32px 28px;
        margin-bottom: 20px;
        scroll-margin-top: 90px;
        transition: box-shadow .25s;
    }
    .pp-section:hover { box-shadow: 0 8px 28px rgba(0,0,0,.06); }
    .pp-section-num {
        width: 40px; height: 40px;
        background: var(--accent-gold);
        color: #0f1923;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .pp-section h2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1a252f;
        margin: 0;
    }
    .pp-section ul {
        padding-left: 0;
        list-style: none;
        margin: 0;
    }
    .pp-section ul li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 6px 0;
        border-bottom: 1px solid #f0f4f8;
        font-size: .9rem;
    }
    .pp-section ul li:last-child { border-bottom: none; }
    .pp-section ul li i { color: var(--accent-gold); margin-top: 3px; flex-shrink: 0; }
    .pp-section p { margin-bottom: .6rem; }
    .pp-section p:last-child { margin-bottom: 0; }

    /* Contact card */
    .pp-contact-card {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        border-radius: 14px;
        padding: 28px 24px;
        color: #fff;
    }
    .pp-contact-card a { color: var(--accent-gold); text-decoration: none; }
    .pp-contact-card a:hover { text-decoration: underline; }

    @media(max-width:991px) {
        .pp-toc { position: static; margin-bottom: 24px; }
        .pp-hero h1 { font-size: 1.7rem; }
    }
    @media(max-width:767px) {
        .pp-section { padding: 22px 16px; }
    }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="pp-hero">
    <div class="container">
        <span class="pp-badge">Legal</span>
        <h1>Privacy Policy</h1>
        <p class="mb-0">
            Effective Date: January 1, 2026 &nbsp;·&nbsp;
            <span>{{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}</span>
        </p>
    </div>
</section>

{{-- Breadcrumb --}}
<nav class="pp-breadcrumb" aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0 bg-transparent p-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
        </ol>
    </div>
</nav>

{{-- Body --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row">

            {{-- Sidebar TOC --}}
            <div class="col-lg-3 mb-4 mb-lg-0">
                <nav class="pp-toc" aria-label="Table of contents">
                    <h6>Contents</h6>
                    @php $toc = [
                        'pp-1'  => 'Information We Collect',
                        'pp-2'  => 'How We Use Your Info',
                        'pp-3'  => 'Data Sharing',
                        'pp-4'  => 'Data Security',
                        'pp-5'  => 'Cookies & Tracking',
                        'pp-6'  => 'Third-Party Services',
                        'pp-7'  => 'User Responsibility',
                        'pp-8'  => 'Your Rights',
                        'pp-9'  => 'Policy Changes',
                        'pp-10' => 'Contact Us',
                    ]; @endphp
                    @foreach($toc as $id => $label)
                    @php $num = ltrim($id, 'pp-'); @endphp
                    <a href="#{{ $id }}">
                        <span class="toc-num">{{ $num }}</span>
                        {{ $label }}
                    </a>
                    @endforeach
                </nav>
            </div>

            {{-- Main Content --}}
            <div class="col-lg-9 pp-content">

                {{-- Intro --}}
                <div class="pp-section mb-4" style="background:linear-gradient(135deg,#fff8e1 0%,#fff 100%);border-color:#ffe082;">
                    <p class="mb-0">
                        Welcome to <strong>{{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}</strong>.
                        Your privacy is important to us, and we are committed to protecting your personal information.
                        This Privacy Policy explains how we collect, use, and safeguard your data when you use our
                        <strong>GAMCA/WAFID medical appointment booking services</strong>.
                    </p>
                </div>

                {{-- 1 --}}
                <div class="pp-section" id="pp-1">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="pp-section-num">1</div>
                        <h2>Information We Collect</h2>
                    </div>
                    <p>When you use our services, we may collect the following information:</p>
                    <ul>
                        <li><i class="fas fa-user fa-sm"></i> Full name (as per passport)</li>
                        <li><i class="fas fa-passport fa-sm"></i> Passport number and details</li>
                        <li><i class="fas fa-phone fa-sm"></i> Contact information (phone number, WhatsApp, email)</li>
                        <li><i class="fas fa-briefcase fa-sm"></i> Visa or job-related details</li>
                        <li><i class="fas fa-credit-card fa-sm"></i> Payment information (transaction reference only — not card details)</li>
                    </ul>
                    <p class="mt-3 mb-0 small text-muted">We only collect information necessary to process your GAMCA/WAFID appointment.</p>
                </div>

                {{-- 2 --}}
                <div class="pp-section" id="pp-2">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="pp-section-num">2</div>
                        <h2>How We Use Your Information</h2>
                    </div>
                    <p>Your information is used for the following purposes:</p>
                    <ul>
                        <li><i class="fas fa-calendar-check fa-sm"></i> To book your GAMCA/WAFID medical appointment</li>
                        <li><i class="fas fa-file-pdf fa-sm"></i> To generate and deliver your appointment slip (PDF)</li>
                        <li><i class="fab fa-whatsapp fa-sm"></i> To communicate with you via WhatsApp, phone, or email</li>
                        <li><i class="fas fa-shield-alt fa-sm"></i> To verify your identity and prevent errors</li>
                        <li><i class="fas fa-chart-line fa-sm"></i> To improve our services and user experience</li>
                    </ul>
                    <p class="mt-3 mb-0 small text-muted">We do not use your information for unrelated purposes.</p>
                </div>

                {{-- 3 --}}
                <div class="pp-section" id="pp-3">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="pp-section-num">3</div>
                        <h2>Data Sharing &amp; Disclosure</h2>
                    </div>
                    <p>We may share your information only when necessary:</p>
                    <ul>
                        <li><i class="fas fa-hospital fa-sm"></i> With official GAMCA/WAFID systems for appointment booking</li>
                        <li><i class="fas fa-clinic-medical fa-sm"></i> With authorized medical centers</li>
                        <li><i class="fas fa-money-check-alt fa-sm"></i> With payment providers for transaction processing</li>
                    </ul>
                    <p class="mt-3 mb-0">
                        <span style="background:#e8f5e9;color:#1b5e20;padding:4px 12px;border-radius:20px;font-size:.82rem;font-weight:600;">
                            <i class="fas fa-check mr-1"></i>We do not sell, rent, or trade your personal data to third parties.
                        </span>
                    </p>
                </div>

                {{-- 4 --}}
                <div class="pp-section" id="pp-4">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="pp-section-num">4</div>
                        <h2>Data Security</h2>
                    </div>
                    <p>We take appropriate security measures to protect your personal data, including:</p>
                    <ul>
                        <li><i class="fas fa-lock fa-sm"></i> Secure data handling practices</li>
                        <li><i class="fas fa-user-shield fa-sm"></i> Restricted access to sensitive information</li>
                        <li><i class="fas fa-server fa-sm"></i> Use of trusted platforms and communication channels</li>
                    </ul>
                    <p class="mt-3 mb-0 small text-muted">
                        <i class="fas fa-info-circle mr-1" style="color:var(--accent-gold)"></i>
                        No method of transmission over the internet is 100% secure. We strive to use commercially acceptable means to protect your data.
                    </p>
                </div>

                {{-- 5 --}}
                <div class="pp-section" id="pp-5">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="pp-section-num">5</div>
                        <h2>Cookies &amp; Tracking</h2>
                    </div>
                    <p>Our website may use cookies to:</p>
                    <ul>
                        <li><i class="fas fa-cog fa-sm"></i> Improve website functionality</li>
                        <li><i class="fas fa-chart-bar fa-sm"></i> Analyze traffic and user behavior</li>
                        <li><i class="fas fa-smile fa-sm"></i> Enhance user experience</li>
                    </ul>
                    <p class="mt-3 mb-0 small text-muted">You can disable cookies in your browser settings if you prefer.</p>
                </div>

                {{-- 6 --}}
                <div class="pp-section" id="pp-6">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="pp-section-num">6</div>
                        <h2>Third-Party Services</h2>
                    </div>
                    <p>We may use third-party services such as:</p>
                    <ul>
                        <li><i class="fas fa-credit-card fa-sm"></i> Payment gateways (JazzCash, Easypaisa, bank transfer)</li>
                        <li><i class="fas fa-chart-pie fa-sm"></i> Analytics tools (e.g., Google Analytics)</li>
                        <li><i class="fab fa-whatsapp fa-sm"></i> Communication tools (e.g., WhatsApp)</li>
                    </ul>
                    <p class="mt-3 mb-0 small text-muted">These services have their own privacy policies, and we are not responsible for their practices.</p>
                </div>

                {{-- 7 --}}
                <div class="pp-section" id="pp-7">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="pp-section-num">7</div>
                        <h2>User Responsibility</h2>
                    </div>
                    <p>You are responsible for:</p>
                    <ul>
                        <li><i class="fas fa-check-circle fa-sm"></i> Providing accurate and correct information</li>
                        <li><i class="fas fa-passport fa-sm"></i> Ensuring your passport and visa details are valid</li>
                        <li><i class="fas fa-eye fa-sm"></i> Reviewing your appointment slip before use</li>
                    </ul>
                    <p class="mt-3 mb-0 small text-muted">Incorrect information may result in booking errors or rejection at the medical center.</p>
                </div>

                {{-- 8 --}}
                <div class="pp-section" id="pp-8">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="pp-section-num">8</div>
                        <h2>Your Rights</h2>
                    </div>
                    <p>You have the right to:</p>
                    <ul>
                        <li><i class="fas fa-search fa-sm"></i> Request access to your data</li>
                        <li><i class="fas fa-edit fa-sm"></i> Request correction of incorrect information</li>
                        <li><i class="fas fa-trash-alt fa-sm"></i> Request deletion of your data (where applicable)</li>
                    </ul>
                    <p class="mt-3 mb-0 small text-muted">To make such requests, contact us using the details in Section 10 below.</p>
                </div>

                {{-- 9 --}}
                <div class="pp-section" id="pp-9">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="pp-section-num">9</div>
                        <h2>Changes to This Policy</h2>
                    </div>
                    <p class="mb-0">
                        We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements.
                        Any changes will be posted on this page with an updated effective date.
                        We encourage you to review this page periodically.
                    </p>
                </div>

                {{-- 10 --}}
                <div class="pp-section" id="pp-10">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="pp-section-num">10</div>
                        <h2>Contact Us</h2>
                    </div>
                    <p class="mb-3">If you have any questions about this Privacy Policy, please contact us:</p>
                    <div class="pp-contact-card">
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

                {{-- Agreement notice --}}
                <div class="text-center py-4">
                    <p class="text-muted small mb-3">By using our website, you agree to this Privacy Policy.</p>
                    <a href="{{ route('home') }}" class="btn btn-dark px-4 py-2 font-weight-bold mr-2">
                        <i class="fas fa-home mr-1"></i> Back to Home
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-dark px-4 py-2 font-weight-bold">
                        <i class="fas fa-envelope mr-1"></i> Contact Us
                    </a>
                </div>

            </div>{{-- /col --}}
        </div>{{-- /row --}}
    </div>
</section>

@push('scripts')
<script>
// Highlight active TOC item on scroll
(function () {
    const sections = document.querySelectorAll('.pp-section[id]');
    const links    = document.querySelectorAll('.pp-toc a');
    if (!sections.length) return;

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(l => l.classList.remove('active'));
                const active = document.querySelector('.pp-toc a[href="#' + entry.target.id + '"]');
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
    "name": "Privacy Policy | {{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}",
    "url": "{{ url()->current() }}",
    "description": "Read the Privacy Policy of Gulf Medical Consultants. Learn how we collect, use, and protect your personal data when booking GAMCA/WAFID medical appointments.",
    "isPartOf": { "@id": "{{ url('/') }}#website" },
    "breadcrumb": { "@id": "{{ url()->current() }}#breadcrumb" }
}
@endpush
