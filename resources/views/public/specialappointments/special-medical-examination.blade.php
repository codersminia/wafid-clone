@extends('layouts.public')

@section('title', 'Choose GAMCA Medical Center | WAFID Choice Service Pakistan 2026')
@section('meta_description', 'Book your GAMCA appointment with center selection using our premium WAFID Choice service. Select your preferred medical center in Lahore or Gujranwala. Fast confirmation via WhatsApp.')
@section('meta_keywords', 'choose GAMCA center Pakistan, WAFID choice center, select GAMCA medical center, WAFID choice appointment, GAMCA center selection Pakistan')

@section('content')

    <!-- Page Header -->
    <section class="page-header text-white py-5" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('medicalExamination') }}" style="color:rgba(255,255,255,.6);">GAMCA Appointment</a></li>
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">Choice Center</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center flex-wrap" style="gap:12px;">
                <div>
                    <span style="display:inline-block;background:var(--accent-gold);color:#0f1923;font-size:.72rem;font-weight:700;padding:4px 14px;border-radius:20px;letter-spacing:.5px;text-transform:uppercase;margin-bottom:10px;">
                        <i class="fas fa-crown mr-1"></i> Premium Service
                    </span>
                    <h1 class="font-weight-bold mb-1">Choose Your GAMCA Medical Center</h1>
                    <p class="lead mb-0" style="color:rgba(255,255,255,.8);">WAFID Choice Service — Select your preferred clinic in Lahore or Gujranwala.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Strip -->
    <div style="background:var(--accent-gold);padding:12px 0;">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap:8px;">
                <p class="mb-0 font-weight-bold" style="color:#0f1923;font-size:.9rem;">
                    <i class="fas fa-star mr-2"></i><strong>Premium Service:</strong> You are using the "Choice Center" option — pick your specific Center instead of auto-assignment.
                </p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+WAFID+Choice+Center+booking." target="_blank" class="btn btn-dark btn-sm font-weight-bold px-4 flex-shrink-0">
                    <i class="fab fa-whatsapp mr-1"></i>Get Help
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
                    <span class="sp-seo-badge">WAFID Choice Center 2026</span>
                    <h2 class="sp-seo-title">Choose Your GAMCA Medical Center – WAFID Choice Service Pakistan</h2>
                    <p class="text-muted mb-3">Book your GAMCA appointment with center selection using our premium WAFID Choice service. Unlike standard booking, this option allows you to choose your preferred medical center and city, giving you full control over your appointment.</p>
                    <p class="text-muted mb-4">Currently available for <strong>Lahore</strong> and <strong>Gujranwala</strong> — the best option for applicants who want a specific clinic, need to avoid auto-assignment, or prefer a faster and more convenient location.</p>
                    <div class="row mb-3">
                        @php $whyChoice = [
                            'Select your preferred GAMCA medical center',
                            'Avoid random clinic assignment',
                            'Better control over location &amp; timing',
                            'Ideal for urgent or specific travel plans',
                            'Personalized booking assistance',
                        ]; @endphp
                        @foreach($whyChoice as $pt)
                        <div class="col-md-6 mb-2">
                            <div class="sp-check-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{!! $pt !!}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="sp-info-card">
                        <div class="sp-info-card-header">
                            <i class="fas fa-crown mr-2"></i>What is WAFID Choice Center?
                        </div>
                        <div class="p-4">
                            <p class="small text-muted mb-3">The WAFID Choice Center service allows you to <strong>manually select your preferred GAMCA medical center</strong> instead of being automatically assigned by the system.</p>
                            <p class="small text-muted mb-3">In standard GAMCA booking, the system assigns a random clinic. With this premium option, you can:</p>
                            <ul class="list-unstyled mb-3">
                                <li class="sp-mini-item"><i class="fas fa-map-marker-alt" style="color:var(--accent-gold);"></i><span class="small">Choose your desired city</span></li>
                                <li class="sp-mini-item"><i class="fas fa-hospital" style="color:var(--accent-gold);"></i><span class="small">Select a specific medical center</span></li>
                                <li class="sp-mini-item"><i class="fas fa-clock" style="color:var(--accent-gold);"></i><span class="small">Better control over appointment timing</span></li>
                            </ul>
                            <div class="sp-fee-box">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="small font-weight-bold">Premium Booking Fee</span>
                                    <span class="font-weight-bold" style="color:var(--accent-gold);">Contact Us</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small font-weight-bold">Medical Test Fee (at clinic)</span>
                                    <span class="font-weight-bold" style="color:var(--accent-gold);">~PKR 25,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── DOCS STRIP ── --}}
            <div class="sp-docs-strip mb-5">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-clipboard-list mr-2" style="color:var(--accent-gold);font-size:1.2rem;"></i>
                    <h5 class="font-weight-bold mb-0">Documents Required Before Selecting Your Center</h5>
                </div>
                <div class="row">
                    @php $docs = [
                        ['icon'=>'fas fa-passport',     'text'=>'Valid passport (6+ months)'],
                        ['icon'=>'fas fa-globe',        'text'=>'Destination GCC country'],
                        ['icon'=>'fas fa-calendar-alt', 'text'=>'Passport issue &amp; expiry details'],
                        ['icon'=>'fab fa-whatsapp',     'text'=>'Active WhatsApp number'],
                        ['icon'=>'fas fa-briefcase',    'text'=>'Visa type / job category'],
                    ]; @endphp
                    @foreach($docs as $doc)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="sp-doc-pill">
                            <i class="{{ $doc['icon'] }}"></i>
                            <span class="small">{!! $doc['text'] !!}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="small text-muted mb-0 mt-1"><i class="fas fa-exclamation-triangle mr-1" style="color:var(--accent-gold);"></i>Enter accurate details to avoid token rejection or delay.</p>
            </div>

            <div class="row">

                <!-- Left Column: Form -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom pt-4">
                            <h4 class="mb-0 text-dark"><i class="fas fa-hospital-user text-danger"></i> Booking Details</h4>
                        </div>
                        <div class="card-body p-4">
                            <form id="appointmentForm" class="appointment-form" method="POST">
                                @csrf

                                <!-- Location Section -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3 mt-2">1. Select Center</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Country</label>
                                        <select class="form-control bg-light" id="country" name="country" readonly>
                                            <option>Pakistan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>City <span class="text-danger">*</span></label>
                                        <select name="city" class="form-control" id="city">
                                            <option value="">-- Select City --</option>
                                            <option value="Lahore">Lahore</option>
                                            <option value="Gujranwala">Gujranwala</option>
                                            <!-- Add other cities if your backend supports them -->
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Medical Center <span class="text-danger">*</span></label>
                                        <select id="medicalCenter" name="medical_center" class="form-control">
                                            <option value="">Select City First</option>
                                        </select>
                                        <small class="text-muted">Choose your preferred lab.</small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Traveling To <span class="text-danger">*</span></label>
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

                                <!-- Personal Section -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3">2. Candidate Details</h6>
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
                                            <option>Pakistan</option>
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
                                        <label>Marital Status</label>
                                        <select class="form-control" name="marital_status">
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                        </select>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Passport Section -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3">3. Passport Info</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Passport No <span class="text-danger">*</span></label>
                                        <input name="passport_no" type="text" class="form-control"
                                            style="text-transform: uppercase;" placeholder="e.g. AB123456">
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
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Issue Place</label>
                                        <input class="form-control" name="passport_issue_place" type="text"
                                            value="Pakistan">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Contact Section -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3">4. Contact & Visa</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" name="email" placeholder="Optional">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Mobile No <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control" id="phone">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>National ID</label>
                                        <input type="text" name="national_id" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Visa Type</label>
                                    <select name="visa_type" class="form-control">
                                        <option value="work-visa">Work Visa</option>
                                        <option value="family-visa">Family Visa</option>
                                    </select>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Position applied for<span class="text-danger">*</span></label>
                                        <select name="position_applied" class="form-control" id="positionApplied">
                                            <option value="">-- Select --</option>
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
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 d-none" id="otherFieldGroup">
                                        <label>Enter Profession Manually</label>
                                        <input type="text" class="form-control" id="otherPosition" name="other_position">
                                    </div>
                                </div>

                                <!-- Checkbox -->
                                <div class="bg-light p-3 rounded mb-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="confirm_info"
                                            id="confirmInfo">
                                        <label class="custom-control-label small" for="confirmInfo">
                                            I confirm my details are correct. I understand "Choice Center" is a premium
                                            service with a higher fee than standard appointments.
                                        </label>
                                    </div>
                                </div>

                                <div class="form-buttons">
                                    <a href="{{ route('home') }}" class="btn btn-outline-dark">Cancel</a>
                                    <button type="submit" class="btn btn-dark shadow px-5">Proceed to Booking <i
                                            class="fas fa-arrow-right ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Info Sidebar -->
                <div class="col-lg-4">

                    <!-- Why Choice? -->
                    <div class="card shadow-sm border-0 mb-4" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);border-radius:14px;">
                        <div class="card-body p-4">
                            <h5 class="font-weight-bold mb-3 text-white"><i class="fas fa-crown mr-2" style="color:var(--accent-gold);"></i>Why Choice Center?</h5>
                            <p class="small mb-3" style="color:rgba(255,255,255,.8);">Standard appointments assign you a random center which might be far away or have a long waiting list.</p>
                            <ul class="list-unstyled mb-0" style="font-size:.9rem;">
                                <li class="mb-3 d-flex align-items-start" style="gap:10px;">
                                    <span class="sp-step-num">1</span>
                                    <span style="color:rgba(255,255,255,.85);">Select the nearest center to you</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start" style="gap:10px;">
                                    <span class="sp-step-num">2</span>
                                    <span style="color:rgba(255,255,255,.85);">Avoid bad service or distant clinics</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start" style="gap:10px;">
                                    <span class="sp-step-num">3</span>
                                    <span style="color:rgba(255,255,255,.85);">Save travel time and reduce stress</span>
                                </li>
                                <li class="d-flex align-items-start" style="gap:10px;">
                                    <span class="sp-step-num">4</span>
                                    <span style="color:rgba(255,255,255,.85);">Priority processing and confirmation</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Available Cities -->
                    <div class="card shadow-sm mb-4 border-0" style="border-radius:14px;">
                        <div class="card-body p-4">
                            <h6 class="font-weight-bold mb-3" style="font-size:.95rem;border-bottom:2px solid var(--accent-gold);padding-bottom:10px;">
                                <i class="fas fa-map-marker-alt mr-2" style="color:var(--accent-gold);"></i>Available Cities
                            </h6>
                            <div class="d-flex flex-column" style="gap:10px;">
                                <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background:#f7f8fc;border:1px solid #e8ecf0;">
                                    <div class="d-flex align-items-center" style="gap:10px;">
                                        <i class="fas fa-city" style="color:var(--accent-gold);"></i>
                                        <span class="font-weight-bold small">Lahore</span>
                                    </div>
                                    <span class="badge badge-pill font-weight-bold px-3 py-2" style="background:#e8f5e9;color:#2e7d32;">Active</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background:#f7f8fc;border:1px solid #e8ecf0;">
                                    <div class="d-flex align-items-center" style="gap:10px;">
                                        <i class="fas fa-city" style="color:var(--accent-gold);"></i>
                                        <span class="font-weight-bold small">Gujranwala</span>
                                    </div>
                                    <span class="badge badge-pill font-weight-bold px-3 py-2" style="background:#e8f5e9;color:#2e7d32;">Active</span>
                                </div>
                            </div>
                            <p class="small text-muted mt-3 mb-0"><i class="fas fa-info-circle mr-1" style="color:var(--accent-gold);"></i>More cities coming soon.</p>
                        </div>
                    </div>

                    <!-- Who Should Use -->
                    <div class="card shadow-sm mb-4 border-0" style="border-radius:14px;">
                        <div class="card-body p-4">
                            <h6 class="font-weight-bold mb-3" style="font-size:.95rem;border-bottom:2px solid var(--accent-gold);padding-bottom:10px;">Who Should Use This?</h6>
                            @php $who = [
                                'Workers who want a specific clinic',
                                'Applicants needing same-city booking',
                                'Families or groups booking together',
                                'Urgent cases requiring flexibility',
                            ]; @endphp
                            @foreach($who as $w)
                            <div class="sp-mini-item">
                                <i class="fas fa-user-check" style="color:var(--accent-gold);"></i>
                                <span class="small">{{ $w }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- WhatsApp CTA -->
                    <div class="card border-0" style="background:var(--accent-gold);border-radius:14px;">
                        <div class="card-body p-4 text-center">
                            <i class="fab fa-whatsapp mb-2" style="font-size:2rem;color:#0f1923;"></i>
                            <h6 class="font-weight-bold mb-2" style="color:#0f1923;">Need Help Choosing?</h6>
                            <p class="small mb-3" style="color:#1a252f;">Our team will guide you to the best center based on your location and urgency.</p>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+WAFID+Choice+Center+booking." target="_blank" class="btn btn-dark btn-block font-weight-bold">
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
                <div class="text-light mt-3">Processing Request...</div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
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

                const citySelect = document.getElementById('city');
                const centerSelect = document.getElementById('medicalCenter');

                // Centers grouped by city
                const centers = {
                    Gujranwala: [
                        "Al Falaq Diagnostic Centre",
                        "Alaq Medical & Diagnostic Centre",
                        "Arsh Diagnostic Centre",
                        "CARE PRO DIAGNOSTIC CENTRE",
                        "Citi Care Diagnostic Centre",
                        "EZCare Medical Center",
                        "Health Care Diagnostic Center",
                        "Misbah Diagnostic Center",
                        "Pacific Diagnostic Centre",
                        "Royal Diagnostic Centre",
                    ],

                    Lahore: [
                        "Advanced Medical Diagnostic Center",
                        "AL Safa Medical Center",
                        "Asslaam Diagnostic Centre",
                        "Atlantic Medical Center",
                        "Bestway Medical Clinic",
                        "Canal View Diagnostic Center",
                        "CDC CARE DIAGNOSTIC CENTRE",
                        "Everest Diagnostic Center",
                        "Fatima Diagnostic Center",
                        "Hum Medical & Diagnostic Center",
                        "IMC Diagnostic Center",
                        "Infinity Diagnostic Center",
                        "Iqra Medical Complex",
                        "Medcare Diagnostics",
                        "National Diagnostic Centre",
                        "North Star Medical Diagnostics",
                        "Opal Diagnostic Centre",
                        "Paramount Medical Clinic",
                        "Quest Medical Centre",
                        "Ridan diagnostic centre",
                        "Taj Medical Travellers Clinic",
                        "Wafi Medical Clinic"
                    ]
                };

                citySelect.addEventListener('change', function () {
                    const city = this.value;

                    // Clear previous options
                    centerSelect.innerHTML = '<option value="">Select</option>';

                    if (centers[city]) {
                        centers[city].forEach(center => {
                            const option = document.createElement('option');
                            option.value = center;
                            option.textContent = center;
                            centerSelect.appendChild(option);
                        });
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
                        const response = await fetch("{{ route('special.store') }}", {
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

            // Add this to force uppercase on passports
            $('input[name="passport_no"], input[name="confirm_passport_no"]').on('keyup', function () {
                $(this).val($(this).val().toUpperCase());
            });
        </script>

        @push('schema')
            ,{
                "@type": "Service",
                "@id": "{{ url('/') }}#wafid-choice-service",
                "name": "Wafid Choice Center Appointment",
                "serviceType": "Medical Test",
                "description": "Premium service allowing candidates to manually select their preferred Wafid medical center in Lahore,
                Gujranwala, and other cities instead of auto-assignment.",
                "provider": {
                    "@id": "{{ url('/') }}#organization"
                },
                "areaServed": {
                    "@type": "Country",
                    "name": "Pakistan"
                },
                "availableChannel": {
                    "@type": "ServiceChannel",
                    "serviceUrl": "{{ route('special.appointment') }}",
                    "serviceType": "Online booking"
                }
            }
        @endpush
    @endpush


{{-- BOTTOM SEO SECTIONS --}}
<section class="py-5" style="background:#f7f8fc;">
<div class="container">
<div class="text-center mb-5"><span class="sp-section-label">How It Works</span><h2 class="sp-section-title">How to Select Your GAMCA Medical Center</h2></div>
<div class="row justify-content-center"><div class="col-lg-10"><div class="row">
<div class="col-md-4 mb-4"><div class="sp-step-card"><div class="sp-step-circle">1</div><h6 class="font-weight-bold mb-2">Fill the Form</h6><p class="text-muted small mb-0">Enter your personal and passport details accurately.</p></div></div>
<div class="col-md-4 mb-4"><div class="sp-step-card"><div class="sp-step-circle">2</div><h6 class="font-weight-bold mb-2">Choose City and Center</h6><p class="text-muted small mb-0">Select Lahore or Gujranwala and your preferred medical center.</p></div></div>
<div class="col-md-4 mb-4"><div class="sp-step-card"><div class="sp-step-circle">3</div><h6 class="font-weight-bold mb-2">Submit Request</h6><p class="text-muted small mb-0">Submit your booking through our secure form.</p></div></div>
<div class="col-md-4 mb-4"><div class="sp-step-card"><div class="sp-step-circle">4</div><h6 class="font-weight-bold mb-2">Complete Payment</h6><p class="text-muted small mb-0">Pay via JazzCash, Easypaisa, or local bank transfer.</p></div></div>
<div class="col-md-4 mb-4"><div class="sp-step-card"><div class="sp-step-circle">5</div><h6 class="font-weight-bold mb-2">Receive Slip</h6><p class="text-muted small mb-0">Get your WAFID slip with your selected center on WhatsApp.</p></div></div>
<div class="col-md-4 mb-4"><div class="sp-step-card"><div class="sp-step-circle">6</div><h6 class="font-weight-bold mb-2">Visit Your Clinic</h6><p class="text-muted small mb-0">Attend your medical test at the center you selected.</p></div></div>
</div></div></div>
</div>
</section>
<section class="py-5" style="background:#fff;">
<div class="container"><div class="row">
<div class="col-lg-6 mb-4 mb-lg-0">
<span class="sp-section-label">Why It Matters</span>
<h2 class="sp-section-title">Benefits of Choosing Your Own Center</h2>
<p class="text-muted mb-4">Selecting your own center gives you full control over your medical appointment experience:</p>
<div class="sp-benefit-item"><div class="sp-benefit-icon"><i class="fas fa-map-marker-alt"></i></div><span class="text-muted">Convenience - near your location</span></div>
<div class="sp-benefit-item"><div class="sp-benefit-icon"><i class="fas fa-clock"></i></div><span class="text-muted">Time saving - less travel distance</span></div>
<div class="sp-benefit-item"><div class="sp-benefit-icon"><i class="fas fa-calendar-check"></i></div><span class="text-muted">Better planning for your visit</span></div>
<div class="sp-benefit-item"><div class="sp-benefit-icon"><i class="fas fa-smile"></i></div><span class="text-muted">Reduced stress and confusion</span></div>
</div>
<div class="col-lg-6">
<span class="sp-section-label">Problems We Solve</span>
<h2 class="sp-section-title">Common Problems This Service Solves</h2>
<p class="text-muted mb-4">Many applicants face these issues with standard booking:</p>
<div class="sp-mistake-item"><i class="fas fa-times-circle mr-3" style="color:#e74c3c;font-size:1.1rem;flex-shrink:0;"></i><span class="text-muted">Assigned clinic in a different city</span></div>
<div class="sp-mistake-item"><i class="fas fa-times-circle mr-3" style="color:#e74c3c;font-size:1.1rem;flex-shrink:0;"></i><span class="text-muted">Long travel distance to the center</span></div>
<div class="sp-mistake-item"><i class="fas fa-times-circle mr-3" style="color:#e74c3c;font-size:1.1rem;flex-shrink:0;"></i><span class="text-muted">Inconvenient appointment timing</span></div>
<div class="sp-mistake-item"><i class="fas fa-times-circle mr-3" style="color:#e74c3c;font-size:1.1rem;flex-shrink:0;"></i><span class="text-muted">Need to rebook due to wrong assignment</span></div>
<div class="mt-4 p-3 rounded" style="background:#fff8e1;border-left:4px solid var(--accent-gold);"><p class="small mb-0"><i class="fas fa-check-circle mr-2" style="color:var(--accent-gold);"></i><strong>With WAFID Choice,</strong> you avoid all these problems.</p></div>
</div>
</div></div>
</section>
<section class="py-5" style="background:#f7f8fc;">
<div class="container"><div class="row justify-content-center"><div class="col-lg-8">
<div class="text-center mb-5"><span class="sp-section-label">Quick Answers</span><h2 class="sp-section-title">FAQs - WAFID Choice Center Service</h2></div>
<div id="spFaqAccordion">
<div class="sp-faq-item"><button class="sp-faq-btn" type="button" data-toggle="collapse" data-target="#sfaq0" aria-expanded="true">Can I select any GAMCA medical center?<div class="sp-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div></button><div id="sfaq0" class="collapse show" data-parent="#spFaqAccordion"><div class="sp-faq-body">Yes, based on availability and system rules, we help you choose the best available center in Lahore or Gujranwala.</div></div></div>
<div class="sp-faq-item"><button class="sp-faq-btn collapsed" type="button" data-toggle="collapse" data-target="#sfaq1" aria-expanded="false">Is this better than standard booking?<div class="sp-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div></button><div id="sfaq1" class="collapse" data-parent="#spFaqAccordion"><div class="sp-faq-body">Yes, it gives you full control instead of random assignment. You choose your city and clinic rather than being auto-assigned.</div></div></div>
<div class="sp-faq-item"><button class="sp-faq-btn collapsed" type="button" data-toggle="collapse" data-target="#sfaq2" aria-expanded="false">Will I get confirmation quickly?<div class="sp-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div></button><div id="sfaq2" class="collapse" data-parent="#spFaqAccordion"><div class="sp-faq-body">Yes, most bookings are confirmed within the same day after payment verification.</div></div></div>
<div class="sp-faq-item"><button class="sp-faq-btn collapsed" type="button" data-toggle="collapse" data-target="#sfaq3" aria-expanded="false">Can I change my center later?<div class="sp-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div></button><div id="sfaq3" class="collapse" data-parent="#spFaqAccordion"><div class="sp-faq-body">Changes may be possible before confirmation. Contact our support team immediately via WhatsApp if you need to make changes.</div></div></div>
</div>
<div class="text-center mt-4"><a href="{{ route('faq') }}" class="btn btn-outline-dark px-4 font-weight-bold">View All FAQs</a></div>
</div></div></div>
</section>

@include('public.partials.service-reviews', ['service' => 'WAFID Choice Center'])

<section style="background:linear-gradient(135deg,var(--accent-gold) 0%,#f4b942 100%);padding:50px 0;">
<div class="container text-center">
<h2 class="font-weight-bold mb-3" style="color:#0f1923;">Need Help Choosing the Right Center?</h2>
<p class="mb-4" style="color:#1a252f;max-width:600px;margin:0 auto 24px;">Our team will guide you in selecting the best center based on your location, appointment availability, and urgency of booking.</p>
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+WAFID+Choice+Center+booking." target="_blank" class="btn btn-dark btn-lg px-5 py-3 font-weight-bold"><i class="fab fa-whatsapp mr-2"></i>Get Expert Guidance on WhatsApp</a>
</div>
</section>

@endsection

@push('head')
<style>
    /* ── SEO Intro ── */
    .sp-seo-badge {
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
    .sp-seo-title { font-size: 1.6rem; font-weight: 800; color: #1a252f; margin-bottom: 14px; }
    .sp-check-item { display: flex; align-items: flex-start; gap: 10px; font-size: .9rem; color: #495057; }
    .sp-check-item i { color: #28a745; margin-top: 2px; flex-shrink: 0; }

    /* ── Info Card ── */
    .sp-info-card { background: #fff; border: 1px solid #e8ecf0; border-radius: 14px; overflow: hidden; }
    .sp-info-card-header {
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        color: var(--accent-gold);
        font-weight: 700;
        font-size: .95rem;
        padding: 16px 20px;
    }
    .sp-fee-box { background: #f7f8fc; border: 1px solid #e8ecf0; border-radius: 10px; padding: 14px 16px; margin-top: 12px; }
    .sp-mini-item { display: flex; align-items: center; gap: 10px; padding: 8px 0; border-bottom: 1px solid #f0f4f8; }
    .sp-mini-item:last-child { border-bottom: none; }

    /* ── Docs Strip ── */
    .sp-docs-strip { background: #f7f8fc; border: 1px solid #e8ecf0; border-radius: 14px; padding: 24px; }
    .sp-doc-pill { display: flex; align-items: center; gap: 10px; background: #fff; border: 1px solid #e8ecf0; border-radius: 10px; padding: 10px 14px; }
    .sp-doc-pill i { color: var(--accent-gold); }

    /* ── Sidebar ── */
    .sp-step-num {
        width: 28px; height: 28px;
        background: var(--accent-gold); color: #0f1923;
        border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: .85rem; flex-shrink: 0;
    }

    /* ── Section Labels ── */
    .sp-section-label { display: block; color: var(--accent-gold); font-size: .8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; }
    .sp-section-title { font-size: 1.7rem; font-weight: 800; color: #1a252f; margin-bottom: 1rem; }

    /* ── Step Cards ── */
    .sp-step-card { background: #fff; border: 1px solid #e8ecf0; border-radius: 14px; padding: 24px; text-align: center; height: 100%; transition: all .3s ease; }
    .sp-step-card:hover { transform: translateY(-5px); box-shadow: 0 12px 28px rgba(0,0,0,.08); border-color: var(--accent-gold); }
    .sp-step-circle {
        width: 52px; height: 52px;
        background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%);
        color: var(--accent-gold); border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; font-weight: 800; margin: 0 auto 16px;
    }

    /* ── Benefits & Mistakes ── */
    .sp-benefit-item { display: flex; align-items: center; gap: 14px; padding: 14px 0; border-bottom: 1px solid #f0f4f8; }
    .sp-benefit-item:last-child { border-bottom: none; }
    .sp-benefit-icon { width: 42px; height: 42px; background: #fff8e1; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--accent-gold); flex-shrink: 0; }
    .sp-mistake-item { display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #f0f4f8; }
    .sp-mistake-item:last-child { border-bottom: none; }

    /* ── FAQ ── */
    .sp-faq-item { background: #fff; border: 1px solid #e8ecf0; border-radius: 12px; margin-bottom: 12px; overflow: hidden; transition: border-color .3s; }
    .sp-faq-item:hover { border-color: var(--accent-gold); }
    .sp-faq-btn { width: 100%; text-align: left; background: transparent; border: none; padding: 20px 24px; font-weight: 600; font-size: .95rem; color: #1a252f; display: flex; justify-content: space-between; align-items: center; cursor: pointer; }
    .sp-faq-icon { width: 30px; height: 30px; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-gold); flex-shrink: 0; margin-left: 12px; transition: all .3s ease; }
    .sp-faq-btn[aria-expanded="true"] .sp-faq-icon { background: var(--accent-gold); color: #fff; transform: rotate(180deg); }
    .sp-faq-body { padding: 0 24px 20px; color: #6c757d; font-size: .9rem; line-height: 1.8; }

    /* ── Form card icon ── */
    .fas.fa-hospital-user { color: var(--accent-gold) !important; }
</style>
@endpush