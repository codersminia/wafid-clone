@extends('layouts.public')

@section('title', 'Confirm SVP Test Payment')

@section('content')

    <!-- Page Header -->
    <section class="page-header text-white py-5" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
        <div class="container">
            <h1>Confirm Booking</h1>
            <p class="lead">Step 2 of 3: Payment Verification</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5 bg-light">
        <div class="container">

            <!-- Fee Alert -->
            <div class="alert border-0 mb-4" style="background-color:#fff8e1;border-left:4px solid var(--accent-gold) !important;border-left-style:solid !important;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="alert-heading mb-2" style="color:#1a252f;">
                            <i class="fas fa-wallet mr-2" style="color:var(--accent-gold);"></i>Registration Fee: <strong>PKR {{ number_format($fee) }}</strong>
                        </h5>
                        <p class="mb-0" style="color:#495057;">
                            Please transfer the amount to one of the accounts below and upload the receipt to confirm your application.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('navtech.payLater') }}" class="btn btn-outline-dark font-weight-bold">
                            <i class="fas fa-clock mr-1"></i> Skip & Pay Later
                        </a>
                    </div>
                </div>
            </div>

            <!-- Account Details Card -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h4 class="mb-0"><i class="fas fa-university mr-2" style="color:var(--accent-gold);"></i>Account Details</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        @foreach($paymentMethods as $method)
                            <div class="col-md-6 text-left mb-4">
                                <div class="p-3 border rounded h-100 row mx-1"
                                    style="background-color:#fff8e1;box-shadow:0 4px 16px rgba(0,0,0,.08);border-color:#ffe082 !important;">
                                    <div class="col-md-5 text-center">
                                        @if($method->qr_code)
                                            <img src="{{ asset('uploads/qr/' . $method->qr_code) }}" alt="QR Code"
                                                class="img-fluid mb-3"
                                                style="max-width: 140px; border: 1px solid #ddd; background: #fff; padding: 5px;">
                                        @else
                                            <div class="mb-3 d-flex align-items-center justify-content-center text-muted small"
                                                style="height: 140px; background: #eee; border: 1px dashed #ccc;">No QR Code</div>
                                        @endif
                                    </div>
                                    <div class="col-md-7">
                                        <p class="small text-dark mb-2"><span style="font-weight:600">Account:
                                            </span>{{ $method->account_name }}</p>
                                        <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Title:
                                            </span> {{ $method->account_title }}</p>
                                        <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Number:
                                            </span> {{ $method->account_number }}</p>
                                        @if($method->iban)
                                            <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">IBAN:
                                                </span> {{ $method->iban }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Payment Details Form -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h4 class="mb-0"><i class="fas fa-upload mr-2" style="color:var(--accent-gold);"></i>Upload Proof</h4>
                </div>
                <div class="card-body p-4">
                    <form id="paymentForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="navtech_appointment_id" value="{{ $appointment->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-600">WhatsApp Number</label>
                                    <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number"
                                        value="{{ old('whatsapp_number', $appointment->whatsapp_number) }}"
                                        placeholder="Enter Whatsapp Number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Payment Method</label>
                                    <select class="form-control p-2" name="payment_method">
                                        <option value="">Select Payment Method</option>
                                        @foreach($paymentMethods as $method)
                                            <option value="{{ $method->account_name }}">{{ $method->account_name }}
                                                ({{ $method->account_title }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Screenshot Upload (Dropzone Style) -->
                        <div class="form-group mb-4">
                            <label for="paymentProof" class="font-weight-600">Upload Payment Screenshot</label>
                            <div id="dropzone" class="border-2 rounded p-5 text-center"
                                style="border: 2px dashed var(--accent-gold); background-color: #fafafa; cursor: pointer; transition: all 0.3s ease;">
                                <input type="file" name="proof_image" class="d-none" id="paymentProof"
                                    accept=".jpg, .jpeg, .png">
                                <div id="dropzone-instructions">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-1"><strong>Click or Drag & drop payment screenshot</strong></p>
                                    <p class="text-muted small">JPG, PNG or JPEG (Max 5MB)</p>
                                </div>

                                <!-- Image preview container -->
                                <div id="previewContainer" class="mt-2" style="display: none;">
                                    <img id="previewImage" src="" alt="Preview"
                                        style="max-height: 250px; border-radius: 8px;" class="img-fluid">
                                    <p class="text-muted small mt-2" id="fileName"></p>
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" id="removePreview">
                                        <i class="fas fa-times"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Terms -->
                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" name="agreeTerms">
                            <label class="form-check-label ml-2" for="agreeTerms">
                                I certify that I have paid the fee and the screenshot provided is genuine.
                            </label>
                        </div>

                        <div class="form-buttons">
                            <button type="submit" class="btn btn-dark">Submit Verification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Loader Overlay -->
        <div id="loaderOverlay"
            style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; justify-content: center; align-items: center; flex-direction: column;">
            <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status"></div>
            <div class="text-light mt-3">Processing your request...</div>
        </div>
    </section>

    @push('scripts')
        <script>
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('paymentProof');
            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('previewImage');
            const instructions = document.getElementById('dropzone-instructions');
            const fileName = document.getElementById('fileName');
            const removePreview = document.getElementById('removePreview');
            const loader = document.getElementById('loaderOverlay');

            // Trigger file input
            dropzone.addEventListener('click', (e) => {
                if (e.target.id !== 'removePreview' && !e.target.closest('#removePreview')) {
                    fileInput.click();
                }
            });

            // Drag and Drop Logic
            ['dragenter', 'dragover'].forEach(name => {
                dropzone.addEventListener(name, (e) => {
                    e.preventDefault();
                    dropzone.style.backgroundColor = "#fff8e1";
                });
            });

            ['dragleave', 'drop'].forEach(name => {
                dropzone.addEventListener(name, (e) => {
                    e.preventDefault();
                    dropzone.style.backgroundColor = "#fafafa";
                });
            });

            dropzone.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                if (files.length) {
                    fileInput.files = files;
                    handlePreview(files[0]);
                }
            });

            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length) handlePreview(e.target.files[0]);
            });

            function handlePreview(file) {
                if (!file.type.startsWith('image/')) {
                    alert('Please upload an image file');
                    return;
                }
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                    instructions.style.display = 'none';
                    fileName.textContent = file.name;
                };
                reader.readAsDataURL(file);
            }

            removePreview.addEventListener('click', (e) => {
                e.stopPropagation();
                fileInput.value = '';
                previewContainer.style.display = 'none';
                instructions.style.display = 'block';
            });


            document.addEventListener('DOMContentLoaded', function () {

                // Apply mask
                $('#whatsapp_number').inputmask('9999 9999999', {
                    clearMaskOnLostFocus: true
                });

            });

            // Form Submission with Validation Error Handling
            document.getElementById('paymentForm').addEventListener('submit', async function (e) {
                e.preventDefault();

                // Reset errors
                this.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                this.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

                loader.style.display = 'flex';
                const formData = new FormData(this);

                try {
                    const response = await fetch("{{ route('navtech.payment.upload') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.status === 422) {
                        Object.keys(data.errors).forEach(field => {
                            const input = this.querySelector(`[name="${field}"]`) || this.querySelector(`#${field}`);
                            if (input) {
                                input.classList.add('is-invalid');
                                const error = document.createElement('div');
                                error.className = 'invalid-feedback d-block';
                                error.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${data.errors[field][0]}`;

                                // Special placement for checkbox and dropzone
                                if (field === 'proof_image') {
                                    dropzone.parentNode.appendChild(error);
                                } else {
                                    input.parentNode.appendChild(error);
                                }
                            }
                        });
                        // Scroll to first error
                        const firstError = document.querySelector('.is-invalid');
                        if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    } else if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                } catch (err) {
                    alert("An error occurred. Please try again.");
                } finally {
                    loader.style.display = 'none';
                }
            });
        </script>
    @endpush

    <style>
        .font-weight-600 {
            font-weight: 600;
        }

        #loaderOverlay.show {
            display: flex !important;
        }

        .invalid-feedback {
            font-size: 85%;
            color: #dc3545;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }
    </style>

@endsection