@extends('layouts.public')

@section('title', 'Tasheer Appointment Registration')

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

        .custom-upload-widget {
            background: #fff;
            padding: 10px 0;
        }

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
            <h1>Tasheer Appointment Registration</h1>
            <p class="lead">Please provide the required details and documents for your Tasheer visa processing.</p>
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
                            
                            <!-- General Info -->
                            <div class="form-section">
                                <h5 class="section-title">General Information</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="embassy">Embassy / Visa Center</label>
                                        <select name="embassy" class="form-control" id="embassy">
                                            <option value="">Select Center</option>
                                            <option value="Karachi">Tasheer Karachi</option>
                                            <option value="Lahore">Tasheer Lahore</option>
                                            <option value="Islamabad">Tasheer Islamabad</option>
                                            <option value="Peshawar">Tasheer Peshawar</option>
                                            <option value="Quetta">Tasheer Quetta</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="whatsapp_number">WhatsApp Number</label>
                                        <input type="tel" name="whatsapp_number" class="form-control" id="whatsapp_number" placeholder="03xx xxxxxxx">
                                    </div>
                                </div>
                            </div>

                            <!-- Document Upload Section -->
                            <div class="form-section">
                                <h5 class="section-title">Required Documents</h5>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
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
        <div id="loaderOverlay">
            <div class="loader-content text-center">
                <div class="spinner-border text-light" role="status" style="width: 4rem; height: 4rem;"></div>
                <div class="text-light mt-3" style="font-size: 1.5rem;">Loading...</div>
            </div>
        </div>
    </section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- STEPPER LOGIC ---
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

            realInput.addEventListener('change', function() {
                modalErrorDiv.innerText = "";
                if(this.files.length > 0) {
                    const file = this.files[0];
                    if (file.size > 2 * 1024 * 1024) { modalErrorDiv.innerText = "Error: File exceeds 2MB limit."; this.value = ""; return; }

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

            btnFinish.addEventListener('click', function() {
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(realInput.files[0]);
                mainFormInput.files = dataTransfer.files;
                statusDisplay.innerHTML = `<i class="fas fa-check-circle"></i> ${realInput.files[0].name} attached`;
                $(modal).modal('hide');
            });
        }

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

        // Masking
        if(typeof $.fn.inputmask !== 'undefined') $('#whatsapp_number').inputmask('9999 9999999');

        // Form Submit
        const form = document.getElementById('appointmentForm');
        const loader = document.getElementById('loaderOverlay');

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
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            form.querySelectorAll('.btn-custom-upload').forEach(el => { el.style.borderColor = '#ced4da'; el.style.color = '#1a8a8a'; });

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
                    Object.keys(data.errors).forEach(field => {
                        const input = form.querySelector(`[name="${field}"]`);
                        if (input && field !== 'passport_pic') {
                            input.classList.add('is-invalid');
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback';
                            errorDiv.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${data.errors[field][0]}`;
                            input.closest('.form-group').appendChild(errorDiv);
                        } else if (field === 'passport_pic') {
                            setWidgetError('main_passport_input', data.errors[field][0]);
                        }
                    });

                    // Scroll to the first error
                    const firstError = document.querySelector('.is-invalid, .invalid-feedback');
                    if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                } else if (data.status === 'success') {
                    window.location.href = data.redirect;                    
                }
            } catch (error) {
                alert('A connection error occurred.');
            } finally {
                loader.classList.remove('show');
            }
        });
    });
</script>
@endpush

@endsection