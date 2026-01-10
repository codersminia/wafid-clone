@extends('layouts.public')
@section('title', 'Payment Confirmation')

@section('content')
<style>
    .btn-teal { background-color: #1a8a8a; color: white; border: none; }
    .btn-teal:hover { background-color: #146e6e; color: white; }
    .border-teal { border: 2px dashed #1a8a8a !important; }
    #loaderOverlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; align-items: center; justify-content: center; }
    #loaderOverlay.show { display: flex; }
</style>

<section class="page-header bg-dark text-white py-5">
    <div class="container">
        <h1>Payment Confirmation</h1>
        <p class="lead">Complete your payment to process your Soft Skill Certificate.</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="alert alert-warning border-0 mb-4">
            <h5><i class="fas fa-wallet"></i> Registration Fee: <strong>PKR {{ number_format($fee) }}</strong></h5>
            <p class="mb-0">Please transfer the amount to one of the accounts below and upload the receipt.</p>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white"><h4 class="mb-0 text-info">Payment Accounts</h4></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="p-3 border rounded d-flex align-items-center">
                            <img src="{{ asset('assets/public/images/qrcode.jpg') }}" style="width: 80px;" class="mr-3">
                            <div><strong>JazzCash / EasyPaisa</strong><br>Title: Admin Name<br>Number: 03xx xxxxxxx</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="p-3 border rounded d-flex align-items-center">
                            <img src="{{ asset('assets/public/images/qrcode.jpg') }}" style="width: 80px;" class="mr-3">
                            <div><strong>Meezan Bank</strong><br>Title: Company Name<br>IBAN: PK64 MEZN ...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white"><h4><i class="fas fa-upload text-info"></i> Upload Proof</h4></div>
            <div class="card-body">
                <form id="paymentForm">
                    @csrf
                    <input type="hidden" name="softskill_id" value="{{ $record->id }}">
                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>WhatsApp Number</label>
                            <input type="text" class="form-control" name="whatsapp_number" value="{{ $record->whatsapp_number }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Payment Method</label>
                            <select class="form-control" name="payment_method" required>
                                <option value="JazzCash">JazzCash</option>
                                <option value="EasyPaisa">EasyPaisa</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Transaction ID / TRX</label>
                        <input type="text" class="form-control" name="transaction_no" required placeholder="Enter Transaction ID">
                    </div>

                    <div class="form-group">
                        <label>Upload Screenshot</label>
                        <div id="dropzone" class="border-teal p-4 text-center bg-white" style="cursor:pointer;">
                            <input type="file" name="proof_image" class="d-none" id="paymentProof" accept="image/*">
                            <div id="drop-text">
                                <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-muted"></i>
                                <p>Click to upload Payment Receipt</p>
                            </div>
                            <img id="previewImage" style="max-height: 150px; display:none;" class="mx-auto">
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="agreeTerms" name="agreeTerms" required>
                        <label class="form-check-label" for="agreeTerms">I certify that I have paid the fee and the screenshot is genuine.</label>
                    </div>

                    <button type="submit" class="btn btn-teal btn-lg px-5">Submit Payment Proof</button>
                </form>
            </div>
        </div>
    </div>
</section>

<div id="loaderOverlay"><div class="text-center"><div class="spinner-border text-light"></div><div class="text-light mt-2">Uploading Proof...</div></div></div>

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
            const res = await fetch("{{ route('softskill.payment.upload') }}", {
                method: "POST",
                body: formData,
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Accept": "application/json" }
            });
            const data = await res.json();
            if (res.status === 200) {
                window.location.href = data.redirect;
            } else {
                alert("Error: " + (data.message || "Validation failed"));
            }
        } catch (err) {
            alert("Error uploading. Try again.");
        } finally {
            document.getElementById('loaderOverlay').classList.remove('show');
        }
    });
</script>
@endpush
@endsection