@extends('layouts.public')

@section('title', 'Submission Successful - Wafid Special Medical')

@section('content')
<style>
    :root { 
        --accent-teal: #1a8a8a; 
        --accent-burgundy: #800020;
        --accent-green: #25d366;
        --tasheer-dark: #343a40; 
    }
    .thank-you-card { background: white; border-radius: 12px; padding: 60px 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin: 0 auto; }
    .success-icon { font-size: 5rem; color: var(--accent-green); margin-bottom: 20px; }
    
    .reference-box { background-color: #f8f9fa; border: 2px dashed var(--accent-teal); padding: 15px; border-radius: 8px; margin: 25px 0; }
    
    .info-list { list-style: none; padding: 0; text-align: left; max-width: 800px; margin: 30px auto; }
    .info-list li { padding: 12px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
    .info-list li strong { color: var(--tasheer-dark); font-weight: 700; }
    .info-list li span { color: #666; }

    .doc-required-list { text-align: left; background: #fff9e6; padding: 25px; border-radius: 8px; border-left: 4px solid #ffc107; margin-bottom: 30px; }
    .doc-required-list h5 { color: var(--accent-burgundy); font-weight: 700; margin-bottom: 15px; }
    .doc-required-list ul { list-style: none; padding: 0; margin: 0; }
    .doc-required-list ul li { margin-bottom: 8px; font-size: 0.95rem; color: #444; }
    .doc-required-list ul li i { color: var(--accent-teal); margin-right: 8px; }

    .btn-whatsapp { background-color: #25d366; color: white; padding: 14px 40px; font-weight: 700; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: 0.3s; border: none; }
    .btn-whatsapp:hover { background-color: #1eb954; color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(37,211,102,0.3); text-decoration: none; }
</style>

<section class="py-5 bg-light" style="min-height: 90vh; display: flex; align-items: center;">
    <div class="container text-center">
        <div class="thank-you-card">
            
            <div class="success-icon"><i class="fas fa-check-circle"></i></div>

            <h1 class="font-weight-bold" style="color: var(--tasheer-dark);">Special Submission Successful!</h1>
            <p class="lead text-muted">Your Special Medical Examination request has been successfully received.</p>

            <!-- Reference Section -->
            <div class="reference-box">
                <span class="text-uppercase small font-weight-bold text-muted d-block">Special Appointment Number</span>
                <h2 class="mb-0 font-weight-bold" style="color: var(--accent-teal);">{{ $appointment->appointment_no }}</h2>
            </div>

            <!-- Summary List -->
            <ul class="info-list">
                <li><strong>Candidate Name:</strong> <span>{{ $appointment->first_name }} {{ $appointment->last_name }}</span></li>
                <li><strong>Medical Center:</strong> <span>{{ $appointment->medical_center }}</span></li>
                <li><strong>City:</strong> <span>{{ ucfirst($appointment->city) }}</span></li>
                <li><strong>Token Validity:</strong> <span class="badge badge-success px-3 py-2 text-white" style="border-radius: 20px;">1 Month</span></li>
            </ul>

            <!-- Required Documents Box -->
            <div class="doc-required-list">
                <h5><i class="fas fa-file-invoice"></i> Documents Required for Medical Center</h5>
                <div class="row text-left">
                    <div class="col-md-6">
                        <ul>
                            <li><i class="fas fa-check-circle"></i> 1. Original Passport</li>
                            <li><i class="fas fa-check-circle"></i> 2. Original CNIC</li>
                            <li><i class="fas fa-check-circle"></i> 3. 4 Photos (Blue Background)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li><i class="fas fa-check-circle"></i> 4. One Passport Copy</li>
                            <li><i class="fas fa-check-circle"></i> 5. Two CNIC Copies</li>
                            <li><i class="fas fa-check-circle"></i> 6. Entry Timing: 9AM - 1PM</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Alert Box -->
            <div class="alert alert-danger border-0 text-left mb-4" style="background-color: #ffe6e6; color: #c0392b; border-radius: 8px;">
                <p class="mb-0">
                    <i class="fas fa-exclamation-circle mr-2"></i> <strong>Important Note:</strong> 
                    Medical Center Fees (Approx. 24,000/-) must be paid directly at the Medical Center.
                </p>
            </div>

            <div class="alert alert-info border-0 text-left mb-5" style="background-color: #e3f2fd; color: #0d47a1; border-radius: 8px;">
                <p class="mb-0">
                    <i class="fas fa-info-circle mr-2"></i> Click below to share your <strong>Payment Proof</strong> & <strong>Passport</strong> via WhatsApp to receive your Medical Slip.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 15px;">
                @php
                    $wa_message = "Hi, I have just submitted my SPECIAL Medical Appointment.\n\n" . 
                                 "*Appointment No:* " . $appointment->appointment_no . "\n" .
                                 "*Candidate:* " . $appointment->first_name . " " . $appointment->last_name . "\n" .
                                 "*Passport:* " . $appointment->passport_no . "\n\n" .
                                 "I am sending the payment screenshot and passport for verification.";
                @endphp
                <a href="https://wa.me/923000000000?text={{ urlencode($wa_message) }}" target="_blank" class="btn-whatsapp">
                    <i class="fab fa-whatsapp fa-lg"></i> Finalize on WhatsApp
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-dark px-5 py-3" style="border-radius: 50px; font-weight: 700;">
                    Back to Home
                </a>
            </div>

        </div>
    </div>
</section>
@endsection