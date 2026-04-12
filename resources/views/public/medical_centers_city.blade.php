@extends('layouts.public')

@section('title', "GAMCA Medical Centers in " . $cityName . " | WAFID Appointment & Token Booking")
@section('meta_description', "Find approved GAMCA medical centers in " . $cityName . ". Book WAFID appointment, check fees, documents, and get your medical slip online for GCC visa.")
@section('meta_keywords', "GAMCA " . strtolower($cityName) . ", WAFID medical " . strtolower($cityName) . ", GAMCA centers " . strtolower($cityName) . ", medical centers " . strtolower($cityName) . " GCC, GAMCA appointment " . strtolower($cityName))

@section('content')
    <!-- Hero Section -->
    <section class="page-title-section py-5"
        style="background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('{{ $cityMedia && $cityMedia->hero_image ? asset($cityMedia->hero_image) : asset('assets/public/images/hero-bg.jpg') }}') center/cover no-repeat;">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-3">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">GAMCA Centers in {{ $cityName }}</li>
                        </ol>
                    </nav>
                    <span style="display:inline-block;background:var(--accent-gold);color:#0f1923;font-size:.72rem;font-weight:700;padding:4px 14px;border-radius:20px;letter-spacing:.5px;text-transform:uppercase;margin-bottom:12px;">
                        <i class="fas fa-map-marker-alt mr-1"></i> WAFID Approved Centers
                    </span>
                    <h1 class="display-4 font-weight-bold text-white mb-3">GAMCA Medical Centers in {{ $cityName }}</h1>
                    <p class="lead text-white-50 mb-4">
                        {{ $cityMedia && $cityMedia->description ? $cityMedia->description : "Find approved WAFID (GAMCA) medical centers in $cityName for GCC visa processing." }}
                    </p>
                    <a href="{{ route('medicalExamination') }}" class="btn btn-warning font-weight-bold px-4 py-2 mr-2" style="color:#0f1923;">
                        <i class="fas fa-calendar-check mr-2"></i>Book Appointment
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+GAMCA+appointment+in+{{ urlencode($cityName) }}." target="_blank" class="btn btn-outline-light px-4 py-2">
                        <i class="fab fa-whatsapp mr-2"></i>WhatsApp Help
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- TOP SEO SECTION -->
    <section class="py-5" style="background:#fff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <span class="city-section-label">WAFID Appointment & Token Guide</span>
                    <h2 class="city-section-title">GAMCA Medical Centers in {{ $cityName }} – WAFID Appointment & Token Guide</h2>
                    <p class="text-muted mb-3">Looking for GAMCA medical centers in {{ $cityName }}? This page helps you find approved WAFID (GAMCA) medical centers and book your GCC medical appointment quickly and correctly.</p>
                    <p class="text-muted mb-4">Applicants traveling to <strong>Saudi Arabia, Qatar, Oman, Kuwait, Bahrain, or UAE</strong> must complete their GAMCA medical test at an approved center before visa processing.</p>
                    <div class="row mb-3">
                        @php $whyUs = [
                            'Verified GAMCA-approved centers',
                            'Correct city &amp; clinic assignment',
                            'Fast WhatsApp confirmation',
                            'Avoid booking mistakes',
                            'Support for all GCC countries',
                        ]; @endphp
                        @foreach($whyUs as $pt)
                        <div class="col-md-6 mb-2">
                            <div class="city-check-item">
                                <i class="fas fa-check-circle"></i>
                                <span class="small">{!! $pt !!}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="city-info-card">
                        <div class="city-info-card-header">
                            <i class="fas fa-hospital mr-2"></i>What is GAMCA / WAFID Medical?
                        </div>
                        <div class="p-4">
                            <p class="small text-muted mb-3">The GAMCA (WAFID) medical test is a mandatory health screening required for GCC visa applicants. It ensures you are medically fit before traveling abroad for work or residency.</p>
                            <p class="small font-weight-bold mb-2" style="color:#1a252f;">Tests usually include:</p>
                            @php $tests = [
                                ['icon'=>'fas fa-tint',        'text'=>'Blood screening (HIV, Hepatitis)'],
                                ['icon'=>'fas fa-x-ray',       'text'=>'Chest X-ray (TB test)'],
                                ['icon'=>'fas fa-stethoscope', 'text'=>'Physical examination'],
                            ]; @endphp
                            @foreach($tests as $t)
                            <div class="city-mini-item"><i class="{{ $t['icon'] }}" style="color:var(--accent-gold);font-size:.8rem;"></i><span class="small">{{ $t['text'] }}</span></div>
                            @endforeach
                            <div class="mt-3">
                                <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-block font-weight-bold btn-sm">
                                    <i class="fas fa-calendar-check mr-2"></i>Book GAMCA Appointment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- How to Book --}}
            <div class="city-steps-strip mt-5">
                <h3 class="font-weight-bold mb-4" style="font-size:1.2rem;color:#1a252f;"><i class="fas fa-list-ol mr-2" style="color:var(--accent-gold);"></i>How to Book GAMCA Appointment in {{ $cityName }}</h3>
                <div class="row">
                    @php $steps = [
                        ['num'=>'1','text'=>'Fill the online booking form'],
                        ['num'=>'2','text'=>'Select ' . $cityName . ' as your city'],
                        ['num'=>'3','text'=>'Submit your passport details'],
                        ['num'=>'4','text'=>'Complete payment'],
                        ['num'=>'5','text'=>'Receive your GAMCA/WAFID slip on WhatsApp'],
                        ['num'=>'6','text'=>'Visit your assigned medical center'],
                    ]; @endphp
                    @foreach($steps as $step)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="city-step-item">
                            <span class="city-step-num">{{ $step['num'] }}</span>
                            <span class="small text-muted">{{ $step['text'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Center Cards -->
    <section class="py-5 bg-light-grey">
        <div class="container">
            <div class="row">
                @foreach($centers as $center)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="medical-card h-100 bg-white rounded-lg shadow-sm overflow-hidden border-0 transition-hover">
                            <!-- Card Image (Dynamic or Placeholder) -->
                            <div class="medical-thumb position-relative">
                                @if($center->image)
                                    <img src="{{ asset($center->image) }}" class="img-fluid" alt="{{ $center->medical_center }}"
                                        style="height: 200px; width: 100%; object-fit: cover;">
                                @else
                                    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=800"
                                        class="img-fluid" alt="{{ $center->medical_center }}"
                                        style="height: 200px; width: 100%; object-fit: cover;">
                                @endif
                                <div class="position-absolute p-3" style="top: 0; right: 0;">
                                    <span class="badge badge-theme px-3 py-2 shadow-sm font-weight-bold">WAFID APPROVED</span>
                                </div>
                            </div>

                            <div class="card-body p-4">
                                <h4 class="h5 font-weight-bold mb-3 text-dark">{{ $center->medical_center }}</h4>

                                <div class="mb-3 d-flex">
                                    <i class="fas fa-map-marker-alt text-dark mt-1 mr-3"></i>
                                    <p class="mb-0 text-muted small">
                                        {{ $center->address_line_1 }}<br>
                                        {{ $center->address_line_2 }}
                                    </p>
                                </div>

                                @if($center->phone)
                                    <div class="mb-2 d-flex align-items-center">
                                        <i class="fas fa-phone-alt text-dark mr-3"></i>
                                        <a href="tel:{{ $center->phone }}"
                                            class="text-muted small text-decoration-none">{{ $center->phone }}</a>
                                    </div>
                                @endif

                                @if($center->rating > 0)
                                    <div class="mb-3 d-flex align-items-center">
                                        <div class="text-warning mr-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa{{ $i <= $center->rating ? 's' : 'r' }} fa-star fa-xs"></i>
                                            @endfor
                                        </div>        
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($center->medical_center . ' ' . $center->address_line_1 . ' ' . $cityName) }}"
                                        target="_blank"
                                        class="btn btn-link text-dark font-weight-bold p-0 text-decoration-none small">
                                        <i class="fas fa-location-arrow mr-1"></i> VIEW ON MAP
                                    </a>
                                    @if($center->website)
                                        <a href="{{ $center->website }}" target="_blank"
                                            class="btn btn-link text-dark font-weight-bold p-0 text-decoration-none small">
                                            WEBSITE <i class="fas fa-external-link-alt ml-1"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer bg-white border-0 p-4 pt-0">
                                <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-block font-weight-bold">
                                    BOOK APPOINTMENT
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- BOTTOM SEO CONTENT --}}

    {{-- Documents + Fees --}}
    <section class="py-5" style="background:#fff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="city-section-label">Before You Visit</span>
                    <h2 class="city-section-title">Documents Required for GAMCA Medical</h2>
                    @php $docs = [
                        ['icon'=>'fas fa-passport',      'text'=>'Original passport (valid 6+ months)'],
                        ['icon'=>'fas fa-images',        'text'=>'Two passport-size photos (white background)'],
                        ['icon'=>'fas fa-file-alt',      'text'=>'GAMCA/WAFID appointment slip'],
                        ['icon'=>'fas fa-briefcase',     'text'=>'Visa or job offer letter'],
                    ]; @endphp
                    @foreach($docs as $doc)
                    <div class="city-doc-item">
                        <i class="{{ $doc['icon'] }}" style="color:var(--accent-gold);flex-shrink:0;"></i>
                        <span class="small text-muted">{{ $doc['text'] }}</span>
                    </div>
                    @endforeach

                    <div class="mt-4 p-3 rounded" style="background:#fff8e1;border-left:4px solid var(--accent-gold);">
                        <p class="small font-weight-bold mb-2" style="color:#1a252f;">GAMCA Medical Fee in {{ $cityName }}</p>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small text-muted">Medical Test Fee</span>
                            <span class="small font-weight-bold" style="color:var(--accent-gold);">PKR 25,000</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="small text-muted">Token Booking Fee</span>
                            <span class="small font-weight-bold" style="color:var(--accent-gold);">PKR 4,500</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="city-section-label">Avoid These Errors</span>
                    <h2 class="city-section-title">Common Mistakes to Avoid</h2>
                    @php $mistakes = [
                        'Wrong passport details',
                        'Selecting incorrect city',
                        'Missing appointment date',
                        'Not bringing required documents',
                    ]; @endphp
                    @foreach($mistakes as $m)
                    <div class="city-mistake-item">
                        <i class="fas fa-times-circle mr-3" style="color:#e74c3c;font-size:1.1rem;flex-shrink:0;"></i>
                        <span class="text-muted small">{{ $m }}</span>
                    </div>
                    @endforeach
                    <div class="mt-4 p-3 rounded" style="background:#f7f8fc;border:1px solid #e8ecf0;">
                        <p class="small font-weight-bold mb-1" style="color:#1a252f;">How Long Does GAMCA Medical Take?</p>
                        <p class="small text-muted mb-1"><i class="fas fa-clock mr-2" style="color:var(--accent-gold);"></i>Test duration: <strong>2–3 hours</strong></p>
                        <p class="small text-muted mb-0"><i class="fas fa-check-circle mr-2" style="color:var(--accent-gold);"></i>Result time: <strong>24–48 hours</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Other Cities + FAQ --}}
    <section class="py-5" style="background:#f7f8fc;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="city-section-label">Other Locations</span>
                    <h2 class="city-section-title">Other Cities with GAMCA Centers</h2>
                    <p class="text-muted mb-4">We also provide booking support in:</p>
                    <div class="d-flex flex-wrap" style="gap:10px;">
                        @php $otherCities = ['karachi','lahore','islamabad','rawalpindi','gujranwala','peshawar','sialkot'];
                        $currentCitySlug = strtolower(str_replace(' ', '-', $cityName)); @endphp
                        @foreach($otherCities as $oc)
                            @if($oc !== $currentCitySlug)
                            <a href="{{ route('public.medical.city', $oc) }}" class="city-other-pill">
                                📍 {{ ucfirst($oc) }}
                            </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-4 p-3 rounded" style="background:#fff;border:1px solid #e8ecf0;">
                        <p class="small font-weight-bold mb-2" style="color:#1a252f;">Quick Links</p>
                        <div class="d-flex flex-wrap" style="gap:8px;">
                            <a href="{{ route('medicalExamination') }}" class="btn btn-sm btn-dark font-weight-bold"><i class="fas fa-calendar-check mr-1"></i>Book Appointment</a>
                            <a href="{{ route('ViewMedicalReport') }}" class="btn btn-sm btn-outline-dark font-weight-bold"><i class="fas fa-search mr-1"></i>Check Status</a>
                            <a href="{{ route('public.gcc.country', 'saudi-arabia') }}" class="btn btn-sm btn-outline-dark font-weight-bold">🇸🇦 Saudi Arabia</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="city-section-label">Quick Answers</span>
                    <h2 class="city-section-title">{{ $cityName }} GAMCA FAQs</h2>
                    <div id="cityFaqAccordion">
                        @php $cityFaqs = [
                            ['q' => 'Are GAMCA centers available in ' . $cityName . '?',    'a' => 'Yes, there are approved WAFID medical centers for GCC medical tests in ' . $cityName . '. Browse the list above to find the nearest one.'],
                            ['q' => 'Can I choose my center in ' . $cityName . '?',         'a' => 'Yes, with our premium Choice Center service you can select your preferred clinic in ' . $cityName . '.'],
                            ['q' => 'Is appointment required before visiting?',             'a' => 'Yes, a GAMCA/WAFID token is mandatory before visiting any medical center. You cannot walk in without a valid appointment slip.'],
                            ['q' => 'How fast are results available?',                      'a' => 'Usually within 24–48 hours after your medical test. You can check your status online using your passport number.'],
                        ]; @endphp
                        @foreach($cityFaqs as $i => $faq)
                        <div class="city-faq-item">
                            <button class="city-faq-btn {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#cfaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                                {{ $faq['q'] }}
                                <div class="city-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div>
                            </button>
                            <div id="cfaq{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}" data-parent="#cityFaqAccordion">
                                <div class="city-faq-body">{{ $faq['a'] }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bottom CTA --}}
    <section style="background:linear-gradient(135deg,var(--accent-gold) 0%,#f4b942 100%);padding:50px 0;">
        <div class="container text-center">
            <h2 class="font-weight-bold mb-3" style="color:#0f1923;">Need Help Booking Your {{ $cityName }} GAMCA Appointment?</h2>
            <p class="mb-4" style="color:#1a252f;max-width:600px;margin:0 auto 24px;">Our team is ready to help with appointment booking, token issues, center selection, and medical guidance.</p>
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center" style="gap:12px;">
                <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-lg px-5 py-3 font-weight-bold">
                    <i class="fas fa-calendar-check mr-2"></i>Book Appointment Now
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+GAMCA+appointment+in+{{ urlencode($cityName) }}." target="_blank" class="btn btn-outline-dark btn-lg px-5 py-3 font-weight-bold">
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp Support
                </a>
            </div>
        </div>
    </section>

    {{-- Structured Data for SEO --}}
    @push('head')
        <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "ItemList",
              "itemListElement": [
                @foreach($centers as $index => $center)
                    {
                      "@type": "ListItem",
                      "position": {{ $index + 1 }},
                      "item": {
                        "@type": "MedicalOrganization",
                        "name": "{{ $center->medical_center }}",
                        "address": {
                          "@type": "PostalAddress",
                          "streetAddress": "{{ $center->address_line_1 }}",
                          "addressLocality": "{{ $cityName }}",
                          "addressCountry": "PK"
                        },
                        "telephone": "{{ $center->phone }}"
                      }
                    }{{ $loop->last ? '' : ',' }}
                @endforeach
              ]
            }
            </script>
        <style>
            :root {
                --theme-color: #FFC654;
                --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            }

            .bg-light-grey { background-color: #f8f9fa; }
            .text-theme { color: var(--theme-color) !important; }
            .btn-theme { background-color: var(--theme-color); color: #000; border: none; transition: var(--transition); }
            .btn-theme:hover { background-color: #e5b24b; color: #000; transform: translateY(-2px); }
            .badge-theme { background-color: var(--theme-color); color: #000; }
            .transition-hover { transition: var(--transition); }
            .transition-hover:hover { transform: translateY(-10px); box-shadow: 0 15px 45px rgba(0,0,0,0.12) !important; }

            /* SEO Content Styles */
            .city-section-label { display:block;color:var(--accent-gold);font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px; }
            .city-section-title { font-size:1.7rem;font-weight:800;color:#1a252f;margin-bottom:1rem; }
            .city-check-item { display:flex;align-items:flex-start;gap:10px;color:#495057; }
            .city-check-item i { color:#28a745;margin-top:2px;flex-shrink:0; }
            .city-info-card { background:#fff;border:1px solid #e8ecf0;border-radius:14px;overflow:hidden; }
            .city-info-card-header { background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);color:var(--accent-gold);font-weight:700;font-size:.95rem;padding:16px 20px; }
            .city-mini-item { display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f0f4f8; }
            .city-mini-item:last-child { border-bottom:none; }
            .city-steps-strip { background:#f7f8fc;border:1px solid #e8ecf0;border-radius:14px;padding:24px; }
            .city-step-item { display:flex;align-items:center;gap:12px;background:#fff;border:1px solid #e8ecf0;border-radius:10px;padding:12px 14px; }
            .city-step-num { width:28px;height:28px;background:var(--accent-gold);color:#0f1923;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;flex-shrink:0; }
            .city-doc-item { display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid #f0f4f8; }
            .city-doc-item:last-child { border-bottom:none; }
            .city-mistake-item { display:flex;align-items:center;padding:12px 0;border-bottom:1px solid #f0f4f8; }
            .city-mistake-item:last-child { border-bottom:none; }
            .city-other-pill { display:inline-flex;align-items:center;gap:5px;background:#f0f4f8;border:1px solid #dde3ea;border-radius:20px;padding:6px 14px;font-size:.82rem;font-weight:600;color:#1a252f;text-decoration:none;transition:all .2s ease; }
            .city-other-pill:hover { background:var(--accent-gold);border-color:var(--accent-gold);color:#0f1923;text-decoration:none; }
            .city-faq-item { background:#fff;border:1px solid #e8ecf0;border-radius:12px;margin-bottom:12px;overflow:hidden;transition:border-color .3s; }
            .city-faq-item:hover { border-color:var(--accent-gold); }
            .city-faq-btn { width:100%;text-align:left;background:transparent;border:none;padding:18px 22px;font-weight:600;font-size:.9rem;color:#1a252f;display:flex;justify-content:space-between;align-items:center;cursor:pointer; }
            .city-faq-icon { width:28px;height:28px;background:#f8f9fa;border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--accent-gold);flex-shrink:0;margin-left:10px;transition:all .3s ease; }
            .city-faq-btn[aria-expanded="true"] .city-faq-icon { background:var(--accent-gold);color:#fff;transform:rotate(180deg); }
            .city-faq-body { padding:0 22px 18px;color:#6c757d;font-size:.88rem;line-height:1.8; }
        </style>
    @endpush
@endsection

@push('schema')
,{
    "@type": "WebPage",
    "@id": "{{ url()->current() }}#webpage",
    "name": "GAMCA Medical Centers in {{ $cityName }} | WAFID Appointment & Token Booking",
    "url": "{{ url()->current() }}",
    "description": "Find approved GAMCA medical centers in {{ $cityName }}. Book WAFID appointment, check fees, documents, and get your medical slip online for GCC visa.",
    "isPartOf": { "@id": "{{ url('/') }}#website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
            { "@type": "ListItem", "position": 2, "name": "GAMCA Centers in {{ $cityName }}", "item": "{{ url()->current() }}" }
        ]
    }
}
,{
    "@type": "FAQPage",
    "@id": "{{ url()->current() }}#faqpage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "Are GAMCA centers available in {{ $cityName }}?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, there are approved WAFID medical centers for GCC medical tests in {{ $cityName }}. Browse the list on this page to find the nearest one." }
        },
        {
            "@type": "Question",
            "name": "Can I choose my center in {{ $cityName }}?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, with our premium Choice Center service you can select your preferred clinic in {{ $cityName }}." }
        },
        {
            "@type": "Question",
            "name": "Is appointment required before visiting a GAMCA center?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, a GAMCA/WAFID token is mandatory before visiting any medical center. You cannot walk in without a valid appointment slip." }
        },
        {
            "@type": "Question",
            "name": "How fast are GAMCA medical results available?",
            "acceptedAnswer": { "@type": "Answer", "text": "Usually within 24-48 hours after your medical test. You can check your status online using your passport number." }
        }
    ]
}
@endpush
