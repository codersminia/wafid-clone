<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Dynamic SEO Tags --}}
    <title>@yield('title', 'Gulf Medical Consultant - GCC Appointments & Services')</title>
    <meta name="description"
        content="@yield('meta_description', 'Secure online booking for Wafid (GAMCA) medical slips, NAVTTC Takamol skill tests, and Tasheer Saudi visa appointments. Pay via JazzCash/Easypaisa.')">
    <meta name="keywords"
        content="@yield('meta_keywords', 'gamca appointment pakistan, wafid online booking, navttc saudi test, tasheer appointment check, gamca medical fee, gamca lahore, gamca karachi')">

    {{-- Geo-Tagging (Crucial for Local SEO in Pakistan/India) --}}
    <meta name="geo.region" content="PK" />
    <meta name="geo.position" content="30.3753;69.3451" />
    <meta name="ICBM" content="30.3753, 69.3451" />

    {{-- Open Graph for WhatsApp/Facebook Sharing --}}
    <meta property="og:site_name" content="Gulf Medical Consultant">
    <meta property="og:title" content="@yield('title', 'Gulf Medical Consultant')">
    <meta property="og:description" content="@yield('meta_description', 'Book your medical appointments easily.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    {{-- Canonical Link (Prevents duplicate content issues) --}}
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Bootstrap & CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/public/css/style.css') }}">

    @stack('head')

    {{-- Add Schema Markup for Local Business --}}
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "{{ $settings['site_name'] ?? 'Gulf Medical Consultant' }}",
            "url": "https://gamcawafidonline.com",
            "logo": "{{ isset($settings['logo']) ? asset($settings['logo']) : asset('assets/public/images/white-logo.svg') }}",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+923000000000",
                "contactType": "customer service"
            },
            "department": [
                {
                    "@type": "ProfessionalService",
                    "name": "Gulf Medical Consultant - Lahore",
                    "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "Office 123, Ferozepur Road",
                        "addressLocality": "Lahore",
                        "addressCountry": "PK"
                    }
                },
                {
                    "@type": "ProfessionalService",
                    "name": "Gulf Medical Consultant - Karachi",
                    "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "Suite 405, Shahrah-e-Faisal",
                        "addressLocality": "Karachi",
                        "addressCountry": "PK"
                    }
                }
                // Add other 2 locations here...
            ]
        }
    </script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ isset($settings['logo']) ? asset($settings['logo']) : asset('assets/public/images/white-logo.svg') }}"
                    alt="{{ $settings['site_name'] ?? 'Logo' }}" height="auto" width="150" class="mr-2">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                            data-toggle="dropdown">Services</a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="{{ route('medicalExamination')}}">Wafid (GAMCA) Medical</a>
                            <a class="dropdown-item" href="{{ route('special.appointment')}}">Wafid Choice Center</a>
                            <a class="dropdown-item" href="{{ route('navtechform')}}">NAVTTC / Takamol Appointment</a>
                            <a class="dropdown-item" href="{{ route('tasheer.form')}}">Tasheer Appointment</a>
                            <a class="dropdown-item" href="{{ route('softskill.form')}}">Soft Skill Certificate</a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('guidelines') }}">Guidelines</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact')}}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about')}}">About</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <h5>About {{ $settings['site_name'] ?? 'Wafid' }}</h5>
                    <p>{{ $settings['footer_text'] ?? 'Providing employment and residency services for Gulf Cooperation Council States.' }}
                    </p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li><a href="{{ route('guidelines') }}" class="text-white-50">Guidelines</a></li>
                        <li><a href="{{ route('faq') }}" class="text-white-50">FAQ</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Contact Info</h5>
                    <p class="text-white-50">
                        <i class="fas fa-phone"></i> {{ $settings['site_phone'] ?? '+966 XX XXX XXXX' }}<br>
                        <i class="fas fa-envelope"></i> {{ $settings['site_email'] ?? 'info@wafid.com' }}
                    </p>
                </div>
            </div>
            <hr class="bg-white-50">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-white-50 mb-0">&copy; 2025 Wafid.com All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-right">
                    @if(!empty($settings['social_facebook'])) <a href="{{ $settings['social_facebook'] }}"
                    target="_blank" class="text-white-50 mr-3"><i class="fab fa-facebook"></i></a> @endif
                    @if(!empty($settings['social_twitter'])) <a href="{{ $settings['social_twitter'] }}" target="_blank"
                    class="text-white-50 mr-3"><i class="fab fa-twitter"></i></a> @endif
                    @if(!empty($settings['social_linkedin'])) <a href="{{ $settings['social_linkedin'] }}"
                    target="_blank" class="text-white-50 mr-3"><i class="fab fa-linkedin"></i></a> @endif
                    @if(!empty($settings['social_instagram'])) <a href="{{ $settings['social_instagram'] }}"
                    target="_blank" class="text-white-50 mr-3"><i class="fab fa-instagram"></i></a> @endif
                    @if(!empty($settings['social_tiktok'])) <a href="{{ $settings['social_tiktok'] }}" target="_blank"
                    class="text-white-50"><i class="fab fa-tiktok"></i></a> @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="footer-disclaimer-box">
                        <p>
                            <strong>Disclaimer:</strong> GamcaWafidOnline.com is a private consultancy service. We are
                            not the official Wafid, NAVTTC, or Tasheer government website. We charge a service fee to
                            assist users in booking appointments and processing paperwork. You can book directly on the
                            official websites if you possess the technical knowledge and payment methods.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.9/dist/jquery.inputmask.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/public/js/script.js') }}"></script>

    <!-- WhatsApp floating button -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '966xxxxxxxxxx') }}"
        target="_blank" class="whatsapp-btn" title="Chat with us on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    @stack('scripts')
</body>

</html>