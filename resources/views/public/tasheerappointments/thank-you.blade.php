@extends('layouts.public')
@section('title', 'Request Received - Tasheer')

@section('content')
<style>
    .thank-card { border-top: 5px solid #1a8a8a; max-width: 700px; margin: 0 auto; }
</style>

<section class="py-5 bg-white" style="min-height: 85vh; display: flex; align-items: center;">
    <div class="container">
        <div class="card shadow-lg thank-card border-0">
            <div class="card-body text-center p-5">
                
                <i class="fas fa-check-circle text-success mb-3" style="font-size: 5rem;"></i>
                
                <h2 class="font-weight-bold mb-2">Request Received</h2>
                <p class="text-muted">We have received your request for Tasheer Appointment.</p>

                <div class="bg-light p-3 rounded my-4 text-left">
                    <h6 class="font-weight-bold border-bottom pb-2">Summary:</h6>
                    <div class="row">
                        <div class="col-6 text-muted">Center:</div>
                        <div class="col-6 font-weight-bold text-dark">{{ $appointment->etimad_center }}</div>
                        <div class="col-6 text-muted">Mission:</div>
                        <div class="col-6 font-weight-bold text-dark">{{ $appointment->embassy }}</div>
                        <div class="col-6 text-muted">Tracking ID:</div>
                        <div class="col-6 font-weight-bold text-primary">#TSH-{{ $appointment->id }}</div>
                    </div>
                </div>

                <div class="alert alert-info small text-left">
                    <i class="fas fa-info-circle"></i> <strong>What happens now?</strong><br>
                    1. We verify your payment.<br>
                    2. We find the earliest available slot at {{ $appointment->etimad_center }}.<br>
                    3. You receive the <strong>Appointment PDF</strong> on WhatsApp.
                </div>

                @php
                    $msg = "Hi, I requested Tasheer Appointment.\nID: TSH-".$appointment->id."\nCenter: ".$appointment->etimad_center."\nPlease update me.";
                @endphp

                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text={{ urlencode($msg) }}" target="_blank" class="btn btn-success btn-lg rounded-pill px-5 shadow">
                    <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
                </a>

                <div class="mt-3">
                    <a href="{{ route('home') }}" class="text-muted small">Return to Home</a>
                </div>

            </div>
        </div>
    </div>
</section>

@include('public.partials.review-popup', ['service' => 'Tasheer Saudi Visa Appointment'])

@endsection