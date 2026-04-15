@extends('layouts.public')

@section('title', 'Contact Us | GAMCA WAFID Medical Appointment Support Pakistan')
@section('meta_description', 'Contact Gulf Medical Consultants for GAMCA/WAFID medical bookings. WhatsApp, call, or email for fast assistance and instant QR slip delivery. Book now.')
@section('meta_keywords', 'contact GAMCA support Pakistan, WAFID medical appointment help, GAMCA booking WhatsApp, Gulf medical consultant contact, WAFID token support')

@push('schema')
,{
    "@type": "ContactPage",
    "@id": "{{ url()->current() }}#contact",
    "mainEntity": { "@id": "{{ url('/') }}#organization" }
},
{
    "@type": "LocalBusiness",
    "@id": "{{ url('/') }}#localbusiness",
    "name": "{{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}",
    "url": "{{ url('/') }}",
    "telephone": "{{ $settings['site_phone'] ?? '' }}",
    "email": "{{ $settings['site_email'] ?? '' }}",
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "PK",
        "addressLocality": "{{ $settings['site_address'] ?? 'Pakistan' }}"
    },
    "openingHours": "Mo-Sa 09:00-22:00",
    "priceRange": "PKR",
    "description": "GAMCA and WAFID medical appointment booking service for GCC countries from Pakistan."
},
{
    "@type": "FAQPage",
    "mainEntity": [
        {"@type":"Question","name":"How quickly can I get my GAMCA/WAFID slip?","acceptedAnswer":{"@type":"Answer","text":"Usually within 30 minutes after booking confirmation and payment."}},
        {"@type":"Question","name":"Can families book GAMCA appointments together?","acceptedAnswer":{"@type":"Answer","text":"Yes, we can coordinate multiple appointments for family members at the same time."}},
        {"@type":"Question","name":"Do I need a local number for WhatsApp booking?","acceptedAnswer":{"@type":"Answer","text":"For faster OTP verification and communication, a reachable Pakistani number is preferred."}},
        {"@type":"Question","name":"Can I reschedule my GAMCA appointment?","acceptedAnswer":{"@type":"Answer","text":"Yes, rescheduling is possible before the cutoff time. Contact us via WhatsApp or call to handle all changes."}}
    ]
}
@endpush

