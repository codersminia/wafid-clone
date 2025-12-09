<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Wafid - Employment and residency services for Gulf Cooperation Council States">
    <meta name="keywords" content="employment, residency, medical examination, Gulf, GCC">
    <meta name="author" content="Wafid">
    <meta property="og:title" content="Wafid - Welcome">
    <meta property="og:description" content="Wafid is an individual seeking employment or residency in any of The Gulf Cooperation Council States.">
    <meta property="og:type" content="website">

    <title>@yield('title', 'Wafid - Employment & Residency Services')</title>
    
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/public/css/style.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/public/images/white-logo.svg') }}" alt="Wafid Logo" height="40" class="mr-2">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown">Services</a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="{{ route('medicalExamination')}}">Medical Examinations</a>
                            <a class="dropdown-item" href="medical-centers.html">Medical Centers</a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('guidelines') }}">Guidelines</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contactus')}}">Contact</a></li>
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
                    <h5>About Wafid</h5>
                    <p>Providing employment and residency services for Gulf Cooperation Council States.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li><a href="{{ route('guidelines') }}" class="text-white-50">Guidelines</a></li>
                        <li><a href="{{ route('faq') }}" class="text-white-50">FAQ</a></li>
                        <li><a href="{{ route('contactus') }}" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Contact Info</h5>
                    <p class="text-white-50">
                        <i class="fas fa-phone"></i> +966 XX XXX XXXX<br>
                        <i class="fas fa-envelope"></i> info@wafid.com
                    </p>
                </div>
            </div>
            <hr class="bg-white-50">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-white-50 mb-0">&copy; 2025 Wafid.com All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-right">
                    <a href="#" class="text-white-50 mr-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white-50 mr-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white-50"><i class="fab fa-linkedin"></i></a>
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
    <a href="https://wa.me/966xxxxxxxxxx" target="_blank" class="whatsapp-btn" title="Chat with us on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    @stack('scripts')
</body>
</html>
