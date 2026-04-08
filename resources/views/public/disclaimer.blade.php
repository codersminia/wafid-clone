@extends('layouts.public')

@section('title', 'Disclaimer | Gulf Medical Consultants – GAMCA WAFID Booking Pakistan')
@section('meta_description', 'Read the Disclaimer of Gulf Medical Consultants. We are an independent GAMCA/WAFID booking service, not affiliated with any government authority or embassy.')
@section('meta_keywords', 'disclaimer, Gulf Medical Consultants, GAMCA disclaimer, WAFID booking disclaimer, independent service Pakistan')

@push('head')
<style>
    .disc-hero {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        padding: 64px 0 48px;
    }
    .disc-hero h1 { color: #fff; font-size: 2.2rem; font-weight: 800; }
    .disc-hero p  { color: rgba(255,255,255,.75); font-size: 1rem; }
    .disc-badge {
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
    .disc-breadcrumb {
        background: #f7f8fc;
        border-bottom: 1px solid #e8ecf0;
        padding: 10px 0;
        font-size: .85rem;
    }
    .disc-breadcrumb a { color: var(--primary-slate); }
    .disc-toc {
        position: sticky;
        top: 80px;
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 24px 20px;
    }
    .disc-toc h6 {
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        margin-bottom: 14px;
    }
    .disc-toc a {
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
    .disc-toc a:hover, .disc-toc a.active { background: #fff8e1; color: #0f1923; font-weight: 600; }
    .disc-toc .toc-num {
        width: 22px; height: 22px;
        background: var(--accent-gold);
        color: #0f1923;
        border-radius: 50%;
        font-size: .68rem;
        font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .disc-content { font-size: .95rem; color: #3a4a5a; line-height: 1.8; }
    .disc-section {
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 32px 28px;
        margin-bottom: 20px;
        scroll-margin-top: 90px;
        transition: box-shadow .25s;
    }
    .disc-section:hover { box-shadow: 0 8px 28px rgba(0,0,0,.06); }
    .disc-section-num {
        width: 40px; height: 40px;
        background: var(--accent-gold);
        color: #0f1923;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .disc-section h2 { font-size: 1.15rem; font-weight: 700; color: #1a252f; margin: 0; }
    .disc-section ul { padding-left: 0; list-style: none; margin: 0; }
    .disc-section ul li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 6px 0;
        border-bottom: 1px solid #f0f4f8;
        font-size: .9rem;
    }
    .disc-section ul li:last-child { border-bottom: none; }
    .disc-section ul li i { margin-top: 3px; flex-shrink: 0; }
    .disc-section p { margin-bottom: .6rem; }
    .disc-section p:last-child { margin-bottom: 0; }
    .disc-notice {
        border-radius: 10px;
        padding: 12px 16px;
        font-size: .88rem;
        margin-top: 14px;
    }
    .disc-notice-warn  { background: #fff8e1; border-left: 4px solid var(--accent-gold); color: #5a4000; }
    .disc-notice-alert { background: #fdecea; border-left: 4px solid #e74c3c; color: #7b1a1a; }
    .disc-contact-card {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        border-radius: 14px;
        padding: 28px 24px;
        color: #fff;
    }
    .disc-contact-card a { color: var(--accent-gold); text-decoration: none; }
    .disc-contact-card a:hover { text-decoration: underline; }
    @media(max-width:991px) { .disc-toc { position: static; margin-bottom: 24px; } .disc-hero h1 { font-size: 1.7rem; } }
    @media(max-width:767px) { .disc-section { padding: 22px 16px; } }
</style>
@endpush

@section('content')

<section class="disc-hero">
    <div class="container">
        <span class="disc-badge">Legal</span>
        <h1>Disclaimer</h1>
        <p class="mb-0">Effective Date: January 1, 2026 &nbsp;·&nbsp; {{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}</p>
    </div>
</section>

<nav class="disc-breadcrumb" aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0 bg-transparent p-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Disclaimer</li>
        </ol>
    </div>
</nav>

<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 mb-4 mb-lg-0">
                <nav class="disc-toc" aria-label="Table of contents">
                    <h6>Contents</h6>
                    @php $toc = [
                        'disc-1' => 'No Government Affiliation',
                        'disc-2' => 'Information Accuracy',
                        'disc-3' => 'Service Limitation',
                        'disc-4' => 'External Links',
                        'disc-5' => 'Use at Your Own Risk',
                        'disc-6' => 'Contact',
                    ]; @endphp
                    @foreach($toc as $id => $label)
                    @php $num = str_replace('disc-', '', $id); @endphp
                    <a href="#{{ $id }}"><span class="toc-num">{{ $num }}</span>{{ $label }}</a>
                    @endforeach
                </nav>
                <div class="mt-3 p-3 text-center" style="background:#fff;border:1px solid #e8ecf0;border-radius:12px;">
                    <p class="small text-muted mb-2">Independent booking service</p>
                    <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-block btn-sm font-weight-bold">
                        <i class="fas fa-calendar-check mr-1"></i> Book Appointment
                    </a>
                </div>
            </div>

            <div class="col-lg-9 disc-content">

                <div class="disc-section mb-4" style="background:linear-gradient(135deg,#fff8e1 0%,#fff 100%);border-color:#ffe082;">
                    <p class="mb-0">
                        The information provided on this website is for general informational and service purposes only.
                        <strong>{{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}</strong> is an independent
                        private consultancy service. We are not a government body, embassy, or official GAMCA/WAFID authority.
                    </p>
                </div>

                <div class="disc-section" id="disc-1">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="disc-section-num">1</div>
                        <h2>No Government Affiliation</h2>
                    </div>
                    <p class="mb-0">
                        We are an independent service provider and are <strong>not affiliated</strong> with any government
                        authority, GAMCA, WAFID, embassy, visa office, or medical center. We provide booking assistance
                        and coordination services only.
                    </p>
                    <div class="disc-notice disc-notice-warn">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        For official GAMCA/WAFID information, always refer to the respective government or authority websites.
                    </div>
                </div>

                <div class="disc-section" id="disc-2">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="disc-section-num">2</div>
                        <h2>Information Accuracy</h2>
                    </div>
                    <p>We strive to keep all information accurate and updated. However, we do not guarantee:</p>
                    <ul>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Completeness of all information</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Accuracy at all times due to system or policy changes</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Timeliness of updates</li>
                    </ul>
                    <p class="mt-2 mb-0 small text-muted">Users should verify information with official sources when necessary.</p>
                </div>

                <div class="disc-section" id="disc-3">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="disc-section-num">3</div>
                        <h2>Service Limitation</h2>
                    </div>
                    <p>We provide <strong>appointment booking assistance only</strong>. We do not:</p>
                    <ul>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Conduct medical tests</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Issue visas</li>
                        <li><i class="fas fa-times-circle fa-sm" style="color:#e74c3c;"></i> Influence medical or visa decisions</li>
                    </ul>
                    <div class="disc-notice disc-notice-warn">
                        <i class="fas fa-info-circle mr-2"></i>
                        Medical fitness decisions are made solely by authorized GAMCA/WAFID medical centers.
                    </div>
                </div>

                <div class="disc-section" id="disc-4">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="disc-section-num">4</div>
                        <h2>External Links</h2>
                    </div>
                    <p class="mb-0">
                        Our website may contain links to third-party websites for reference purposes.
                        We are not responsible for the content, accuracy, or privacy practices of those websites.
                        Visiting external links is at your own discretion.
                    </p>
                </div>

                <div class="disc-section" id="disc-5">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="disc-section-num">5</div>
                        <h2>Use at Your Own Risk</h2>
                    </div>
                    <p class="mb-0">
                        Any action taken based on information from this website is strictly at your own risk.
                        We shall not be held liable for any loss, damage, or inconvenience arising from the use
                        of information or services provided on this website.
                    </p>
                    <div class="disc-notice disc-notice-alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Always double-check your passport details, appointment slip, and clinic instructions before attending your medical test.
                    </div>
                </div>

                <div class="disc-section" id="disc-6">
                    <div class="d-flex align-items-center mb-3" style="gap:14px;">
                        <div class="disc-section-num">6</div>
                        <h2>Contact</h2>
                    </div>
                    <p class="mb-3">For any concerns or questions about this disclaimer:</p>
                    <div class="disc-contact-card">
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
                    <p class="text-muted small mb-3">By using this website, you agree to this disclaimer.</p>
                    <a href="{{ route('home') }}" class="btn btn-dark px-4 py-2 font-weight-bold mr-2">
                        <i class="fas fa-home mr-1"></i> Back to Home
                    </a>
                    <a href="{{ route('privacy.policy') }}" class="btn btn-outline-dark px-4 py-2 font-weight-bold">
                        <i class="fas fa-shield-alt mr-1"></i> Privacy Policy
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function () {
    const sections = document.querySelectorAll('.disc-section[id]');
    const links    = document.querySelectorAll('.disc-toc a');
    if (!sections.length) return;
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(l => l.classList.remove('active'));
                const a = document.querySelector('.disc-toc a[href="#' + entry.target.id + '"]');
                if (a) a.classList.add('active');
            }
        });
    }, { rootMargin: '-30% 0px -60% 0px' });
    sections.forEach(s => observer.observe(s));
})();
</script>
@endpush

@endsection
