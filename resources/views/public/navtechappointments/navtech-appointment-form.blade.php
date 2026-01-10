@extends('layouts.public')

@section('title', 'SVP Registration - Medical Examination')

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

        #passportModal .btn-info:disabled { background-color: #a0cece !important; }

        /* Custom Upload Widget Styling */
        .custom-upload-widget {
            background: #fff;
            padding: 10px 0;
        }

        .upload-subtitle {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .btn-custom-upload {
            background-color: transparent;
            border: 1px solid #ced4da;
            color: #1a8a8a; /* Teal color from image */
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 5px;
            transition: all 0.3s ease;
            width: fit-content;
            margin-bottom: 6px;
        }

        .btn-custom-upload:hover {
            background-color: #f8f9fa;
            border-color: #1a8a8a;
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
    </style>

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>SVP International Registration</h1>
            <p class="lead">Please provide the required details and documents for your application.</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appointment-form-wrapper">
                        <form id="appointmentForm" class="appointment-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Location & Basic Info -->
                            <div class="form-section">
                                <h5 class="section-title">General Information</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="country">Country</label>
                                        <select class="form-control" id="country" name="country">
                                            <option value="Pakistan">Pakistan</option>                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="city">City</label>
                                        <select name="city" class="form-control" id="city">
                                            <option value="">Select City</option>
                                            <option value="Islamabad">Islamabad</option>
                                            <option value="Karachi">Karachi</option>
                                            <option value="Lahore">Lahore</option>
                                            <option value="Peshawar">Peshawar</option>
                                            <option value="Quetta">Quetta</option>
                                            <option value="Multan">Multan</option>
                                            <option value="Sialkot">Sialkot</option>
                                            <option value="Faisalabad">Faisalabad</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="whatsapp_number">WhatsApp Number</label>
                                        <input type="tel" name="whatsapp_number" class="form-control" id="whatsapp_number" placeholder="03xx xxxxxxx">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="occupation">Occupation</label>
                                        <select name="occupation" class="form-control" id="occupation">
                                            <option value="">Select Occupation</option>
                                            <option value="Electrician">Building Electrician</option>
                                            <option value="Plumber">Plumber</option>
                                            <option value="Carpenter">Carpenter</option>
                                            <option value="Mason">Mason</option>
                                            <option value="Welder">Welder</option>
                                            <option value="Painter">Painter</option>
                                            <option value="AC Technician">AC Technician</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Document Upload Section -->
                            <div class="form-section">
                                <h5 class="section-title">Required Documents</h5>
                                
                                <div class="form-row">
                                    <!-- Passport Upload Widget -->
                                    <div class="col-md-4 mb-4">
                                        <div class="custom-upload-widget form-group border p-3 rounded shadow-sm bg-white">
                                            <label>Upload Passport</label>
                                            {{-- <p class="upload-subtitle">Please upload or take a photo of your <strong>passport</strong></p> --}}
                                            <button type="button" class="btn btn-custom-upload" data-toggle="modal" data-target="#passportModal">
                                                Upload Passport
                                            </button>
                                            <p class="upload-format-info">PNG, JPG or JPEG format, max 2MB.</p>
                                            <input type="file" name="passport_pic" id="main_passport_input" class="d-none">
                                            <div id="passport_name_display" class="upload-status-text"></div>
                                        </div>
                                    </div>

                                    <!-- ID Card Upload Widget -->
                                    <div class="col-md-4 mb-4">
                                        <div class="custom-upload-widget form-group border p-3 rounded shadow-sm bg-white">
                                            <label>ID Card Front Page</label>
                                            {{-- <p class="upload-subtitle">Please upload or take a photo of your <strong>ID Card</strong></p> --}}
                                            <button type="button" class="btn btn-custom-upload" data-toggle="modal" data-target="#idCardModal">
                                                Upload ID Card
                                            </button>
                                            <p class="upload-format-info">PNG, JPG or JPEG format, max 2MB.</p>
                                            <input type="file" name="id_card_front" id="main_id_card_input" class="d-none">
                                            <div id="id_status_display" class="upload-status-text"></div>
                                        </div>
                                    </div>

                                    <!-- User Photo Upload Widget -->
                                    <div class="col-md-4 mb-4">
                                        <div class="custom-upload-widget form-group border p-3 rounded shadow-sm bg-white">
                                            <label>Passport Size Photo</label>
                                            {{-- <p class="upload-subtitle">Please upload or take a photo of <strong>yourself</strong></p> --}}
                                            <button type="button" class="btn btn-custom-upload" data-toggle="modal" data-target="#photoModal">
                                                Upload Photo
                                            </button>
                                            <p class="upload-format-info">PNG, JPG or JPEG format, max 2MB.</p>
                                            <input type="file" name="user_pic" id="main_user_pic_input" class="d-none">
                                            <div id="photo_status_display" class="upload-status-text"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="form-buttons mt-4">
                                <a href="{{ route('home') }}" class="btn btn-outline-dark">Cancel</a>
                                <button type="submit" class="btn btn-dark">Submit Registration</button>
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
                        <!-- Stepper Header -->
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

                        <!-- Step Content Container -->
                        <div id="passport-steps-content">
                            
                            <!-- Step 1: General -->
                            <div class="step-content active" id="step-1">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="far fa-image mr-2"></i> Only <strong>PNG, JPEG or JPG</strong> images must be used</li>
                                    <li><i class="fas fa-file-alt mr-2"></i> The <strong>size</strong> of the photo should not exceed <strong>2 MBs</strong></li>
                                    <li><i class="far fa-user mr-2"></i> If your <strong>last name is blank</strong>, please provide <strong>your father's name</strong> as the last name</li>
                                    <li><i class="fas fa-barcode mr-2"></i> The <strong>MRZ code</strong> should be <strong>clearly visible</strong></li>
                                </ul>
                                <div class="comparison-box text-center mt-3">
                                    <img src="{{ asset('assets/public/images/generalDocumentsFormat.13061148.webp') }}" class="img-fluid rounded" alt="Passport Guide">
                                </div>
                            </div>

                            <!-- Step 2: Color -->
                            <div class="step-content d-none" id="step-2">
                                <p><i class="fas fa-th mr-2"></i> Please make sure to upload the document <strong>in full color</strong>.</p>
                                <div class="comparison-box text-center mt-3">
                                    <img src="{{ asset('assets/public/images/documentsColor.8793867e.webp') }}" class="img-fluid rounded" alt="Color Guide">
                                </div>
                            </div>

                            <!-- Step 3: Quality -->
                            <div class="step-content d-none" id="step-3">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-star mr-2"></i> <strong>No glare</strong> or stain over the scan.</li>
                                    <li><i class="fas fa-moon mr-2"></i> <strong>No shadows</strong> over the scan.</li>
                                </ul>
                                <div class="comparison-box text-center mt-3">
                                    <img src="{{ asset('assets/public/images/documentsQuality.1df57e31.webp') }}" class="img-fluid rounded" alt="Quality Guide">
                                </div>
                            </div>

                            <!-- Step 4: Scan -->
                            <div class="step-content d-none" id="step-4">
                                <p><i class="fas fa-copy mr-2"></i> Double pages of scanned copies are not allowed. <strong>Only a single page</strong> should be uploaded.</p>
                                <div class="comparison-box text-center mt-3">
                                    <img src="{{ asset('assets/public/images/documentsScan.68ba3262.webp') }}" class="img-fluid rounded" alt="Scan Guide">
                                </div>
                            </div>

                            <!-- Step 5: Cropping -->
                            <div class="step-content d-none" id="step-5">
                                <p><i class="fas fa-crop mr-2"></i> Crop the document so that <strong>no information is missed</strong>.</p>
                                <div class="comparison-box text-center mt-3 mb-3">
                                    <img src="{{ asset('assets/public/images/documentsCrop.3a15f38c.webp') }}" class="img-fluid rounded" alt="Crop Guide">
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="reviewCheck">
                                    <label class="form-check-label" for="reviewCheck">I have reviewed the instructions on how to upload the photo.</label>
                                </div>
                            </div>

                            <!-- Step 6: Upload -->
                            <div class="step-content d-none" id="step-6">
                                <h6 class="font-weight-bold">Upload your passport</h6>
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

        <!-- ID Card Modal -->
        <div class="modal fade" id="idCardModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-weight-bold">Instructions for ID Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="stepper-wrapper mb-4" id="stepper-id">
                            <div class="stepper-item active" data-step="1"><div class="step-counter">1</div><div class="step-name">Front</div></div>
                            <div class="stepper-item" data-step="2"><div class="step-counter">2</div><div class="step-name">Quality</div></div>
                            <div class="stepper-item" data-step="3"><div class="step-counter">3</div><div class="step-name">Edges</div></div>
                            <div class="stepper-item" data-step="4"><div class="step-counter">4</div><div class="step-name">Upload</div></div>
                        </div>

                        <div class="id-steps-content">
                            <div class="step-content active" id="id-step-1">
                                <p>Upload the <strong>Front Side</strong> of your original ID card. Photocopies are not accepted.</p>
                                <div class="text-center"><img src="{{ asset('assets/public/images/documentsColor.8793867e.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="id-step-2">
                                <p>Ensure there is <strong>no glare</strong> from lights and all text is readable.</p>
                                <div class="text-center"><img src="{{ asset('assets/public/images/documentsQuality.1df57e31.webp') }}" class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="id-step-3">
                                <p>Make sure all <strong>four corners</strong> of the card are visible in the photo.</p>
                                <div class="text-center"><img src="{{ asset('assets/public/images/documentsCrop.3a15f38c.webp') }}" class="img-fluid rounded"></div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="idReviewCheck">
                                    <label class="form-check-label" for="idReviewCheck">I have confirmed the card is clear and fully visible.</label>
                                </div>
                            </div>
                            <div class="step-content d-none" id="id-step-4">
                                <div class="upload-area text-center p-5 border rounded" id="id-drop-zone" style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-id-card fa-3x text-info mb-3"></i>
                                    <p>Click to upload <strong>ID Card Front</strong></p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 2MB)</small>
                                    <input type="file" id="real-id-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>
                                <div id="id-modal-error" class="text-danger small mt-2 font-weight-bold"></div>
                                <div id="id-file-name" class="mt-2 text-success font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-id-back">Back</button>
                        <button type="button" class="btn btn-info text-white" id="btn-id-continue" style="background-color: #1a8a8a;">Continue</button>
                        <button type="button" class="btn btn-info text-white d-none" id="btn-id-finish" style="background-color: #1a8a8a;">Finish</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Passport Photo Modal -->
        <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-weight-bold">Personal Photo Standard Requirements</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Expanded Stepper Header -->
                        <div class="stepper-wrapper mb-4" id="stepper-photo">
                            <div class="stepper-item active" data-step="1"><div class="step-counter">1</div><div class="step-name">General</div></div>
                            <div class="stepper-item" data-step="2"><div class="step-counter">2</div><div class="step-name">Quality</div></div>
                            <div class="stepper-item" data-step="3"><div class="step-counter">3</div><div class="step-name">Pose</div></div>
                            <div class="stepper-item" data-step="4"><div class="step-counter">4</div><div class="step-name">Glasses</div></div>
                            <div class="stepper-item" data-step="5"><div class="step-counter">5</div><div class="step-name">Headdress</div></div>
                            <div class="stepper-item" data-step="6"><div class="step-counter">6</div><div class="step-name">Upload</div></div>
                        </div>

                        <div class="photo-steps-content">
                            <!-- Step 1: General -->
                            <div class="step-content active" id="photo-step-1">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="far fa-image mr-2"></i> Photo must <strong>both show a close up of your face and the top of the shoulders</strong>.</li>
                                    <li><i class="far fa-smile mr-2"></i> Your <strong>face</strong> must take up <strong>70% to 80%</strong> of the photo.</li>
                                    <li><i class="fas fa-file-alt mr-2"></i> The size of the photo should not be more than <strong>2 MBs</strong>.</li>
                                    <li><i class="fas fa-file-image mr-2"></i> Only <strong>PNG, JPEG or JPG</strong> images must be used.</li>
                                    <li><i class="fas fa-expand-arrows-alt mr-2"></i> Photo must be in dimension of <strong>40 (height) x 30 (width)</strong>. Min resolution <strong>720px</strong>.</li>
                                    <li><i class="far fa-calendar-alt mr-2"></i> Your photo must be taken <strong>less than 6 months</strong> ago.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/1.webp') }}" class="img-fluid rounded" alt="General Guide">
                                </div>
                            </div>

                            <!-- Step 2: Quality -->
                            <div class="step-content d-none" id="photo-step-2">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="fas fa-palette mr-2"></i> <strong>Colored</strong>.</li>
                                    <li><i class="far fa-square mr-2"></i> Taken against a <strong>plain white or light grey background</strong>.</li>
                                    <li><i class="fas fa-sun mr-2"></i> <strong>Clear</strong>, have high resolution and with <strong>balanced light</strong>.</li>
                                    <li><i class="fas fa-adjust mr-2"></i> Have a <strong>good color balance</strong>, natural tones and without 'red eye'.</li>
                                    <li><i class="fas fa-low-vision mr-2"></i> No shadows or glare in the Photo or in the background.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/2.webp') }}" class="img-fluid rounded" alt="Quality Guide">
                                </div>
                            </div>

                            <!-- Step 3: Pose -->
                            <div class="step-content d-none" id="photo-step-3">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="far fa-user mr-2"></i> <strong>Your face must be centered</strong>. You must look directly at the camera.</li>
                                    <li><i class="fas fa-arrows-alt-v mr-2"></i> <strong>Do not tilt or turn</strong> your head in any way.</li>
                                    <li><i class="far fa-meh mr-2"></i> Your <strong>expression must be neutral</strong>. No smiling or frowning.</li>
                                    <li><i class="far fa-eye mr-2"></i> Your eyes must be <strong>opened</strong> and your mouth <strong>closed</strong>.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/3.webp') }}" class="img-fluid rounded" alt="Pose Guide">
                                </div>
                            </div>

                            <!-- Step 4: Glasses -->
                            <div class="step-content d-none" id="photo-step-4">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="fas fa-glasses mr-2"></i> Do <strong>not wear sunglasses</strong> or tinted/colored glasses.</li>
                                    <li><i class="far fa-eye mr-2"></i> If you wear glasses, your <strong>eyes must be clearly visible</strong>.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/4.webp') }}" class="img-fluid rounded" alt="Glasses Guide">
                                </div>
                            </div>

                            <!-- Step 5: Headdress -->
                            <div class="step-content d-none" id="photo-step-5">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="fas fa-graduation-cap mr-2"></i> Do <strong>not wear a head covering</strong> (hats, caps, headbands).</li>
                                    <li><i class="fas fa-kaaba mr-2"></i> Except if you wear it for <strong>religious reasons</strong>, face must be visible.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/5.webp') }}" class="img-fluid rounded" alt="Headdress Guide">
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="photoReviewCheck">
                                    <label class="form-check-label" for="photoReviewCheck">I have reviewed the instructions on how to upload the photo.</label>
                                </div>
                            </div>

                            <!-- Step 6: Upload -->
                            <div class="step-content d-none" id="photo-step-6">
                                <div class="upload-area text-center p-5 border rounded" id="photo-drop-zone" style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-camera fa-3x text-info mb-3"></i>
                                    <p>Click to upload <strong>Your Photo</strong></p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 2MB)</small>
                                    <input type="file" id="real-photo-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>
                                <div id="photo-modal-error" class="text-danger small mt-2 font-weight-bold"></div>
                                <div id="photo-file-name" class="mt-2 text-success font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-photo-back">Back</button>
                        <button type="button" class="btn btn-info text-white" id="btn-photo-continue" style="background-color: #1a8a8a;">Continue</button>
                        <button type="button" class="btn btn-info text-white d-none" id="btn-photo-finish" style="background-color: #1a8a8a;">Finish</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loader Overlay -->
        <div id="loaderOverlay">
            <div class="loader-content text-center">
                <div class="spinner-border text-light" role="status" style="width: 4rem; height: 4rem;">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="text-light mt-3" style="font-size: 1.5rem;">Loading...</div>
            </div>
        </div>
    </section>

@push('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function () {
        
        // --- GENERIC MODAL HANDLER FUNCTION ---
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
            
            // Target the new error div
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

                    // 1. Validation: Size
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
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(realInput.files[0]);
                mainFormInput.files = dataTransfer.files;
                
                statusDisplay.innerHTML = `<i class="fas fa-check-circle"></i> ${realInput.files[0].name} attached`;
                $(modal).modal('hide');
            });
        }

        // --- INITIALIZE THE THREE MODALS ---

        // 1. Passport
        setupStepper({
            modalId: 'passportModal',
            modalErrorId: 'passport-modal-error', // Added
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

        // 2. ID Card
        setupStepper({
            modalId: 'idCardModal',
            modalErrorId: 'id-modal-error', // Added
            stepPrefix: 'id-step-',
            totalSteps: 4,
            checkStep: 3,
            checkId: 'idReviewCheck',
            btnContinue: 'btn-id-continue',
            btnBack: 'btn-id-back',
            btnFinish: 'btn-id-finish',
            realInput: 'real-id-input',
            dropZone: 'id-drop-zone',
            fileNameDisplay: 'id-file-name',
            statusDisplay: 'id_status_display',
            mainFormInput: 'main_id_card_input'
        });

        // 3. Photo (Modified for 6 steps)
        setupStepper({
            modalId: 'photoModal',
            modalErrorId: 'photo-modal-error',
            stepPrefix: 'photo-step-',
            totalSteps: 6,         // Changed from 3 to 6
            checkStep: 5,          // Review checkbox is now on Step 5 (Headdress)
            checkId: 'photoReviewCheck',
            btnContinue: 'btn-photo-continue',
            btnBack: 'btn-photo-back',
            btnFinish: 'btn-photo-finish',
            realInput: 'real-photo-input',
            dropZone: 'photo-drop-zone',
            fileNameDisplay: 'photo-file-name',
            statusDisplay: 'photo_status_display',
            mainFormInput: 'main_user_pic_input'
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Phone Mask for WhatsApp
        if(typeof $.fn.inputmask !== 'undefined'){
            $('#whatsapp_number').inputmask('9999 9999999');
        }

        // Update file name label on select
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        const form = document.getElementById('appointmentForm');
        const loader = document.getElementById('loaderOverlay');

        // Helper to show errors on custom widgets
        function setWidgetError(inputId, message) {
            const input = document.getElementById(inputId);
            const widget = input.closest('.custom-upload-widget');
            const btn = widget.querySelector('.btn-custom-upload');
            
            btn.style.borderColor = '#dc3545';
            btn.style.color = '#dc3545';
            
            const error = document.createElement('div');
            error.className = 'invalid-feedback d-block';
            error.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${message}`;
            widget.appendChild(error);
        }

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            // 1. Reset previous errors
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            form.querySelectorAll('.btn-custom-upload').forEach(el => {
                el.style.borderColor = '#ced4da';
                el.style.color = '#1a8a8a';
            });

            // 2. Submit via AJAX
            const formData = new FormData(form);
            loader.classList.add('show');

            try {
                const response = await fetch("{{ route('navtechform.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "Accept": "application/json",
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.status === 422) {
                    // Server-side validation errors
                    Object.keys(data.errors).forEach(field => {
                        const input = form.querySelector(`[name="${field}"]`);
                        const errorMessage = data.errors[field][0];

                        // Handle Standard Inputs (City, WhatsApp, etc)
                        if (input && !['passport_pic', 'id_card_front', 'user_pic'].includes(field)) {
                            input.classList.add('is-invalid');
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback';
                            errorDiv.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${data.errors[field][0]}`;
                            input.closest('.form-group').appendChild(errorDiv);
                        } 
                        // Handle Custom File Widgets
                        else {
                            let targetInputId = '';
                            if(field === 'passport_pic') targetInputId = 'main_passport_input';
                            if(field === 'id_card_front') targetInputId = 'main_id_card_input';
                            if(field === 'user_pic') targetInputId = 'main_user_pic_input';

                            if(targetInputId) setWidgetError(targetInputId, errorMessage);
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
                alert('A connection error occurred. Please try again.');
            } finally {
                loader.classList.remove('show');
            }
        });

    });
</script>
@endpush

@endsection