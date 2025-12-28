@extends('layouts.public')

@section('title', 'Registration Successful - Tasheer Appointment')

@section('content')
<style>
    :root { --tasheer-teal: #1a8a8a; --tasheer-dark: #343a40; }
    .thank-you-card { background: white; border-radius: 12px; padding: 60px 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin: 0 auto; }
    .success-icon { font-size: 5rem; color: var(--tasheer-teal); margin-bottom: 20px; }
    .reference-box { background-color: #f8f9fa; border: 2px dashed var(--tasheer-teal); padding: 15px; border-radius: 8px; margin: 25px 0; }
    .info-list { list-style: none; padding: 0; text-align: left; max-width: 500px; margin: 30px auto; }
    .info-list li { padding: 12px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; }
    .info-list li strong { color: var(--tasheer-dark); }
    .btn-whatsapp { background-color: #25d366; color: white; padding: 14px 40px; font-weight: 700; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: 0.3s; }
    .btn-whatsapp:hover { background-color: #1eb954; color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(37,211,102,0.3); }
</style>

<section class="py-5 bg-light" style="min-height: 90vh; display: flex; align-items: center;">
    <div class="container text-center">
        <div class="thank-you-card">
            
            <div class="success-icon"><i class="fas fa-check-circle"></i></div>

            <h1 class="font-weight-bold" style="color: var(--tasheer-dark);">Submission Successful!</h1>
            <p class="lead text-muted">Your Tasheer Appointment request has been received and is under review.</p>

            <div class="reference-box">
                <span class="text-uppercase small font-weight-bold text-muted d-block">Reference ID</span>
                <h2 class="mb-0 font-weight-bold" style="color: var(--tasheer-teal);">#TSH-{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }}</h2>
            </div>

            <ul class="info-list">
                <li><strong>Center:</strong> <span>Tasheer {{ $appointment->embassy }}</span></li>
                <li><strong>WhatsApp:</strong> <span>{{ $appointment->whatsapp_number }}</span></li>
                <li><strong>Documents:</strong> <span class="text-success"><i class="fas fa-check"></i> Passport Attached</span></li>
                <li><strong>Payment:</strong> <span class="text-success"><i class="fas fa-check"></i> Verified Receipt</span></li>
            </ul>

            <div class="alert alert-info border-0" style="background-color: #e3f2fd; color: #0d47a1;">
                <p class="mb-0"><i class="fas fa-info-circle mr-2"></i> Our representative will contact you on WhatsApp within 24 hours to provide your appointment slip.</p>
            </div>

            <div class="mt-5 d-flex flex-column flex-md-row justify-content-center" style="gap: 15px;">
                <a href="https://wa.me/923000000000?text=Hi, I have submitted my Tasheer Appointment registration. Reference ID is #TSH-{{ $appointment->id }}" target="_blank" class="btn-whatsapp">
                    <i class="fab fa-whatsapp fa-lg"></i> Finalize on WhatsApp
                </a>
                <a href="{{ route('tasheer.form') }}" class="btn btn-outline-dark px-5 py-3" style="border-radius: 50px; font-weight: 700;">
                    New Application
                </a>
            </div>
        </div>
    </div>
</section>
@endsection