@push('head')
<style>
    /* ── Hero ── */
    .contact-hero {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        padding: 60px 0 48px;
    }
    .contact-hero h1 { color: #fff; font-size: 2.1rem; font-weight: 800; }
    .contact-hero p  { color: rgba(255,255,255,.78); font-size: 1rem; max-width: 620px; }
    .contact-hero-badge {
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
    /* ── Above-fold CTA strip ── */
    .contact-cta-strip {
        background: var(--accent-gold);
        padding: 14px 0;
    }
    /* ── Channel cards ── */
    .contact-channel-card {
        background: #fff;
        border: 1px solid #e8ecf0;
        border-radius: 14px;
        padding: 28px 20px;
        text-align: center;
        height: 100%;
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }
    .contact-channel-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(0,0,0,.08);
        border-color: var(--accent-gold);
    }
    .contact-channel-icon {
        width: 60px; height: 60px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 16px;
    }
    .contact-channel-card h5 { font-size: 1rem; font-weight: 700; color: #1a252f; }
    /* ── Why contact us ── */
    .why-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid #f0f4f8;
    }
    .why-contact-item:last-child { border-bottom: none; }
    .why-contact-icon {
        width: 40px; height: 40px;
        background: #fff8e1;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: var(--accent-gold);
        flex-shrink: 0;
    }
    /* ── GCC country links ── */
    .gcc-link-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f0f4f8;
        border: 1px solid #dde3ea;
        border-radius: 20px;
        padding: 6px 14px;
        font-size: .82rem;
        font-weight: 600;
        color: #1a252f;
        text-decoration: none;
        transition: all .2s ease;
        margin: 4px 3px;
    }
    .gcc-link-pill:hover {
        background: var(--accent-gold);
        border-color: var(--accent-gold);
        color: #0f1923;
        text-decoration: none;
    }
    /* ── Contact FAQ ── */
    .contact-faq-item { border: 1px solid #e8ecf0; border-radius: 10px; margin-bottom: 10px; overflow: hidden; }
    .contact-faq-btn {
        width: 100%; text-align: left; background: #fff; border: none;
        padding: 15px 20px; font-weight: 600; font-size: .9rem; color: #1a252f;
        display: flex; justify-content: space-between; align-items: center; cursor: pointer;
    }
    .contact-faq-btn .faq-icon { transition: transform .3s; color: var(--accent-gold); }
    .contact-faq-btn[aria-expanded="true"] .faq-icon { transform: rotate(180deg); }
    .contact-faq-body { padding: 0 20px 14px; color: #6c757d; font-size: .88rem; }
    /* ── Location tabs ── */
    .custom-location-tabs .nav-link {
        background-color: #fff; color: #333; transition: all 0.3s;
        border: 1px solid #eee; border-left: 5px solid transparent;
    }
    .custom-location-tabs .nav-link:hover { background-color: #f8f9fa; transform: translateX(5px); }
    .custom-location-tabs .nav-link.active {
        background-color: #1a252f !important; color: #fff !important;
        border-color: #1a252f !important; border-left: 5px solid var(--accent-gold) !important;
        transform: translateX(5px); box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .custom-location-tabs .nav-link.active small { color: rgba(255,255,255,0.8) !important; }
    .custom-location-tabs .nav-link.active h5 { color: #fff !important; }
    .faq-item a[aria-expanded="true"] .transition-icon { transform: rotate(180deg); }
    .faq-item .transition-icon { transition: transform 0.3s ease; }
    @media(max-width:767px) { .contact-hero h1 { font-size: 1.65rem; } }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="contact-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">Contact Us</li>
            </ol>
        </nav>
        <span class="contact-hero-badge">Support</span>
        <h1 class="mt-2 mb-3">Contact Us – GAMCA &amp; WAFID Medical Support Pakistan</h1>
        <p class="mb-4">We are here to help you with GAMCA &amp; WAFID medical appointment bookings for <strong style="color:var(--accent-gold)">Saudi Arabia, UAE, Oman, Kuwait, Qatar, and Bahrain</strong>. Bilingual support, instant confirmations, and step-by-step guidance — 7 days a week.</p>
        <div class="d-flex flex-wrap" style="gap:10px;">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GAMCA+medical+booking." target="_blank" class="btn btn-warning font-weight-bold px-4 py-2" style="color:#0f1923;">
                <i class="fab fa-whatsapp mr-2"></i>WhatsApp Now
            </a>
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['site_phone'] ?? '') }}" class="btn btn-outline-light px-4 py-2">
                <i class="fas fa-phone mr-2"></i>Call Us
            </a>
        </div>
    </div>
</section>

{{-- CHANNEL CARDS --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="contact-channel-card">
                    <div class="contact-channel-icon" style="background:#e8f5e9;"><i class="fab fa-whatsapp" style="color:#25d366;"></i></div>
                    <h5>WhatsApp – Fastest Response</h5>
                    <p class="text-muted small mb-3">Share your details, preferred GCC country, and appointment type for same-day support.</p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GAMCA+medical+booking." target="_blank" class="btn btn-success btn-sm px-4 font-weight-bold">
                        <i class="fab fa-whatsapp mr-1"></i>Chat Now
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="contact-channel-card">
                    <div class="contact-channel-icon" style="background:#fff8e1;"><i class="fas fa-phone-alt" style="color:var(--accent-gold);"></i></div>
                    <h5>Call – Speak With a Coordinator</h5>
                    <p class="text-muted small mb-3">Available during business hours. Call to schedule your appointment or get answers to any GAMCA/WAFID queries.</p>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['site_phone'] ?? '') }}" class="btn btn-dark btn-sm px-4 font-weight-bold">
                        <i class="fas fa-phone mr-1"></i>{{ $settings['site_phone'] ?? '+92 XXX XXXXXXX' }}
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="contact-channel-card">
                    <div class="contact-channel-icon" style="background:#e8f0fe;"><i class="fas fa-envelope" style="color:#1a73e8;"></i></div>
                    <h5>Email – Detailed Queries</h5>
                    <p class="text-muted small mb-3">Attach your passport copy, previous medical reports, and travel dates for quicker assistance.</p>
                    <a href="mailto:{{ $settings['site_email'] ?? 'info@example.com' }}" class="btn btn-outline-dark btn-sm px-4 font-weight-bold">
                        <i class="fas fa-envelope mr-1"></i>Send Email
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center mt-2">
            <p class="text-muted small mb-2">We support GAMCA/WAFID bookings for all GCC countries:</p>
            <a href="{{ route('public.gcc.country', 'saudi-arabia') }}" class="gcc-link-pill">🇸🇦 Saudi Arabia</a>
            <a href="{{ route('public.gcc.country', 'uae') }}" class="gcc-link-pill">🇦🇪 UAE</a>
            <a href="{{ route('public.gcc.country', 'qatar') }}" class="gcc-link-pill">🇶🇦 Qatar</a>
            <a href="{{ route('public.gcc.country', 'oman') }}" class="gcc-link-pill">🇴🇲 Oman</a>
            <a href="{{ route('public.gcc.country', 'kuwait') }}" class="gcc-link-pill">🇰🇼 Kuwait</a>
            <a href="{{ route('public.gcc.country', 'bahrain') }}" class="gcc-link-pill">🇧🇭 Bahrain</a>
        </div>
    </div>
</section>

{{-- FORM + SIDEBAR --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="row">
            {{-- Contact Form --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0" style="border-radius:14px;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="font-weight-bold m-0" id="formTitle" style="font-size:1.3rem;">Send Us a Message</h2>
                        </div>
                        
                        <!-- Contact Form -->
                        <form id="contactForm"> 
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold small">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="As per passport" maxlength="100" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold small">Mobile / WhatsApp Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="0300 1234567" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="font-weight-bold small">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" maxlength="100" required>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small">Subject <span class="text-danger">*</span></label>
                                <select class="form-control custom-select p-2" name="subject" required>
                                    <option value="" selected disabled>Select Subject...</option>
                                    <option value="Saudi Arabia – GAMCA Medical">🇸🇦 Saudi Arabia – GAMCA Medical</option>
                                    <option value="UAE – Visa Medical">🇦🇪 UAE – Visa Medical</option>
                                    <option value="Qatar – WAFID Token">🇶🇦 Qatar – WAFID Token</option>
                                    <option value="Oman – WAFID Token">🇴🇲 Oman – WAFID Token</option>
                                    <option value="Kuwait – WAFID Token">🇰🇼 Kuwait – WAFID Token</option>
                                    <option value="Bahrain – WAFID Token">🇧🇭 Bahrain – WAFID Token</option>
                                    <option value="NAVTTC Booking">NAVTTC / Takamol Registration</option>
                                    <option value="Tasheer/Visa">Tasheer Visa Center Appointment</option>
                                    <option value="Payment">Payment Verification</option>
                                    <option value="Other">Other Inquiry</option>
                                </select>
                            </div>
                            </div>
                            <div class="mb-3">
                                <label class="font-weight-bold small">Message / Query <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="message" rows="6" placeholder="Describe your query or booking details..." maxlength="1000" required></textarea>
                            </div>
                            
                            <!-- Quick Tips -->
                            <div class="alert alert-light border mb-4" style="background:#f8f9fa;">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-lightbulb mr-3 mt-1" style="color:var(--accent-gold);font-size:1.2rem;"></i>
                                    <div>
                                        <h6 class="font-weight-bold mb-2">Quick Tips for Faster Response:</h6>
                                        <ul class="small text-muted mb-0 pl-3" style="line-height:1.8;">
                                            <li>Include your passport number if available</li>
                                            <li>Mention your preferred appointment date</li>
                                            <li>Specify if you need family bookings</li>
                                            <li>For urgent requests, use WhatsApp for instant support</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" id="submitBtn" class="btn btn-dark px-5 mt-1 font-weight-bold">
                                <span id="btnText"><i class="fas fa-paper-plane mr-2"></i>Get Assistance Now</span>
                                <span id="btnLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </form>


                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4 mt-4 mt-lg-0">

                {{-- Why Contact Us --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius:14px;">
                    <div class="card-body p-4">
                        <h3 class="font-weight-bold mb-3" style="font-size:1rem;">
                            <i class="fas fa-star mr-2" style="color:var(--accent-gold);"></i>Why Contact Us?
                        </h3>
                        @php $whyPoints = [
                            ['icon'=>'fas fa-bolt',          'text'=>'Instant GAMCA/WAFID token confirmations'],
                            ['icon'=>'fas fa-language',      'text'=>'Bilingual instructions and reminders'],
                            ['icon'=>'fas fa-clock',         'text'=>'Time-zone aware appointment scheduling'],
                            ['icon'=>'fas fa-file-alt',      'text'=>'Guidance on documents, fasting & vaccination'],
                            ['icon'=>'fas fa-calendar-check','text'=>'Same-day and next-day bookings available'],
                        ]; @endphp
                        @foreach($whyPoints as $pt)
                        <div class="why-contact-item">
                            <div class="why-contact-icon"><i class="{{ $pt['icon'] }} fa-sm"></i></div>
                            <span class="small text-muted" style="padding-top:4px;">{{ $pt['text'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Dynamic Common Questions -->
                <div class="card bg-white border-0 shadow-sm mb-4 overflow-hidden" style="border-radius:14px;">
                    <div class="card-body p-4">
                        <h3 class="font-weight-bold mb-3" style="font-size:1rem;">
                            <i class="far fa-question-circle mr-2" style="color:var(--accent-gold);"></i>Common Questions
                        </h3>
                        <ul class="list-unstyled mt-2" id="sidebarFaq">
                            @forelse($faqs as $faq)
                                <li class="border-bottom py-3">
                                    <div class="faq-item">
                                        <a href="#faq-collapse-{{ $faq->id }}" data-toggle="collapse" class="text-dark d-flex justify-content-between align-items-center text-decoration-none hover-primary collapsed" aria-expanded="false">
                                            <span class="small font-weight-bold">{{ $faq->question }}</span>
                                            <i class="fas fa-chevron-down text-muted transition-icon ml-2 flex-shrink-0" style="font-size:.7rem;"></i>
                                        </a>
                                        <div class="collapse mt-2" id="faq-collapse-{{ $faq->id }}" data-parent="#sidebarFaq">
                                            <div class="small text-muted leading-relaxed">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="text-muted small">No frequent questions found.</li>
                            @endforelse
                        </ul>
                        <a href="{{ route('faq') }}" class="btn btn-link btn-sm p-0 mt-3 font-weight-bold">View all FAQs →</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

{{-- CONTACT FAQ (SEO) --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <h6 class="text-uppercase font-weight-bold" style="color:var(--accent-gold);letter-spacing:1px;">FAQ</h6>
                    <h2 class="font-weight-bold text-dark">GAMCA &amp; WAFID Booking – Frequently Asked Questions</h2>
                </div>
                <div id="contactFaqAccordion">
                    @php $contactFaqs = [
                        ['q'=>'How quickly can I get my GAMCA/WAFID slip?',    'a'=>'Usually within 30 minutes after booking confirmation and payment. We deliver your official appointment slip as a PDF directly to your WhatsApp.'],
                        ['q'=>'Can families book GAMCA appointments together?', 'a'=>'Yes, we can coordinate multiple appointments for family members at the same time. Contact us via WhatsApp with all passport details.'],
                        ['q'=>'Do I need a local number for WhatsApp booking?', 'a'=>'For faster OTP verification and communication, a reachable Pakistani number is preferred. International numbers are also accepted.'],
                        ['q'=>'Can I reschedule my GAMCA appointment?',         'a'=>'Yes, rescheduling is possible before the cutoff time. We handle all changes via WhatsApp or call — just contact us as early as possible.'],
                    ]; @endphp
                    @foreach($contactFaqs as $i => $faq)
                    <div class="contact-faq-item">
                        <button class="contact-faq-btn {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                            data-toggle="collapse" data-target="#cfaq{{ $i }}"
                            aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                            {{ $faq['q'] }}
                            <i class="fas fa-chevron-down faq-icon"></i>
                        </button>
                        <div id="cfaq{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}" data-parent="#contactFaqAccordion">
                            <div class="contact-faq-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
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
            <p class="text-muted">We have physical presence in Gujranwala city for your convenience.</p>
            <div class="theme-divider"></div>
        </div>

        <div class="row">
            @php
                $offices = isset($settings['office_locations']) ? json_decode($settings['office_locations'], true) : [];
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
                                        <h5 class="mb-0 text-dark">{{ $office['title'] ?? 'Office' }}</h5>
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
                                            
                                            <!-- Optional: Directions link if you store coordinates or separate link, assuming map_url can serve or add another field -->
                                            <!-- Just linking to google maps general if url is embed, extracting might be hard. -->
                                            
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Apply mask
    $('#phone').inputmask('9999 9999999', {
        clearMaskOnLostFocus: true
    });

    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');

    // Function to wipe away all red borders and error messages
    function clearFormErrors(f) {
        f.classList.remove('was-validated'); 
        f.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        f.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        // 1. Clear old errors
        clearFormErrors(form);

        // UI Loading state
        submitBtn.disabled = true;
        btnText.innerText = "Sending...";
        btnLoader.classList.remove('d-none');

        const formData = new FormData(form);

        try {
            const response = await fetch("{{ route('contact.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData
            });

            const data = await response.json();

            if (response.status === 422) {
                // Handle Validation Errors
                Object.keys(data.errors).forEach(field => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('is-invalid');
                        const error = document.createElement('div');
                        error.className = 'invalid-feedback';
                        error.innerText = data.errors[field][0];
                        input.parentNode.appendChild(error);
                    }
                });
            } else if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent!',
                    text: data.message,
                    confirmButtonColor: '#343a40'
                });

                form.reset();      
                clearFormErrors(form);    
            }
        } catch (err) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong. Please try again later.'
            });
        } finally {
            // Reset Button
            submitBtn.disabled = false;
            btnText.innerText = "Submit Query";
            btnLoader.classList.add('d-none');
        }
    });

    // --- END CONTACT LOGIC ---
});
</script>
@endpush
@endsection