@extends('layouts.public')

@section('title', 'GAMCA Medical Status Check Online | WAFID Medical Report Status 2026')
@section('meta_description', 'Check your GAMCA medical status online through the official Wafid system. Verify GCC medical test results for Saudi Arabia, UAE, Qatar, Oman, Kuwait & Bahrain using your passport number.')
@section('meta_keywords', 'GAMCA medical status check, WAFID medical report check, GCC medical result online, check GAMCA status Pakistan, WAFID result 2026')

@section('content')

    <!-- Page Header -->
    <section class="page-header text-white py-5" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">Medical Status Check</li>
                </ol>
            </nav>
            <span style="display:inline-block;background:var(--accent-gold);color:#0f1923;font-size:.72rem;font-weight:700;padding:4px 14px;border-radius:20px;letter-spacing:.5px;text-transform:uppercase;margin-bottom:10px;">
                <i class="fas fa-search mr-1"></i> Real-Time Status Check
            </span>
            <h1 class="font-weight-bold mb-1">GAMCA Medical Status Check Online</h1>
            <p class="lead mb-0" style="color:rgba(255,255,255,.8);">WAFID Medical Report Status 2026 — Check your GCC medical result instantly.</p>
        </div>
    </section>

    <!-- Trust Strip -->
    <div style="background:var(--accent-gold);padding:12px 0;">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap:8px;">
                <p class="mb-0 font-weight-bold" style="color:#0f1923;font-size:.9rem;">
                    <i class="fas fa-history mr-2"></i>Real-time status retrieval from GCC Health Council database. Results usually available within 24–48 hours.
                </p>
                <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-sm font-weight-bold px-4 flex-shrink-0">
                    <i class="fas fa-calendar-check mr-1"></i>Book Appointment
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">

            {{-- ── TOP SEO SECTION ── --}}
            <div class="row mb-5">
                <div class="col-lg-8">
                    <span class="ms-seo-badge">WAFID Report Status 2026</span>
                    <h2 class="ms-seo-title">GAMCA Medical Status Check Online (WAFID Report Status 2026)</h2>
                    <p class="text-muted mb-3">Check your GAMCA medical status online through the official Wafid system. This page helps applicants from Pakistan and other countries verify their GCC medical test results quickly and accurately.</p>
                    <p class="text-muted mb-4">If you have completed your medical for <strong>Saudi Arabia, UAE, Qatar, Oman, Kuwait, or Bahrain</strong>, you can check your fitness report status using your passport number.</p>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="ms-info-card">
                        <div class="ms-info-card-header">
                            <i class="fas fa-question-circle mr-2"></i>How to Check GAMCA Medical Status
                        </div>
                        <div class="p-4">
                            @php $howSteps = [
                                'Enter your passport number or reference number',
                                'Select your nationality',
                                'Submit your request',
                                'View your medical report status instantly',
                            ]; @endphp
                            @foreach($howSteps as $i => $step)
                            <div class="d-flex align-items-start mb-3" style="gap:10px;">
                                <span class="ms-step-num">{{ $i + 1 }}</span>
                                <span class="small text-muted">{{ $step }}</span>
                            </div>
                            @endforeach
                            <div class="mt-2 p-2 rounded" style="background:#fff3cd;border:1px solid #ffe082;">
                                <p class="small mb-0 font-weight-bold" style="color:#856404;"><i class="fas fa-exclamation-circle mr-1"></i>Make sure your details match your appointment slip exactly.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                
                <!-- Left Column: Search Form -->
                <div class="col-lg-7 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom pt-4">
                            <h4 class="mb-0 text-dark"><i class="fas fa-search mr-2" style="color:var(--accent-gold);"></i>Find Report</h4>
                        </div>
                        <div class="card-body p-4">
                            
                            <form id="appointmentForm" method="POST" action="{{ route('medicalResults.save') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <label class="font-weight-bold">Passport Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" name="passport_no" placeholder="e.g. AB1234567" style="text-transform: uppercase;" >
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Nationality</label>
                                        <select name="nationality" class="form-control p-2">
                                            <option value="Pakistani" selected>Pakistani</option>
                                        </select>
                                    </div>     
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">WhatsApp Number <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control" id="phone" placeholder="0300 1234567" >
                                        <small class="text-muted">We will send the PDF to this number.</small>
                                    </div> 
                                </div>

                                <button type="submit" class="btn btn-dark btn-lg btn-block mt-3 shadow">
                                    <i class="fas fa-search mr-2"></i> Check Status
                                </button>
                                
                            </form>

                            <!-- Success Message -->
                            <div id="successMessage" class="alert alert-success mt-4 d-none text-center shadow-sm" style="border-left: 5px solid #28a745;">
                                <h5 class="alert-heading font-weight-bold"><i class="fab fa-whatsapp"></i> Request Received!</h5>
                                <p class="mb-0">Our team is checking the official database. You will receive your <strong>Medical Status PDF</strong> on WhatsApp shortly.</p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right Column: Status Guide (SEO Content) -->
                <div class="col-lg-5">

                    <div class="card shadow-sm border-0 mb-4" style="border-radius:14px;background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
                        <div class="card-body p-4">
                            <h5 class="font-weight-bold mb-3 text-white"><i class="fas fa-info-circle mr-2" style="color:var(--accent-gold);"></i>Status Guide</h5>
                            <p class="small mb-3" style="color:rgba(255,255,255,.6);">Understanding your report status:</p>
                            <div class="d-flex align-items-start mb-3" style="gap:14px;">
                                <i class="fas fa-check-circle text-success fa-2x flex-shrink-0"></i>
                                <div>
                                    <h6 class="mt-0 font-weight-bold text-white mb-1">FIT Status</h6>
                                    <p class="small mb-0" style="color:rgba(255,255,255,.6);">You are medically healthy and cleared to travel. Proceed with visa stamping.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-3" style="gap:14px;">
                                <i class="fas fa-times-circle text-danger fa-2x flex-shrink-0"></i>
                                <div>
                                    <h6 class="mt-0 font-weight-bold text-white mb-1">UNFIT Status</h6>
                                    <p class="small mb-0" style="color:rgba(255,255,255,.6);">You have failed the medical exam. Consult a doctor and check if re-medical is allowed.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start" style="gap:14px;">
                                <i class="fas fa-clock fa-2x flex-shrink-0" style="color:var(--accent-gold);"></i>
                                <div>
                                    <h6 class="mt-0 font-weight-bold text-white mb-1">PENDING / RETEST</h6>
                                    <p class="small mb-0" style="color:rgba(255,255,255,.6);">The lab needs more time or additional tests to confirm your result.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0" style="border-radius:14px;background:var(--accent-gold);">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-calendar-check mb-2" style="font-size:2rem;color:#0f1923;"></i>
                            <h6 class="font-weight-bold mb-2" style="color:#0f1923;">Haven't Booked Yet?</h6>
                            <p class="small mb-3" style="color:#1a252f;">Book your GAMCA appointment now and get your slip on WhatsApp.</p>
                            <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-block font-weight-bold">
                                <i class="fas fa-calendar-check mr-2"></i>Book GAMCA Appointment
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>        

        <!-- Loader Overlay -->
        <div id="loaderOverlay">
            <div class="loader-content text-center">
                <div class="spinner-border text-light" role="status" style="width: 4rem; height: 4rem;"></div>
                <div class="text-light mt-3" style="font-size: 1.5rem;">Connecting to Database...</div>
            </div>
        </div>

    </section>

    <!-- SEO Content Section (Bottom of page) -->
    <section class="py-5" style="background:#f7f8fc;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="ms-section-label">After Your Result</span>
                    <h2 class="ms-section-title">What to Do After Checking Your Result?</h2>
                    <div class="ms-result-block ms-fit-block mb-4">
                        <h6 class="font-weight-bold mb-3"><i class="fas fa-check-circle mr-2 text-success"></i>If Your Status is FIT:</h6>
                        <div class="ms-mini-item"><i class="fas fa-stamp" style="color:#28a745;"></i><span class="small">Proceed with visa stamping</span></div>
                        <div class="ms-mini-item"><i class="fas fa-file-alt" style="color:#28a745;"></i><span class="small">Submit documents to employer/agent</span></div>
                        <div class="ms-mini-item"><i class="fas fa-plane" style="color:#28a745;"></i><span class="small">Continue travel process</span></div>
                    </div>
                    <div class="ms-result-block ms-unfit-block">
                        <h6 class="font-weight-bold mb-3"><i class="fas fa-times-circle mr-2 text-danger"></i>If Your Status is UNFIT:</h6>
                        <div class="ms-mini-item"><i class="fas fa-user-md" style="color:#e74c3c;"></i><span class="small">Consult a doctor for treatment</span></div>
                        <div class="ms-mini-item"><i class="fas fa-redo" style="color:#e74c3c;"></i><span class="small">Check if re-medical is allowed</span></div>
                        <div class="ms-mini-item"><i class="fas fa-book" style="color:#e74c3c;"></i><span class="small">Follow GCC medical guidelines</span></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="ms-section-label">Common Issues</span>
                    <h2 class="ms-section-title">Common Issues While Checking Status</h2>
                    @php $issues = [
                        'Incorrect passport number',
                        'Wrong nationality selection',
                        'Checking too early (before upload)',
                    ]; @endphp
                    @foreach($issues as $issue)
                    <div class="ms-mistake-item">
                        <i class="fas fa-times-circle mr-3" style="color:#e74c3c;font-size:1.1rem;flex-shrink:0;"></i>
                        <span class="text-muted">{{ $issue }}</span>
                    </div>
                    @endforeach
                    <div class="mt-4 p-3 rounded" style="background:#fff8e1;border-left:4px solid var(--accent-gold);">
                        <p class="small mb-0"><i class="fas fa-lightbulb mr-2" style="color:var(--accent-gold);"></i>If your result is not showing, wait a few hours and try again.</p>
                    </div>

                    <div class="mt-4">
                        <span class="ms-section-label">Tests Included</span>
                        <h3 class="font-weight-bold mb-3" style="font-size:1.2rem;color:#1a252f;">GAMCA Medical Tests Included</h3>
                        @php $tests = [
                            ['icon'=>'fas fa-tint',        'text'=>'Blood tests (HIV, Hepatitis B & C)'],
                            ['icon'=>'fas fa-x-ray',       'text'=>'Chest X-ray (TB screening)'],
                            ['icon'=>'fas fa-stethoscope', 'text'=>'Physical examination'],
                            ['icon'=>'fas fa-heartbeat',   'text'=>'Blood pressure and general health'],
                        ]; @endphp
                        @foreach($tests as $t)
                        <div class="ms-mini-item"><i class="{{ $t['icon'] }}" style="color:var(--accent-gold);"></i><span class="small">{{ $t['text'] }}</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background:#fff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="ms-section-label">Pakistan Cities</span>
                    <h2 class="ms-section-title">Pakistan City-Based Medical Centers</h2>
                    <p class="text-muted mb-4">Medical tests are conducted in major cities:</p>
                    <div class="d-flex flex-wrap" style="gap:10px;">
                        @foreach(['karachi','lahore','islamabad','rawalpindi','peshawar','multan','gujranwala','sialkot'] as $city)
                        <a href="{{ route('public.medical.city', $city) }}" class="badge px-3 py-2 text-decoration-none" style="background:#f0f4f8;color:#1a252f;font-size:.85rem;border:1px solid #e8ecf0;transition:all .2s ease;" onmouseover="this.style.background='var(--accent-gold)';this.style.borderColor='var(--accent-gold)'" onmouseout="this.style.background='#f0f4f8';this.style.borderColor='#e8ecf0'">
                            📍 {{ ucfirst($city) }}
                        </a>
                        @endforeach
                    </div>
                    <div class="mt-4 p-3 rounded" style="background:#f7f8fc;border:1px solid #e8ecf0;">
                        <p class="small font-weight-bold mb-1" style="color:#1a252f;">GAMCA medical status kaise check karein?</p>
                        <p class="small text-muted mb-0">Passport number enter karein aur apna medical result check karein. Natija 24 se 48 ghante mein available hota hai.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="ms-section-label">Quick Answers</span>
                    <h2 class="ms-section-title">GAMCA Medical Status FAQs</h2>
                    <div id="msFaqAccordion">
                        @php $msFaqs = [
                            ['q'=>'How long does GAMCA result take?',                    'a'=>'Usually 24–48 hours after your medical test. Some cases may take longer depending on additional tests or medical review.'],
                            ['q'=>'Can I check without passport number?',                'a'=>'Passport number or reference ID is required to retrieve your medical status from the official system.'],
                            ['q'=>'What does "FIT" mean?',                               'a'=>'You are medically eligible for GCC visa processing. You can proceed with visa stamping and travel.'],
                            ['q'=>'Can I repeat medical if UNFIT?',                      'a'=>'Yes, in some cases after treatment. Check with your employer or agent for GCC-specific re-medical guidelines.'],
                        ]; @endphp
                        @foreach($msFaqs as $i => $faq)
                        <div class="ms-faq-item">
                            <button class="ms-faq-btn {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#msfaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                                {{ $faq['q'] }}
                                <div class="ms-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div>
                            </button>
                            <div id="msfaq{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}" data-parent="#msFaqAccordion">
                                <div class="ms-faq-body">{{ $faq['a'] }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('faq') }}" class="btn btn-outline-dark px-4 font-weight-bold">View All FAQs →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="background:linear-gradient(135deg,var(--accent-gold) 0%,#f4b942 100%);padding:50px 0;">
        <div class="container text-center">
            <h2 class="font-weight-bold mb-3" style="color:#0f1923;">Haven't Booked Your GAMCA Appointment Yet?</h2>
            <p class="mb-4" style="color:#1a252f;max-width:600px;margin:0 auto 24px;">Book now and get your GAMCA/WAFID slip on WhatsApp. Fast processing, WhatsApp support, all GCC countries.</p>
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center" style="gap:12px;">
                <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-lg px-5 py-3 font-weight-bold">
                    <i class="fas fa-calendar-check mr-2"></i>Book GAMCA Appointment
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GAMCA+medical+status." target="_blank" class="btn btn-outline-dark btn-lg px-5 py-3 font-weight-bold">
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp Support
                </a>
            </div>
        </div>
    </section>


@push('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function () {

        // Auto Uppercase Passport
        $('input[name="passport_no"]').on('keyup', function(){
            $(this).val($(this).val().toUpperCase());
        });

        // Apply phone mask
        $('#phone').inputmask('9999 9999999', { clearMaskOnLostFocus: true });

        const form = document.getElementById('appointmentForm');
        const loader = document.getElementById('loaderOverlay');

        const showLoader = () => loader.classList.add('show');
        const hideLoader = () => loader.classList.remove('show');

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            // remove previous errors
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

            const formData = new FormData(form);

            showLoader();

            try {
                const response = await fetch("{{ route('medicalResults.save') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "Accept": "application/json",
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.status === 422) {
                    let firstErrorField = null;

                    Object.keys(data.errors).forEach(field => {
                        const input = form.querySelector(`[name="${field}"]`);
                        if (input) {
                            input.classList.add('is-invalid');
                            const error = document.createElement('div');
                            error.className = 'invalid-feedback';
                            error.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${data.errors[field][0]}`;
                            input.parentNode.appendChild(error);
                            if (!firstErrorField) firstErrorField = input;
                        }
                    });

                    if (firstErrorField) {
                        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstErrorField.focus();
                    }

                } else if (data.status === 'success') {
                    form.reset();
                    const msg = document.getElementById('successMessage');
                    msg.classList.remove('d-none');
                    msg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Optional: Hide success message after 10 seconds
                    setTimeout(() => {
                         msg.classList.add('d-none');
                    }, 10000);
                }

            } catch (error) {
                console.error(error);
                alert('Connection error. Please try again.');
            } finally {
                hideLoader();
            }
        });
    });

</script>
@endpush

@push('head')
<style>
    .ms-seo-badge { display:inline-block;background:var(--accent-gold);color:#0f1923;font-size:.72rem;font-weight:700;padding:5px 14px;border-radius:20px;letter-spacing:.5px;text-transform:uppercase;margin-bottom:12px; }
    .ms-seo-title { font-size:1.6rem;font-weight:800;color:#1a252f;margin-bottom:14px; }
    .ms-status-cards { display:flex;flex-direction:column;gap:10px; }
    .ms-status-card { display:flex;align-items:center;gap:14px;padding:14px 16px;border-radius:10px;border:1px solid #e8ecf0; }
    .ms-status-card i { font-size:1.5rem;flex-shrink:0; }
    .ms-status-card div { display:flex;flex-direction:column; }
    .ms-status-card strong { font-size:.9rem;color:#1a252f; }
    .ms-status-card span { font-size:.8rem;color:#6c757d; }
    .ms-fit { background:#f0fff4;border-color:#c3e6cb; }
    .ms-fit i { color:#28a745; }
    .ms-unfit { background:#fff5f5;border-color:#f5c6cb; }
    .ms-unfit i { color:#e74c3c; }
    .ms-pending { background:#fff8e1;border-color:#ffe082; }
    .ms-pending i { color:var(--accent-gold); }
    .ms-info-card { background:#fff;border:1px solid #e8ecf0;border-radius:14px;overflow:hidden; }
    .ms-info-card-header { background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);color:var(--accent-gold);font-weight:700;font-size:.95rem;padding:16px 20px; }
    .ms-step-num { width:28px;height:28px;background:var(--accent-gold);color:#0f1923;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;flex-shrink:0; }
    .ms-mini-item { display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f0f4f8; }
    .ms-mini-item:last-child { border-bottom:none; }
    .ms-section-label { display:block;color:var(--accent-gold);font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px; }
    .ms-section-title { font-size:1.5rem;font-weight:800;color:#1a252f;margin-bottom:1rem; }
    .ms-result-block { background:#f7f8fc;border:1px solid #e8ecf0;border-radius:12px;padding:20px; }
    .ms-fit-block { border-left:4px solid #28a745; }
    .ms-unfit-block { border-left:4px solid #e74c3c; }
    .ms-mistake-item { display:flex;align-items:center;padding:12px 0;border-bottom:1px solid #f0f4f8; }
    .ms-mistake-item:last-child { border-bottom:none; }
    .ms-faq-item { background:#fff;border:1px solid #e8ecf0;border-radius:12px;margin-bottom:12px;overflow:hidden;transition:border-color .3s; }
    .ms-faq-item:hover { border-color:var(--accent-gold); }
    .ms-faq-btn { width:100%;text-align:left;background:transparent;border:none;padding:20px 24px;font-weight:600;font-size:.95rem;color:#1a252f;display:flex;justify-content:space-between;align-items:center;cursor:pointer; }
    .ms-faq-icon { width:30px;height:30px;background:#f8f9fa;border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--accent-gold);flex-shrink:0;margin-left:12px;transition:all .3s ease; }
    .ms-faq-btn[aria-expanded="true"] .ms-faq-icon { background:var(--accent-gold);color:#fff;transform:rotate(180deg); }
    .ms-faq-body { padding:0 24px 20px;color:#6c757d;font-size:.9rem;line-height:1.8; }
</style>
@endpush

@push('schema')
,{
    "@type": "FAQPage",
    "mainEntity": [
        {"@type":"Question","name":"How long does GAMCA result take?","acceptedAnswer":{"@type":"Answer","text":"Usually 24–48 hours after your medical test."}},
        {"@type":"Question","name":"What does FIT mean in GAMCA?","acceptedAnswer":{"@type":"Answer","text":"You are medically eligible for GCC visa processing and can proceed with visa stamping."}},
        {"@type":"Question","name":"Can I repeat medical if UNFIT?","acceptedAnswer":{"@type":"Answer","text":"Yes, in some cases after treatment. Check with your employer or agent for GCC-specific re-medical guidelines."}}
    ]
},
{
    "@type": "HowTo",
    "name": "How to Check GAMCA Medical Status Online",
    "step": [
        {"@type":"HowToStep","name":"Enter Passport Number","text":"Enter your passport number or reference number in the search form."},
        {"@type":"HowToStep","name":"Select Nationality","text":"Select your nationality from the dropdown."},
        {"@type":"HowToStep","name":"Submit Request","text":"Submit your request to check your medical status."},
        {"@type":"HowToStep","name":"View Result","text":"View your medical report status (FIT, UNFIT, or PENDING)."}
    ]
}
@endpush

@endsection