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
                                    <input type="text" class="form-control form-control-lg" name="passport_no" id="passport_no" placeholder="e.g. AB1234567" style="text-transform: uppercase;">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Nationality</label>
                                        <select name="nationality" id="nationality" class="form-control p-2">
                                            <option value="">Select nationality</option>
                                            <option value="Afghan">Afghan</option>
                                            <option value="Albanian">Albanian</option>
                                            <option value="Algerian">Algerian</option>
                                            <option value="Angolan">Angolan</option>
                                            <option value="Argentinian">Argentinian</option>
                                            <option value="Armenian">Armenian</option>
                                            <option value="Australian">Australian</option>
                                            <option value="Austrian">Austrian</option>
                                            <option value="Azerbaijani">Azerbaijani</option>
                                            <option value="Bahraini">Bahraini</option>
                                            <option value="Bangladeshi">Bangladeshi</option>
                                            <option value="Belarusian">Belarusian</option>
                                            <option value="Belgian">Belgian</option>
                                            <option value="Bhutanese">Bhutanese</option>
                                            <option value="Bosnian">Bosnian</option>
                                            <option value="Brazilian">Brazilian</option>
                                            <option value="British">British</option>
                                            <option value="Bulgarian">Bulgarian</option>
                                            <option value="Burkinabe">Burkinabe</option>
                                            <option value="Burundian">Burundian</option>
                                            <option value="Cambodian">Cambodian</option>
                                            <option value="Cameroonian">Cameroonian</option>
                                            <option value="Canadian">Canadian</option>
                                            <option value="Chadian">Chadian</option>
                                            <option value="Chilean">Chilean</option>
                                            <option value="Chinese">Chinese</option>
                                            <option value="Colombian">Colombian</option>
                                            <option value="Congolese">Congolese</option>
                                            <option value="Cuban">Cuban</option>
                                            <option value="Cypriot">Cypriot</option>
                                            <option value="Czech">Czech</option>
                                            <option value="Danish">Danish</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dutch">Dutch</option>
                                            <option value="Ecuadorean">Ecuadorean</option>
                                            <option value="Egyptian">Egyptian</option>
                                            <option value="Eritrean">Eritrean</option>
                                            <option value="Ethiopian">Ethiopian</option>
                                            <option value="Filipino">Filipino</option>
                                            <option value="Finnish">Finnish</option>
                                            <option value="French">French</option>
                                            <option value="German">German</option>
                                            <option value="Ghanaian">Ghanaian</option>
                                            <option value="Greek">Greek</option>
                                            <option value="Guatemalan">Guatemalan</option>
                                            <option value="Indian">Indian</option>
                                            <option value="Indonesian">Indonesian</option>
                                            <option value="Iranian">Iranian</option>
                                            <option value="Iraqi">Iraqi</option>
                                            <option value="Irish">Irish</option>
                                            <option value="Italian">Italian</option>
                                            <option value="Ivorian">Ivorian</option>
                                            <option value="Jamaican">Jamaican</option>
                                            <option value="Japanese">Japanese</option>
                                            <option value="Jordanian">Jordanian</option>
                                            <option value="Kazakhstani">Kazakhstani</option>
                                            <option value="Kenyan">Kenyan</option>
                                            <option value="Kuwaiti">Kuwaiti</option>
                                            <option value="Kyrgyzstani">Kyrgyzstani</option>
                                            <option value="Laotian">Laotian</option>
                                            <option value="Lebanese">Lebanese</option>
                                            <option value="Libyan">Libyan</option>
                                            <option value="Lithuanian">Lithuanian</option>
                                            <option value="Malagasy">Malagasy</option>
                                            <option value="Malawian">Malawian</option>
                                            <option value="Malaysian">Malaysian</option>
                                            <option value="Maldivian">Maldivian</option>
                                            <option value="Malian">Malian</option>
                                            <option value="Maltese">Maltese</option>
                                            <option value="Mauritanian">Mauritanian</option>
                                            <option value="Mexican">Mexican</option>
                                            <option value="Moroccan">Moroccan</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Nepalese">Nepalese</option>
                                            <option value="New Zealander">New Zealander</option>
                                            <option value="Nigerian">Nigerian</option>
                                            <option value="Norwegian">Norwegian</option>
                                            <option value="Omani">Omani</option>
                                            <option value="Pakistani" selected>Pakistani</option>
                                            <option value="Palestinian">Palestinian</option>
                                            <option value="Panamanian">Panamanian</option>
                                            <option value="Peruvian">Peruvian</option>
                                            <option value="Polish">Polish</option>
                                            <option value="Portuguese">Portuguese</option>
                                            <option value="Qatari">Qatari</option>
                                            <option value="Romanian">Romanian</option>
                                            <option value="Russian">Russian</option>
                                            <option value="Rwandan">Rwandan</option>
                                            <option value="Saudi">Saudi</option>
                                            <option value="Senegalese">Senegalese</option>
                                            <option value="Serbian">Serbian</option>
                                            <option value="Sierra Leonean">Sierra Leonean</option>
                                            <option value="Singaporean">Singaporean</option>
                                            <option value="Slovakian">Slovakian</option>
                                            <option value="Slovenian">Slovenian</option>
                                            <option value="Somali">Somali</option>
                                            <option value="South African">South African</option>
                                            <option value="South Korean">South Korean</option>
                                            <option value="Sri Lankan">Sri Lankan</option>
                                            <option value="Sudanese">Sudanese</option>
                                            <option value="Swedish">Swedish</option>
                                            <option value="Swiss">Swiss</option>
                                            <option value="Syrian">Syrian</option>
                                            <option value="Taiwanese">Taiwanese</option>
                                            <option value="Tajik">Tajik</option>
                                            <option value="Tanzanian">Tanzanian</option>
                                            <option value="Thai">Thai</option>
                                            <option value="Togolese">Togolese</option>
                                            <option value="Tunisian">Tunisian</option>
                                            <option value="Turkish">Turkish</option>
                                            <option value="Turkmen">Turkmen</option>
                                            <option value="Ugandan">Ugandan</option>
                                            <option value="Ukrainian">Ukrainian</option>
                                            <option value="American">American</option>
                                            <option value="Uzbekistani">Uzbekistani</option>
                                            <option value="Venezuelan">Venezuelan</option>
                                            <option value="Vietnamese">Vietnamese</option>
                                            <option value="Yemeni">Yemeni</option>
                                            <option value="Zambian">Zambian</option>
                                        </select>
                                    </div>     
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">WhatsApp Number <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control" id="phone" placeholder="0300 1234567">
                                        <small class="text-muted">We will send the PDF to this number.</small>
                                    </div> 
                                </div>

                                <button type="submit" class="btn btn-dark btn-lg btn-block mt-3 shadow">
                                    <i class="fas fa-search mr-2"></i> Check Status
                                </button>
                                
                            </form>

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

{{-- ── Confirmation Popup Modal ── --}}
<div id="msConfirmModal" style="display:none;position:fixed;inset:0;z-index:9999;align-items:center;justify-content:center;padding:16px;">
    {{-- Backdrop --}}
    <div id="msModalBackdrop" style="position:absolute;inset:0;background:rgba(15,25,35,.7);backdrop-filter:blur(3px);opacity:0;transition:opacity .3s ease;"></div>

    {{-- Dialog --}}
    <div id="msModalDialog" style="position:relative;width:100%;max-width:400px;background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 16px 40px rgba(0,0,0,.2);transform:translateY(16px);opacity:0;transition:transform .3s ease,opacity .3s ease;">

        {{-- Header --}}
        <div style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);padding:18px 20px 16px;text-align:center;">
            <i class="fas fa-check-circle" style="font-size:1.6rem;color:var(--accent-gold);display:block;margin-bottom:8px;"></i>
            <h6 style="color:#fff;font-weight:700;margin:0 0 4px;font-size:1rem;">Request Submitted!</h6>
            <p style="color:rgba(255,255,255,.6);font-size:.82rem;margin:0;">Your medical status request has been received.</p>
            <button type="button" id="msModalClose" style="position:absolute;top:12px;right:14px;background:none;border:none;color:rgba(255,255,255,.6);font-size:1.2rem;cursor:pointer;line-height:1;">&times;</button>
        </div>

        {{-- Body --}}
        <div style="padding:18px 20px;">

            {{-- Details --}}
            <div style="background:#f7f8fc;border:1px solid #e8ecf0;border-radius:10px;padding:12px 14px;margin-bottom:12px;font-size:.85rem;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                    <span style="color:#6c757d;font-weight:600;">Passport</span>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span id="popupPassport" style="font-weight:700;color:#1a252f;"></span>
                        <button type="button" id="popupCopyBtn" style="background:none;border:1px solid #dee2e6;border-radius:5px;padding:2px 8px;cursor:pointer;font-size:.72rem;color:#6c757d;">
                            <i class="fas fa-copy mr-1"></i>Copy
                        </button>
                    </div>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="color:#6c757d;font-weight:600;">Nationality</span>
                    <span id="popupNationality" style="font-weight:700;color:#1a252f;">Pakistani</span>
                </div>
            </div>

            {{-- Tip --}}
            <div style="background:#fff8e1;border-left:3px solid var(--accent-gold);border-radius:0 6px 6px 0;padding:10px 12px;margin-bottom:14px;font-size:.8rem;color:#856404;">
                <strong><i class="fas fa-info-circle mr-1"></i>On the official site:</strong> Enter passport number &amp; select <strong id="popupTipNationality">Pakistani</strong> as nationality.
            </div>

            {{-- Buttons --}}
            <div style="display:flex;flex-direction:column;gap:9px;">
                <button type="button" id="popupWhatsappBtn"
                    style="display:flex;align-items:center;justify-content:center;gap:8px;background:#25d366;color:#fff;border:none;border-radius:8px;padding:11px 14px;font-weight:600;font-size:.9rem;cursor:pointer;width:100%;">
                    <i class="fab fa-whatsapp"></i> Get Result on WhatsApp
                    <span style="background:rgba(255,255,255,.25);font-size:.68rem;padding:2px 7px;border-radius:20px;">Recommended</span>
                </button>
                <button type="button" id="popupOfficialBtn"
                    style="display:flex;align-items:center;justify-content:center;gap:6px;background:#fff;color:#1a252f;border:1.5px solid #1a252f;border-radius:8px;padding:10px 14px;font-weight:600;font-size:.9rem;cursor:pointer;">
                    <i class="fas fa-external-link-alt"></i> Check on Official Wafid Site
                </button>
            </div>

        </div>
    </div>
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Auto Uppercase Passport
        document.getElementById('passport_no').addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });

        // Phone mask
        $('#phone').inputmask('9999 9999999', { clearMaskOnLostFocus: true });

        var waNumber = '{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}';

        var form        = document.getElementById('appointmentForm');
        var loader      = document.getElementById('loaderOverlay');
        var modal       = document.getElementById('msConfirmModal');
        var backdrop    = document.getElementById('msModalBackdrop');
        var dialog      = document.getElementById('msModalDialog');
        var popupPassport  = document.getElementById('popupPassport');
        var popupCopyBtn   = document.getElementById('popupCopyBtn');
        var popupWaBtn     = document.getElementById('popupWhatsappBtn');
        var popupOfficialBtn = document.getElementById('popupOfficialBtn');
        var closeBtn    = document.getElementById('msModalClose');

        var waUrl = '';

        function openModal(passportNo, nationality) {
            popupPassport.textContent = passportNo;
            document.getElementById('popupNationality').textContent = nationality || 'Pakistani';
            document.getElementById('popupTipNationality').textContent = nationality || 'Pakistani';

            // Build WhatsApp URL
            var waText = encodeURIComponent(
                'Hi, I have submitted a medical status request.\nPassport Number: ' + passportNo + '\nNationality: ' + (nationality || 'Pakistani') + '\nPlease share my GAMCA/WAFID medical result.'
            );
            waUrl = 'https://wa.me/' + waNumber + '?text=' + waText;

            modal.style.display = 'flex';
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    backdrop.style.opacity = '1';
                    dialog.style.opacity   = '1';
                    dialog.style.transform = 'translateY(0)';
                });
            });
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            backdrop.style.opacity = '0';
            dialog.style.opacity   = '0';
            dialog.style.transform = 'translateY(20px)';
            setTimeout(function () {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }, 350);
        }

        closeBtn.addEventListener('click', closeModal);
        backdrop.addEventListener('click', closeModal);

        // Official Wafid site
        popupOfficialBtn.addEventListener('click', function () {
            window.open('https://wafid.com/en/medical-status-search/', '_blank');
        });

        // WhatsApp button
        popupWaBtn.addEventListener('click', function () {
            window.open(waUrl, '_blank');
        });

        // Copy passport
        popupCopyBtn.addEventListener('click', function () {
            navigator.clipboard.writeText(popupPassport.textContent).then(function () {
                popupCopyBtn.innerHTML = '<i class="fas fa-check mr-1"></i>Copied!';
                popupCopyBtn.style.color = '#28a745';
                popupCopyBtn.style.borderColor = '#28a745';
                setTimeout(function () {
                    popupCopyBtn.innerHTML = '<i class="fas fa-copy mr-1"></i>Copy';
                    popupCopyBtn.style.color = '#6c757d';
                    popupCopyBtn.style.borderColor = '#dee2e6';
                }, 2000);
            });
        });

        // Form submit
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            form.querySelectorAll('.is-invalid').forEach(function (el) { el.classList.remove('is-invalid'); });
            form.querySelectorAll('.invalid-feedback').forEach(function (el) { el.remove(); });

            var passportNo = document.getElementById('passport_no').value.trim();
            var formData   = new FormData(form);

            loader.classList.add('show');

            try {
                var response = await fetch("{{ route('medicalResults.save') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                var data = await response.json();

                if (response.status === 422) {
                    var firstErrorField = null;
                    Object.keys(data.errors).forEach(function (field) {
                        var input = form.querySelector('[name="' + field + '"]');
                        if (input) {
                            input.classList.add('is-invalid');
                            var err = document.createElement('div');
                            err.className = 'invalid-feedback';
                            err.innerHTML = '<i class="fas fa-times-circle mr-1"></i>' + data.errors[field][0];
                            input.parentNode.appendChild(err);
                            if (!firstErrorField) firstErrorField = input;
                        }
                    });
                    if (firstErrorField) {
                        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstErrorField.focus();
                    }
                } else if (data.status === 'success') {
                    var nationality = document.getElementById('nationality').options[document.getElementById('nationality').selectedIndex].text;
                    openModal(passportNo, nationality);
                    form.reset();
                }

            } catch (err) {
                console.error(err);
                alert('Connection error. Please try again.');
            } finally {
                loader.classList.remove('show');
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