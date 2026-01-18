@extends('layouts.public')
@section('title', 'Medical & Visa Guidelines - GCC Requirements')
@section('meta_description', 'Read the official medical requirements for Saudi Arabia, UAE, and Oman. Check prohibited diseases and age limits.')

@section('content')
<section class="page-header bg-dark text-white py-5">
    <div class="container">
        <h1>Medical & Visa Guidelines</h1>
        <p class="lead">What you need to know before booking your appointment.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Medical Guidelines -->
            <div class="col-lg-8">
                <div class="mb-5">
                    <h3 class="text-dark font-weight-bold">1. Wafid (GAMCA) Medical Rules</h3>
                    <p>To obtain a work visa for GCC countries (Saudi Arabia, UAE, Oman, Qatar, Bahrain, Kuwait), you must pass a medical exam.</p>
                    
                    <div class="card bg-light border-0 mb-3">
                        <div class="card-body">
                            <h5 class="font-weight-bold"><i class="fas fa-exclamation-triangle text-warning"></i> Major Reasons for Unfit Status</h5>
                            <ul>
                                <li><strong>Infectious Diseases:</strong> HIV/AIDS, Hepatitis B & C, Tuberculosis (TB) or old TB scars.</li>
                                <li><strong>Vision:</strong> Color blindness (for specific trades like drivers/electricians).</li>
                                <li><strong>Physical Disability:</strong> Missing limbs or fingers (depending on trade).</li>
                                <li><strong>Pregnancy:</strong> Applicants found pregnant will be declared unfit for work visas.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h3 class="text-dark font-weight-bold">2. NAVTTC / Takamol SVP Program</h3>
                    <p>Saudi Arabia has introduced the Skill Verification Program (SVP) for <strong>12 specific trades</strong>.</p>
                    <ul class="list-unstyled">
                        <li>Electrician</li>
                        <li>Plumber</li>
                        <li>Welder</li>
                        <li>Automotive Electrician</li>
                        <li>HVAC Technician</li>
                    </ul>
                    <p><strong>Note:</strong> You must clear this test <em>before</em> your visa stamping. The certificate is valid for 5 years.</p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card shadow-sm" style="top: 100px;">
                    <div class="card-header bg-primary-dark text-white">
                        <h5 class="mb-0">Validity Periods</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Medical Slip</span>
                            <strong>30 Days</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Fit Report</span>
                            <strong>60 - 90 Days</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>NAVTTC Certificate</span>
                            <strong>5 Years</strong>
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-block">Book Medical Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection