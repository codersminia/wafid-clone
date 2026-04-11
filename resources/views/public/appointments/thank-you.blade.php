@extends('layouts.public')
@section('title', 'Request Received - Wafid Medical')

@section('content')
<style>
    .thank-card { max-width: 700px; margin: 0 auto; border-top: 5px solid #28a745; }
    .ref-box { background: #f8f9fa; border: 1px dashed #ced4da; padding: 15px; border-radius: 8px; }
    .step-badge { width: 30px; height: 30px; background: #343a40; color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 10px; }
</style>

<section class="py-5 bg-white" style="min-height: 85vh; display: flex; align-items: center;">
    <div class="container">
        
        <div class="card shadow-lg thank-card border-0">
            <div class="card-body text-center p-5">
                
                <i class="fas fa-check-circle text-success mb-3" style="font-size: 5rem;"></i>
                
                <h2 class="font-weight-bold mb-2">Request Received</h2>
                <p class="text-muted">We have received your payment proof and details.</p>

                <div class="ref-box my-4">
                    <small class="text-uppercase text-muted">Tracking ID</small>
                    <h3 class="text-dark font-weight-bold mb-0">{{ $appointment->appointment_no }}</h3>
                </div>

                <div class="text-left mb-4">
                    <h5 class="mb-3">What happens next?</h5>
                    <div class="d-flex align-items-center mb-2">
                        <div class="step-badge">1</div>
                        <div>Admin verifies your payment (approx 10-30 mins).</div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="step-badge">2</div>
                        <div>We generate the official Wafid PDF Slip.</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="step-badge">3</div>
                        <div>You receive the PDF on <strong>WhatsApp ({{ $appointment->phone }})</strong>.</div>
                    </div>
                </div>

                <hr>

                <div class="alert alert-info border-0 mb-4">
                    <i class="fab fa-whatsapp"></i> <strong>Want it faster?</strong> Click below to notify our agent directly.
                </div>

                @php
                    $wa_msg = "Hello, I have submitted a new booking.\nTracking ID: " . $appointment->appointment_no . "\nName: " . $appointment->first_name . "\nPlease check and approve.";
                @endphp

                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text={{ urlencode($wa_msg) }}" target="_blank" class="btn btn-success btn-lg rounded-pill px-5 shadow">
                    <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
                </a>
                
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="text-muted small">Return to Home</a>
                </div>

            </div>
        </div>

    </div>
</section>

@include('public.partials.review-popup', ['service' => 'GAMCA / WAFID Appointment'])

@endsection