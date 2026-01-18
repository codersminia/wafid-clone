@extends('layouts.public')

@section('title', 'Check Wafid (GAMCA) Medical Status Online | Fit/Unfit Report')
@section('meta_description', 'Check your Wafid (GAMCA) medical examination status online. Enter your passport number to receive your Fit/Unfit report via WhatsApp.')
@section('meta_keywords', 'check gamca status, wafid medical report, gamca fit unfit, medical status online pakistan, wafid result check')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1 class="font-weight-bold">Check Medical Status</h1>
            <p class="lead">View your Wafid (GAMCA) medical test results online.</p>
        </div>
    </section>

    <!-- Trust Alert -->
    <div class="bg-light py-2 border-bottom text-center">
        <div class="container">
            <small class="text-muted"><i class="fas fa-history"></i> Real-time status retrieval from GCC Health Council database.</small>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                
                <!-- Left Column: Search Form -->
                <div class="col-lg-7 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom pt-4">
                            <h4 class="mb-0 text-dark"><i class="fas fa-search text-primary"></i> Find Report</h4>
                        </div>
                        <div class="card-body p-4">
                            
                            <form id="appointmentForm" method="POST" action="{{ route('medicalResults.save') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <label class="font-weight-bold">Passport Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" name="passport_no" placeholder="e.g. AB1234567" style="text-transform: uppercase;" >
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Nationality</label>
                                        <select name="nationality" class="form-control p-2">
                                            <option value="Pakistani" selected>Pakistani</option>
                                        </select>
                                    </div>     
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">WhatsApp Number <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control" id="phone" placeholder="0300 1234567" >
                                        <small class="text-muted">We will send the PDF to this number.</small>
                                    </div> 
                                </div>

                                <button type="submit" class="btn btn-dark btn-lg btn-block mt-3 shadow">
                                    <i class="fas fa-search mr-2"></i> Check Status
                                </button>
                                
                            </form>

                            <!-- Success Message -->
                            <div id="successMessage" class="alert alert-success mt-4 d-none text-center shadow-sm" style="border-left: 5px solid #28a745;">
                                <h5 class="alert-heading font-weight-bold"><i class="fab fa-whatsapp"></i> Request Received!</h5>
                                <p class="mb-0">Our team is checking the official database. You will receive your <strong>Medical Status PDF</strong> on WhatsApp shortly.</p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right Column: Status Guide (SEO Content) -->
                <div class="col-lg-5">
                    
                    <div class="card shadow-sm border-0 mb-4 bg-primary-dark text-white">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3"><i class="fas fa-info-circle text-warning"></i> Status Guide</h5>
                            <p class="small text-white-50">Understanding your report status:</p>
                            
                            <div class="media mb-3">
                                <i class="fas fa-check-circle text-success fa-2x mr-3"></i>
                                <div class="media-body">
                                    <h6 class="mt-0 font-weight-bold">FIT Status</h6>
                                    <p class="small mb-0 text-white-50">You are medically healthy and cleared to travel. You can proceed with visa stamping.</p>
                                </div>
                            </div>

                            <div class="media mb-3">
                                <i class="fas fa-times-circle text-danger fa-2x mr-3"></i>
                                <div class="media-body">
                                    <h6 class="mt-0 font-weight-bold">UNFIT Status</h6>
                                    <p class="small mb-0 text-white-50">You have failed the medical exam due to an infectious or physical issue. You cannot travel.</p>
                                </div>
                            </div>

                             <div class="media">
                                <i class="fas fa-clock text-warning fa-2x mr-3"></i>
                                <div class="media-body">
                                    <h6 class="mt-0 font-weight-bold">PENDING / RETEST</h6>
                                    <p class="small mb-0 text-white-50">The lab needs more time or additional tests to confirm your result.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 font-weight-bold">Common Questions</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled small mb-0">
                                <li class="mb-2"><strong>Q: How long does the result take?</strong><br> <span class="text-muted">Usually 24 to 48 hours after the test.</span></li>
                                <li class="mb-2"><strong>Q: Validity of Fit Report?</strong><br> <span class="text-muted">The medical report is valid for 60 to 90 days depending on the country.</span></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>        

        <!-- Loader Overlay -->
        <div id="loaderOverlay">
            <div class="loader-content text-center">
                <div class="spinner-border text-light" role="status" style="width: 4rem; height: 4rem;"></div>
                <div class="text-light mt-3" style="font-size: 1.5rem;">Connecting to Database...</div>
            </div>
        </div>

    </section>

    <!-- SEO Content Section (Bottom of page) -->
    <section class="py-5 bg-light border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <h3 class="font-weight-bold mb-3">About Wafid Medical Status Check</h3>
                    <p class="text-muted text-justify">
                        The Wafid (formerly GAMCA) medical examination is a mandatory requirement for expatriates wishing to work in Gulf Cooperation Council (GCC) countries, including Saudi Arabia, UAE, Kuwait, Qatar, Oman, and Bahrain. 
                        Once you have completed your medical test at an assigned center, the results are uploaded to the central online portal.
                    </p>
                    <p class="text-muted text-justify">
                        Use our <strong>Online Status Check</strong> tool to track your report. Simply enter your passport number, and our team will retrieve the latest status (Fit or Unfit) from the official system and send the detailed PDF report directly to your WhatsApp. This service saves you the hassle of visiting the medical center repeatedly.
                    </p>
                </div>
            </div>
        </div>
    </section>


@push('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function () {

        // Auto Uppercase Passport
        $('input[name="passport_no"]').on('keyup', function(){
            $(this).val($(this).val().toUpperCase());
        });

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
                    msg.classList.remove('d-none');
                    msg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Optional: Hide success message after 10 seconds
                    setTimeout(() => {
                         msg.classList.add('d-none');
                    }, 10000);
                }

            } catch (error) {
                console.error(error);
                alert('Connection error. Please try again.');
            } finally {
                hideLoader();
            }
        });
    });

</script>
@endpush

@endsection