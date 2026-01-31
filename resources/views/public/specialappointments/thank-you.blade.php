@extends('layouts.public')
@section('title', 'Special Booking Received')

@section('content')
<style>
    .thank-card { max-width: 700px; margin: 0 auto; border-top: 5px solid #1a8a8a; } /* Teal for Special */
    .ref-box { background: #f8f9fa; border: 1px dashed #1a8a8a; padding: 15px; border-radius: 8px; }
    .step-badge { width: 30px; height: 30px; background: #1a8a8a; color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 10px; }
</style>

<section class="py-5 bg-white" style="min-height: 85vh; display: flex; align-items: center;">
    <div class="container">
        
        <div class="card shadow-lg thank-card border-0">
            <div class="card-body text-center p-5">
                
                <i class="fas fa-check-circle text-info mb-3" style="font-size: 5rem; color: #1a8a8a !important;"></i>
                
                <h2 class="font-weight-bold mb-2">Premium Request Received</h2>
                <p class="text-muted">We are securing your specific medical center slot.</p>

                <div class="ref-box my-4">
                    <small class="text-uppercase text-muted">Tracking ID</small>
                    <h3 class="text-dark font-weight-bold mb-0">{{ $appointment->appointment_no }}</h3>
                </div>

                <div class="text-left bg-light p-3 rounded mb-4">
                    <h6 class="font-weight-bold text-center border-bottom pb-2">Booking Summary</h6>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Center:</span>
                        <strong class="text-primary">{{ $appointment->medical_center }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>City:</span>
                        <strong>{{ $appointment->city }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Candidate:</span>
                        <strong>{{ $appointment->first_name }} {{ $appointment->last_name }}</strong>
                    </div>
                </div>

                <div class="text-left mb-4">
                    <h5 class="mb-3">Next Steps:</h5>
                    <div class="d-flex align-items-center mb-2">
                        <div class="step-badge">1</div>
                        <div>Payment Verification (Priority Queue).</div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="step-badge">2</div>
                        <div>We book the specific slot at <strong>{{ $appointment->medical_center }}</strong>.</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="step-badge">3</div>
                        <div>You receive the PDF on WhatsApp.</div>
                    </div>
                </div>

                <hr>

                <div class="alert alert-info border-0 mb-4">
                    <i class="fab fa-whatsapp"></i> <strong>Expedite Process:</strong> Click below to confirm your choice center request.
                </div>

                @php
                    $wa_message = "Hello, I booked a CHOICE CENTER appointment.\n\n" . 
                                 "ID: " . $appointment->appointment_no . "\n" .
                                 "Center: " . $appointment->medical_center . "\n" .
                                 "Proof attached. Please process ASAP.";
                @endphp

                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text={{ urlencode($wa_message) }}" target="_blank" class="btn btn-success btn-lg rounded-pill px-5 shadow" style="background-color: #25d366; border:none;">
                    <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
                </a>
                
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="text-muted small">Return to Home</a>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection