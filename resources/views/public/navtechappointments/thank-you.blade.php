@extends('layouts.public')
@section('title', 'SVP Application Submitted')

@section('content')
    <style>
        .thank-card { border-top: 5px solid #28a745; max-width: 700px; margin: 0 auto; }
    </style>

    <section class="py-5 bg-white" style="min-height: 85vh; display: flex; align-items: center;">
        <div class="container">
            <div class="card shadow-lg thank-card border-0">
                <div class="card-body text-center p-5">
                    
                    <i class="fas fa-check-circle text-success mb-3" style="font-size: 5rem;"></i>
                    
                    <h2 class="font-weight-bold mb-2">Application Received</h2>
                    <p class="text-muted">We have received your documents for the Takamol Skill Test.</p>

                    <div class="bg-light p-3 rounded my-4 text-left">
                        <h6 class="font-weight-bold border-bottom pb-2">Your Details:</h6>
                        <div class="row">
                            <div class="col-6 text-muted">Occupation:</div>
                            <div class="col-6 font-weight-bold text-dark">{{ $appointment->occupation }}</div>
                            <div class="col-6 text-muted">Ref ID:</div>
                            <div class="col-6 font-weight-bold text-primary">#SVP-{{ $appointment->id }}</div>
                        </div>
                    </div>

                    <div class="alert alert-info small text-left">
                        <i class="fas fa-info-circle"></i> <strong>What happens now?</strong><br>
                        1. We verify your payment.<br>
                        2. We upload your documents to the Saudi Takamol portal.<br>
                        3. You receive your <strong>Roll Number Slip (Admit Card)</strong> on WhatsApp within 24 hours.
                    </div>

                    @php
                        $msg = "Hello, I applied for SVP Test.\nID: SVP-".$appointment->id."\nTrade: ".$appointment->occupation."\nPlease verify payment.";
                    @endphp

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text={{ urlencode($msg) }}" target="_blank" class="btn btn-success btn-lg rounded-pill px-5 shadow">
                        <i class="fab fa-whatsapp mr-2"></i> Chat with Agent
                    </a>

                    <div class="mt-3">
                        <a href="{{ route('home') }}" class="text-muted small">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection