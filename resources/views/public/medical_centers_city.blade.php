@extends('layouts.public')

@section('title', "Wafid Approved Medical Centers in " . $cityName . " - " . ($settings['site_name'] ?? 'Gulf Medical Consultant'))
@section('meta_description', "Find the complete list of Wafid (GAMCA) approved medical centers in " . $cityName . ". Get verified addresses, phone numbers, and location maps for your medical examination.")
@section('meta_keywords', "medical centers in " . strtolower($cityName) . ", gamca approved clinics " . strtolower($cityName) . ", wafid medical " . strtolower($cityName) . ", gamca pakistan, medical test for saudi visa in " . strtolower($cityName))

@section('content')
    <!-- Hero Section -->
    <section class="page-title-section py-5"
        style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ $cityMedia && $cityMedia->hero_image ? asset($cityMedia->hero_image) : asset('assets/public/images/hero-bg.jpg') }}') center/cover no-repeat;">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-3">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Medical Centers in
                                {{ $cityName }}</li>
                        </ol>
                    </nav>
                    <h1 class="display-4 font-weight-bold text-white mb-3">Medical Centers in {{ $cityName }}</h1>
                    <p class="lead text-white-50 mb-0">
                        {{ $cityMedia && $cityMedia->description ? $cityMedia->description : "Authorized GAMCA / Wafid medical centers for GCC visa processing in $cityName." }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
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

            .bg-light-grey {
                background-color: #f8f9fa;
            }

            .text-theme {
                color: var(--theme-color) !important;
            }

            .btn-theme {
                background-color: var(--theme-color);
                color: #000;
                border: none;
                transition: var(--transition);
            }

            .btn-theme:hover {
                background-color: #e5b24b;
                color: #000;
                transform: translateY(-2px);
            }

            .badge-theme {
                background-color: var(--theme-color);
                color: #000;
            }

            .transition-hover {
                transition: var(--transition);
            }

            .transition-hover:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12) !important;
            }
        </style>
    @endpush
@endsection