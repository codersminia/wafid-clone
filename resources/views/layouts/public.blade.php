<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5RWFT77P');</script>
    <!-- End Google Tag Manager -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Preconnect to CDN origins for faster resource loading --}}
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://code.jquery.com" crossorigin>
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">

    {{-- Dynamic SEO Tags --}}
    <title>@yield('title', 'Gulf Medical Consultant - GCC Appointments & Services')</title>
    <meta name="description"
        content="@yield('meta_description', 'Secure online booking for Wafid (GAMCA) medical slips, NAVTTC Takamol skill tests, and Tasheer Saudi visa appointments. Pay via JazzCash/Easypaisa.')">
    <meta name="keywords"
        content="@yield('meta_keywords', 'gamca appointment pakistan, wafid online booking, navttc saudi test, tasheer appointment check, gamca medical fee, gamca lahore, gamca karachi')">

    {{-- Schema.org / Search Preview --}}
    <meta itemprop="name" content="@yield('title')">
    <meta itemprop="description" content="@yield('meta_description')">
    <meta itemprop="image"
        content="@yield('og_image', isset($settings['logo']) ? asset($settings['logo']) : asset('assets/public/images/gulf-medical-logo.png'))">

    {{-- Geo-Tagging (Crucial for Local SEO in Pakistan/India) --}}
    <meta name="geo.region" content="PK" />
    <meta name="geo.position" content="30.3753;69.3451" />
    <meta name="ICBM" content="30.3753, 69.3451" />

    {{-- Open Graph for WhatsApp/Facebook Sharing --}}
    <meta property="og:site_name" content="{{ $settings['site_name'] ?? 'Gulf Medical Consultant' }}">
    <meta property="og:title" content="@yield('title', 'Gulf Medical Consultant')">
    <meta property="og:description" content="@yield('meta_description', 'Book your medical appointments easily.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image"
        content="@yield('og_image', isset($settings['logo']) ? asset($settings['logo']) : asset('assets/public/images/gulf-medical-logo.png'))">
    <meta property="og:image:secure_url"
        content="@yield('og_image', isset($settings['logo']) ? asset($settings['logo']) : asset('assets/public/images/gulf-medical-logo.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    {{-- Twitter Cards --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Gulf Medical Consultant')">
    <meta name="twitter:description" content="@yield('meta_description', 'Book your medical appointments easily.')">
    <meta name="twitter:image"
        content="@yield('og_image', isset($settings['logo']) ? asset($settings['logo']) : asset('assets/public/images/gulf-medical-logo.png'))">

    {{-- Canonical Link (Prevents duplicate content issues) --}}
    @if(request()->has('page') || request()->has('search') || request()->has('category'))
    <link rel="canonical" href="{{ url()->current() }}" />
    @else
    <link rel="canonical" href="{{ url()->current() }}" />
    @endif
    {{-- Pagination rel links for blog --}}
    @stack('pagination_links')

    <link rel="shortcut icon"
        href="{{ isset($settings['favicon']) ? asset($settings['favicon']) : asset('assets/public/images/favicon.png') }}" />

    <!-- Critical CSS: Bootstrap & FontAwesome loaded non-render-blocking -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"></noscript>

    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>

    <!-- Site CSS (critical, loaded normally) -->
    <link rel="stylesheet" href="{{ asset('assets/public/css/style.css') }}">

    <!-- Critical inline CSS to prevent FOUC while Bootstrap loads async -->
    <style>
        *{box-sizing:border-box}
        body{margin:0;font-family:"Segoe UI",Tahoma,Geneva,Verdana,sans-serif;overflow-x:hidden}
        .site-navbar{background:linear-gradient(90deg,#0f1923 0%,#1a252f 100%);padding:.6rem 0;position:sticky;top:0;z-index:1050}
        .container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}
        @media(min-width:576px){.container{max-width:540px}}
        @media(min-width:768px){.container{max-width:720px}}
        @media(min-width:992px){.container{max-width:960px}}
        @media(min-width:1200px){.container{max-width:1140px}}
        img{max-width:100%;height:auto}
        .sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
    </style>

    {{-- Preload above-the-fold assets --}}
    <link rel="preload" as="image" href="{{ isset($settings['logo']) ? asset($settings['logo']) : asset('assets/public/images/gulf-medical-logo.png') }}" fetchpriority="high" imagesizes="(max-width: 991px) 160px, 200px">

    @stack('head')

    {{-- Global Schema Markup (Organization & WebSite) --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Organization",
                "@id": "{{ url('/') }}#organization",
                "name": "{{ $settings['site_name'] ?? 'Gulf Medical Consultant' }}",
                "url": "{{ url('/') }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ isset($settings['favicon']) ? asset($settings['favicon']) : asset('assets/public/images/favicon.png') }}"
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "{{ $settings['site_phone'] ?? '' }}",
                    "contactType": "customer service"
                }
            },
            {
                "@type": "WebSite",
                "@id": "{{ url('/') }}#website",
                "url": "{{ url('/') }}",
                "name": "{{ $settings['site_name'] ?? 'Gulf Medical Consultant' }}",
                "publisher": { "@id": "{{ url('/') }}#organization" }
            },
            {
                "@type": "BreadcrumbList",
                "@id": "{{ url()->current() }}#breadcrumb",
                "itemListElement": [
                    {
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Home",
                        "item": "{{ url('/') }}"
                    }
                    @if(url()->current() != url('/'))
                        ,{
                            "@type": "ListItem",
                            "position": 2,
                            "name": "@yield('title')"
                        }
                    @endif
                ]
            }
            @stack('schema')
        ]
    }
    </script>
    <style>
        body {
            overflow-x: hidden !important;
        }
    </style>
