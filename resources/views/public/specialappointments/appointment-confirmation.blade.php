@extends('layouts.public')

@section('title', 'Confirm Choice Booking - Wafid')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>Confirm Choice Booking</h1>
            <p class="lead">Step 2 of 3: Premium Service Payment</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5 bg-light">
        <div class="container">

            {{-- <h3>Your Appointment Number</h3>
            <div class="alert alert-success">
                <strong>{{ $appointment->appointment_no }}</strong>
            </div> --}}

            <!-- Fee Alert -->
            <div class="alert alert-warning border-0 mb-4" style="background-color: #fff3cd;">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="alert-heading mb-2">
                            <i class="fas fa-exclamation-triangle"></i> Appointment Fee
                        </h5>
                        <p class="mb-0">
                            <strong>
                                Fee Amount: {{ $fee }} PKR
                            </strong>
                            - Payment is required to confirm your appointment.
                            Please proceed with payment using the account details below.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Confirmation Card -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h4 class="mb-0"><i class="fas fa-user-check text-danger"></i> Account Details</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        @foreach($paymentMethods as $method)
                            <div class="col-md-6 text-left mb-4">
                                <div class="p-3 border rounded h-100 row mx-0"
                                    style="background-color: #fff9e6; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);">
                                    <div class="col-md-5 text-center">
                                        @if($method->qr_code)
                                            <img src="{{ asset('uploads/qr/' . $method->qr_code) }}" alt="QR Code"
                                                class="img-fluid mb-3"
                                                style="max-width: 140px; border: 1px solid #ddd; padding: 5px; background: #fff;">
                                        @else
                                            <div class="mb-3 d-flex align-items-center justify-content-center"
                                                style="height: 140px; background: #eee; border: 1px dashed #ccc;">No QR Code</div>
                                        @endif
                                    </div>

                                    <div class="col-md-7">
                                        <p class="small text-dark mb-2"><span style="font-weight:600">Account:
                                            </span>{{ $method->account_name }}</p>
                                        <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Account
                                                Title: </span> {{ $method->account_title }}</p>
                                        <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Account
                                                Number: </span> {{ $method->account_number }}</p>
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
                    <h4 class="mb-0"><i class="fas fa-credit-card text-danger"></i> Payment Information</h4>
                </div>
                <div class="card-body p-4">
                    <form id="paymentForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="special_appointment_id" value="{{ $appointment->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Passport No.</label>
                                    <!-- Auto-filled from the database -->
                                    <input type="text" class="form-control" name="passport_no"
                                        value="{{ old('passport_no', $appointment->passport_no) }}"
                                        placeholder="Enter passport number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Mobile No.</label>
                                    <!-- Auto-filled from the 'phone' column in the database -->
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                        value="{{ old('mobile_no', $appointment->phone) }}"
                                        placeholder="Enter mobile number">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
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

                        <!-- Payment Screenshot Upload -->
                        <div class="form-group mb-4">
                            <label for="paymentProof" class="font-weight-600">Upload Payment Screenshot</label>
                            <div id="dropzone" class="border-2 rounded p-4 text-center dropzone-area"
                                style="border: 2px dashed #dc3545; background-color: #fafafa; cursor: pointer !important; transition: all 0.3s ease;">
                                <input type="file" name="proof_image" class="form-control-file d-none" id="paymentProof"
                                    accept=".jpg, .jpeg, .png">
                                <label for="paymentProof" class="cursor-pointer mb-0" style="pointer-events: none;">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-1"><strong>Drag & drop your payment screenshot here</strong></p>
                                    <p class="text-muted small">or click to select from your device</p>
                                </label>
                                <!-- Image preview container -->
                                <div id="previewContainer" class="mt-3" style="display: none;">
                                    <img id="previewImage" src="/placeholder.svg" alt="Preview"
                                        style="max-width: 100%; max-height: 300px; border-radius: 4px;">
                                    <p class="text-muted small mt-2" id="fileName"></p>
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" id="removePreview">
                                        <i class="fas fa-times"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" name="agreeTerms">
                            <label class="form-check" for="agreeTerms">
                                I agree to the non-refundable policy and confirm payment.
                            </label>
                        </div>

                        <!-- Terms Text -->
                        <div class="mb-4 p-3 border rounded bg-light">
                            <p class="small text-muted mb-3">
                                <strong><i class="fas fa-shield-alt"></i> Refund Policy:</strong><br>
                                Choice center fees are strictly non-refundable once the appointment is booked, as this is a
                                paid premium slot.
                            </p>
                        </div>

                        <div class="form-buttons d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-dark px-5">Complete Booking</button>
                            <span class="text-muted mx-3">OR</span>
                            <a href="{{ route('special.payLater') }}" class="btn btn-outline-secondary px-5">Pay Later</a>
                        </div>
                    </form>
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
            // Copy to clipboard function
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(() => {
                    alert('Copied to clipboard!');
                }).catch(() => {
                    console.log('Failed to copy');
                });
            }

            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('paymentProof');
            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('previewImage');
            const fileName = document.getElementById('fileName');
            const removePreview = document.getElementById('removePreview');

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            // Highlight drop area when dragging over it
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight(e) {
                dropzone.style.borderColor = '#dc3545';
                dropzone.style.backgroundColor = '#fff5f5';
            }

            function unhighlight(e) {
                dropzone.style.borderColor = '#ddd';
                dropzone.style.backgroundColor = '#fafafa';
            }

            // Handle dropped files
            dropzone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                displayPreview(files[0]);
            }

            // Handle file input change
            fileInput.addEventListener('change', function (e) {
                if (e.target.files.length > 0) {
                    displayPreview(e.target.files[0]);
                }
            });

            // NEW: Make the entire dropzone div clickable
            dropzone.addEventListener('click', function (e) {
                // If the user clicked the 'Remove' button or its icon, don't open the file dialog
                if (e.target.id === 'removePreview' || e.target.closest('#removePreview')) {
                    return;
                }
                fileInput.click();
            });

            // Update the Remove Preview logic to stop event bubbling
            removePreview.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation(); // Prevents the click from reaching the 'dropzone' div

                fileInput.value = '';
                previewContainer.style.display = 'none';
                dropzone.querySelector('label').style.display = 'block';
            });

            // Update displayPreview to hide instructions when image is loaded
            function displayPreview(file) {
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        previewImage.src = event.target.result;
                        fileName.textContent = 'File: ' + file.name + ' (' + (file.size / 1024).toFixed(2) + ' KB)';
                        previewContainer.style.display = 'block';

                        // Hide the "Drag & Drop" instructions so the image is the focus
                        dropzone.querySelector('label').style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert('Please select a valid image file');
                    fileInput.value = '';
                }
            }

            document.addEventListener('DOMContentLoaded', function () {

                // Apply mask
                $('#mobile_no').inputmask('9999 9999999', {
                    clearMaskOnLostFocus: true
                });

            });

            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('paymentForm');
                const loader = document.getElementById('loaderOverlay');

                const showLoader = () => loader.classList.add('show');
                const hideLoader = () => loader.classList.remove('show');

                form.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    // Remove previous validation errors
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                    form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

                    const formData = new FormData(form);

                    // Show loader
                    showLoader();

                    try {
                        const response = await fetch("{{ route('special.payment.upload') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                                "Accept": "application/json"
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

                                    // For checkboxes, append error after label
                                    if (input.type === 'checkbox') {
                                        input.parentNode.appendChild(error);
                                    } else {
                                        input.parentNode.appendChild(error);
                                    }

                                    // Capture first error field for scrolling
                                    if (!firstErrorField) firstErrorField = input;
                                }
                            });

                            // Scroll to the first error smoothly
                            if (firstErrorField) {
                                firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                if (firstErrorField.type !== 'checkbox') {
                                    firstErrorField.focus();
                                }
                            }

                        } else if (data.status === 'success') {
                            form.reset();
                            window.location.href = data.redirect;
                        } else {
                            alert('Unexpected server response.');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Something went wrong! Please try again.');
                    } finally {
                        hideLoader();
                    }
                });
            });

        </script>
    @endpush


@endsection