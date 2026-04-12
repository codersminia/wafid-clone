@extends('layouts.public')

@section('title', 'Tasheer Appointment Pakistan | Saudi Visa Biometric Booking (Etimad Centers)')
@section('meta_description', 'Book your Tasheer appointment in Pakistan for Saudi Arabia visa biometric enrollment. Fast slot booking at Etimad centers in Karachi, Lahore, Islamabad & Rawalpindi.')
@section('meta_keywords', 'Tasheer appointment Pakistan, Saudi visa biometric appointment, Etimad center booking, Tasheer Saudi visa, Saudi visa appointment Pakistan')

@section('content')

    <style>
        .stepper-wrapper {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .stepper-wrapper::before {
            content: "";
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #e0e0e0;
            z-index: 1;
        }

        .stepper-item {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: white;
            padding: 0 10px;
        }

        .step-counter {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: white;
            border: 2px solid #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: #999;
            margin-bottom: 5px;
        }

        .stepper-item.active .step-counter {
            border-color: #2c3e50;
            color: #2c3e50;
        }

        .stepper-item.completed .step-counter {
            background-color: #2c3e50;
            border-color: #2c3e50;
            color: white;
        }

        .step-name {
            font-size: 12px;
            color: #999;
        }

        .stepper-item.active .step-name {
            color: #2c3e50;
            font-weight: bold;
        }

        .instruction-list li {
            margin-bottom: 12px;
            font-size: 14px;
            color: #555;
        }

        .comparison-box img {
            max-width: 100%;
            height: auto;
            border: 1px solid #f0f0f0;
        }

        #passportModal .btn-info:disabled {
            background-color: #a0cece !important;
        }

        .custom-upload-widget {
            background: #fff;
            padding: 10px 0;
        }

        .btn-custom-upload {
            background-color: transparent;
            border: 1px solid #ced4da;
            color: #2c3e50;
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 5px;
            transition: all 0.3s ease;
            width: fit-content;
            margin-bottom: 6px;
        }

        .btn-custom-upload:hover {
            background-color: #f8f9fa;
            border-color: #2c3e50;
            color: #146e6e;
        }

        .upload-format-info {
            font-size: 12px;
            color: #888;
            line-height: 1.4;
            margin-top: 5px;
        }

        .upload-status-text {
            font-size: 0.85rem;
            color: #28a745;
            font-weight: bold;
            margin-top: 5px;
        }

        .logo-box img {
            height: 45px;
            margin: 0 10px;
        }
    </style>

    <!-- Page Header -->
    <section class="page-header text-white py-5" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">Tasheer Appointment</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center flex-wrap" style="gap:12px;">
                <div>
                    <span style="display:inline-block;background:#e74c3c;color:#fff;font-size:.72rem;font-weight:700;padding:4px 14px;border-radius:20px;letter-spacing:.5px;text-transform:uppercase;margin-bottom:10px;">
                        <i class="fas fa-clock mr-1"></i> Limited Slots Available
                    </span>
                    <h1 class="font-weight-bold mb-1">Tasheer Appointment Pakistan</h1>
                    <p class="lead mb-0" style="color:rgba(255,255,255,.8);">Saudi Visa Biometric Booking — Etimad Centers in Karachi, Lahore, Islamabad & Rawalpindi.</p>
                </div>
                <div class="ml-auto">
                    <div class="bg-white p-2 rounded shadow-sm d-inline-flex align-items-center" style="gap:8px;">
                        <img src="{{ asset('assets/public/images/tasheer-logo.png') }}" alt="Tasheer Logo" style="height:40px;">
                        <span class="text-muted font-weight-bold">|</span>
                        <img src="{{ asset('assets/public/images/saudi-vision-2030.png') }}" alt="KSA Vision 2030" style="height:40px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Urgency Strip -->
    <div style="background:var(--accent-gold);padding:12px 0;">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap:8px;">
                <p class="mb-0 font-weight-bold" style="color:#0f1923;font-size:.9rem;">
                    <i class="fas fa-clock mr-2"></i><strong>Note:</strong> Slots are limited. Book early to avoid Saudi visa delays.
                </p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+Tasheer+appointment+booking." target="_blank" class="btn btn-dark btn-sm font-weight-bold px-4 flex-shrink-0">
                    <i class="fab fa-whatsapp mr-1"></i>Book Now
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
                    <span class="ts-seo-badge">Saudi Visa Biometric Booking</span>
                    <h2 class="ts-seo-title">Tasheer Appointment Pakistan – Saudi Visa Biometric Booking (Etimad Centers)</h2>
                    <p class="text-muted mb-3">Book your Tasheer appointment in Pakistan for Saudi Arabia visa processing. This step is required for biometric enrollment and document submission at authorized Etimad / Tasheer centers.</p>
                    <p class="text-muted mb-4">We help you secure your Saudi visa appointment slot quickly, avoiding delays caused by limited availability and incorrect booking details.</p>
                    <div class="row">
                        @php $whyTs = [
                            'Fast slot booking (limited availability)',
                            'Correct embassy &amp; center selection',
                            'Avoid booking errors or rejection',
                            'WhatsApp updates and reminders',
                            'Support for urgent visa cases',
                        ]; @endphp
                        @foreach($whyTs as $pt)
                        <div class="col-md-6 mb-2">
                            <div class="ts-check-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{!! $pt !!}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="ts-info-card">
                        <div class="ts-info-card-header">
                            <i class="fas fa-fingerprint mr-2"></i>What is Tasheer / Etimad Appointment?
                        </div>
                        <div class="p-4">
                            <p class="small text-muted mb-3">A Tasheer appointment is an official booking required for submitting your biometric data (fingerprints, photo) and visa documents for Saudi Arabia. The process is handled through authorized centers:</p>
                            <div class="ts-mini-item"><i class="fas fa-building" style="color:var(--accent-gold);"></i><span class="small font-weight-bold">Tasheer</span></div>
                            <div class="ts-mini-item"><i class="fas fa-building" style="color:var(--accent-gold);"></i><span class="small font-weight-bold">Etimad</span></div>
                            <div class="mt-3 p-2 rounded" style="background:#fff3cd;border:1px solid #ffe082;">
                                <p class="small mb-0 font-weight-bold" style="color:#856404;"><i class="fas fa-exclamation-circle mr-1"></i>Without this appointment, your Saudi visa application cannot proceed.</p>
                            </div>
                            <div class="mt-3">
                                <p class="small font-weight-bold mb-2" style="color:#1a252f;">Available Cities:</p>
                                @php $cities = ['Lahore','Islamabad']; @endphp
                                <div class="d-flex flex-wrap" style="gap:6px;">
                                    @foreach($cities as $city)
                                    <span class="badge badge-light border px-3 py-2" style="font-size:.8rem;">📍 {{ $city }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── DOCS STRIP ── --}}
            <div class="ts-docs-strip mb-5">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-clipboard-list mr-2" style="color:var(--accent-gold);font-size:1.2rem;"></i>
                    <h5 class="font-weight-bold mb-0">Documents Required for Tasheer Appointment</h5>
                </div>
                <div class="row">
                    @php $docs = [
                        ['icon'=>'fas fa-passport',      'text'=>'Passport (front page with clear photo)'],
                        ['icon'=>'fas fa-file-alt',      'text'=>'Valid Saudi visa or application reference'],
                        ['icon'=>'fab fa-whatsapp',      'text'=>'Active WhatsApp number'],
                        ['icon'=>'fas fa-globe',         'text'=>'Embassy / visa category selection'],
                    ]; @endphp
                    @foreach($docs as $doc)
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="ts-doc-pill">
                            <i class="{{ $doc['icon'] }}"></i>
                            <span class="small">{{ $doc['text'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="small text-muted mb-0 mt-1"><i class="fas fa-exclamation-triangle mr-1" style="color:var(--accent-gold);"></i>Upload a clear passport image to avoid rejection or delay.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="appointment-form-wrapper shadow-lg">
                        <form id="appointmentForm" class="appointment-form" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Section 1: Center Selection -->
                            <div class="form-section">
                                <h5 class="section-title"><i class="fas fa-map-marker-alt text-dark"></i> Select Center</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Select Visa Embassy <span class="text-danger">*</span></label>
                                        <select name="embassy" class="form-control" id="embassy">
                                            <option value="">-- Select Visa Embassy --</option>
                                            <option value="Karachi">Karachi</option>
                                            <option value="Islamabad">Islamabad</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Select Etimad Center <span class="text-danger">*</span></label>
                                        <select name="etimad_center" class="form-control" id="etimad_center">
                                            <option value="">-- Select Center --</option>
                                            <option value="Lahore">Lahore</option>
                                            <option value="Islamabad">Islamabad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>WhatsApp Number <span class="text-danger">*</span></label>
                                        <input type="tel" name="whatsapp_number" class="form-control" id="whatsapp_number"
                                            placeholder="03xx xxxxxxx">
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Document Upload -->
                            <div class="form-section">
                                <h5 class="section-title"><i class="fas fa-passport text-dark"></i> Documents</h5>
                                <p class="small text-muted mb-4">Upload the front page of your passport. Ensure the photo
                                    and text are clear.</p>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div
                                            class="custom-upload-widget form-group border p-4 rounded bg-light text-center">
                                            <i class="fas fa-passport fa-3x text-muted mb-3"></i>
                                            <h6 class="font-weight-bold">Passport Front Page</h6>

                                            <button type="button" class="btn btn-outline-dark btn-sm mt-2"
                                                data-toggle="modal" data-target="#passportModal">
                                                Upload Passport
                                            </button>

                                            <input type="file" name="passport_pic" id="main_passport_input" class="d-none">
                                            <div id="passport_name_display"
                                                class="upload-status-text mt-2 font-weight-bold text-success"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="alert alert-info small w-100">
                                            <i class="fas fa-info-circle"></i> <strong>Why Passport?</strong> We need your
                                            Passport Number and Expiry Date to book the slot on the official Tasheer portal.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-buttons mt-4">
                                <a href="{{ route('home') }}" class="btn btn-outline-dark">Back</a>
                                <button type="submit" class="btn btn-dark px-5 shadow">Next Step: Payment <i
                                        class="fas fa-arrow-right ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Passport Upload Modal -->
        <div class="modal fade" id="passportModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-weight-bold">Instructions for uploading Passport</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="stepper-wrapper mb-4">
                            <div class="stepper-item active" id="step-1-tab">
                                <div class="step-counter">1</div>
                                <div class="step-name">General</div>
                            </div>
                            <div class="stepper-item" id="step-2-tab">
                                <div class="step-counter">2</div>
                                <div class="step-name">Color</div>
                            </div>
                            <div class="stepper-item" id="step-3-tab">
                                <div class="step-counter">3</div>
                                <div class="step-name">Quality</div>
                            </div>
                            <div class="stepper-item" id="step-4-tab">
                                <div class="step-counter">4</div>
                                <div class="step-name">Scan</div>
                            </div>
                            <div class="stepper-item" id="step-5-tab">
                                <div class="step-counter">5</div>
                                <div class="step-name">Cropping</div>
                            </div>
                            <div class="stepper-item" id="step-6-tab">
                                <div class="step-counter">6</div>
                                <div class="step-name">Upload</div>
                            </div>
                        </div>

                        <div id="passport-steps-content">
                            <div class="step-content active" id="step-1">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="far fa-image mr-2"></i> Only <strong>PNG, JPEG or JPG</strong> images must
                                        be used</li>
                                    <li><i class="fas fa-file-alt mr-2"></i> The <strong>size</strong> of the photo should
                                        not exceed <strong>5 MBs</strong></li>
                                    <li><i class="fas fa-barcode mr-2"></i> The <strong>MRZ code</strong> should be
                                        <strong>clearly visible</strong></li>
                                </ul>
                                <div class="comparison-box text-center mt-3"><img
                                        src="{{ asset('assets/public/images/generalDocumentsFormat.13061148.webp') }}"
                                        class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="step-2">
                                <p><i class="fas fa-th mr-2"></i> Please make sure to upload the document <strong>in full
                                        color</strong>.</p>
                                <div class="comparison-box text-center mt-3"><img
                                        src="{{ asset('assets/public/images/documentsColor.8793867e.webp') }}"
                                        class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="step-3">
                                <p><i class="fas fa-star mr-2"></i> No glare or shadows over the scan.</p>
                                <div class="comparison-box text-center mt-3"><img
                                        src="{{ asset('assets/public/images/documentsQuality.1df57e31.webp') }}"
                                        class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="step-4">
                                <p><i class="fas fa-copy mr-2"></i> Only a single page should be uploaded.</p>
                                <div class="comparison-box text-center mt-3"><img
                                        src="{{ asset('assets/public/images/documentsScan.68ba3262.webp') }}"
                                        class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="step-5">
                                <p><i class="fas fa-crop mr-2"></i> Crop so that <strong>no information is missed</strong>.
                                </p>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="reviewCheck">
                                    <label class="form-check-label" for="reviewCheck">I have reviewed the instructions on
                                        how to upload the photo.</label>
                                </div>
                            </div>
                            <div class="step-content d-none" id="step-6">
                                <div class="upload-area text-center p-5 border rounded" id="drop-zone"
                                    style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-info mb-3"></i>
                                    <p>Click, or <span class="text-info">Browse</span> to upload</p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 5MB)</small>
                                    <input type="file" id="real-passport-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>
                                <div id="passport-modal-error" class="text-danger small mt-2 font-weight-bold"></div>
                                <div id="file-name-display" class="mt-2 text-success font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-back">Back</button>
                        <button type="button" class="btn btn-info text-white px-4" id="btn-continue"
                            style="background-color: #2c3e50;">Continue</button>
                        <button type="button" class="btn btn-info text-white px-4 d-none" id="btn-upload-finish"
                            style="background-color: #2c3e50;">Upload file</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loader -->
        <div id="loaderOverlay">
            <div class="loader-content text-center">
                <div class="spinner-border text-light" style="width: 4rem; height: 4rem;"></div>
                <div class="text-light mt-3">Processing Request...</div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                // --- 1. Stepper Logic for Modal ---
                function setupStepper(config) {
                    let currentStep = 1;
                    const modal = document.getElementById(config.modalId);
                    const btnContinue = document.getElementById(config.btnContinue);
                    const btnBack = document.getElementById(config.btnBack);
                    const btnFinish = document.getElementById(config.btnFinish);
                    const reviewCheck = config.checkId ? document.getElementById(config.checkId) : null;
                    const realInput = document.getElementById(config.realInput);
                    const dropZone = document.getElementById(config.dropZone);
                    const statusDisplay = document.getElementById(config.statusDisplay);
                    const fileNameDisplay = document.getElementById(config.fileNameDisplay);
                    const mainFormInput = document.getElementById(config.mainFormInput);
                    const modalErrorDiv = document.getElementById(config.modalErrorId);

                    function goToStep(step) {
                        modal.querySelectorAll('.step-content').forEach(el => el.classList.add('d-none'));
                        modal.querySelector(`#${config.stepPrefix}${step}`).classList.remove('d-none');
                        modal.querySelectorAll('.stepper-item').forEach((item, index) => {
                            const stepIdx = index + 1;
                            item.classList.toggle('completed', stepIdx < step);
                            item.classList.toggle('active', stepIdx === step);
                        });
                        currentStep = step;
                        btnBack.classList.toggle('d-none', step === 1);
                        btnContinue.classList.toggle('d-none', step === config.totalSteps);
                        btnFinish.classList.toggle('d-none', step !== config.totalSteps);
                        if (step === config.checkStep && reviewCheck) btnContinue.disabled = !reviewCheck.checked;
                        else btnContinue.disabled = false;
                    }

                    if (reviewCheck) reviewCheck.addEventListener('change', () => { if (currentStep === config.checkStep) btnContinue.disabled = !reviewCheck.checked; });
                    btnContinue.addEventListener('click', () => { if (currentStep < config.totalSteps) goToStep(currentStep + 1); });
                    btnBack.addEventListener('click', () => goToStep(currentStep - 1));
                    dropZone.addEventListener('click', () => realInput.click());

                    realInput.addEventListener('change', function () {
                        modalErrorDiv.innerText = "";
                        if (this.files.length > 0) {
                            const file = this.files[0];
                            if (file.size > 5 * 1024 * 1024) { modalErrorDiv.innerText = "Error: File exceeds 5MB limit."; this.value = ""; return; }

                            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                            if (!allowedTypes.includes(file.type)) {
                                modalErrorDiv.innerText = "Error: Only JPG, JPEG, and PNG are allowed.";
                                this.value = ""; // Clear input
                                return;
                            }

                            fileNameDisplay.innerText = "Selected: " + file.name;
                            btnFinish.disabled = false;
                        }
                    });

                    btnFinish.addEventListener('click', function () {
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(realInput.files[0]);
                        mainFormInput.files = dataTransfer.files;

                        // Update UI to show file is selected
                        statusDisplay.innerHTML = `<i class="fas fa-check-circle"></i> ${realInput.files[0].name} attached`;

                        // Clear any error styles on the main widget
                        const widget = mainFormInput.closest('.custom-upload-widget');
                        const btn = widget.querySelector('.btn-custom-upload');
                        if (btn) {
                            btn.style.borderColor = '#ced4da';
                            btn.style.color = '#2c3e50';
                        }
                        const err = widget.querySelector('.invalid-feedback');
                        if (err) err.remove();

                        $(modal).modal('hide');
                    });
                }

                // Initialize Stepper
                setupStepper({
                    modalId: 'passportModal',
                    modalErrorId: 'passport-modal-error',
                    stepPrefix: 'step-',
                    totalSteps: 6,
                    checkStep: 5,
                    checkId: 'reviewCheck',
                    btnContinue: 'btn-continue',
                    btnBack: 'btn-back',
                    btnFinish: 'btn-upload-finish',
                    realInput: 'real-passport-input',
                    dropZone: 'drop-zone',
                    fileNameDisplay: 'file-name-display',
                    statusDisplay: 'passport_name_display',
                    mainFormInput: 'main_passport_input'
                });

                // --- 2. Masking ---
                if (typeof $.fn.inputmask !== 'undefined') $('#whatsapp_number').inputmask('9999 9999999');

                // --- 3. Form Submission & Validation ---
                const form = document.getElementById('appointmentForm');
                const loader = document.getElementById('loaderOverlay');

                // IMPROVED: Safe function to show errors on custom file widgets
                function setWidgetError(inputId, message) {
                    const input = document.getElementById(inputId);
                    if (!input) return; // Guard clause

                    const widget = input.closest('.custom-upload-widget');
                    if (!widget) return; // Guard clause

                    // 1. Color the button red (if found)
                    const btn = widget.querySelector('.btn-custom-upload');
                    if (btn) {
                        btn.style.borderColor = '#dc3545';
                        btn.style.color = '#dc3545';
                    }

                    // 2. Remove existing error if any
                    const existingError = widget.querySelector('.invalid-feedback');
                    if (existingError) existingError.remove();

                    // 3. Create and append new error message
                    const error = document.createElement('div');
                    error.className = 'invalid-feedback d-block'; // d-block forces it to show
                    error.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${message}`;
                    widget.appendChild(error);
                }

                form.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    // Clear previous errors
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                    form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                    form.querySelectorAll('.btn-custom-upload').forEach(el => {
                        el.style.borderColor = '#ced4da';
                        el.style.color = '#2c3e50';
                    });

                    const formData = new FormData(form);
                    loader.classList.add('show');

                    try {
                        const response = await fetch("{{ route('tasheer.store') }}", {
                            method: "POST",
                            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Accept": "application/json" },
                            body: formData
                        });
                        const data = await response.json();

                        if (response.status === 422) {
                            // Loop through errors
                            Object.keys(data.errors).forEach(field => {

                                // CASE A: The Passport File Error
                                if (field === 'passport_pic') {
                                    setWidgetError('main_passport_input', data.errors[field][0]);
                                }

                                // CASE B: Standard Fields (Embassy, Center, Phone)
                                else {
                                    const input = form.querySelector(`[name="${field}"]`);
                                    if (input) {
                                        input.classList.add('is-invalid');
                                        const errorDiv = document.createElement('div');
                                        errorDiv.className = 'invalid-feedback';
                                        errorDiv.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${data.errors[field][0]}`;
                                        input.closest('.form-group').appendChild(errorDiv);
                                    }
                                }
                            });

                            // Scroll to the first error
                            const firstError = document.querySelector('.is-invalid, .invalid-feedback');
                            if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });

                        } else if (data.status === 'success') {
                            window.location.href = data.redirect;
                        }
                    } catch (error) {
                        console.error(error);
                        // alert('A connection error occurred.');
                    } finally {
                        loader.classList.remove('show');
                    }
                });
            });
        </script>

        @push('schema')
            ,{
                "@type": "Service",
                "@id": "{{ url('/') }}#tasheer-service",
                "name": "Tasheer Saudi Visa Appointment",
                "serviceType": "Government Service",
                "description": "Biometric enrollment and document submission appointment booking for Saudi Arabia visa at Tasheer
                (Etimad) centers in Islamabad, Karachi, Lahore, Peshawar, and Quetta.",
                "provider": {
                    "@id": "{{ url('/') }}#organization"
                },
                "areaServed": {
                    "@type": "Country",
                    "name": "Pakistan"
                },
                "availableChannel": {
                    "@type": "ServiceChannel",
                    "serviceUrl": "{{ route('tasheer.form') }}",
                    "serviceType": "Online booking"
                }
            }
        @endpush
    @endpush

