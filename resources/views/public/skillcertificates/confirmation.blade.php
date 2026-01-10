@extends('layouts.public')
@section('title', 'Payment Confirmation')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>Payment Confirmation</h1>
            <p class="lead">Complete your payment to process your Soft Skill Certificate.</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5 bg-light">
        <div class="container">
            
            <!-- Fee Alert -->
            <div class="alert alert-warning border-0 mb-4" style="background-color: #fff3cd;">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="alert-heading mb-2">
                            <i class="fas fa-wallet"></i> Registration Fee: <strong>PKR {{ number_format($fee) }}</strong>
                        </h5>
                        <p class="mb-0">
                            Please transfer the amount to one of the accounts below and upload the receipt to confirm your application.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Account Details Card -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h4 class="mb-0"><i class="fas fa-university text-danger"></i> Account Details</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 text-left mb-4">
                            <div class="p-3 border rounded row mx-1" style="background-color: #fff9e6; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);">
                                <div class="col-md-5">
                                    <img src="{{asset('assets/public/images/qrcode.jpg')}}" alt="QR Code" class="img-fluid mb-3" style="max-width: 140px;">
                                </div>
                                <div class="col-md-7">
                                    <p class="small text-dark mb-2"><span style="font-weight:600">Account: </span>Jazz Cash</p>
                                    <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Title: </span> Mahad Butt</p>
                                    <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Number: </span> 19123456789</p>
                                </div>                        
                            </div>
                        </div>
                        <div class="col-md-6 text-left mb-4">
                            <div class="p-3 border rounded row mx-1" style="background-color: #fff9e6; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);">
                                <div class="col-md-5">
                                    <img src="{{asset('assets/public/images/qrcode.jpg')}}" alt="QR Code" class="img-fluid mb-3" style="max-width: 140px;">
                                </div>
                                <div class="col-md-7">
                                    <p class="small text-dark mb-2"><span style="font-weight:600">Account: </span>Meezan Bank</p>
                                    <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Title: </span> Mahad Butt</p>
                                    <p class="small font-weight-600 text-dark mb-2"><span style="font-weight:600">Number: </span> 19123456789</p>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Details Form -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white border-bottom pt-4 pb-3">
                    <h4 class="mb-0"><i class="fas fa-upload text-info"></i> Upload Proof</h4>
                </div>
                <div class="card-body p-4">
                    <form id="paymentForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="softskill_id" value="{{ $record->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-600">WhatsApp Number</label>
                                    <input type="text" 
                                        class="form-control" 
                                        id="whatsapp_number" 
                                        name="whatsapp_number" 
                                        value="{{ old('whatsapp_number', $record->whatsapp_number) }}" 
                                        placeholder="Enter Whatsapp Number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-600">Payment Method</label>
                                    <select class="form-control p-2" name="payment_method" id="payment_method">
                                        <option value="">Select Payment Method</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="JazzCash">JazzCash</option>
                                        <option value="EasyPaisa">EasyPaisa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Screenshot Upload (Navtech Dropzone Style) -->
                        <div class="form-group mb-4">
                            <label for="paymentProof" class="font-weight-600">Upload Payment Screenshot</label>
                            <div id="dropzone" class="border-2 rounded p-5 text-center" style="border: 2px dashed #1a8a8a; background-color: #fafafa; cursor: pointer; transition: all 0.3s ease;">
                                <input type="file" name="proof_image" class="d-none" id="paymentProof" accept=".jpg, .jpeg, .png">
                                <div id="dropzone-instructions">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-1"><strong>Click or Drag & drop payment screenshot</strong></p>
                                    <p class="text-muted small">JPG, PNG or JPEG (Max 2MB)</p>
                                </div>
                                
                                <!-- Image preview container -->
                                <div id="previewContainer" class="mt-2" style="display: none;">
                                    <img id="previewImage" src="" alt="Preview" style="max-height: 250px; border-radius: 8px;" class="img-fluid">
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
                            <button type="submit" class="btn btn-dark">Submit Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Loader Overlay -->
        <div id="loaderOverlay" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; justify-content: center; align-items: center; flex-direction: column;">
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
                dropzone.style.backgroundColor = "#eef9f9";
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

        // Form Submission with Validation Error Handling (Navtech Style)
        document.getElementById('paymentForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Reset errors
            this.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            this.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            
            loader.style.display = 'flex';
            const formData = new FormData(this);

            try {
                const response = await fetch("{{ route('softskill.payment.upload') }}", {
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
                            } else if (input.type === 'checkbox') {
                                input.parentNode.appendChild(error);
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
    .font-weight-600 { font-weight: 600; }
    .invalid-feedback { font-size: 85%; color: #dc3545; margin-top: 5px; }
    .is-invalid { border-color: #dc3545 !important; }
    #loaderOverlay.show { display: flex !important; }
</style>

@endsection