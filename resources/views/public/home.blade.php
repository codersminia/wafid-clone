@extends('layouts.public')

@section('title', 'Wafid - Welcome')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <h1 class="hero-title">Welcome to Wafid</h1>
                    <p class="hero-subtitle">Wafid is an individual seeking employment or residency in any of The Gulf Cooperation Council States.</p>
                    <p class="hero-tagline">We wish you good health and happiness.</p>
                </div>
                <!-- <div class="col-lg-6">
                    <div class="hero-decoration">
                        <div class="decoration-circle"></div>
                        <div class="decoration-checkmark"></div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Services Cards -->
    <section class="services-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="service-card">
                        <div class="card-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h3 class="card-title">Medical Examinations</h3>
                        <p class="card-description">Book your health check-up appointment or view your test results</p>
                        <div class="card-buttons">
                            <a href="{{ route('medicalExamination')}}" class="btn btn-dark">Book an Appointment</a>
                            <a href="{{ route('ViewMedicalReport') }}" class="btn btn-outline-dark">View Medical Reports</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="service-card">
                        <div class="card-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3 class="card-title">Special Medical Examinations</h3>
                        <p class="card-description">Book your health check-up at your preferred medical center</p>
                        <div class="card-buttons">
                            <a href="{{ route('specialMedicalExamination')}}" class="btn btn-dark">Book an Appointment</a>
                            <a href="medical-centers-list.html" class="btn btn-outline-dark">Medical Centers List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
    