{{-- ── BOTTOM SEO SECTIONS ── --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="ts-section-label">How It Works</span>
            <h2 class="ts-section-title">Step-by-Step Tasheer Appointment Process</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    @php $steps = [
                        ['num'=>'1','title'=>'Select Embassy & Center', 'desc'=>'Choose your visa embassy and nearest Etimad/Tasheer center.'],
                        ['num'=>'2','title'=>'Enter Contact Details',   'desc'=>'Provide your WhatsApp number for updates and confirmation.'],
                        ['num'=>'3','title'=>'Upload Passport',         'desc'=>'Upload a clear front page of your passport.'],
                        ['num'=>'4','title'=>'Submit Request',          'desc'=>'Submit your booking through our secure form.'],
                        ['num'=>'5','title'=>'Team Processes Booking',  'desc'=>'Our team processes your appointment on the official system.'],
                        ['num'=>'6','title'=>'Receive Confirmation',    'desc'=>'Get your appointment details and schedule on WhatsApp.'],
                        ['num'=>'7','title'=>'Visit Tasheer Center',    'desc'=>'Attend your appointment for biometric enrollment.'],
                    ]; @endphp
                    @foreach($steps as $step)
                    <div class="col-md-4 mb-4">
                        <div class="ts-step-card">
                            <div class="ts-step-circle">{{ $step['num'] }}</div>
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

<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="ts-section-label">At the Center</span>
                <h2 class="ts-section-title">What Happens at Tasheer Center?</h2>
                <p class="text-muted mb-4">At your appointment, you will:</p>
                @php $atCenter = [
                    ['icon'=>'fas fa-file-alt',    'text'=>'Submit your visa documents'],
                    ['icon'=>'fas fa-fingerprint', 'text'=>'Provide fingerprints (biometrics)'],
                    ['icon'=>'fas fa-camera',      'text'=>'Take a digital photograph'],
                    ['icon'=>'fas fa-check-circle','text'=>'Confirm your application details'],
                ]; @endphp
                @foreach($atCenter as $item)
                <div class="ts-benefit-item">
                    <div class="ts-benefit-icon"><i class="{{ $item['icon'] }}"></i></div>
                    <span class="text-muted">{{ $item['text'] }}</span>
                </div>
                @endforeach
                <div class="mt-4 p-3 rounded" style="background:#fff8e1;border-left:4px solid var(--accent-gold);">
                    <p class="small mb-0"><i class="fas fa-info-circle mr-2" style="color:var(--accent-gold);"></i>Make sure to arrive on time with all required documents.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="ts-section-label">Avoid These Errors</span>
                <h2 class="ts-section-title">Common Mistakes to Avoid</h2>
                <p class="text-muted mb-4">These mistakes can cause visa delays or rebooking issues:</p>
                @php $mistakes = [
                    'Selecting wrong embassy or center',
                    'Uploading unclear passport image',
                    'Missing appointment date',
                    'Incorrect personal details',
                ]; @endphp
                @foreach($mistakes as $m)
                <div class="ts-mistake-item">
                    <i class="fas fa-times-circle mr-3" style="color:#e74c3c;font-size:1.1rem;flex-shrink:0;"></i>
                    <span class="text-muted">{{ $m }}</span>
                </div>
                @endforeach
                <div class="mt-4 p-3 rounded" style="background:#f7f8fc;border:1px solid #e8ecf0;">
                    <p class="small font-weight-bold mb-2">Why Early Booking is Important</p>
                    <p class="small text-muted mb-0">Tasheer appointment slots are limited and fill quickly, especially during peak seasons. Booking early helps you avoid delays, get your preferred date, and complete your application on schedule.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="ts-section-label">Quick Answers</span>
                    <h2 class="ts-section-title">Tasheer Appointment FAQs</h2>
                </div>
                <div id="tsFaqAccordion">
                    @php $tsFaqs = [
                        ['q'=>'Is Tasheer appointment mandatory for Saudi visa?', 'a'=>'Yes, biometric submission through Tasheer/Etimad is required for Saudi Arabia visa processing. Without this appointment, your visa application cannot proceed.'],
                        ['q'=>'How long does booking take?',                      'a'=>'Most appointments are booked within 24–48 hours depending on slot availability at your chosen center.'],
                        ['q'=>'Can I reschedule my appointment?',                 'a'=>'Yes, but it depends on slot availability. Contact our support team early via WhatsApp if you need to reschedule.'],
                        ['q'=>'What should I bring to the center?',              'a'=>'Bring your original passport, appointment confirmation slip, and all required visa documents.'],
                    ]; @endphp
                    @foreach($tsFaqs as $i => $faq)
                    <div class="ts-faq-item">
                        <button class="ts-faq-btn {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#tsfaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                            {{ $faq['q'] }}
                            <div class="ts-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div>
                        </button>
                        <div id="tsfaq{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}" data-parent="#tsFaqAccordion">
                            <div class="ts-faq-body">{{ $faq['a'] }}</div>
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

@include('public.partials.service-reviews', ['service' => 'Tasheer Saudi Visa Appointment'])

<section style="background:linear-gradient(135deg,var(--accent-gold) 0%,#f4b942 100%);padding:50px 0;">
    <div class="container text-center">
        <h2 class="font-weight-bold mb-3" style="color:#0f1923;">Need Help with Your Saudi Visa Appointment?</h2>
        <p class="mb-4" style="color:#1a252f;max-width:600px;margin:0 auto 24px;">Our team provides full support for appointment booking, document preparation, embassy selection, and urgent slot requests.</p>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+Tasheer+appointment+booking." target="_blank" class="btn btn-dark btn-lg px-5 py-3 font-weight-bold">
            <i class="fab fa-whatsapp mr-2"></i>Get Help on WhatsApp
        </a>
    </div>
</section>

@push('head')
<style>
    .ts-seo-badge { display:inline-block;background:var(--accent-gold);color:#0f1923;font-size:.72rem;font-weight:700;padding:5px 14px;border-radius:20px;letter-spacing:.5px;text-transform:uppercase;margin-bottom:12px; }
    .ts-seo-title { font-size:1.6rem;font-weight:800;color:#1a252f;margin-bottom:14px; }
    .ts-check-item { display:flex;align-items:flex-start;gap:10px;font-size:.9rem;color:#495057; }
    .ts-check-item i { color:#28a745;margin-top:2px;flex-shrink:0; }
    .ts-info-card { background:#fff;border:1px solid #e8ecf0;border-radius:14px;overflow:hidden; }
    .ts-info-card-header { background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);color:var(--accent-gold);font-weight:700;font-size:.95rem;padding:16px 20px; }
    .ts-mini-item { display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f0f4f8; }
    .ts-mini-item:last-child { border-bottom:none; }
    .ts-docs-strip { background:#f7f8fc;border:1px solid #e8ecf0;border-radius:14px;padding:24px; }
    .ts-doc-pill { display:flex;align-items:center;gap:10px;background:#fff;border:1px solid #e8ecf0;border-radius:10px;padding:10px 14px; }
    .ts-doc-pill i { color:var(--accent-gold); }
    .ts-section-label { display:block;color:var(--accent-gold);font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px; }
    .ts-section-title { font-size:1.7rem;font-weight:800;color:#1a252f;margin-bottom:1rem; }
    .ts-step-card { background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:24px;text-align:center;height:100%;transition:all .3s ease; }
    .ts-step-card:hover { transform:translateY(-5px);box-shadow:0 12px 28px rgba(0,0,0,.08);border-color:var(--accent-gold); }
    .ts-step-circle { width:52px;height:52px;background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);color:var(--accent-gold);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.3rem;font-weight:800;margin:0 auto 16px; }
    .ts-benefit-item { display:flex;align-items:center;gap:14px;padding:14px 0;border-bottom:1px solid #f0f4f8; }
    .ts-benefit-item:last-child { border-bottom:none; }
    .ts-benefit-icon { width:42px;height:42px;background:#fff8e1;border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--accent-gold);flex-shrink:0; }
    .ts-mistake-item { display:flex;align-items:center;padding:12px 0;border-bottom:1px solid #f0f4f8; }
    .ts-mistake-item:last-child { border-bottom:none; }
    .ts-faq-item { background:#fff;border:1px solid #e8ecf0;border-radius:12px;margin-bottom:12px;overflow:hidden;transition:border-color .3s; }
    .ts-faq-item:hover { border-color:var(--accent-gold); }
    .ts-faq-btn { width:100%;text-align:left;background:transparent;border:none;padding:20px 24px;font-weight:600;font-size:.95rem;color:#1a252f;display:flex;justify-content:space-between;align-items:center;cursor:pointer; }
    .ts-faq-icon { width:30px;height:30px;background:#f8f9fa;border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--accent-gold);flex-shrink:0;margin-left:12px;transition:all .3s ease; }
    .ts-faq-btn[aria-expanded="true"] .ts-faq-icon { background:var(--accent-gold);color:#fff;transform:rotate(180deg); }
    .ts-faq-body { padding:0 24px 20px;color:#6c757d;font-size:.9rem;line-height:1.8; }
</style>
@endpush

@endsection

@push('schema')
,{
    "@type": "WebPage",
    "@id": "{{ url()->current() }}#webpage",
    "name": "Tasheer Appointment Pakistan | Saudi Visa Biometric Booking (Etimad Centers)",
    "url": "{{ url()->current() }}",
    "description": "Book your Tasheer appointment in Pakistan for Saudi Arabia visa biometric enrollment. Fast slot booking at Etimad centers in Karachi, Lahore, Islamabad & Rawalpindi.",
    "isPartOf": { "@id": "{{ url('/') }}#website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
            { "@type": "ListItem", "position": 2, "name": "Tasheer Appointment", "item": "{{ url()->current() }}" }
        ]
    }
}
@endpush

@push('schema')
@php
    $svcRatings = \App\Models\ServiceReview::where('service', 'Tasheer Saudi Visa Appointment')->where('status', 'approved')->pluck('rating')->filter(fn($r) => is_numeric($r));
@endphp
@if($svcRatings->count() > 0)
,{
    "@type": "Service",
    "@id": "{{ url('/') }}#tasheer-service-rating",
    "name": "Tasheer Saudi Visa Appointment",
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
            "name": "Is Tasheer appointment mandatory for Saudi visa?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, biometric submission through Tasheer/Etimad is required for Saudi Arabia visa processing. Without this appointment, your visa application cannot proceed." }
        },
        {
            "@type": "Question",
            "name": "How long does Tasheer booking take?",
            "acceptedAnswer": { "@type": "Answer", "text": "Most appointments are booked within 24-48 hours depending on slot availability at your chosen center." }
        },
        {
            "@type": "Question",
            "name": "What should I bring to the Tasheer center?",
            "acceptedAnswer": { "@type": "Answer", "text": "Bring your original passport, appointment confirmation slip, and all required visa documents." }
        }
    ]
}
@endpush
