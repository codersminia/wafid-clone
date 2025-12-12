@extends('layouts.public')

@section('title', 'Wafid - Medical Examination')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>Medical Examinations Results</h1>
            <p class="lead">Book your health check-up appointment or view your test results</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Replaced with exact appointment form design from image -->
                    <div class="appointment-form-wrapper">
                        <form id="appointmentForm" class="appointment-form" method="POST" action="{{ route('medicalResults.save') }}">
                            @csrf
                            <!-- Appointment Location Section -->
                            <div class="form-section">
                                <h5 class="section-title">Your Medical Examinations Results</h5>
                                
                                <div class="form-section-label">By Passport Number</div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="country">Passport NO.</label>
                                        <input type="text" class="form-control" name="passport_no" placeholder="Enter Passport NO">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="city">Nationality</label>
                                        <select name="nationality" class="form-control">
                                            <option value="Pakistani">Pakistani</option>
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone No</label>
                                        <input type="tel" name="phone" class="form-control" id="phone">
                                    </div>      
                                </div>
                            </div>                            

                            <button type="submit" class="btn py-2 btn-dark">Check</button>
                            
                        </form>
                    </div>

                    <div id="successMessage" 
                        class="alert alert-success mt-4 d-none" 
                        style="opacity: 0; transition: opacity 0.6s ease;">
                        <i class="fab fa-whatsapp mr-2"></i>
                        We'll contact you on WhatsApp and share your slip with you.
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

        // Apply phone mask
        $('#phone').inputmask('9999 9999999', { clearMaskOnLostFocus: true });

        const form = document.getElementById('appointmentForm');
        const loader = document.getElementById('loaderOverlay');

        const showLoader = () => loader.classList.add('show');
        const hideLoader = () => loader.classList.remove('show');

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            // remove previous errors
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

            const formData = new FormData(form);

            showLoader();

            try {
                const response = await fetch("{{ route('medicalResults.save') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "Accept": "application/json",
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

                            input.parentNode.appendChild(error);

                            if (!firstErrorField) firstErrorField = input;
                        }
                    });

                    if (firstErrorField) {
                        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstErrorField.focus();
                    }

                } else if (data.status === 'success') {
                    form.reset();

                    const msg = document.getElementById('successMessage');

                    // Set the message text
                    msg.innerHTML = `
                        <i class="fab fa-whatsapp mr-2"></i>
                        We'll contact you on WhatsApp and share your slip with you.
                    `;

                    // Show + fade in
                    msg.classList.remove('d-none');
                    setTimeout(() => {
                        msg.style.opacity = "1";
                    }, 50);

                    // Auto-hide after 6 seconds
                    setTimeout(() => {
                        msg.style.opacity = "0";
                    }, 6000);

                    // Completely hide after fade-out
                    setTimeout(() => {
                        msg.classList.add('d-none');
                    }, 6600);

                    // Scroll to message
                    msg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }

            } catch (error) {
                console.error(error);
                alert('Something went wrong! Please try again.');
            } finally {
                hideLoader();
            }
        });
    });

</script>
@endpush


@endsection
