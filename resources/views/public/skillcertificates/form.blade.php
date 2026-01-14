@extends('layouts.public')

@section('title', 'Soft Skill Certificate Registration')

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
            border-color: #1a8a8a;
            color: #1a8a8a;
        }
        .stepper-item.completed .step-counter {
            background-color: #1a8a8a;
            border-color: #1a8a8a;
            color: white;
        }
        .step-name { font-size: 12px; color: #999; }
        .stepper-item.active .step-name { color: #1a8a8a; font-weight: bold; }

        .instruction-list li { margin-bottom: 12px; font-size: 14px; color: #555; }
        .comparison-box img { max-width: 100%; height: auto; border: 1px solid #f0f0f0; }

        .custom-upload-widget { background: #fff; padding: 10px 0; }

        .btn-custom-upload {
            background-color: transparent;
            border: 1px solid #ced4da;
            color: #1a8a8a;
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
            border-color: #1a8a8a;
            color: #146e6e;
        }

        .upload-status-text {
            font-size: 0.85rem;
            color: #28a745;
            /* font-weight: bold; */
            margin-top: 5px;
        }

        #loaderOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        #loaderOverlay.show { display: flex; }

        .custom-upload-widget.border-danger {
            border-color: #dc3545 !important;
            background-color: #fff8f8; /* Light red tint */
        }
        .invalid-feedback {
            display: block; /* Ensure it shows up since it's added dynamically */
        }
    </style>

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>Soft Skill Certificate Registration</h1>
            <p class="lead">Please provide the required details and documents for your application.</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="appointment-form-wrapper">
                <form id="softSkillForm" class="appointment-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-section">
                        <h5 class="section-title">General Information</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="whatsapp_number">WhatsApp Number</label>
                                <input type="tel" name="whatsapp_number" class="form-control" id="whatsapp_number" placeholder="03xx xxxxxxx">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="section-title">Required Documents</h5>
                        <div class="form-row">
                            <!-- ID Front Widget -->
                            <div class="col-md-3 mb-4">
                                <div class="custom-upload-widget form-group border p-3 rounded shadow-sm bg-white">
                                    <label>ID Card Front</label>
                                    <button type="button" class="btn btn-custom-upload" data-toggle="modal" data-target="#idFrontModal">Upload ID Front</button>
                                    <p class="upload-format-info">PNG, JPG or JPEG format, max 2MB.</p>
                                    <input type="file" name="id_card_front" id="main_id_front_input" class="d-none">
                                    <div id="id_front_status" class="upload-status-text"></div>
                                </div>
                            </div>

                            <!-- ID Back Widget -->
                            <div class="col-md-3 mb-4">
                                <div class="custom-upload-widget form-group border p-3 rounded shadow-sm bg-white">
                                    <label>ID Card Back</label>
                                    <button type="button" class="btn btn-custom-upload" data-toggle="modal" data-target="#idBackModal">Upload ID Back</button>
                                    <p class="upload-format-info">PNG, JPG or JPEG format, max 2MB.</p>
                                    <input type="file" name="id_card_back" id="main_id_back_input" class="d-none">
                                    <div id="id_back_status" class="upload-status-text"></div>
                                </div>
                            </div>

                            <!-- User Photo Widget -->
                            <div class="col-md-3 mb-4">
                                <div class="custom-upload-widget form-group border p-3 rounded shadow-sm bg-white">
                                    <label>Personal Photo</label>
                                    <button type="button" class="btn btn-custom-upload" data-toggle="modal" data-target="#photoModal">Upload Photo</button>
                                    <p class="upload-format-info">PNG, JPG or JPEG format, max 2MB.</p>
                                    <input type="file" name="user_pic" id="main_user_pic_input" class="d-none">
                                    <div id="photo_status_display" class="upload-status-text"></div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-4">
                                <div class="custom-upload-widget form-group border p-3 rounded shadow-sm bg-white">
                                    <label>Passport Copy</label>
                                    <button type="button" class="btn btn-custom-upload" data-toggle="modal" data-target="#passportModal">
                                        Upload Passport
                                    </button>
                                    <p class="upload-format-info">PNG, JPG or JPEG format, max 2MB.</p>
                                    <input type="file" name="passport_pic" id="main_passport_input" class="d-none">
                                    <div id="passport_name_display" class="upload-status-text"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-buttons mt-4">
                        <a href="{{ route('home') }}" class="btn btn-outline-dark">Cancel</a>
                        <button type="submit" class="btn btn-dark px-5">Submit Registration</button>
                    </div>
                </form>
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
                            <div class="stepper-item active" id="idf-step-tab-1"><div class="step-counter">1</div><div class="step-name">Front</div></div>
                            <div class="stepper-item" id="idf-step-tab-2"><div class="step-counter">2</div><div class="step-name">Quality</div></div>
                            <div class="stepper-item" id="idf-step-tab-3"><div class="step-counter">3</div><div class="step-name">Edges</div></div>
                            <div class="stepper-item" id="idf-step-tab-4"><div class="step-counter">4</div><div class="step-name">Upload</div></div>
                        </div>
                        <div class="id-steps-content">
                            <div class="step-content active" id="idf-step-1">
                                <p>Upload the <strong>Front Side</strong> of your original ID card. Photocopies are not accepted.</p>
                                <div class="text-center"><img src="{{ asset('assets/public/images/documentsColor.8793867e.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="idf-step-2">
                                <p>Ensure there is <strong>no glare</strong> from lights and all text is readable.</p>
                                <div class="text-center"><img src="{{ asset('assets/public/images/documentsQuality.1df57e31.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="idf-step-3">
                                <p>Make sure all <strong>four corners</strong> of the card are visible in the photo.</p>
                                <div class="text-center"><img src="{{ asset('assets/public/images/documentsCrop.3a15f38c.webp') }}" class="img-fluid rounded"></div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="idfReviewCheck">
                                    <label class="form-check-label" for="idfReviewCheck">I have confirmed the card is clear and fully visible.</label>
                                </div>
                            </div>
                            <div class="step-content d-none" id="idf-step-4">
                                <div class="upload-area text-center p-5 border rounded" id="idf-drop-zone" style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-id-card fa-3x text-info mb-3"></i>
                                    <p>Click to upload <strong>ID Card Front</strong></p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 2MB)</small>
                                    <input type="file" id="real-idf-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>
                                <div id="idf-file-name" class="mt-2 text-success font-weight-bold"></div>
                                <div id="idf-error" class="text-danger mt-2 small font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-idf-back">Back</button>
                        <button type="button" class="btn btn-info text-white" id="btn-idf-continue" style="background-color: #1a8a8a;">Continue</button>
                        <button type="button" class="btn btn-info text-white d-none" id="btn-idf-finish" style="background-color: #1a8a8a;">Finish</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= ID CARD BACK MODAL ================= -->
        <div class="modal fade" id="idBackModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-weight-bold">Instructions for ID Card Back</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="stepper-wrapper mb-4">
                            <div class="stepper-item active" id="idb-step-tab-1"><div class="step-counter">1</div><div class="step-name">Back</div></div>
                            <div class="stepper-item" id="idb-step-tab-2"><div class="step-counter">2</div><div class="step-name">Quality</div></div>
                            <div class="stepper-item" id="idb-step-tab-3"><div class="step-counter">3</div><div class="step-name">Edges</div></div>
                            <div class="stepper-item" id="idb-step-tab-4"><div class="step-counter">4</div><div class="step-name">Upload</div></div>
                        </div>
                        <div class="id-steps-content">
                            <div class="step-content active" id="idb-step-1">
                                <p>Upload the <strong>Back Side</strong> of your original ID card.</p>
                                <div class="text-center"><img src="{{ asset('assets/public/images/documentsColor.8793867e.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="idb-step-2">
                                <p>Ensure there is <strong>no glare</strong> and text is readable.</p>
                                <div class="text-center"><img src="{{ asset('assets/public/images/documentsQuality.1df57e31.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="idb-step-3">
                                <p>Make sure all <strong>four corners</strong> are visible.</p>
                                <div class="text-center"><img src="{{ asset('assets/public/images/documentsCrop.3a15f38c.webp') }}" class="img-fluid rounded"></div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="idbReviewCheck">
                                    <label class="form-check-label" for="idbReviewCheck">I have confirmed the card is clear.</label>
                                </div>
                            </div>
                            <div class="step-content d-none" id="idb-step-4">
                                <div class="upload-area text-center p-5 border rounded" id="idb-drop-zone" style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-id-card fa-3x text-info mb-3"></i>
                                    <p>Click to upload <strong>ID Card Back</strong></p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 2MB)</small>
                                    <input type="file" id="real-idb-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>
                                <div id="idb-file-name" class="mt-2 text-success font-weight-bold"></div>
                                <div id="idb-error" class="text-danger mt-2 small font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-idb-back">Back</button>
                        <button type="button" class="btn btn-info text-white" id="btn-idb-continue" style="background-color: #1a8a8a;">Continue</button>
                        <button type="button" class="btn btn-info text-white d-none" id="btn-idb-finish" style="background-color: #1a8a8a;">Finish</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= USER PHOTO MODAL ================= -->
        <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-weight-bold">Personal Photo Requirements</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="stepper-wrapper mb-4">
                            <div class="stepper-item active" id="ph-step-tab-1"><div class="step-counter">1</div><div class="step-name">General</div></div>
                            <div class="stepper-item" id="ph-step-tab-2"><div class="step-counter">2</div><div class="step-name">Quality</div></div>
                            <div class="stepper-item" id="ph-step-tab-3"><div class="step-counter">3</div><div class="step-name">Pose</div></div>
                            <div class="stepper-item" id="ph-step-tab-4"><div class="step-counter">4</div><div class="step-name">Glasses</div></div>
                            <div class="stepper-item" id="ph-step-tab-5"><div class="step-counter">5</div><div class="step-name">Headdress</div></div>
                            <div class="stepper-item" id="ph-step-tab-6"><div class="step-counter">6</div><div class="step-name">Upload</div></div>
                        </div>
                        <div class="ph-steps-content">
                            <div class="step-content active" id="ph-step-1">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="far fa-image mr-2"></i> Photo must <strong>both show a close up of your face and the top of the shoulders</strong>.</li>
                                    <li><i class="far fa-smile mr-2"></i> Your <strong>face</strong> must take up <strong>70% to 80%</strong> of the photo.</li>
                                    <li><i class="fas fa-file-alt mr-2"></i> The size of the photo should not be more than <strong>2 MBs</strong>.</li>
                                    <li><i class="fas fa-file-image mr-2"></i> Only <strong>PNG, JPEG or JPG</strong> images must be used.</li>
                                    <li><i class="fas fa-expand-arrows-alt mr-2"></i> Photo must be in dimension of <strong>40 (height) x 30 (width)</strong>. Min resolution <strong>720px</strong>.</li>
                                    <li><i class="far fa-calendar-alt mr-2"></i> Your photo must be taken <strong>less than 6 months</strong> ago.</li>
                                </ul>
                                <div class="text-center"><img src="{{ asset('assets/public/images/1.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="ph-step-2">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="fas fa-palette mr-2"></i> <strong>Colored</strong>.</li>
                                    <li><i class="far fa-square mr-2"></i> Taken against a <strong>plain white or light grey background</strong>.</li>
                                    <li><i class="fas fa-sun mr-2"></i> <strong>Clear</strong>, have high resolution and with <strong>balanced light</strong>.</li>
                                    <li><i class="fas fa-adjust mr-2"></i> Have a <strong>good color balance</strong>, natural tones and without 'red eye'.</li>
                                    <li><i class="fas fa-low-vision mr-2"></i> No shadows or glare in the Photo or in the background.</li>
                                </ul>
                                <div class="text-center"><img src="{{ asset('assets/public/images/2.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="ph-step-3">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="far fa-user mr-2"></i> <strong>Your face must be centered</strong>. You must look directly at the camera.</li>
                                    <li><i class="fas fa-arrows-alt-v mr-2"></i> <strong>Do not tilt or turn</strong> your head in any way.</li>
                                    <li><i class="far fa-meh mr-2"></i> Your <strong>expression must be neutral</strong>. No smiling or frowning.</li>
                                    <li><i class="far fa-eye mr-2"></i> Your eyes must be <strong>opened</strong> and your mouth <strong>closed</strong>.</li>
                                </ul>
                                <div class="text-center"><img src="{{ asset('assets/public/images/3.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="ph-step-4">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="fas fa-glasses mr-2"></i> Do <strong>not wear sunglasses</strong> or tinted/colored glasses.</li>
                                    <li><i class="far fa-eye mr-2"></i> If you wear glasses, your <strong>eyes must be clearly visible</strong>.</li>
                                </ul>
                                <div class="text-center"><img src="{{ asset('assets/public/images/4.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="ph-step-5">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="fas fa-graduation-cap mr-2"></i> Do <strong>not wear a head covering</strong> (hats, caps, headbands).</li>
                                    <li><i class="fas fa-kaaba mr-2"></i> Except if you wear it for <strong>religious reasons</strong>, face must be visible.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/5.webp') }}" class="img-fluid rounded" alt="Headdress Guide">
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="photoReviewCheck">
                                    <label class="form-check-label" for="photoReviewCheck">I have reviewed the instructions.</label>
                                </div>
                            </div>
                            <div class="step-content d-none" id="ph-step-6">
                                <div class="upload-area text-center p-5 border rounded" id="ph-drop-zone" style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-camera fa-3x text-info mb-3"></i>
                                    <p>Click to upload <strong>Personal Photo</strong></p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 2MB)</small>
                                    <input type="file" id="real-ph-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>
                                <div id="ph-file-name" class="mt-2 text-success font-weight-bold"></div>
                                <div id="ph-error" class="text-danger mt-2 small font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-ph-back">Back</button>
                        <button type="button" class="btn btn-info text-white" id="btn-ph-continue" style="background-color: #1a8a8a;">Continue</button>
                        <button type="button" class="btn btn-info text-white d-none" id="btn-ph-finish" style="background-color: #1a8a8a;">Finish</button>
                    </div>
                </div>
            </div>
        </div>

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
                            <div class="stepper-item active" id="step-1-tab"><div class="step-counter">1</div><div class="step-name">General</div></div>
                            <div class="stepper-item" id="step-2-tab"><div class="step-counter">2</div><div class="step-name">Color</div></div>
                            <div class="stepper-item" id="step-3-tab"><div class="step-counter">3</div><div class="step-name">Quality</div></div>
                            <div class="stepper-item" id="step-4-tab"><div class="step-counter">4</div><div class="step-name">Scan</div></div>
                            <div class="stepper-item" id="step-5-tab"><div class="step-counter">5</div><div class="step-name">Cropping</div></div>
                            <div class="stepper-item" id="step-6-tab"><div class="step-counter">6</div><div class="step-name">Upload</div></div>
                        </div>

                        <div id="passport-steps-content">
                            <div class="step-content active" id="step-1">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="far fa-image mr-2"></i> Only <strong>PNG, JPEG or JPG</strong> images must be used</li>
                                    <li><i class="fas fa-file-alt mr-2"></i> The <strong>size</strong> of the photo should not exceed <strong>2 MBs</strong></li>
                                    <li><i class="fas fa-barcode mr-2"></i> The <strong>MRZ code</strong> should be <strong>clearly visible</strong></li>
                                </ul>
                                <div class="comparison-box text-center mt-3"><img src="{{ asset('assets/public/images/generalDocumentsFormat.13061148.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="step-2">
                                <p><i class="fas fa-th mr-2"></i> Please make sure to upload the document <strong>in full color</strong>.</p>
                                <div class="comparison-box text-center mt-3"><img src="{{ asset('assets/public/images/documentsColor.8793867e.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="step-3">
                                <p><i class="fas fa-star mr-2"></i> No glare or shadows over the scan.</p>
                                <div class="comparison-box text-center mt-3"><img src="{{ asset('assets/public/images/documentsQuality.1df57e31.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="step-4">
                                <p><i class="fas fa-copy mr-2"></i> Only a single page should be uploaded.</p>
                                <div class="comparison-box text-center mt-3"><img src="{{ asset('assets/public/images/documentsScan.68ba3262.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="step-5">
                                <p><i class="fas fa-crop mr-2"></i> Crop so that <strong>no information is missed</strong>.</p>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="reviewCheck">
                                    <label class="form-check-label" for="reviewCheck">I have reviewed the instructions on how to upload the photo.</label>
                                </div>
                            </div>
                            <div class="step-content d-none" id="step-6">
                                <div class="upload-area text-center p-5 border rounded" id="drop-zone" style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-info mb-3"></i>
                                    <p>Click, or <span class="text-info">Browse</span> to upload</p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 2MB)</small>
                                    <input type="file" id="real-passport-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>
                                <div id="passport-modal-error" class="text-danger small mt-2 font-weight-bold"></div>                                
                                <div id="file-name-display" class="mt-2 text-success font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-back">Back</button>
                        <button type="button" class="btn btn-info text-white px-4" id="btn-continue" style="background-color: #1a8a8a;">Continue</button>
                        <button type="button" class="btn btn-info text-white px-4 d-none" id="btn-upload-finish" style="background-color: #1a8a8a;">Upload file</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loader Overlay -->
        <div id="loaderOverlay"><div class="loader-content text-center"><div class="spinner-border text-light" style="width: 4rem; height: 4rem;"></div><div class="text-light mt-3">Submitting...</div></div></div>
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

            realInput.addEventListener('change', function() {
                // Reset state
                modalErrorDiv.innerText = "";
                fileNameDisplay.innerText = "";
                btnFinish.disabled = true;

                if(this.files.length > 0) {
                    const file = this.files[0];

                    // 1. Validation: Size (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        modalErrorDiv.innerText = "Error: File exceeds 2MB limit.";
                        this.value = ""; // Clear input
                        return;
                    }

                    // 2. Validation: Type
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!allowedTypes.includes(file.type)) {
                        modalErrorDiv.innerText = "Error: Only JPG, JPEG, and PNG are allowed.";
                        this.value = ""; // Clear input
                        return;
                    }

                    // If valid
                    fileNameDisplay.innerText = "Selected: " + file.name;
                    btnFinish.disabled = false;
                }
            });

            btnFinish.addEventListener('click', function() {
                if (realInput.files.length > 0) {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(realInput.files[0]);
                    mainFormInput.files = dataTransfer.files;
                    
                    statusDisplay.innerHTML = `<i class="fas fa-check-circle"></i> Attached`;
                    $(modal).modal('hide'); // Using jQuery for Bootstrap modal close
                }
            });
        }

        // Initialize 3 separate steppers with Validation Config
        setupStepper({
            modalId: 'idFrontModal', stepPrefix: 'idf-step-', totalSteps: 4, checkStep: 3, checkId: 'idfReviewCheck',
            btnContinue: 'btn-idf-continue', btnBack: 'btn-idf-back', btnFinish: 'btn-idf-finish',
            realInput: 'real-idf-input', dropZone: 'idf-drop-zone', 
            fileNameDisplayId: 'idf-file-name',
            modalErrorId: 'idf-error', // New ID
            statusDisplay: 'id_front_status', mainFormInput: 'main_id_front_input'
        });

        setupStepper({
            modalId: 'idBackModal', stepPrefix: 'idb-step-', totalSteps: 4, checkStep: 3, checkId: 'idbReviewCheck',
            btnContinue: 'btn-idb-continue', btnBack: 'btn-idb-back', btnFinish: 'btn-idb-finish',
            realInput: 'real-idb-input', dropZone: 'idb-drop-zone', 
            fileNameDisplayId: 'idb-file-name',
            modalErrorId: 'idb-error', // New ID
            statusDisplay: 'id_back_status', mainFormInput: 'main_id_back_input'
        });

        setupStepper({
            modalId: 'photoModal', stepPrefix: 'ph-step-', totalSteps: 6, checkStep: 5, checkId: 'photoReviewCheck',
            btnContinue: 'btn-ph-continue', btnBack: 'btn-ph-back', btnFinish: 'btn-ph-finish',
            realInput: 'real-ph-input', dropZone: 'ph-drop-zone', 
            fileNameDisplayId: 'ph-file-name',
            modalErrorId: 'ph-error', // New ID
            statusDisplay: 'photo_status_display', mainFormInput: 'main_user_pic_input'
        });

        setupStepper({
            modalId: 'passportModal', 
            stepPrefix: 'step-', // Note: Your passport modal uses 'step-1' instead of 'ph-step-1'
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

        function setWidgetError(inputId, message) {
            const input = document.getElementById(inputId);
            if (!input) return;

            const widget = input.closest('.custom-upload-widget');
            const statusDiv = widget.querySelector('.upload-status-text');
            
            // Add red border to the widget box
            widget.classList.add('border-danger');
            widget.classList.remove('border-success'); // In case it was green before
            
            // Show error message in the status area
            statusDiv.innerHTML = `<span class="text-danger"><i class="fas fa-exclamation-circle"></i> ${message}</span>`;
        }

        // WhatsApp Masking and Submission Logic remain the same...
        if(typeof $.fn.inputmask !== 'undefined') $('#whatsapp_number').inputmask('9999 9999999');

        $('#softSkillForm').on('submit', async function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            const loader = document.getElementById('loaderOverlay');

            // 1. Clear previous errors
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            form.querySelectorAll('.custom-upload-widget').forEach(el => {
                el.classList.remove('border-danger');
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
                    // 2. Handle Validation Errors
                    Object.keys(data.errors).forEach(field => {
                        const input = form.querySelector(`[name="${field}"]`);
                        const errorMessage = data.errors[field][0];

                        // List of file fields used in your form
                        const fileFields = ['id_card_front', 'id_card_back', 'user_pic', 'passport_pic'];

                        if (fileFields.includes(field)) {
                            let targetInputId = '';
                            if(field === 'id_card_front') targetInputId = 'main_id_front_input';
                            if(field === 'id_card_back') targetInputId = 'main_id_back_input';
                            if(field === 'user_pic') targetInputId = 'main_user_pic_input';
                            if(field === 'passport_pic') targetInputId = 'main_passport_input';

                            if(targetInputId) setWidgetError(targetInputId, errorMessage);
                        } 
                        else if (input) {
                            // Handle Standard Inputs (WhatsApp, etc.)
                            input.classList.add('is-invalid');
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback';
                            errorDiv.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${errorMessage}`;
                            
                            // Append error after the input
                            input.closest('.form-group').appendChild(errorDiv);
                        }
                    });
                    
                    // 3. Scroll to the first error
                    const firstError = document.querySelector('.is-invalid, .border-danger');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }

                } else if (data.status === 'success') {
                    window.location.href = data.redirect;                    
                } else {
                    alert(data.message || 'An unexpected error occurred.');
                }

            } catch (err) {
                console.error(err);
                alert('Server connection error. Please try again.');
            } finally {
                loader.classList.remove('show');
            }
        });
    });
</script>
@endpush
@endsection