@extends('layouts.public')
@section('title', 'Registration Successful')

@section('content')
<style>
    .thank-you-card { background: white; border-radius: 12px; padding: 50px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin: 0 auto; }
    .success-icon { font-size: 5rem; color: #1a8a8a; margin-bottom: 20px; }
    .ref-box { background-color: #f8f9fa; border: 2px dashed #1a8a8a; padding: 15px; border-radius: 8px; margin: 20px 0; }
</style>

<section class="py-5 bg-light" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container text-center">
        <div class="thank-you-card">
            <div class="success-icon"><i class="fas fa-check-circle"></i></div>
            <h1 class="font-weight-bold">Registration Received!</h1>
            <p class="lead text-muted">Thank you for applying for the Soft Skill Certificate.</p>

            <div class="ref-box">
                <span class="text-uppercase small font-weight-bold text-muted d-block">Your Reference ID</span>
                <h2 class="mb-0 font-weight-bold" style="color: #1a8a8a;">#SKILL-{{ str_pad($record->id, 5, '0', STR_PAD_LEFT) }}</h2>
            </div>

            <div class="alert alert-info border-0 mt-4">
                <p class="mb-0">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Verification:</strong> Our team will verify your payment and documents within 24 hours.
                </p>
            </div>

            <div class="mt-5">
                <a href="https://wa.me/923000000000?text=Hi, I have submitted my Soft Skill Registration. ID: #SKILL-{{ $record->id }}" class="btn btn-success btn-lg px-4" style="border-radius: 50px;">
                    <i class="fab fa-whatsapp"></i> Contact on WhatsApp
                </a>
                <a href="/" class="btn btn-outline-dark btn-lg px-4 ml-2" style="border-radius: 50px;">Go Home</a>
            </div>
        </div>
    </div>
</section>
@endsection