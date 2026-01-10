@extends('layouts.public')

@section('title', 'Registration Successful - SVP International')

@section('content')
    <style>
        :root {
            --navtech-teal: #25d366;
            --navtech-dark: #343a40;
        }
        .thank-you-card {
            background: white;
            border-radius: 12px;
            padding: 50px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            /* max-width: 800px; */
            margin: 0 auto;
        }
        .success-icon {
            font-size: 5rem;
            color: var(--navtech-teal);
            margin-bottom: 20px;
        }
        .appointment-no-box {
            background-color: #f8f9fa;
            border: 2px dashed var(--navtech-teal);
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .info-list {
            list-style: none;
            padding: 0;
            text-align: left;
            max-width: 800px;
            margin: 30px auto;
        }
        .info-list li {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }
        .info-list li strong { color: var(--navtech-dark); }
        .btn-whatsapp {
            background-color: #25d366;
            color: white;
            padding: 14px 30px;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        .btn-whatsapp:hover {
            background-color: #1eb954;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
        }
    </style>

    <section class="py-5 bg-light" style="min-height: 90vh; display: flex; align-items: center;">
        <div class="container text-center">
            <div class="thank-you-card">
                
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>

                <h1 class="font-weight-bold" style="color: var(--navtech-dark);">Registration Received!</h1>
                <p class="lead text-muted">Thank you for submitting your application for SVP International.</p>

                <div class="appointment-no-box">
                    <span class="text-uppercase small font-weight-bold text-muted d-block">Your Reference ID</span>
                    <h2 class="mb-0 font-weight-bold" style="color: var(--navtech-teal);">#SVP-{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }}</h2>
                </div>

                <!-- Detail Summary -->
                <ul class="info-list">
                    <li><strong>Occupation:</strong> <span>{{ $appointment->occupation }}</span></li>
                    <li><strong>Location:</strong> <span>{{ $appointment->city }}, {{ $appointment->country }}</span></li>
                    <li><strong>WhatsApp:</strong> <span>{{ $appointment->whatsapp_number }}</span></li>
                    <li><strong>Documents:</strong> <span class="text-success"><i class="fas fa-paperclip"></i> Uploaded</span></li>
                </ul>

                <!-- Action Notice -->
                <div class="alert alert-warning border-0" style="background-color: #fff9e6;">
                    <p class="mb-0">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Important:</strong> Our team will verify your documents within 24-48 hours. Please click the button below to connect with our representative for the next steps.
                    </p>
                </div>

                <div class="mt-5 d-flex flex-column flex-md-row justify-content-center gap-3" style="gap: 15px;">
                    <a href="https://wa.me/923000000000?text=Hi, I have submitted my SVP Registration. My ID is #SVP-{{ $appointment->id }}" target="_blank" class="btn-whatsapp">
                        <i class="fab fa-whatsapp fa-lg"></i> Complete Verification on WhatsApp
                    </a>
                    <a href="{{ route('navtechform') }}" class="btn btn-outline-dark px-4 py-3" style="border-radius: 50px; font-weight: 700;">
                        New Registration
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection