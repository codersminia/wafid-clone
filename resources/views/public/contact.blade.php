@extends('layouts.public')

{{-- Dynamic SEO Tags --}}
@section('title', 'Contact Support - Gulf Medical Consultant')
@section('meta_description', 'Need help with GAMCA Wafid appointments, NAVTTC tests, or Tasheer bookings? Contact our support team in Pakistan via WhatsApp or Email.')
@section('meta_keywords', 'contact gamca consultant, wafid support number, navttc helpline pakistan, gamca appointment complaint, gulf visa medical help')

@push('head')
<style>
    .custom-location-tabs .nav-link { 
        background-color: #fff; 
        color: #333; 
        transition: all 0.3s; 
        border: 1px solid #eee;
        border-left: 5px solid transparent; 
    }
    .custom-location-tabs .nav-link:hover { 
        background-color: #f8f9fa; 
        transform: translateX(5px);
    }
    .custom-location-tabs .nav-link.active { 
        background-color: #2c3e50 !important; /* User Requested Color */
        color: #fff !important; 
        border-color: #2c3e50 !important;
        border-left: 5px solid #1a252f !important; 
        transform: translateX(5px); 
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .custom-location-tabs .nav-link.active small {
        color: rgba(255,255,255,0.8) !important;
    }
    .custom-location-tabs .nav-link.active h5 {
        color: #fff !important;
    }
</style>
@endpush

@section('content')

<!-- Page Header -->
<section class="inner-page-hero" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('assets/public/images/hero-bg.jpg') }}') center/cover no-repeat;">
    <div class="container">
        <h1 class="font-weight-bold">Contact Our Experts</h1>
        <p class="lead">Having trouble booking? We are here to help you 24/7.</p>
    </div>
</section>

<!-- Main Content -->
<section class="py-5 bg-light-grey">
    <div class="container">
        
        <!-- DYNAMIC CONTACT CARDS -->
        <div class="row mb-5">
            <!-- WhatsApp -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center py-4">
                    <div class="card-body">
                        <div class="icon-circle bg-light-green text-success mx-auto mb-3" style="width: 60px; height: 60px; line-height: 60px; border-radius: 50%; background: #e6fffa;">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </div>
                        <h5 class="font-weight-bold">WhatsApp Support</h5>
                        <p class="text-muted small">Fastest response for booking issues.</p>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '92xxxxxxxxxx') }}" class="btn btn-success btn-sm px-4">Chat Now</a>
                    </div>
                </div>
            </div>
            <!-- Email -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center py-4">
                    <div class="card-body">
                        <div class="icon-circle bg-light-blue text-primary mx-auto mb-3" style="width: 60px; height: 60px; line-height: 60px; border-radius: 50%; background: #e6f7ff;">
                            <i class="fas fa-envelope fa-2x"></i>
                        </div>
                        <h5 class="font-weight-bold">Email Us</h5>
                        <p class="text-muted small">Send your documents for review.</p>
                        <a href="mailto:{{ $settings['site_email'] ?? 'support@gamcawafidonline.com' }}" class="text-dark font-weight-bold">{{ $settings['site_email'] ?? 'support@gamcawafidonline.com' }}</a>
                    </div>
                </div>
            </div>
            <!-- Hours -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center py-4">
                    <div class="card-body">
                        <div class="icon-circle bg-light-red text-danger mx-auto mb-3" style="width: 60px; height: 60px; line-height: 60px; border-radius: 50%; background: #ffe6e6;">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <h5 class="font-weight-bold">Working Hours</h5>
                        <p class="text-muted small">Mon - Sat: 9:00 AM - 10:00 PM<br>Sunday: Online Support Only</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title font-weight-bold m-0" id="formTitle">Send a Message</h3>
                            <button type="button" id="toggleFormBtn" class="btn btn-sm btn-outline-primary font-weight-bold">
                                <i class="fas fa-star mr-1"></i> Give Feedback
                            </button>
                        </div>
                        
                        <!-- Contact Form -->
                        <form id="contactForm"> 
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="As per passport" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="0300 1234567" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="font-weight-bold">Email Address</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="font-weight-bold">Select Service Issue <span class="text-danger">*</span></label>
                                <select class="form-control custom-select p-2" name="subject" required>
                                    <option value="" selected disabled>Choose a topic...</option>
                                    <option value="Wafid Appointment">Wafid (GAMCA) Appointment Issue</option>
                                    <option value="NAVTTC Booking">NAVTTC / Takamol Registration</option>
                                    <option value="Tasheer/Visa">Tasheer Visa Center Appointment</option>
                                    <option value="Payment">Payment Verification (JazzCash/Easypaisa)</option>
                                    <option value="Report Status">Check Medical Report Status</option>
                                    <option value="Other">Other Inquiry</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="font-weight-bold">Message Details <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="message" rows="5" placeholder="Please describe your issue..." required></textarea>
                            </div>
                            
                            <!-- Improved Button with Spinner -->
                            <button type="submit" id="submitBtn" class="btn btn-dark px-5 mt-2">
                                <span id="btnText">Submit Query</span>
                                <span id="btnLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </form>

                        <!-- Feedback Form (Hidden by default) -->
                        <form id="feedbackForm" class="d-none">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Your Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="font-weight-bold">Your Rating <span class="text-danger">*</span></label>
                                <div class="rating-input d-flex text-warning fa-2x">
                                    <i class="fas fa-star rating-star" data-rating="1"></i>
                                    <i class="fas fa-star rating-star" data-rating="2"></i>
                                    <i class="fas fa-star rating-star" data-rating="3"></i>
                                    <i class="fas fa-star rating-star" data-rating="4"></i>
                                    <i class="fas fa-star rating-star" data-rating="5"></i>
                                    <input type="hidden" name="rating" id="ratingValue" value="5">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="font-weight-bold">Share Your Experience <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="message" rows="5" placeholder="How was your experience with us?" required></textarea>
                            </div>
                            <button type="submit" id="fbSubmitBtn" class="btn btn-dark px-5 mt-2">
                                <span id="fbBtnText">Submit Feedback</span>
                                <span id="fbBtnLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card bg-white border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Common Questions</h5>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-3"><a href="#" class="text-dark d-flex justify-content-between align-items-center">How to pay via JazzCash? <i class="fas fa-chevron-right small"></i></a></li>
                            <li class="mb-3"><a href="#" class="text-dark d-flex justify-content-between align-items-center">Can I change my Medical Center? <i class="fas fa-chevron-right small"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card bg-primary-dark text-white border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title"><i class="fas fa-shield-alt mr-2"></i> Secure Service</h5>
                        <p class="small mb-0">We value your privacy. Your data is automatically deleted from our local records after 30 days.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Office Locations Section -->
<section class="py-5 bg-white" id="locations">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-accent-red font-weight-bold text-uppercase">Find Us</h6>
            <h2 class="font-weight-bold text-dark">Visit Our Offices</h2>
            <p class="text-muted">We have physical presence in Gujranwala city for your convenience.</p>
            <div class="theme-divider"></div>
        </div>

        <div class="row">
            @php
                $offices = isset($settings['office_locations']) ? json_decode($settings['office_locations'], true) : [];
                $colors = ['text-danger', 'text-primary', 'text-success', 'text-warning', 'text-info'];
                $bg_colors = ['bg-light-red', 'bg-light-blue', 'bg-light-green', 'bg-light-orange', 'bg-light-info'];
                $icons = ['fa-map-marker-alt', 'fa-building', 'fa-landmark', 'fa-star', 'fa-map'];
            @endphp

            @if(count($offices) > 0)
                <!-- Location Tabs (Left Side) -->
                <div class="col-md-4 mb-4">
                    <div class="nav flex-column nav-pills custom-location-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach($offices as $index => $office)
                            @php
                                $color = $colors[$index % count($colors)];
                                $bg = $bg_colors[$index % count($bg_colors)];
                                $icon = $icons[$index % count($icons)];
                                $activeClass = ($index === 0) ? 'active' : '';
                                $ariaSelected = ($index === 0) ? 'true' : 'false';
                            @endphp
                            <a class="nav-link {{ $activeClass }} p-4 shadow-sm mb-3 border rounded" id="v-pills-office{{ $index }}-tab" data-toggle="pill" href="#v-pills-office{{ $index }}" role="tab" aria-controls="v-pills-office{{ $index }}" aria-selected="{{ $ariaSelected }}">
                                <div class="d-flex align-items-center">
                                    <div class=" {{ $bg }} {{ $color }} rounded-circle mr-3" style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                        <i class="fas {{ $icon }}"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 text-dark">{{ $office['title'] ?? 'Office' }}</h5>
                                        <small class="text-muted">{{ $office['city'] ?? 'Branch' }}</small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Map Content (Right Side) -->
                <div class="col-md-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        @foreach($offices as $index => $office)
                            @php
                                $activeClass = ($index === 0) ? 'show active' : '';
                            @endphp
                            <div class="tab-pane fade {{ $activeClass }}" id="v-pills-office{{ $index }}" role="tabpanel">
                                <div class="card border-0 shadow-lg">
                                    <div class="card-body p-0">
                                        <!-- Embedded Map -->
                                        @if(!empty($office['map_url']))
                                            <iframe src="{{ $office['map_url'] }}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                        @else
                                            <div style="height: 400px; display: flex; align-items: center; justify-content: center; background: #eee;">
                                                <p class="text-muted">Map URL not provided.</p>
                                            </div>
                                        @endif
                                        
                                        <div class="p-4 bg-light">
                                            <h4 class="font-weight-bold">{{ $office['title'] ?? 'Our Office' }}</h4>
                                            <p><i class="fas fa-map-pin text-danger mr-2"></i> {{ $office['address'] ?? '' }}</p>
                                            <p><i class="fas fa-phone text-success mr-2"></i> {{ $office['phone'] ?? '' }}</p>
                                            
                                            <!-- Optional: Directions link if you store coordinates or separate link, assuming map_url can serve or add another field -->
                                            <!-- Just linking to google maps general if url is embed, extracting might be hard. -->
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-12 text-center">
                    <p class="text-muted">No office locations configured yet.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Apply mask
    $('#phone').inputmask('9999 9999999', {
        clearMaskOnLostFocus: true
    });

    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');

    // Function to wipe away all red borders and error messages
    function clearFormErrors(f) {
        f.classList.remove('was-validated'); 
        f.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        f.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        // 1. Clear old errors
        clearFormErrors(form);

        // UI Loading state
        submitBtn.disabled = true;
        btnText.innerText = "Sending...";
        btnLoader.classList.remove('d-none');

        const formData = new FormData(form);

        try {
            const response = await fetch("{{ route('contact.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData
            });

            const data = await response.json();

            if (response.status === 422) {
                // Handle Validation Errors
                Object.keys(data.errors).forEach(field => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('is-invalid');
                        const error = document.createElement('div');
                        error.className = 'invalid-feedback';
                        error.innerText = data.errors[field][0];
                        input.parentNode.appendChild(error);
                    }
                });
            } else if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent!',
                    text: data.message,
                    confirmButtonColor: '#343a40'
                });

                form.reset();      
                clearFormErrors(form);    
            }
        } catch (err) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong. Please try again later.'
            });
        } finally {
            // Reset Button
            submitBtn.disabled = false;
            btnText.innerText = "Submit Query";
            btnLoader.classList.add('d-none');
        }
    });

    // --- FEEDBACK LOGIC ---
    const feedbackForm = document.getElementById('feedbackForm');
    const toggleBtn = document.getElementById('toggleFormBtn');
    const formTitle = document.getElementById('formTitle');
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('ratingValue');

    // Toggle between forms
    toggleBtn.addEventListener('click', function() {
        if (feedbackForm.classList.contains('d-none')) {
            // Switch to Feedback
            form.classList.add('d-none');
            feedbackForm.classList.remove('d-none');
            formTitle.innerText = "What Our Clients Say";
            toggleBtn.innerHTML = '<i class="fas fa-envelope mr-1"></i> Send Message';
            toggleBtn.classList.replace('btn-outline-primary', 'btn-outline-dark');
        } else {
            // Switch to Contact
            feedbackForm.classList.add('d-none');
            form.classList.remove('d-none');
            formTitle.innerText = "Send a Message";
            toggleBtn.innerHTML = '<i class="fas fa-star mr-1"></i> Give Feedback';
            toggleBtn.classList.replace('btn-outline-dark', 'btn-outline-primary');
        }
    });

    // Star Rating Logic
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;
            stars.forEach(s => {
                s.classList.toggle('fas', s.getAttribute('data-rating') <= rating);
                s.classList.toggle('far', s.getAttribute('data-rating') > rating);
            });
        });
    });

    // Feedback Submit
    feedbackForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const fbSubmitBtn = document.getElementById('fbSubmitBtn');
        const fbBtnText = document.getElementById('fbBtnText');
        const fbBtnLoader = document.getElementById('fbBtnLoader');

        fbSubmitBtn.disabled = true;
        fbBtnText.innerText = "Submitting...";
        fbBtnLoader.classList.remove('d-none');

        const formData = new FormData(feedbackForm);

        try {
            const response = await fetch("{{ route('feedback.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData
            });

            const data = await response.json();

            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Thank You!',
                    text: data.message,
                    confirmButtonColor: '#007bff'
                });
                feedbackForm.reset();
                clearFormErrors(feedbackForm);
                // Reset stars to 5
                stars.forEach(s => s.classList.replace('far', 'fas'));
                ratingInput.value = 5;
            }
        } catch (err) {
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong!' });
        } finally {
            fbSubmitBtn.disabled = false;
            fbBtnText.innerText = "Submit Feedback";
            fbBtnLoader.classList.add('d-none');
        }
    });
});
</script>
@endpush
@endsection