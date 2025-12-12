@extends('layouts.public')

@section('title', 'Wafid - Medical Examination')

@section('content')

    <!-- Main Content -->
    <section class="thank-you-section py-5" style="min-height: 100vh; background-color: #f8f9fa; display: flex; align-items: center;">
        <div class="container">
            <div class="thank-you-content" style="background: white; border-radius: 8px; padding: 60px 40px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin: 0 auto;">
                
                <h3>Your Appointment Number</h3>
                <div class="alert alert-success">
                    <strong>{{ $appointment->appointment_no }}</strong>
                </div>

                <!-- Header with Icon -->
                <div class="text-center mb-5">
                    <div style="font-size: 4rem; color: var(--accent-green); margin-bottom: 25px;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h1 style="font-size: 2.2rem; font-weight: 700; color: var(--accent-green); margin-bottom: 15px; line-height: 1.3;">
                        Thank You for Your Submission
                    </h1>
                    <p style="font-size: 1rem; color: var(--text-light);">Your appointment request has been successfully submitted</p>
                </div>                

                <!-- Alert Banner -->
                <div style="background: linear-gradient(90deg, #fff3cd 0%, #fffbea 100%); border-left: 4px solid #ffc107; padding: 20px; border-radius: 6px; margin-bottom: 40px;">
                    <p style="margin: 0; color: var(--text-dark); font-size: 0.95rem; line-height: 1.8;">
                        Click on the <span style="background-color: #ffeb3b; padding: 2px 6px; border-radius: 3px; font-weight: 700; color: #000;">WHATSAPP BUTTON</span> below<br>
                        Share your <span style="background-color: #ffeb3b; padding: 2px 6px; border-radius: 3px; font-weight: 700; color: #000;">Payment Slip</span> and <span style="background-color: #ffeb3b; padding: 2px 6px; border-radius: 3px; font-weight: 700; color: #000;">Passport Front Page</span> on WhatsApp for verification.<br>
                        This is needed to receive the <strong>Medical Token Slip</strong> after fee verification. Your<br>
                        Appointment PDF file will be sent to your email or WhatsApp.
                    </p>
                </div>

                <!-- Appointment Details -->
                <div style="margin: 35px 0;">
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: var(--accent-burgundy); margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid var(--border-light);">
                        Appointment Details
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 12px 0; color: var(--text-dark); line-height: 1.8; border-bottom: 1px solid #f0f0f0;"><strong>Appointment Token Validity:</strong> 1 Month</li>
                        <li style="padding: 12px 0; color: var(--text-dark); line-height: 1.8; border-bottom: 1px solid #f0f0f0;"><strong>Entry Timing of Medical Center:</strong> 9:00 AM to 1:00 PM</li>
                    </ul>
                </div>

                <!-- Documents Required -->
                <div style="margin: 35px 0;">
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: var(--accent-burgundy); margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid var(--border-light);">
                        Documents Required for Medical Center
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 12px 0; color: var(--text-dark); line-height: 1.8; border-bottom: 1px solid #f0f0f0;"><strong>1.</strong> Original Passport</li>
                        <li style="padding: 12px 0; color: var(--text-dark); line-height: 1.8; border-bottom: 1px solid #f0f0f0;"><strong>2.</strong> Original CNIC</li>
                        <li style="padding: 12px 0; color: var(--text-dark); line-height: 1.8; border-bottom: 1px solid #f0f0f0;"><strong>3.</strong> Four (4) Photos Passport Size (Blue Background)</li>
                        <li style="padding: 12px 0; color: var(--text-dark); line-height: 1.8; border-bottom: 1px solid #f0f0f0;"><strong>4.</strong> One Passport Copy (Color/B&W)</li>
                        <li style="padding: 12px 0; color: var(--text-dark); line-height: 1.8; border-bottom: 1px solid #f0f0f0;"><strong>5.</strong> Two CNIC Copies (B&W)</li>
                        <li style="padding: 12px 0; color: var(--text-dark); line-height: 1.8;"><strong>6.</strong> Covid-19 Vaccination Certificate (Optional)</li>
                    </ul>
                </div>

                <!-- Important Note -->
                <div style="background: #ffe6e6; border-left: 4px solid var(--accent-red); padding: 20px; border-radius: 6px; margin: 30px 0;">
                    <div style="color: var(--accent-red); font-weight: 700; font-size: 1.1rem; margin-bottom: 10px;">
                        <i class="fas fa-exclamation-circle"></i> Important Note:
                    </div>
                    <p style="color: var(--text-dark); margin: 0; line-height: 1.8;">
                        Medical Center Fees shall be paid on Medical Center
                    </p>
                </div>

                <!-- Medical Fee -->
                <div style="background: #f0f0f0; padding: 20px; border-radius: 6px; margin: 20px 0;">
                    <div style="font-size: 0.95rem; color: var(--text-light); margin-bottom: 8px;">Medical Fee:</div>
                    <div style="font-size: 1.8rem; font-weight: 700; color: var(--text-dark);">24,000/-</div>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 15px; justify-content: center; margin-top: 40px; padding-top: 30px; border-top: 2px solid var(--border-light);" class="flex-wrap">
                    <a href="https://wa.me/966xxxxxxxxxx" target="_blank" style="background-color: #25d366; border: none; color: white; padding: 14px 40px; font-weight: 700; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; min-width: 200px; justify-content: center;" onmouseover="this.style.backgroundColor='#20ba5a'; this.style.boxShadow='0 6px 16px rgba(37, 211, 102, 0.4)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.backgroundColor='#25d366'; this.style.boxShadow='none'; this.style.transform='none';">
                        <i class="fab fa-whatsapp"></i>
                        Contact via WhatsApp
                    </a>
                    <a href="{{route('home')}}" style="background-color: var(--text-dark); border: none; color: white; padding: 14px 40px; font-weight: 700; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; min-width: 200px; justify-content: center;" onmouseover="this.style.backgroundColor='var(--accent-red)'; this.style.boxShadow='0 6px 16px rgba(231, 76, 60, 0.4)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.backgroundColor='var(--text-dark)'; this.style.boxShadow='none'; this.style.transform='none';">
                        <i class="fas fa-home"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