</head>

<body style="overflow-x: hidden;">

    <!-- Skip to main content (keyboard accessibility) -->
    <a href="#main-content" class="sr-only sr-only-focusable" style="position:absolute;top:0;left:0;z-index:9999;padding:8px 16px;background:var(--accent-gold);color:#0f1923;font-weight:700;border-radius:0 0 4px 0;">Skip to main content</a>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RWFT77P"
    height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
     
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark site-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ isset($settings['logo']) ? asset($settings['logo']) : asset('assets/public/images/gulf-medical-logo.png') }}"
                    alt="{{ $settings['site_name'] ?? 'Logo' }}"
                    height="52" width="234" class="mr-2"
                    sizes="(max-width: 991px) 160px, 200px"
                    fetchpriority="high" loading="eager" decoding="sync">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown">Services</a>
                        <div class="dropdown-menu site-dropdown" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="{{ route('medicalExamination') }}">
                                <i class="fas fa-file-medical mr-2 text-accent"></i>Wafid (GAMCA) Medical
                            </a>
                            <a class="dropdown-item" href="{{ route('special.appointment') }}">
                                <i class="fas fa-hospital mr-2 text-accent"></i>Wafid Choice Center
                            </a>
                            <a class="dropdown-item" href="{{ route('navtechform') }}">
                                <i class="fas fa-tools mr-2 text-accent"></i>NAVTTC / Takamol
                            </a>
                            <a class="dropdown-item" href="{{ route('tasheer.form') }}">
                                <i class="fas fa-passport mr-2 text-accent"></i>Tasheer Appointment
                            </a>
                            <a class="dropdown-item" href="{{ route('softskill.form') }}">
                                <i class="fas fa-certificate mr-2 text-accent"></i>Soft Skill Certificate
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="centersDropdown" role="button" data-toggle="dropdown">Medical Centers</a>
                        <div class="dropdown-menu site-dropdown" aria-labelledby="centersDropdown">
                            @foreach($all_cities as $city)
                                <a class="dropdown-item" href="{{ route('public.medical.city', ['city' => strtolower(str_replace(' ', '-', $city))]) }}">
                                    <i class="fas fa-map-marker-alt mr-2 text-accent"></i>{{ $city }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('public.blogs') }}">Blogs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item ml-lg-3">
                        <a class="nav-link nav-cta-btn" href="{{ route('medicalExamination') }}" style="color:#0f1923 !important;">
                            <i class="fas fa-calendar-check mr-1" style="color:#0f1923 !important;"></i> Book Now
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main id="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <!-- Brand -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <img src="{{ isset($settings['logo']) ? asset($settings['logo']) : asset('assets/public/images/gulf-medical-logo.png') }}"
                            alt="{{ $settings['site_name'] ?? 'Gulf Medical' }}" height="50" class="mb-4"
                            loading="lazy" decoding="async">
                        <p class="footer-about">{{ $settings['footer_text'] ?? 'Providing employment and residency services for Gulf Cooperation Council States.' }}</p>
                        <div class="footer-socials mt-4">
                            @if(!empty($settings['social_facebook']))
                                <a href="{{ $settings['social_facebook'] }}" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                            @endif
                            @if(!empty($settings['social_twitter']))
                                <a href="{{ $settings['social_twitter'] }}" target="_blank" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                            @endif
                            @if(!empty($settings['social_instagram']))
                                <a href="{{ $settings['social_instagram'] }}" target="_blank" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                            @endif
                            @if(!empty($settings['social_linkedin']))
                                <a href="{{ $settings['social_linkedin'] }}" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                            @endif
                            @if(!empty($settings['social_tiktok']))
                                <a href="{{ $settings['social_tiktok'] }}" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok" aria-hidden="true"></i></a>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-2 col-md-6 mb-5">
                        <h6 class="footer-heading">Quick Links</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('medicalExamination') }}">GAMCA Medical</a></li>
                            <li><a href="{{ route('special.appointment') }}">Wafid Choice</a></li>
                            <li><a href="{{ route('navtechform') }}">NAVTTC Test</a></li>
                            <li><a href="{{ route('tasheer.form') }}">Tasheer Visa</a></li>
                            <li><a href="{{ route('softskill.form') }}">Soft Skills</a></li>
                            <li><a href="{{ route('review.page') }}" style="color:var(--accent-gold);font-weight:600;">Leave a Review</a></li>
                        </ul>
                    </div>

                    <!-- Info Links -->
                    <div class="col-lg-2 col-md-6 mb-5">
                        <h6 class="footer-heading">Information</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('public.blogs') }}">Blog</a></li>
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="{{ route('ViewMedicalCenters') }}">Medical Centers</a></li>
                            <li><a href="{{ route('ViewMedicalReport') }}">Check Status</a></li>
                            <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms.conditions') }}">Terms &amp; Conditions</a></li>
                            <li><a href="{{ route('refund.policy') }}">Refund Policy</a></li>
                            <li><a href="{{ route('disclaimer') }}">Disclaimer</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <h6 class="footer-heading">Get In Touch</h6>
                        <ul class="footer-contact-list">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($settings['site_address'] ?? '') }}" target="_blank">
                                    {{ $settings['site_address'] ?? 'Address not set' }}
                                </a>
                            </li>
                            <li>
                                <i class="fas fa-phone-alt"></i>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['site_phone'] ?? '') }}">
                                    {{ $settings['site_phone'] ?? '+92 XXX XXXXXXX' }}
                                </a>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:{{ $settings['site_email'] ?? 'info@wafid.com' }}">
                                    {{ $settings['site_email'] ?? 'info@wafid.com' }}
                                </a>
                            </li>
                        </ul>
                        <div class="footer-action-btns mt-4">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '') }}" target="_blank" class="footer-btn footer-btn-whatsapp">
                                <i class="fab fa-whatsapp"></i> WhatsApp Us
                            </a>
                            <a href="{{ route('medicalExamination') }}" class="footer-btn footer-btn-book">
                                <i class="fas fa-calendar-check"></i> Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="footer-disclaimer">
                    <strong>Disclaimer:</strong> {{ $settings['site_name'] ?? 'Gulf Medical Consultants' }} is a private consultancy service. We are not the official Wafid, NAVTTC, or Tasheer government website. We charge a service fee to assist users in booking appointments and processing paperwork.
                </div>
                <div class="footer-copyright">
                    <span>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Gulf Medical Consultants' }}. All rights reserved.</span>
                    <span class="mx-2">·</span>
                    <a href="{{ route('privacy.policy') }}" style="color:rgba(255,255,255,.8);font-size:.82rem;text-decoration:none;">Privacy Policy</a>
                    <span class="mx-2">·</span>
                    <a href="{{ route('terms.conditions') }}" style="color:rgba(255,255,255,.8);font-size:.82rem;text-decoration:none;">Terms &amp; Conditions</a>
                    <span class="mx-2">·</span>
                    <a href="{{ route('refund.policy') }}" style="color:rgba(255,255,255,.8);font-size:.82rem;text-decoration:none;">Refund Policy</a>
                    <span class="mx-2">·</span>
                    <a href="{{ route('disclaimer') }}" style="color:rgba(255,255,255,.8);font-size:.82rem;text-decoration:none;">Disclaimer</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS: jQuery first (sync, already at end of body so non-blocking) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap bundle and inputmask deferred after jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.9/dist/jquery.inputmask.min.js" defer></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/public/js/script.js') }}" defer></script>

    <!-- WhatsApp floating button -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hello!%20I%20need%20assistance%20with%20an%20appointment."
        target="_blank" class="whatsapp-btn" id="waTrackingBtn" title="Chat with us on WhatsApp">
        <span class="wa-label">Need Help?</span>
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        // 1. WhatsApp Tracking
        document.getElementById('waTrackingBtn').addEventListener('click', function () {
            fetch("{{ route('track.whatsapp') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            });
        });

        // 2. Visitor Tracking (Trigger on load after a short delay)
        window.addEventListener('load', function () {
            setTimeout(function () {
                fetch("{{ route('track.visitor') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        page_url: window.location.href,
                        referrer: document.referrer
                    })
                });
            }, 1000); // 1s delay to ensure accurate metrics
        });
    </script>

    @stack('scripts')
</body>

</html>