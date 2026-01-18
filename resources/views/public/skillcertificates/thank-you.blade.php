@extends('layouts.public')
@section('title', 'Application Received - Soft Skill')

@section('content')
<style>
    .thank-card { border-top: 5px solid #1a8a8a; max-width: 700px; margin: 0 auto; }
</style>

<section class="py-5 bg-white" style="min-height: 85vh; display: flex; align-items: center;">
    <div class="container">
        <div class="card shadow-lg thank-card border-0">
            <div class="card-body text-center p-5">
                
                <i class="fas fa-award text-success mb-3" style="font-size: 5rem;"></i>
                
                <h2 class="font-weight-bold mb-2">Application Received</h2>
                <p class="text-muted">We have received your details for the Soft Skill Certificate.</p>

                <div class="bg-light p-3 rounded my-4">
                    <span class="text-uppercase small font-weight-bold text-muted d-block">Reference ID</span>
                    <h3 class="text-dark font-weight-bold mb-0">#SKILL-{{ str_pad($record->id, 5, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div class="text-left mb-4">
                    <h6 class="font-weight-bold">Process Timeline:</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> <strong>Step 1:</strong> Admin verifies payment (1-2 Hours).</li>
                        <li class="mb-2"><i class="far fa-circle text-muted mr-2"></i> <strong>Step 2:</strong> Document Verification (Same Day).</li>
                        <li><i class="far fa-circle text-muted mr-2"></i> <strong>Step 3:</strong> Certificate PDF sent via WhatsApp.</li>
                    </ul>
                </div>

                @php
                    $msg = "Hi, I applied for Soft Skill Certificate.\nRef ID: SKILL-".$record->id."\nPlease check my payment.";
                @endphp

                <a href="https://wa.me/923000000000?text={{ urlencode($msg) }}" class="btn btn-success btn-lg rounded-pill px-5 shadow">
                    <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
                </a>

                <div class="mt-3">
                    <a href="{{ route('home') }}" class="text-muted small">Return to Home</a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection