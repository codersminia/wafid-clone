@extends('layouts.public')

@section('title', 'Book GAMCA Appointment Online in Pakistan | WAFID Token Booking 2026')
@section('meta_description', 'Book your GAMCA appointment online in Pakistan with step-by-step guidance. WAFID token booking for Saudi Arabia, UAE, Qatar, Oman, Kuwait & Bahrain. Fast confirmation via WhatsApp.')
@section('meta_keywords', 'GAMCA appointment Pakistan, WAFID token booking, GAMCA medical booking online, WAFID appointment 2026, GAMCA booking Pakistan')

@section('content')

    <!-- Page Header -->
    <section class="page-header text-white py-5" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">GAMCA Appointment</li>
                </ol>
            </nav>
            <h1 class="font-weight-bold">Book GAMCA Appointment Online in Pakistan</h1>
            <p class="lead" style="color:rgba(255,255,255,.8);">WAFID Token Booking 2026 — Fast confirmation, WhatsApp support, all GCC countries.</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">

            <div class="row">

                <!-- Left Column: The Form -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom pt-4">
                            <h4 class="mb-0 text-dark"><i class="far fa-edit text-danger"></i> Candidate Details</h4>
                        </div>
                        <div class="card-body p-4">
                            <form id="appointmentForm" class="appointment-form" method="POST">
                                @csrf

                                <!-- Location Section -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3 mt-2">1. Location & Visa</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="country">Current Country <span class="text-danger">*</span></label>
                                        <select class="form-control bg-light" id="country" name="country" readonly>
                                            <option value="Pakistan" selected>Pakistan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="city">Select City <span class="text-danger">*</span></label>
                                        <select name="city" class="form-control" id="city">
                                            <option value="">-- Choose City --</option>
                                            <option value="bahawalpur">Bahawalpur</option>
                                            <option value="chakdara">Chakdara</option>
                                            <option value="faisalabad">Faisalabad</option>
                                            <option value="gujranwala">Gujranwala</option>
                                            <option value="gwadar">Gwadar</option>
                                            <option value="islamabad">Islamabad</option>
                                            <option value="karachi">Karachi</option>
                                            <option value="khuzdar">Khuzdar</option>
                                            <option value="lahore">Lahore</option>
                                            <option value="multan">Multan</option>
                                            <option value="panjgur">Panjgur</option>
                                            <option value="peshawar">Peshawar</option>
                                            <option value="quetta">Quetta</option>
                                            <option value="rawalpindi">Rawalpindi</option>
                                            <option value="sahiwal">Sahiwal</option>
                                            <option value="sialkot">Sialkot</option>
                                            <option value="turbat">Turbat</option>
                                        </select>
                                        <small class="form-text text-muted">Choose the city nearest to you.</small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="countryTravelingTo">Traveling To <span
                                                class="text-danger">*</span></label>
                                        <select id="countryTravelingTo" name="country_traveling_to" class="form-control">
                                            <option value="">-- Select Country --</option>
                                            <option value="saudi-arabia">Saudi Arabia</option>
                                            <option value="uae">UAE</option>
                                            <option value="qatar">Qatar</option>
                                            <option value="kuwait">Kuwait</option>
                                            <option value="bahrain">Bahrain</option>
                                            <option value="oman">Oman</option>
                                        </select>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Personal Info -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3">2. Personal Information</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" class="form-control"
                                            placeholder="As per Passport">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" class="form-control"
                                            placeholder="As per Passport">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Nationality <span class="text-danger">*</span></label>
                                        <select class="form-control" name="nationality" id="nationality">
                                            <option value="Pakistan" selected>Pakistan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select class="form-control" name="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Marital Status <span class="text-danger">*</span></label>
                                        <select class="form-control" name="marital_status">
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                        </select>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Passport Info -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3">3. Passport Details</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Passport Number <span class="text-danger">*</span></label>
                                        <input name="passport_no" type="text" class="form-control"
                                            placeholder="e.g. AB1234567" style="text-transform: uppercase;">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Confirm Passport No <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="confirm_passport_no"
                                            style="text-transform: uppercase;">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Issue Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="passport_issue_date">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Expiry Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="passport_expiry_date">
                                        <small class="text-muted">Must be valid for 6+ months.</small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Issue Place <span class="text-danger">*</span></label>
                                        <input class="form-control" name="passport_issue_place" type="text"
                                            value="Pakistan">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Contact & Job -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3">4. Contact & Profession</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Phone No <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control" id="phone"
                                            placeholder="0300 1234567">
                                        <small class="text-muted">We will WhatsApp the slip to this number.</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>National ID (CNIC) <span class="text-danger">*</span></label>
                                        <input type="text" name="national_id" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Visa Type <span class="text-danger">*</span></label>
                                        <select name="visa_type" class="form-control">
                                            <option value="work-visa">Work Visa</option>
                                            <option value="family-visa">Family Visa</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Position Applied For <span class="text-danger">*</span></label>
                                        <select name="position_applied" class="form-control" id="positionApplied">
                                            <option value="">-- Select Profession --</option>
                                            <option value="banking-finance">Banking & Finance</option>
                                            <option value="carpenter">Carpenter</option>
                                            <option value="cashier">Cashier</option>
                                            <option value="electrician">Electrician</option>
                                            <option value="engineer">Engineer</option>
                                            <option value="general-secretory">General Secretory</option>
                                            <option value="health-medicine-nursing">Health & Medicine & Nursing</option>
                                            <option value="heavy-driver">Heavy Driver</option>
                                            <option value="it-internet-engineer">IT & Internet Engineer</option>
                                            <option value="leisure-tourism">Leisure & Tourism</option>
                                            <option value="light-driver">Light Driver</option>
                                            <option value="mason">Mason</option>
                                            <option value="president">President</option>
                                            <option value="labour">Labour</option>
                                            <option value="plumber">Plumber</option>
                                            <option value="doctor">Doctor</option>
                                            <option value="family">Family</option>
                                            <option value="steel-fixer">Steel Fixer</option>
                                            <option value="aluminum-technician">Aluminum Technician</option>
                                            <option value="nurse">Nurse</option>
                                            <option value="male-nurse">Male Nurse</option>
                                            <option value="ward-boy">Ward Boy</option>
                                            <option value="shovel-operator">Shovel Operator</option>
                                            <option value="dozer-operator">Dozer Operator</option>
                                            <option value="car-mechanic">Car Mechanic</option>
                                            <option value="petrol-mechanic">Petrol Mechanic</option>
                                            <option value="diesel-mechanic">Diesel Mechanic</option>
                                            <option value="student">Student</option>
                                            <option value="accountant">Accountant</option>
                                            <option value="lab-technician">Lab Technician</option>
                                            <option value="draftsman">Drafts man</option>
                                            <option value="auto-cad-operator">Auto-Cad Operator</option>
                                            <option value="painter">Painter</option>
                                            <option value="tailor">Tailor</option>
                                            <option value="welder">Welder</option>
                                            <option value="xray-technician">X-ray Technician</option>
                                            <option value="lecturer">Lecturer</option>
                                            <option value="ac-technician">A.C Technician</option>
                                            <option value="business">Business</option>
                                            <option value="cleaner">Cleaner</option>
                                            <option value="security-guard">Security Guard</option>
                                            <option value="house-maid">House Maid</option>
                                            <option value="manager">Manager</option>
                                            <option value="hospital-cleaning">Hospital Cleaning</option>
                                            <option value="mechanic">Mechanic</option>
                                            <option value="computer-operator">Computer Operator</option>
                                            <option value="house-driver">House Driver</option>
                                            <option value="driver">Driver</option>
                                            <option value="cleaning-labour">Cleaning Labour</option>
                                            <option value="building-electrician">Building Electrician</option>
                                            <option value="salesman">Salesman</option>
                                            <option value="plastermason">Plastermason</option>
                                            <option value="servant">Servant</option>
                                            <option value="barber">Barber</option>
                                            <option value="residence">Residence</option>
                                            <option value="shepherds">Shepherds</option>
                                            <option value="employment">Employment</option>
                                            <option value="fuel-filler">Fuel Filler</option>
                                            <option value="worker">Worker</option>
                                            <option value="house-boy">House Boy</option>
                                            <option value="house-wife">House Wife</option>
                                            <option value="rcc-fitter">RCC Fitter</option>
                                            <option value="clerk">Clerk</option>
                                            <option value="microbiologist">Microbiologist</option>
                                            <option value="teacher">Teacher</option>
                                            <option value="helper">Helper</option>
                                            <option value="hajj-duty">Hajj Duty</option>
                                            <option value="shuttering">Shuttering</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="medical-specialist">Medical Specialist</option>
                                            <option value="office-secretary">Office Secretary</option>
                                            <option value="technician">Technician</option>
                                            <option value="butcher">Butcher</option>
                                            <option value="arabic-food-cook">Arabic Food Cook</option>
                                            <option value="agricultural-worker">Agricultural Worker</option>
                                            <option value="service">Service</option>
                                            <option value="studio-cad-designer">Studio CAD Designer</option>
                                            <option value="financial-analyst">Financial Analyst</option>
                                            <option value="cabin-appearance-air-lines">Cabin Appearance (AIR LINES)</option>
                                            <option value="car-washer">Car Washer</option>
                                            <option value="surveyor">Surveyor</option>
                                            <option value="electrical-technician">Electrical Technician</option>
                                            <option value="waiter">Waiter</option>
                                            <option value="nursing-helper">Nursing helper</option>
                                            <option value="anesthesia-technician">Anesthesia technician</option>
                                            <option value="marvel">Marvel</option>
                                            <option value="construction-worker">Construction worker</option>
                                            <option value="other">Other (Type Manually)</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 d-none" id="otherFieldGroup">
                                        <label>Enter Profession Manually</label>
                                        <input type="text" class="form-control" id="otherPosition" name="other_position"
                                            placeholder="E.g. Crane Operator">
                                    </div>
                                </div>

                                <!-- Agreement -->
                                <div class="bg-light p-3 rounded mb-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="confirm_info"
                                            id="confirmInfo">
                                        <label class="custom-control-label small" for="confirmInfo">
                                            I confirm that my passport details are 100% correct. I understand that if I
                                            provide wrong data, I will have to pay the fee again for a new slip.
                                        </label>
                                    </div>
                                </div>

                                <div class="form-buttons">
                                    <a href="{{ route('home') }}" class="btn btn-outline-dark">Cancel</a>
                                    <button type="submit" class="btn btn-dark shadow px-5">Save And Continue <i
                                            class="fas fa-arrow-right ml-2"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Instructions & SEO Content -->
                <div class="col-lg-4">

                    <!-- Guide Card -->
                    <div class="card shadow-sm border-0 mb-4" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);border-radius:14px;">
                        <div class="card-body p-4">
                            <h5 class="font-weight-bold mb-3 text-white">Booking Instructions</h5>
                            <ul class="list-unstyled mb-0" style="font-size:.9rem;">
                                <li class="mb-3 d-flex align-items-start gap-2">
                                    <span class="appt-step-num">1</span>
                                    <span style="color:rgba(255,255,255,.85);">Fill the form with your passport details</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start gap-2">
                                    <span class="appt-step-num">2</span>
                                    <span style="color:rgba(255,255,255,.85);">Pay the service fee via JazzCash/Bank</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start gap-2">
                                    <span class="appt-step-num">3</span>
                                    <span style="color:rgba(255,255,255,.85);">Upload the payment screenshot</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <span class="appt-step-num">4</span>
                                    <span style="color:rgba(255,255,255,.85);">Get your GAMCA slip on WhatsApp in 30 mins</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Required Docs at Center -->
                    <div class="card shadow-sm mb-4 border-0" style="border-radius:14px;">
                        <div class="card-body p-4">
                            <h6 class="font-weight-bold mb-3" style="font-size:.95rem;border-bottom:2px solid var(--accent-gold);padding-bottom:10px;">Documents Required at Center</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="appt-doc-item"><i class="fas fa-passport" style="color:var(--accent-gold);"></i><span class="small">Original Passport</span></li>
                                <li class="appt-doc-item"><i class="fas fa-id-card" style="color:var(--accent-gold);"></i><span class="small">Original CNIC</span></li>
                                <li class="appt-doc-item"><i class="fas fa-money-bill-wave" style="color:var(--accent-gold);"></i><span class="small">Cash for Center Fee (~PKR 25,000)</span></li>
                                <li class="appt-doc-item"><i class="fas fa-images" style="color:var(--accent-gold);"></i><span class="small">4 Passport Size Photos</span></li>
                            </ul>
                        </div>
                    </div>

                    <!-- GCC Countries -->
                    <div class="card shadow-sm mb-4 border-0" style="border-radius:14px;">
                        <div class="card-body p-4">
                            <h6 class="font-weight-bold mb-3" style="font-size:.95rem;border-bottom:2px solid var(--accent-gold);padding-bottom:10px;">GCC Country Guides</h6>
                            <div class="d-flex flex-wrap" style="gap:8px;">
                                <a href="{{ route('public.gcc.country', 'saudi-arabia') }}" class="appt-country-pill">🇸🇦 Saudi Arabia</a>
                                <a href="{{ route('public.gcc.country', 'uae') }}" class="appt-country-pill">🇦🇪 UAE</a>
                                <a href="{{ route('public.gcc.country', 'qatar') }}" class="appt-country-pill">🇶🇦 Qatar</a>
                                <a href="{{ route('public.gcc.country', 'oman') }}" class="appt-country-pill">🇴🇲 Oman</a>
                                <a href="{{ route('public.gcc.country', 'kuwait') }}" class="appt-country-pill">🇰🇼 Kuwait</a>
                                <a href="{{ route('public.gcc.country', 'bahrain') }}" class="appt-country-pill">🇧🇭 Bahrain</a>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp CTA -->
                    <div class="card border-0" style="background:var(--accent-gold);border-radius:14px;">
                        <div class="card-body p-4 text-center">
                            <i class="fab fa-whatsapp mb-2" style="font-size:2rem;color:#0f1923;"></i>
                            <h6 class="font-weight-bold mb-2" style="color:#0f1923;">Need Help?</h6>
                            <p class="small mb-3" style="color:#1a252f;">Get instant guidance on form filling, payment, and appointment issues.</p>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GAMCA+appointment+booking." target="_blank" class="btn btn-dark btn-block font-weight-bold">
                                <i class="fab fa-whatsapp mr-2"></i>Chat on WhatsApp
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Loader -->
        <div id="loaderOverlay">
            <div class="loader-content text-center">
                <div class="spinner-border text-light" role="status" style="width: 4rem; height: 4rem;"></div>
                <div class="text-light mt-3">Processing...</div>
            </div>
        </div>
    </section>

    {{-- ── BOTTOM SEO SECTION ── --}}

    {{-- SEO Intro + Docs Strip --}}
    <section class="py-5" style="background:#fff;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8">
                    <div class="appt-seo-intro">
                        <span class="appt-seo-badge">WAFID Token Booking 2026</span>
                        <h2 class="appt-seo-title">Book Your GAMCA Appointment Online in Pakistan</h2>
                        <p class="text-muted mb-3">Book your GAMCA appointment online in Pakistan with step-by-step guidance and fast confirmation. This page helps you secure your WAFID (GAMCA) token, select the correct city, and complete your GCC medical booking without errors.</p>
                        <p class="text-muted mb-4">Whether you are traveling to <strong>Saudi Arabia, United Arab Emirates, Qatar, Oman, Kuwait, or Bahrain</strong>, a valid GAMCA/WAFID appointment is mandatory before your visa process can proceed.</p>
                        <div class="row">
                            @php $whyUs = [
                                'Easy online GAMCA token booking form',
                                'WhatsApp support for quick assistance',
                                'Correct city &amp; clinic guidance',
                                'Fast processing and confirmation',
                                'Avoid common mistakes (wrong passport, wrong city)',
                            ]; @endphp
                            @foreach($whyUs as $point)
                            <div class="col-md-6 mb-2">
                                <div class="appt-check-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{!! $point !!}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="appt-info-card">
                        <h6 class="font-weight-bold mb-3" style="color:#1a252f;"><i class="fas fa-file-alt mr-2" style="color:var(--accent-gold);"></i>What is GAMCA / WAFID?</h6>
                        <p class="small text-muted mb-3">A GAMCA appointment (WAFID appointment) is an official booking required for your GCC medical test. After booking, you receive a QR code slip to take to the assigned medical center for:</p>
                        <ul class="list-unstyled mb-3">
                            <li class="appt-doc-item"><i class="fas fa-tint mr-2" style="color:var(--accent-gold);"></i><span class="small">Blood tests (HIV, Hepatitis)</span></li>
                            <li class="appt-doc-item"><i class="fas fa-x-ray mr-2" style="color:var(--accent-gold);"></i><span class="small">Chest X-ray (TB screening)</span></li>
                            <li class="appt-doc-item"><i class="fas fa-stethoscope mr-2" style="color:var(--accent-gold);"></i><span class="small">Physical examination</span></li>
                        </ul>
                        <div class="appt-fee-box">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small font-weight-bold">WAFID Token Fee</span>
                                <span class="font-weight-bold" style="color:var(--accent-gold);">PKR 4,500</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small font-weight-bold">Medical Test Fee (at center)</span>
                                <span class="font-weight-bold" style="color:var(--accent-gold);">~PKR 25,000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Documents Required Strip --}}
            <div class="appt-docs-strip">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-clipboard-list mr-2" style="color:var(--accent-gold);font-size:1.2rem;"></i>
                    <h5 class="font-weight-bold mb-0">Documents Required for GAMCA Appointment</h5>
                </div>
                <div class="row">
                    @php $docs = [
                        ['icon'=>'fas fa-passport',     'text'=>'Passport (valid for at least 6 months)'],
                        ['icon'=>'fas fa-globe',        'text'=>'Destination country (GCC state)'],
                        ['icon'=>'fas fa-calendar-alt', 'text'=>'Passport issue &amp; expiry details'],
                        ['icon'=>'fab fa-whatsapp',     'text'=>'Contact number (WhatsApp active)'],
                        ['icon'=>'fas fa-briefcase',    'text'=>'Visa type / job category'],
                    ]; @endphp
                    @foreach($docs as $doc)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="appt-doc-pill">
                            <i class="{{ $doc['icon'] }}"></i>
                            <span class="small">{!! $doc['text'] !!}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="small text-muted mb-0 mt-1"><i class="fas fa-exclamation-triangle mr-1" style="color:var(--accent-gold);"></i>Enter accurate details to avoid token rejection or delay.</p>
            </div>
        </div>
    </section>

    {{-- Step-by-Step Process --}}
    <section class="py-5" style="background:#f7f8fc;">
        <div class="container">
            <div class="text-center mb-5">
                <span class="appt-section-label">How It Works</span>
                <h2 class="appt-section-title">Step-by-Step GAMCA Appointment Process</h2>
            </div>
            <div class="row justify-content-center">
                @php $steps = [
                    ['num'=>'1','title'=>'Fill the Form',         'desc'=>'Enter your passport details, city, and destination country accurately.'],
                    ['num'=>'2','title'=>'Select City & Country', 'desc'=>'Choose your nearest city and the GCC country you are traveling to.'],
                    ['num'=>'3','title'=>'Submit Booking',        'desc'=>'Submit your booking request through our secure online form.'],
                    ['num'=>'4','title'=>'Complete Payment',      'desc'=>'Pay via JazzCash, Easypaisa, or local bank transfer.'],
                    ['num'=>'5','title'=>'Receive Token Slip',    'desc'=>'Get your GAMCA/WAFID token slip on WhatsApp within 30 minutes.'],
                    ['num'=>'6','title'=>'Visit Medical Center',  'desc'=>'Visit the assigned medical center on your appointment date.'],
                ]; @endphp
                <div class="col-lg-10">
                    <div class="row">
                        @foreach($steps as $step)
                        <div class="col-md-4 mb-4">
                            <div class="appt-step-card">
                                <div class="appt-step-circle">{{ $step['num'] }}</div>
                                <h6 class="font-weight-bold mb-2">{{ $step['title'] }}</h6>
                                <p class="text-muted small mb-0">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Common Mistakes + City Guides --}}
    <section class="py-5" style="background:#fff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="appt-section-label">Avoid These Errors</span>
                    <h2 class="appt-section-title">Common Mistakes to Avoid</h2>
                    <p class="text-muted mb-4">Even a small mistake can cause rejection or rebooking delays. Make sure you:</p>
                    @php $mistakes = [
                        'Don\'t enter incorrect passport number',
                        'Don\'t select the wrong sponsor city',
                        'Don\'t delay payment confirmation',
                        'Don\'t miss your appointment date',
                    ]; @endphp
                    @foreach($mistakes as $m)
                    <div class="appt-mistake-item">
                        <i class="fas fa-times-circle mr-3" style="color:#e74c3c;font-size:1.1rem;flex-shrink:0;"></i>
                        <span class="text-muted">{{ $m }}</span>
                    </div>
                    @endforeach
                    <div class="mt-4 p-3 rounded" style="background:#fff8e1;border-left:4px solid var(--accent-gold);">
                        <p class="small mb-0"><i class="fas fa-lightbulb mr-2" style="color:var(--accent-gold);"></i><strong>Tip:</strong> Double-check your passport number before submitting. One wrong digit means paying the fee again.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="appt-section-label">City-Based Booking</span>
                    <h2 class="appt-section-title">Pakistan City-Based GAMCA Booking</h2>
                    <p class="text-muted mb-4">We provide guidance for all major cities in Pakistan:</p>
                    <div class="row">
                        @php $cities = ['karachi','lahore','islamabad','rawalpindi','peshawar']; @endphp
                        @foreach($cities as $city)
                        <div class="col-6 mb-3">
                            <a href="{{ route('public.medical.city', $city) }}" class="appt-city-item text-decoration-none" style="transition:all .2s ease;" onmouseover="this.style.background='#fff8e1';this.style.borderColor='var(--accent-gold)'" onmouseout="this.style.background='#f7f8fc';this.style.borderColor='#e8ecf0'">
                                <i class="fas fa-map-marker-alt mr-2" style="color:var(--accent-gold);"></i>
                                <span class="small font-weight-bold" style="color:#1a252f;">GAMCA Appointment {{ ucfirst($city) }}</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-3 p-3 rounded" style="background:#f7f8fc;border:1px solid #e8ecf0;">
                        <p class="small mb-2 font-weight-bold">Who Needs a GAMCA Appointment?</p>
                        <p class="small text-muted mb-0">You need a GAMCA/WAFID appointment if you are applying for an employment visa, work permit, residency visa, or GCC job processing — for any GCC country from Pakistan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="py-5" style="background:#f7f8fc;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <span class="appt-section-label">Quick Answers</span>
                        <h2 class="appt-section-title">GAMCA Appointment FAQs</h2>
                    </div>
                    @php $apptFaqs = [
                        ['q'=>'How long does it take to get a GAMCA token?',   'a'=>'Most bookings are confirmed within the same day or within 24 hours after payment verification.'],
                        ['q'=>'Can I reschedule my GAMCA appointment?',        'a'=>'Yes, but you must contact support before your appointment date. Rescheduling after the date may require a new token.'],
                        ['q'=>'What happens if I enter wrong details?',        'a'=>'Incorrect details can delay or cancel your token. Always double-check your passport number, name, and city before submitting.'],
                        ['q'=>'Is GAMCA appointment mandatory?',               'a'=>'Yes, it is required for all GCC medical tests before visa processing. Without a valid GAMCA/WAFID token, you cannot proceed with your visa medical.'],
                    ]; @endphp
                    <div id="apptFaqAccordion">
                        @foreach($apptFaqs as $i => $faq)
                        <div class="appt-faq-item">
                            <button class="appt-faq-btn {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#afaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                                {{ $faq['q'] }}
                                <div class="appt-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div>
                            </button>
                            <div id="afaq{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}" data-parent="#apptFaqAccordion">
                                <div class="appt-faq-body">{{ $faq['a'] }}</div>
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

    @include('public.partials.service-reviews', ['service' => 'GAMCA / WAFID Appointment'])

    {{-- Bottom CTA --}}
    <section style="background:linear-gradient(135deg,var(--accent-gold) 0%,#f4b942 100%);padding:50px 0;">
        <div class="container text-center">
            <h2 class="font-weight-bold mb-3" style="color:#0f1923;">Need Help with Your Booking?</h2>
            <p class="mb-4" style="color:#1a252f;max-width:600px;margin:0 auto 24px;">Get instant guidance on form filling, document verification, payment confirmation, and appointment issues.</p>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GAMCA+appointment+booking." target="_blank" class="btn btn-dark btn-lg px-5 py-3 font-weight-bold">
                <i class="fab fa-whatsapp mr-2"></i>Get Help on WhatsApp
            </a>
        </div>
    </section>

    @push('scripts')
        <script>
            // Wait for DOM + all scripts to be fully ready
            document.addEventListener('DOMContentLoaded', function () {

                // Apply mask
                $('#phone').inputmask('9999 9999999', {
                    clearMaskOnLostFocus: true
                });

            });

            document.addEventListener('DOMContentLoaded', function () {
                const positionSelect = document.getElementById('positionApplied');
                const otherFieldGroup = document.getElementById('otherFieldGroup');

                positionSelect.addEventListener('change', function () {
                    if (this.value === 'other') {
                        otherFieldGroup.classList.remove('d-none');
                    } else {
                        otherFieldGroup.classList.add('d-none');
                        document.getElementById('otherPosition').value = ''; // reset field
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('appointmentForm');
                const loader = document.getElementById('loaderOverlay');

                const showLoader = () => loader.classList.add('show');
                const hideLoader = () => loader.classList.remove('show');

                form.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    // Remove previous errors
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                    form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

                    const formData = new FormData(form);

                    // Show loader
                    showLoader();

                    try {
                        const response = await fetch("{{ route('appointment.store') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                                "Accept": "application/json",
                            },
                            body: formData
                        });

                        const data = await response.json();

                        if (response.status === 422) {
                            let firstErrorField = null; // To scroll to the first error

                            Object.keys(data.errors).forEach(field => {
                                const input = form.querySelector(`[name="${field}"]`);
                                if (input) {
                                    input.classList.add('is-invalid');

                                    const error = document.createElement('div');
                                    error.className = 'invalid-feedback';
                                    error.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${data.errors[field][0]}`;

                                    input.parentNode.appendChild(error);

                                    // Capture the first field with an error
                                    if (!firstErrorField) firstErrorField = input;
                                }
                            });

                            // Scroll to the first error smoothly
                            if (firstErrorField) {
                                firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                firstErrorField.focus();
                            }

                        } else if (data.status === 'success') {
                            form.reset();
                            window.location.href = data.redirect;
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Something went wrong! Please try again.');
                    } finally {
                        // Hide loader after request completes
                        hideLoader();
                    }
                });
            });

            // Force Uppercase on Passport Inputs for UX
            $('input[name="passport_no"], input[name="confirm_passport_no"]').on('keyup', function () {
                $(this).val($(this).val().toUpperCase());
            });
        </script>

        @push('schema')
            ,{
            "@type": "Service",
            "@id": "{{ url('/') }}#wafid-medical-service",
            "name": "Wafid (GAMCA) Medical Examination",
            "serviceType": "Medical Test",
            "description": "Online booking service for Wafid (GAMCA) medical examination appointments in Pakistan for GCC countries
            including Saudi Arabia, UAE, Qatar, Kuwait, Bahrain, and Oman.",
            "provider": {
                "@id": "{{ url('/') }}#organization"
            },
            "areaServed": {
                "@type": "Country",
                "name": "Pakistan"
            },
            "availableChannel": {
                "@type": "ServiceChannel",
                "serviceUrl": "{{ route('medicalExamination') }}",
                "serviceType": "Online booking"
            }
            }
        @endpush
    @endpush

@endsection

@push('head')
<style>
    /* ── Top SEO Intro ── */
    .appt-seo-badge {
        display: inline-block;
        background: var(--accent-gold);
        color: #0f1923;
        font-size: .72rem;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 20px;
        letter-spacing: .5px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }
    .appt-seo-title { font-size: 1.6rem; font-weight: 800; color: #1a252f; margin-bottom: 14px; }
    .appt-check-item { display: flex; align-items: flex-start; gap: 10px; font-size: .9rem; color: #495057; }
    .appt-check-item i { color: #28a745; margin-top: 2px; flex-shrink: 0; }

    /* ── Info Card ── */
    .appt-info-card { background: #f7f8fc; border: 1px solid #e8ecf0; border-radius: 14px; padding: 24px; }
    .appt-fee-box { background: #fff; border: 1px solid #e8ecf0; border-radius: 10px; padding: 14px 16px; margin-top: 12px; }

    /* ── Docs Strip ── */
    .appt-docs-strip { background: #f7f8fc; border: 1px solid #e8ecf0; border-radius: 14px; padding: 24px; }
    .appt-doc-pill { display: flex; align-items: center; gap: 10px; background: #fff; border: 1px solid #e8ecf0; border-radius: 10px; padding: 10px 14px; }
    .appt-doc-pill i { color: var(--accent-gold); }
    .appt-doc-item { display: flex; align-items: center; gap: 10px; padding: 8px 0; border-bottom: 1px solid #f0f4f8; }
    .appt-doc-item:last-child { border-bottom: none; }

    /* ── Sidebar ── */
    .appt-step-num {
        width: 28px; height: 28px;
        background: var(--accent-gold); color: #0f1923;
        border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: .85rem; flex-shrink: 0; margin-right: 10px;
    }
    .appt-country-pill {
        display: inline-flex; align-items: center; gap: 5px;
        background: #f0f4f8; border: 1px solid #dde3ea; border-radius: 20px;
        padding: 5px 12px; font-size: .78rem; font-weight: 600; color: #1a252f;
        text-decoration: none; transition: all .2s ease;
    }
    .appt-country-pill:hover { background: var(--accent-gold); border-color: var(--accent-gold); color: #0f1923; text-decoration: none; }

    /* ── Section Labels ── */
    .appt-section-label { display: block; color: var(--accent-gold); font-size: .8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; }
    .appt-section-title { font-size: 1.7rem; font-weight: 800; color: #1a252f; margin-bottom: 1rem; }

    /* ── Step Cards ── */
    .appt-step-card { background: #fff; border: 1px solid #e8ecf0; border-radius: 14px; padding: 24px; text-align: center; height: 100%; transition: all .3s ease; }
    .appt-step-card:hover { transform: translateY(-5px); box-shadow: 0 12px 28px rgba(0,0,0,.08); border-color: var(--accent-gold); }
    .appt-step-circle {
        width: 52px; height: 52px;
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        color: var(--accent-gold); border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; font-weight: 800; margin: 0 auto 16px;
    }

    /* ── Mistakes & Cities ── */
    .appt-mistake-item { display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #f0f4f8; }
    .appt-mistake-item:last-child { border-bottom: none; }
    .appt-city-item { background: #f7f8fc; border: 1px solid #e8ecf0; border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; }

    /* ── FAQ ── */
    .appt-faq-item { background: #fff; border: 1px solid #e8ecf0; border-radius: 12px; margin-bottom: 12px; overflow: hidden; transition: border-color .3s; }
    .appt-faq-item:hover { border-color: var(--accent-gold); }
    .appt-faq-btn { width: 100%; text-align: left; background: transparent; border: none; padding: 20px 24px; font-weight: 600; font-size: .95rem; color: #1a252f; display: flex; justify-content: space-between; align-items: center; cursor: pointer; }
    .appt-faq-icon { width: 30px; height: 30px; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-gold); flex-shrink: 0; margin-left: 12px; transition: all .3s ease; }
    .appt-faq-btn[aria-expanded="true"] .appt-faq-icon { background: var(--accent-gold); color: #fff; transform: rotate(180deg); }
    .appt-faq-body { padding: 0 24px 20px; color: #6c757d; font-size: .9rem; line-height: 1.8; }
</style>
@endpush

@push('schema')
,{
    "@type": "WebPage",
    "@id": "{{ url()->current() }}#webpage",
    "name": "Book GAMCA Appointment Online in Pakistan | WAFID Token Booking 2026",
    "url": "{{ url()->current() }}",
    "description": "Book your GAMCA appointment online in Pakistan with step-by-step guidance. WAFID token booking for Saudi Arabia, UAE, Qatar, Oman, Kuwait & Bahrain.",
    "isPartOf": { "@id": "{{ url('/') }}#website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
            { "@type": "ListItem", "position": 2, "name": "GAMCA Appointment", "item": "{{ url()->current() }}" }
        ]
    }
}
@endpush

@push('schema')
@php
    $svcRatings = \App\Models\ServiceReview::where('service', 'GAMCA / WAFID Appointment')->where('status', 'approved')->pluck('rating')->filter(fn($r) => is_numeric($r));
@endphp
@if($svcRatings->count() > 0)
,{
    "@type": "Service",
    "@id": "{{ url('/') }}#wafid-medical-service-rating",
    "name": "Wafid (GAMCA) Medical Examination",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ round($svcRatings->avg(), 1) }}",
        "reviewCount": {{ $svcRatings->count() }},
        "bestRating": 5,
        "worstRating": 1
    }
}
@endif
,{
    "@type": "FAQPage",
    "@id": "{{ url()->current() }}#faqpage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "How long does it take to get a GAMCA token?",
            "acceptedAnswer": { "@type": "Answer", "text": "Most bookings are confirmed within the same day or within 24 hours after payment verification." }
        },
        {
            "@type": "Question",
            "name": "Can I reschedule my GAMCA appointment?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, but you must contact support before your appointment date. Rescheduling after the date may require a new token." }
        },
        {
            "@type": "Question",
            "name": "What happens if I enter wrong details?",
            "acceptedAnswer": { "@type": "Answer", "text": "Incorrect details can delay or cancel your token. Always double-check your passport number, name, and city before submitting." }
        },
        {
            "@type": "Question",
            "name": "Is GAMCA appointment mandatory?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, it is required for all GCC medical tests before visa processing. Without a valid GAMCA/WAFID token, you cannot proceed with your visa medical." }
        }
    ]
}
@endpush
