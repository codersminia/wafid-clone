@extends('layouts.public')

@section('title', 'Wafid - Medical Examination')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>Appointment Confirmation</h1>
            <p class="lead">Complete Your Payment and Confirm Your Appointment</p>
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
                                Fee Amount: {{ number_format($fee) }} PKR
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
                        <!-- QR Codes Section -->
                        <div class="col-lg-12 mb-4 mb-lg-0">
                            <div class="row">
                                <div class="col-md-6 text-left mb-4">
                                    <div class="p-3 m-3 border rounded row" style="background-color: #fff9e6;box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);">
                                        <div class="col-md-6">
                                            <img src="{{asset('assets/public/images/qrcode.jpg')}}?height=180&width=180" alt="QR Code 1" class="img-fluid mb-3" style="max-width: 150px;">
                                        </div>

                                        <div class="col-md-6">
                                            <p class="small text-dark mb-2"><span style="font-weight:600">Account: </span>Jazz Cash</p>
                                            <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Account Title: </span> Mahad Butt</p>
                                            <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Account Number: </span> 19123456789</p>
                                            <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">IBAN Number: </span> 19123456789</p>
                                        </div>                        
                                    </div>
                                </div>
                                <div class="col-md-6 text-left mb-4">
                                    <div class="p-3 m-3 border rounded row" style="background-color: #fff9e6;box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);">
                                        <div class="col-md-6">
                                            <img src="{{asset('assets/public/images/qrcode.jpg')}}?height=180&width=180" alt="QR Code 1" class="img-fluid mb-3" style="max-width: 150px;">
                                        </div>

                                        <div class="col-md-6">
                                            <p class="small text-dark mb-2"><span style="font-weight:600">Account: </span>Meezan Bank</p>
                                            <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Account Title: </span> Mahad Butt</p>
                                            <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Account Number: </span> 19123456789</p>
                                            <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">IBAN Number: </span> 19123456789</p>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Important Announcement -->
            {{-- <div class="alert alert-danger border-0 mb-4" style="background-color: #ffe6e6;">
                <div class="p-3" style="background-color: #ffeb3b; color: #333; border-radius: 4px;" class="mb-3">
                    <strong><i class="fas fa-info-circle"></i> Important Notice:</strong>
                    <p class="mb-0">Pay the full amount of 4,500 and use your appointment number in the transfer reference. Make your payment and upload the proof below for confirmation.</p>
                </div>
            </div> --}}

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
                                    <input type="text" class="form-control" name="passport_no" placeholder="Enter passport number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Mobile No.</label>
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter mobile number">
                                </div>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Payment Method</label>
                                    <select class="form-control p-2" name="payment_method">
                                        <option value="">Select Payment Method</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="jazzcash">Jazzcash</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Deposit slip No / Trx ID</label>
                                    <input type="text" class="form-control" name="transaction_no" placeholder="Enter trx id">
                                </div>
                            </div>
                        </div>                        

                        <!-- Payment Screenshot Upload -->
                        <div class="form-group mb-4">
                            <label for="paymentProof" class="font-weight-600">Upload Payment Screenshot</label>
                            <div id="dropzone" class="border-2 rounded p-4 text-center dropzone-area" style="border: 2px dashed #dc3545; background-color: #fafafa; cursor: pointer !important; transition: all 0.3s ease;">
                                <input type="file" name="proof_image" class="form-control-file d-none" id="paymentProof" accept="image/*">
                                <label for="paymentProof" class="cursor-pointer mb-0">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-1"><strong>Drag & drop your payment screenshot here</strong></p>
                                    <p class="text-muted small">or click to select from your device</p>
                                </label>
                                <!-- Image preview container -->
                                <div id="previewContainer" class="mt-3" style="display: none;">
                                    <img id="previewImage" src="/placeholder.svg" alt="Preview" style="max-width: 100%; max-height: 300px; border-radius: 4px;">
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
                                I certify that the information given in this form is true, complete, and accurate.
                            </label>
                        </div>

                        <!-- Terms Text -->
                        <div class="mb-4 p-3 border rounded bg-light">
                            <p class="small text-muted mb-3">
                                <strong>Privacy & Terms Information:</strong><br>
                                We offer genuine/swift services and efficient services for Gomco medical appointments. Whether you are a first-timer or any other case, we offer the best possible help for your situation as a whole. Wafid appoints a specialized team that follows all international standards to ensure your medical examinations are done in a safe and secure environment. We also provide the option to print your Gomco appointment slip for easy reference. Whether you are in Karachi, Lahore, Islamabad, Multan, Faisalabad, Sargodha, Jhang, Bahawalpur, Rawalpindi, Sargodha, Jhang, Bahawalpur, Rawalpindi, Faisalabad, Sahiwal, or any other city, we are here to help. You can conveniently book your generic appointment slip for easy reference. Whether you are in Karachi, Lahore, Islamabad, and other cities like Quetta, Peshawar, Multan (DAI), Bannu, Kohat, Hassan Abdal, Taxila, Gujrat, Jhang, etc you can conveniently book your generic appointments for all need.
                            </p>
                        </div>

                        <div class="form-buttons">
                            {{-- <button type="reset" class="btn btn-outline-dark">Previous</button> --}}
                            <button type="submit" class="btn btn-dark">Submit</button>
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
        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                displayPreview(e.target.files[0]);
            }
        });

        // Display preview function
        function displayPreview(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                    fileName.textContent = 'File: ' + file.name + ' (' + (file.size / 1024).toFixed(2) + ' KB)';
                    previewContainer.style.display = 'block';
                    dropzone.querySelector('label').style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select a valid image file');
                fileInput.value = '';
            }
        }

        // Remove preview
        removePreview.addEventListener('click', function() {
            fileInput.value = '';
            previewContainer.style.display = 'none';
            dropzone.querySelector('label').style.display = 'block';
        });

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
