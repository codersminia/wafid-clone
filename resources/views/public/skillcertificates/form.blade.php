@extends('layouts.public')

@section('title', 'Soft Skill Certificate Pakistan | Work Readiness Certificate for Gulf Jobs')
@section('meta_description', 'Get your Soft Skill Work Readiness Certificate in Pakistan for Gulf jobs in Saudi Arabia, UAE, Qatar, Oman, Kuwait & Bahrain. Delivered digitally on WhatsApp within 24 hours.')
@section('meta_keywords', 'soft skill certificate Pakistan, work readiness certificate GCC, CV improvement certificate, Gulf job certificate Pakistan, Saudi visa skills certificate')

@section('content')

    <style>
        /* Keep your existing CSS styles exactly as they were */
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

        .upload-format-info {
            font-size: 12px;
            color: #888;
            line-height: 1.4;
            margin-top: 5px;
        }

        .btn-custom-upload:hover {
            background-color: #f8f9fa;
            border-color: #2c3e50;
            color: #146e6e;
        }

        .upload-status-text {
            font-size: 0.85rem;
            color: #28a745;
            margin-top: 5px;
        }

        #loaderOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        #loaderOverlay.show {
            display: flex;
        }

        .custom-upload-widget.border-danger {
            border-color: #dc3545 !important;
            background-color: #fff8f8;
        }

        .invalid-feedback {
            display: block;
        }

        .benefits-list li {
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #555;
        }

        .benefits-list i {
            color: #28a745;
            margin-right: 10px;
        }
    </style>

    <!-- Page Header -->
    <section class="page-header text-white py-5" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">Soft Skill Certificate</li>
                </ol>
            </nav>
            <span style="display:inline-block;background:var(--accent-gold);color:#0f1923;font-size:.72rem;font-weight:700;padding:4px 14px;border-radius:20px;letter-spacing:.5px;text-transform:uppercase;margin-bottom:10px;">
                <i class="fas fa-bolt mr-1"></i> Get Certificate Within 24 Hours
            </span>
            <h1 class="font-weight-bold mb-1">Soft Skill Certificate Pakistan</h1>
            <p class="lead mb-0" style="color:rgba(255,255,255,.8);">Work Readiness Certificate for Gulf Jobs — Improve your CV instantly.</p>
        </div>
    </section>

    <!-- Strip -->
    <div style="background:var(--accent-gold);padding:12px 0;">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap:8px;">
                <p class="mb-0 font-weight-bold" style="color:#0f1923;font-size:.9rem;">
                    <i class="fas fa-certificate mr-2"></i>Improve your job chances instantly — Used by Gulf job applicants across Pakistan.
                </p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+a+Soft+Skill+Certificate." target="_blank" class="btn btn-dark btn-sm font-weight-bold px-4 flex-shrink-0">
                    <i class="fab fa-whatsapp mr-1"></i>Apply Now
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
                    <span class="sc-seo-badge">Work Readiness Certificate 2026</span>
                    <h2 class="sc-seo-title">Soft Skill Certificate Pakistan – Work Readiness Certificate for Gulf Jobs</h2>
                    <p class="text-muted mb-3">Get your Soft Skill Certificate in Pakistan and enhance your CV for jobs in <strong>Saudi Arabia, UAE, Qatar, Oman, Kuwait, and Bahrain</strong>. This Work Readiness Certificate proves that you understand essential workplace skills required by Gulf employers.</p>
                    <p class="text-muted mb-4">Delivered digitally on your WhatsApp, ready to download and use.</p>
                    <div class="row">
                        @php $whySc = [
                            'Improve your CV for Gulf jobs',
                            'Increase chances of job selection',
                            'Show professional work readiness',
                            'Stand out from other candidates',
                            'Support your visa application profile',
                        ]; @endphp
                        @foreach($whySc as $pt)
                        <div class="col-md-6 mb-2">
                            <div class="sc-check-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ $pt }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="sc-info-card">
                        <div class="sc-info-card-header">
                            <i class="fas fa-certificate mr-2"></i>What is a Work Readiness Certificate?
                        </div>
                        <div class="p-4">
                            <p class="small text-muted mb-3">A Soft Skill / Work Readiness Certificate is a verified document that confirms your understanding of essential workplace skills. Especially useful for workers applying for jobs in:</p>
                            @php $sectors = ['Construction','Technical trades','Hospitality','Office and admin roles']; @endphp
                            @foreach($sectors as $s)
                            <div class="sc-mini-item"><i class="fas fa-briefcase" style="color:var(--accent-gold);font-size:.8rem;"></i><span class="small">{{ $s }}</span></div>
                            @endforeach
                            <div class="mt-3">
                                <p class="small font-weight-bold mb-2" style="color:#1a252f;">Skills Covered:</p>
                                <div class="d-flex flex-wrap" style="gap:6px;">
                                    @foreach(['Communication','Teamwork','Time Management','Workplace Safety'] as $skill)
                                    <span class="badge px-3 py-2" style="background:var(--accent-gold);color:#0f1923;font-size:.78rem;">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── DOCS STRIP ── --}}
            <div class="sc-docs-strip mb-5">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-clipboard-list mr-2" style="color:var(--accent-gold);font-size:1.2rem;"></i>
                    <h5 class="font-weight-bold mb-0">Documents Required</h5>
                </div>
                <div class="row">
                    @php $docs = [
                        ['icon'=>'fas fa-id-card',    'text'=>'CNIC (front side)'],
                        ['icon'=>'fas fa-passport',   'text'=>'Passport copy'],
                        ['icon'=>'fab fa-whatsapp',   'text'=>'Active WhatsApp number'],
                    ]; @endphp
                    @foreach($docs as $doc)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="sc-doc-pill">
                            <i class="{{ $doc['icon'] }}"></i>
                            <span class="small">{{ $doc['text'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="small text-muted mb-0 mt-1"><i class="fas fa-exclamation-triangle mr-1" style="color:var(--accent-gold);"></i>Upload clear images to ensure smooth processing.</p>
            </div>

            <div class="row">

                <!-- Left Column: Form -->
                <div class="col-lg-8">
                    <div class="appointment-form-wrapper shadow-sm">
                        <form id="softSkillForm" class="appointment-form" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-section">
                                <h5 class="section-title"><i class="fas fa-user-edit text-dark"></i> Applicant Details</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="whatsapp_number">WhatsApp Number <span
                                                class="text-danger">*</span></label>
                                        <input type="tel" name="whatsapp_number" class="form-control" id="whatsapp_number"
                                            placeholder="03xx xxxxxxx">
                                        <small class="text-muted">The digital certificate will be sent to this
                                            number.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h5 class="section-title"><i class="fas fa-file-upload text-dark"></i> Upload Documents</h5>
                                <p class="small text-muted mb-3">Clear photos are required for identity verification on the
                                    certificate.</p>

                                <div class="row">
                                    <!-- 1. ID Front -->
                                    <div class="col-md-6 mb-4">
                                        <div
                                            class="custom-upload-widget border text-center p-4 rounded bg-light hover-shadow h-100">
                                            <i class="fas fa-id-card fa-3x text-muted mb-3"></i>
                                            <h6 class="font-weight-bold">1. ID Card Front</h6>

                                            <button type="button" class="btn btn-outline-dark btn-sm mt-2"
                                                data-toggle="modal" data-target="#idFrontModal">
                                                Upload Front
                                            </button>

                                            <input type="file" name="id_card_front" id="main_id_front_input" class="d-none">
                                            <div id="id_front_status" class="upload-status-text mt-2"></div>
                                        </div>
                                    </div>

                                    <!-- 2. Passport (Renamed from 4 to 2 for logical order) -->
                                    <div class="col-md-6 mb-4">
                                        <div
                                            class="custom-upload-widget border text-center p-4 rounded bg-light hover-shadow h-100">
                                            <i class="fas fa-passport fa-3x text-muted mb-3"></i>
                                            <h6 class="font-weight-bold">2. Passport</h6>

                                            <button type="button" class="btn btn-outline-dark btn-sm mt-2"
                                                data-toggle="modal" data-target="#passportModal">
                                                Upload Passport
                                            </button>

                                            <input type="file" name="passport_pic" id="main_passport_input" class="d-none">
                                            <div id="passport_name_display" class="upload-status-text mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-buttons mt-4">
                                <a href="{{ route('home') }}" class="btn btn-outline-dark">Cancel</a>
                                <button type="submit" class="btn btn-dark px-5 shadow">Next: Processing Fee <i
                                        class="fas fa-arrow-right ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column: SEO Content -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 mb-4" style="border-radius:14px;background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
                        <div class="card-body p-4">
                            <h5 class="font-weight-bold mb-3 text-white"><i class="fas fa-star mr-2" style="color:var(--accent-gold);"></i>Why Get This Certificate?</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex align-items-start" style="gap:10px;">
                                    <span class="sc-step-num">1</span>
                                    <span style="color:rgba(255,255,255,.85);font-size:.9rem;"><strong style="color:var(--accent-gold);">Visa Support:</strong> Adds value to your visa application profile.</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start" style="gap:10px;">
                                    <span class="sc-step-num">2</span>
                                    <span style="color:rgba(255,255,255,.85);font-size:.9rem;"><strong style="color:var(--accent-gold);">Higher Salary:</strong> Candidates with soft skills often negotiate better pay.</span>
                                </li>
                                <li class="d-flex align-items-start" style="gap:10px;">
                                    <span class="sc-step-num">3</span>
                                    <span style="color:rgba(255,255,255,.85);font-size:.9rem;"><strong style="color:var(--accent-gold);">Job Ready:</strong> Proves you understand workplace ethics and safety.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-4" style="border-radius:14px;">
                        <div class="card-body p-4">
                            <h6 class="font-weight-bold mb-3" style="font-size:.95rem;border-bottom:2px solid var(--accent-gold);padding-bottom:10px;">Who Should Apply?</h6>
                            @php $who = ['Workers applying for GCC jobs','Fresh candidates with no experience','Skilled labor (electricians, plumbers, drivers)','Job seekers improving their CV','Applicants preparing for visa processing']; @endphp
                            @foreach($who as $w)
                            <div class="sc-mini-item"><i class="fas fa-user-check" style="color:var(--accent-gold);"></i><span class="small">{{ $w }}</span></div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card border-0" style="background:var(--accent-gold);border-radius:14px;">
                        <div class="card-body p-4 text-center">
                            <i class="fab fa-whatsapp mb-2" style="font-size:2rem;color:#0f1923;"></i>
                            <h6 class="font-weight-bold mb-2" style="color:#0f1923;">Get Certificate in 24 Hours</h6>
                            <p class="small mb-3" style="color:#1a252f;">Apply now and receive your digital certificate on WhatsApp.</p>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+a+Soft+Skill+Certificate." target="_blank" class="btn btn-dark btn-block font-weight-bold">
                                <i class="fab fa-whatsapp mr-2"></i>Chat on WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= ID CARD FRONT MODAL ================= -->
        <div class="modal fade" id="idFrontModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-weight-bold">Instructions for ID Card Front</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="stepper-wrapper mb-4">
                            <div class="stepper-item active" id="idf-step-tab-1">
                                <div class="step-counter">1</div>
                                <div class="step-name">Front</div>
                            </div>
                            <div class="stepper-item" id="idf-step-tab-2">
                                <div class="step-counter">2</div>
                                <div class="step-name">Quality</div>
                            </div>
                            <div class="stepper-item" id="idf-step-tab-3">
                                <div class="step-counter">3</div>
                                <div class="step-name">Edges</div>
                            </div>
                            <div class="stepper-item" id="idf-step-tab-4">
                                <div class="step-counter">4</div>
                                <div class="step-name">Upload</div>
                            </div>
                        </div>
                        <div class="id-steps-content">
                            <div class="step-content active" id="idf-step-1">
                                <p>Upload the <strong>Front Side</strong> of your original ID card. Photocopies are not
                                    accepted.</p>
                                <div class="text-center"><img
                                        src="{{ asset('assets/public/images/documentsColor.8793867e.webp') }}"
                                        class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="idf-step-2">
                                <p>Ensure there is <strong>no glare</strong> from lights and all text is readable.</p>
                                <div class="text-center"><img
                                        src="{{ asset('assets/public/images/documentsQuality.1df57e31.webp') }}"
                                        class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="idf-step-3">
                                <p>Make sure all <strong>four corners</strong> of the card are visible in the photo.</p>
                                <div class="text-center"><img
                                        src="{{ asset('assets/public/images/documentsCrop.3a15f38c.webp') }}"
                                        class="img-fluid rounded"></div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="idfReviewCheck">
                                    <label class="form-check-label" for="idfReviewCheck">I have confirmed the card is clear
                                        and fully visible.</label>
                                </div>
                            </div>
                            <div class="step-content d-none" id="idf-step-4">
                                <div class="upload-area text-center p-5 border rounded" id="idf-drop-zone"
                                    style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-id-card fa-3x text-info mb-3"></i>
                                    <p>Click to upload <strong>ID Card Front</strong></p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 5MB)</small>
                                    <input type="file" id="real-idf-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>
                                <div id="idf-file-name" class="mt-2 text-success font-weight-bold"></div>
                                <div id="idf-error" class="text-danger mt-2 small font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-idf-back">Back</button>
                        <button type="button" class="btn btn-info text-white" id="btn-idf-continue"
                            style="background-color: #2c3e50;">Continue</button>
                        <button type="button" class="btn btn-info text-white d-none" id="btn-idf-finish"
                            style="background-color: #2c3e50;">Finish</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= PASSPORT MODAL ================= -->
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
                <div class="text-light mt-3">Submitting Application...</div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {

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
                    const mainFormInput = document.getElementById(config.mainFormInput);
                    const fileNameDisplay = document.getElementById(config.fileNameDisplayId);
                    const modalErrorDiv = document.getElementById(config.modalErrorId);

                    function goToStep(step) {
                        // Use Vanilla JS for consistency with your requested snippet
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

                        if (step === config.checkStep && reviewCheck) {
                            btnContinue.disabled = !reviewCheck.checked;
                        } else if (step === config.totalSteps) {
                            btnFinish.disabled = !realInput.files.length;
                        } else {
                            btnContinue.disabled = false;
                        }
                    }

                    if (reviewCheck) {
                        reviewCheck.addEventListener('change', () => {
                            if (currentStep === config.checkStep) btnContinue.disabled = !reviewCheck.checked;
                        });
                    }

                    btnContinue.addEventListener('click', () => { if (currentStep < config.totalSteps) goToStep(currentStep + 1); });
                    btnBack.addEventListener('click', () => goToStep(currentStep - 1));
                    dropZone.addEventListener('click', () => realInput.click());

                    realInput.addEventListener('change', function () {
                        // Reset state
                        modalErrorDiv.innerText = "";
                        fileNameDisplay.innerText = "";
                        btnFinish.disabled = true;

                        if (this.files.length > 0) {
                            const file = this.files[0];

                            if (file.size > 5 * 1024 * 1024) {
                                modalErrorDiv.innerText = "Error: File exceeds 5MB limit.";
                                this.value = "";
                                return;
                            }

                            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                            if (!allowedTypes.includes(file.type)) {
                                modalErrorDiv.innerText = "Error: Only JPG, JPEG, and PNG are allowed.";
                                this.value = "";
                                return;
                            }

                            fileNameDisplay.innerText = "Selected: " + file.name;
                            btnFinish.disabled = false;
                        }
                    });

                    btnFinish.addEventListener('click', function () {
                        if (realInput.files.length > 0) {
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(realInput.files[0]);
                            mainFormInput.files = dataTransfer.files;

                            statusDisplay.innerHTML = `<i class="fas fa-check-circle"></i> Attached`;
                            $(modal).modal('hide');
                        }
                    });
                }

                // --- REMOVED ID BACK AND PHOTO STEPPERS ---

                // 1. ID Front Stepper
                setupStepper({
                    modalId: 'idFrontModal', stepPrefix: 'idf-step-', totalSteps: 4, checkStep: 3, checkId: 'idfReviewCheck',
                    btnContinue: 'btn-idf-continue', btnBack: 'btn-idf-back', btnFinish: 'btn-idf-finish',
                    realInput: 'real-idf-input', dropZone: 'idf-drop-zone',
                    fileNameDisplayId: 'idf-file-name',
                    modalErrorId: 'idf-error',
                    statusDisplay: 'id_front_status', mainFormInput: 'main_id_front_input'
                });

                // 2. Passport Stepper
                setupStepper({
                    modalId: 'passportModal',
                    stepPrefix: 'step-',
                    totalSteps: 6,
                    checkStep: 5,
                    checkId: 'reviewCheck',
                    btnContinue: 'btn-continue',
                    btnBack: 'btn-back',
                    btnFinish: 'btn-upload-finish',
                    realInput: 'real-passport-input',
                    dropZone: 'drop-zone',
                    fileNameDisplayId: 'file-name-display',
                    modalErrorId: 'passport-modal-error',
                    statusDisplay: 'passport_name_display',
                    mainFormInput: 'main_passport_input'
                });

                // Error Handler
                function setWidgetError(inputId, message) {
                    const input = document.getElementById(inputId);
                    if (!input) return;

                    const widget = input.closest('.custom-upload-widget');
                    if (!widget) return;

                    const btn = widget.querySelector('.btn-custom-upload');
                    if (btn) {
                        btn.style.borderColor = '#dc3545';
                        btn.style.color = '#dc3545';
                    }

                    const existingError = widget.querySelector('.invalid-feedback');
                    if (existingError) existingError.remove();

                    const error = document.createElement('div');
                    error.className = 'invalid-feedback d-block';
                    error.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${message}`;
                    widget.appendChild(error);
                }

                if (typeof $.fn.inputmask !== 'undefined') $('#whatsapp_number').inputmask('9999 9999999');

                $('#softSkillForm').on('submit', async function (e) {
                    e.preventDefault();
                    const form = this;
                    const formData = new FormData(form);
                    const loader = document.getElementById('loaderOverlay');

                    // Reset errors
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                    form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                    form.querySelectorAll('.btn-custom-upload').forEach(el => {
                        el.style.borderColor = '#ced4da';
                        el.style.color = '#2c3e50';
                    });

                    loader.classList.add('show');

                    try {
                        const response = await fetch("{{ route('softskill.store') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json",
                            },
                            body: formData
                        });

                        const data = await response.json();

                        if (response.status === 422) {
                            Object.keys(data.errors).forEach(field => {
                                const errorMessage = data.errors[field][0];

                                // Mapping - REMOVED ID BACK AND USER PIC MAPPING
                                if (field === 'id_card_front') setWidgetError('main_id_front_input', errorMessage);
                                else if (field === 'passport_pic') setWidgetError('main_passport_input', errorMessage);
                                else {
                                    // Standard Input
                                    const input = form.querySelector(`[name="${field}"]`);
                                    if (input) {
                                        input.classList.add('is-invalid');
                                        const errorDiv = document.createElement('div');
                                        errorDiv.className = 'invalid-feedback';
                                        errorDiv.innerHTML = errorMessage;
                                        input.closest('.form-group').appendChild(errorDiv);
                                    }
                                }
                            });

                            const firstError = document.querySelector('.is-invalid, .invalid-feedback');
                            if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });

                        } else if (data.status === 'success') {
                            window.location.href = data.redirect;
                        }
                    } catch (err) {
                        // handle error
                        console.error(err);
                        // alert("An unexpected error occurred.");
                    } finally {
                        loader.classList.remove('show');
                    }
                });
            });

            @push('schema')
                , {
                    "@type": "Service",
                        "@id": "{{ url('/') }}#softskill-service",
                            "name": "Soft Skill Certificate Program",
                                "serviceType": "Educational Occupational Credential",
                                    "description": "Work readiness and soft skill certification program for GCC employment. Covers communication, teamwork, time management, workplace safety, and basic English skills.",
                                        "provider": {
                        "@id": "{{ url('/') }}#organization"
                    },
                    "areaServed": {
                        "@type": "Country",
                            "name": "Pakistan"
                    },
                    "availableChannel": {
                        "@type": "ServiceChannel",
                            "serviceUrl": "{{ route('softskill.form') }}",
                                "serviceType": "Online application"
                    }
                }
            @endpush
        </script>
    @endpush

{{-- ── BOTTOM SEO SECTIONS ── --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="sc-section-label">How It Works</span>
            <h2 class="sc-section-title">How to Get Your Soft Skill Certificate</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    @php $steps = [
                        ['num'=>'1','title'=>'Enter WhatsApp Number', 'desc'=>'Provide your active WhatsApp number for certificate delivery.'],
                        ['num'=>'2','title'=>'Upload Documents',      'desc'=>'Upload your CNIC front side and passport copy clearly.'],
                        ['num'=>'3','title'=>'Submit Request',        'desc'=>'Submit your application through our secure form.'],
                        ['num'=>'4','title'=>'Team Verifies Details', 'desc'=>'Our team reviews and verifies your submitted documents.'],
                        ['num'=>'5','title'=>'Certificate Generated', 'desc'=>'Your digital Work Readiness Certificate is generated.'],
                        ['num'=>'6','title'=>'Receive on WhatsApp',   'desc'=>'Get your certificate as a PDF on WhatsApp within 24 hours.'],
                    ]; @endphp
                    @foreach($steps as $step)
                    <div class="col-md-4 mb-4">
                        <div class="sc-step-card">
                            <div class="sc-step-circle">{{ $step['num'] }}</div>
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
                <span class="sc-section-label">What You Gain</span>
                <h2 class="sc-section-title">Benefits of Soft Skill Certification</h2>
                @php $benefits = [
                    ['icon'=>'fas fa-briefcase',    'text'=>'Better job opportunities in GCC countries'],
                    ['icon'=>'fas fa-money-bill',   'text'=>'Higher salary potential'],
                    ['icon'=>'fas fa-file-alt',     'text'=>'Professional CV improvement'],
                    ['icon'=>'fas fa-bolt',         'text'=>'Faster employer selection'],
                    ['icon'=>'fas fa-smile',        'text'=>'Increased confidence during interviews'],
                ]; @endphp
                @foreach($benefits as $b)
                <div class="sc-benefit-item">
                    <div class="sc-benefit-icon"><i class="{{ $b['icon'] }}"></i></div>
                    <span class="text-muted">{{ $b['text'] }}</span>
                </div>
                @endforeach
            </div>
            <div class="col-lg-6">
                <span class="sc-section-label">Why Choose Us</span>
                <h2 class="sc-section-title">Why Choose Gulf Medical Consultant?</h2>
                @php $whyUs = [
                    'Fast certificate processing',
                    'Verified and professional format',
                    'WhatsApp delivery for easy access',
                    'Support for Gulf job applicants',
                    'Trusted by job seekers across Pakistan',
                ]; @endphp
                @foreach($whyUs as $w)
                <div class="sc-check-item mb-3">
                    <i class="fas fa-check-circle" style="color:#28a745;flex-shrink:0;"></i>
                    <span class="text-muted">{{ $w }}</span>
                </div>
                @endforeach
                <div class="mt-4 p-3 rounded" style="background:#fff8e1;border-left:4px solid var(--accent-gold);">
                    <p class="small mb-0"><i class="fas fa-link mr-2" style="color:var(--accent-gold);"></i>Also useful alongside your <a href="{{ route('medicalExamination') }}" style="color:var(--accent-gold);">GAMCA Medical Appointment</a> and <a href="{{ route('public.gcc.country', 'saudi-arabia') }}" style="color:var(--accent-gold);">Saudi Arabia visa process</a>.</p>
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
                    <span class="sc-section-label">Quick Answers</span>
                    <h2 class="sc-section-title">Soft Skill Certificate FAQs</h2>
                </div>
                <div id="scFaqAccordion">
                    @php $scFaqs = [
                        ['q'=>'Is this certificate mandatory for Gulf jobs?',       'a'=>'No, but it significantly improves your chances of selection and salary. Gulf employers prefer candidates with verified workplace skills.'],
                        ['q'=>'How long does it take to receive the certificate?',  'a'=>'Most certificates are issued within 24 hours after document verification and payment confirmation.'],
                        ['q'=>'Will I get a physical copy?',                        'a'=>'You receive a digital certificate (PDF) which you can print anytime. It is delivered directly to your WhatsApp.'],
                        ['q'=>'Can I use this for all GCC countries?',              'a'=>'Yes, it is useful for jobs in all GCC countries including Saudi Arabia, UAE, Qatar, Oman, Kuwait, and Bahrain.'],
                    ]; @endphp
                    @foreach($scFaqs as $i => $faq)
                    <div class="sc-faq-item">
                        <button class="sc-faq-btn {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#scfaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                            {{ $faq['q'] }}
                            <div class="sc-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div>
                        </button>
                        <div id="scfaq{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}" data-parent="#scFaqAccordion">
                            <div class="sc-faq-body">{{ $faq['a'] }}</div>
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

@include('public.partials.service-reviews', ['service' => 'Soft Skill Certificate'])

<section style="background:linear-gradient(135deg,var(--accent-gold) 0%,#f4b942 100%);padding:50px 0;">
    <div class="container text-center">
        <h2 class="font-weight-bold mb-3" style="color:#0f1923;">Get Your Certificate Within 24 Hours</h2>
        <p class="mb-4" style="color:#1a252f;max-width:600px;margin:0 auto 24px;">Improve your job chances instantly. Used by Gulf job applicants across Pakistan. Apply now and receive your digital certificate on WhatsApp.</p>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+a+Soft+Skill+Certificate." target="_blank" class="btn btn-dark btn-lg px-5 py-3 font-weight-bold">
            <i class="fab fa-whatsapp mr-2"></i>Apply on WhatsApp
        </a>
    </div>
</section>

@push('head')
<style>
    .sc-seo-badge { display:inline-block;background:var(--accent-gold);color:#0f1923;font-size:.72rem;font-weight:700;padding:5px 14px;border-radius:20px;letter-spacing:.5px;text-transform:uppercase;margin-bottom:12px; }
    .sc-seo-title { font-size:1.6rem;font-weight:800;color:#1a252f;margin-bottom:14px; }
    .sc-check-item { display:flex;align-items:flex-start;gap:10px;font-size:.9rem;color:#495057; }
    .sc-check-item i { color:#28a745;margin-top:2px;flex-shrink:0; }
    .sc-info-card { background:#fff;border:1px solid #e8ecf0;border-radius:14px;overflow:hidden; }
    .sc-info-card-header { background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);color:var(--accent-gold);font-weight:700;font-size:.95rem;padding:16px 20px; }
    .sc-mini-item { display:flex;align-items:center;gap:10px;padding:7px 0;border-bottom:1px solid #f0f4f8; }
    .sc-mini-item:last-child { border-bottom:none; }
    .sc-docs-strip { background:#f7f8fc;border:1px solid #e8ecf0;border-radius:14px;padding:24px; }
    .sc-doc-pill { display:flex;align-items:center;gap:10px;background:#fff;border:1px solid #e8ecf0;border-radius:10px;padding:10px 14px; }
    .sc-doc-pill i { color:var(--accent-gold); }
    .sc-step-num { width:28px;height:28px;background:var(--accent-gold);color:#0f1923;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;flex-shrink:0; }
    .sc-section-label { display:block;color:var(--accent-gold);font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px; }
    .sc-section-title { font-size:1.7rem;font-weight:800;color:#1a252f;margin-bottom:1rem; }
    .sc-step-card { background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:24px;text-align:center;height:100%;transition:all .3s ease; }
    .sc-step-card:hover { transform:translateY(-5px);box-shadow:0 12px 28px rgba(0,0,0,.08);border-color:var(--accent-gold); }
    .sc-step-circle { width:52px;height:52px;background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);color:var(--accent-gold);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.3rem;font-weight:800;margin:0 auto 16px; }
    .sc-benefit-item { display:flex;align-items:center;gap:14px;padding:14px 0;border-bottom:1px solid #f0f4f8; }
    .sc-benefit-item:last-child { border-bottom:none; }
    .sc-benefit-icon { width:42px;height:42px;background:#fff8e1;border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--accent-gold);flex-shrink:0; }
    .sc-faq-item { background:#fff;border:1px solid #e8ecf0;border-radius:12px;margin-bottom:12px;overflow:hidden;transition:border-color .3s; }
    .sc-faq-item:hover { border-color:var(--accent-gold); }
    .sc-faq-btn { width:100%;text-align:left;background:transparent;border:none;padding:20px 24px;font-weight:600;font-size:.95rem;color:#1a252f;display:flex;justify-content:space-between;align-items:center;cursor:pointer; }
    .sc-faq-icon { width:30px;height:30px;background:#f8f9fa;border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--accent-gold);flex-shrink:0;margin-left:12px;transition:all .3s ease; }
    .sc-faq-btn[aria-expanded="true"] .sc-faq-icon { background:var(--accent-gold);color:#fff;transform:rotate(180deg); }
    .sc-faq-body { padding:0 24px 20px;color:#6c757d;font-size:.9rem;line-height:1.8; }
</style>
@endpush

@endsection