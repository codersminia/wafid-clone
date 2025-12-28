@extends('layouts.public')

@section('title', 'Tasheer Appointment - Payment Confirmation')

@section('content')
<style>
    .btn-teal { background-color: #1a8a8a; color: white; border: none; font-weight: 700; }
    .btn-teal:hover { background-color: #146e6e; color: white; }
    .border-teal { border: 2px dashed #1a8a8a !important; }
    .font-weight-600 { font-weight: 600; }
    #loaderOverlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; align-items: center; justify-content: center; }
    #loaderOverlay.show { display: flex; }
</style>

<section class="page-header bg-dark text-white py-5">
    <div class="container text-center">
        <h1>Appointment Confirmation</h1>
        <p class="lead">Complete Your Payment of PKR {{ number_format($fee) }} to Process Registration</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        
        <!-- Fee Alert -->
        <div class="alert alert-warning border-0 mb-4" style="background-color: #fff3cd;">
            <h5 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Required Action</h5>
            <p class="mb-0">Please transfer **PKR {{ number_format($fee) }}** to the accounts below and upload the screenshot for verification.</p>
        </div>

        <!-- Account Details Card -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-white py-3"><h4 class="mb-0 text-dark">Payment Accounts</h4></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="p-3 border rounded d-flex align-items-center" style="background-color: #fff9e6;">
                            <img src="{{ asset('assets/public/images/qrcode.jpg') }}" class="img-fluid mr-3" style="max-width: 100px;">
                            <div>
                                <p class="mb-1"><strong>Jazz Cash</strong></p>
                                <p class="small mb-0">Title: Mahad Butt</p>
                                <p class="small mb-0">Number: 03xx xxxxxxx</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="p-3 border rounded d-flex align-items-center" style="background-color: #fff9e6;">
                            <img src="{{ asset('assets/public/images/qrcode.jpg') }}" class="img-fluid mr-3" style="max-width: 100px;">
                            <div>
                                <p class="mb-1"><strong>Meezan Bank</strong></p>
                                <p class="small mb-0">Title: Mahad Butt</p>
                                <p class="small mb-0">IBAN: PK64 MEZN ...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Form -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3"><h4><i class="fas fa-credit-card text-info"></i> Upload Payment Proof</h4></div>
            <div class="card-body p-4">
                <form id="paymentForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tasheer_appointment_id" value="{{ $appointment->id }}">

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="font-weight-600">WhatsApp Number</label>
                            <input type="text" class="form-control" name="whatsapp_number" value="{{ $appointment->whatsapp_number }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-600">Payment Method</label>
                            <select class="form-control" name="payment_method" required>
                                <option value="">Select Method</option>
                                <option value="JazzCash">JazzCash</option>
                                <option value="EasyPaisa">EasyPaisa</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-600">Transaction ID / TRX No</label>
                        <input type="text" class="form-control" name="transaction_no" placeholder="Enter transaction reference" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-600">Upload Receipt Screenshot</label>
                        <div id="dropzone" class="border-teal rounded p-5 text-center bg-white" style="cursor: pointer;">
                            <input type="file" name="proof_image" class="d-none" id="paymentProof" accept="image/*">
                            <div id="drop-text">
                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                <p class="mb-0 text-muted">Click to upload your <strong>Payment Receipt</strong></p>
                            </div>
                            <img id="previewImage" style="max-height: 250px; display:none;" class="mx-auto rounded shadow-sm">
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="agreeTerms" name="agreeTerms" required>
                        <label class="form-check-label" for="agreeTerms">I certify that the information provided is accurate and the payment proof is genuine.</label>
                    </div>

                    <button type="submit" class="btn btn-teal btn-lg px-5">Submit Payment</button>
                </form>
            </div>
        </div>
    </div>
</section>

<div id="loaderOverlay"><div class="loader-content text-center"><div class="spinner-border text-light"></div><div class="text-light mt-3">Verifying Payment...</div></div></div>

@push('scripts')
<script>
    const dropzone = document.getElementById('dropzone');
    const input = document.getElementById('paymentProof');
    const preview = document.getElementById('previewImage');
    const dropText = document.getElementById('drop-text');

    dropzone.addEventListener('click', () => input.click());
    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.style.display = 'block';
                dropText.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('paymentForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        document.getElementById('loaderOverlay').classList.add('show');
        
        const formData = new FormData(this);
        try {
            const res = await fetch("{{ route('tasheer.payment.upload') }}", {
                method: "POST",
                body: formData,
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Accept": "application/json" }
            });
            const data = await res.json();
            if (res.status === 422) {
                alert("Please complete all fields and upload the image.");
            } else {
                window.location.href = data.redirect;
            }
        } catch (err) {
            alert("Connection error. Please try again.");
        } finally {
            document.getElementById('loaderOverlay').classList.remove('show');
        }
    });
</script>
@endpush
@endsection