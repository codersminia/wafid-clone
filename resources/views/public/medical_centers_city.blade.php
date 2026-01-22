@extends('layouts.public')

@section('title', "List of Medical Centers in " . $cityName . " - " . ($settings['site_name'] ?? 'Gulf Medical Consultant'))
@section('meta_description', "Find the complete list of Wafid (GAMCA) approved medical centers in " . $cityName . ". Get addresses, phone numbers, and contact details for your medical examination.")
@section('meta_keywords', "medical centers in " . strtolower($cityName) . ", gamca approved clinics " . strtolower($cityName) . ", wafid medical " . strtolower($cityName) . ", gamca pakistan")

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4 font-weight-bold text-dark mb-3">Medical Centers in {{ $cityName }}</h1>
                <p class="lead text-muted">A comprehensive list of GAMCA / Wafid approved medical examination centers in
                    {{ $cityName }}.</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $cityName }}</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                @foreach($centers as $center)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary-light rounded-circle p-3 mr-3">
                                        <i class="fas fa-hospital text-primary fa-lg"></i>
                                    </div>
                                    <h5 class="card-title font-weight-bold mb-0 text-dark">{{ $center->medical_center }}</h5>
                                </div>

                                <hr class="my-3 opacity-5">

                                <div class="mb-2 d-flex">
                                    <i class="fas fa-map-marker-alt text-primary mt-1 mr-3"></i>
                                    <p class="mb-0 text-muted small">
                                        {{ $center->address_line_1 }}<br>
                                        {{ $center->address_line_2 }}
                                    </p>
                                </div>

                                @if($center->phone)
                                    <div class="mb-2 d-flex align-items-center">
                                        <i class="fas fa-phone-alt text-primary mr-3"></i>
                                        <a href="tel:{{ $center->phone }}"
                                            class="text-muted small text-decoration-none">{{ $center->phone }}</a>
                                    </div>
                                @endif

                                @if($center->email)
                                    <div class="mb-2 d-flex align-items-center">
                                        <i class="fas fa-envelope text-primary mr-3"></i>
                                        <a href="mailto:{{ $center->email }}"
                                            class="text-muted small text-decoration-none">{{ $center->email }}</a>
                                    </div>
                                @endif

                                @if($center->rating > 0)
                                    <div class="mb-3 d-flex align-items-center">
                                        <i class="fas fa-star text-warning mr-2"></i>
                                        <span class="font-weight-bold text-dark mr-1">{{ $center->rating }}</span>
                                        <span class="text-muted small">Rating</span>
                                    </div>
                                @endif
                            </div>

                            <div class="card-footer bg-white border-0 p-4 pt-0">
                                @if($center->website)
                                    <a href="{{ $center->website }}" target="_blank"
                                        class="btn btn-outline-primary btn-block btn-sm font-weight-bold">
                                        Visit Website <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                @else
                                    <a href="{{ route('medicalExamination') }}"
                                        class="btn btn-primary btn-block btn-sm font-weight-bold">
                                        Book Appointment <i class="fas fa-calendar-check ml-1"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .1) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .bg-primary-light {
            background-color: rgba(0, 123, 255, 0.1);
        }

        .opacity-5 {
            opacity: 0.05;
        }
    </style>
@endsection