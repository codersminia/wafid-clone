@extends('layouts.public')

@section('title', 'Book Wafid (GAMCA) Appointment Online | Pakistan')
@section('meta_description', 'Apply for Wafid medical appointment in Pakistan. Online booking for Saudi Arabia, UAE, Oman, and Kuwait visas. Fast processing.')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1 class="font-weight-bold">Wafid (GAMCA) Online Registration</h1>
            <p class="lead">Secure booking service for GCC medical examinations in Pakistan.</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                
                <!-- Left Column: The Form -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom pt-4">
                            <h4 class="mb-0 text-dark"><i class="far fa-edit text-danger"></i> Candidate Details</h4>
                        </div>
                        <div class="card-body p-4">
                            <form id="appointmentForm" class="appointment-form" method="POST">
                                @csrf
                                
                                <!-- Location Section -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3 mt-2">1. Location & Visa</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="country">Current Country <span class="text-danger">*</span></label>
                                        <select class="form-control bg-light" id="country" name="country" readonly>
                                            <option value="Pakistan" selected>Pakistan</option>                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="city">Select City <span class="text-danger">*</span></label>
                                        <select name="city" class="form-control" id="city" >
                                            <option value="">-- Choose City --</option>
                                            <option value="bahawalpur">Bahawalpur</option>
                                            <option value="chakdara">Chakdara</option>
                                            <option value="faisalabad">Faisalabad</option>
                                            <option value="gujranwala">Gujranwala</option>
                                            <option value="gwadar">Gwadar</option>
                                            <option value="islamabad">Islamabad</option>
                                            <option value="karachi">Karachi</option>
                                            <option value="khuzdar">Khuzdar</option>
                                            <option value="lahore">Lahore</option>
                                            <option value="multan">Multan</option>
                                            <option value="panjgur">Panjgur</option>
                                            <option value="peshawar">Peshawar</option>
                                            <option value="quetta">Quetta</option>
                                            <option value="rawalpindi">Rawalpindi</option>
                                            <option value="sahiwal">Sahiwal</option>
                                            <option value="sialkot">Sialkot</option>
                                            <option value="turbat">Turbat</option>
                                        </select>
                                        <small class="form-text text-muted">Choose the city nearest to you.</small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="countryTravelingTo">Traveling To <span class="text-danger">*</span></label>
                                        <select id="countryTravelingTo" name="country_traveling_to" class="form-control" >
                                            <option value="">-- Select Country --</option>
                                            <option value="saudi-arabia">Saudi Arabia</option>
                                            <option value="uae">UAE</option>
                                            <option value="qatar">Qatar</option>
                                            <option value="kuwait">Kuwait</option>
                                            <option value="bahrain">Bahrain</option>
                                            <option value="oman">Oman</option>
                                        </select>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Personal Info -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3">2. Personal Information</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" class="form-control" placeholder="As per Passport" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" class="form-control" placeholder="As per Passport" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Nationality <span class="text-danger">*</span></label>
                                        <select class="form-control" name="nationality" id="nationality">
                                            <option value="Pakistan" selected>Pakistan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select class="form-control" name="gender" >
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                     <div class="form-group col-md-4">
                                        <label>Marital Status <span class="text-danger">*</span></label>
                                        <select class="form-control" name="marital_status" >
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                        </select>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Passport Info -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3">3. Passport Details</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Passport Number <span class="text-danger">*</span></label>
                                        <input name="passport_no" type="text" class="form-control" placeholder="e.g. AB1234567" style="text-transform: uppercase;" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Confirm Passport No <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="confirm_passport_no" style="text-transform: uppercase;" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Issue Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="passport_issue_date" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Expiry Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="passport_expiry_date" >
                                        <small class="text-muted">Must be valid for 6+ months.</small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Issue Place <span class="text-danger">*</span></label>
                                        <input class="form-control" name="passport_issue_place" type="text" value="Pakistan" >
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Contact & Job -->
                                <h6 class="text-uppercase text-muted font-weight-bold mb-3">4. Contact & Profession</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Phone No <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control" id="phone" placeholder="0300 1234567" >
                                        <small class="text-muted">We will WhatsApp the slip to this number.</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>National ID (CNIC) <span class="text-danger">*</span></label>
                                        <input type="text" name="national_id" class="form-control" >
                                    </div>
                                     <div class="form-group col-md-6">
                                        <label>Visa Type <span class="text-danger">*</span></label>
                                        <select name="visa_type" class="form-control" >
                                            <option value="work-visa">Work Visa</option>
                                            <option value="family-visa">Family Visa</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Position Applied For <span class="text-danger">*</span></label>
                                        <select name="position_applied" class="form-control" id="positionApplied" >
                                            <option value="">-- Select Profession --</option>
                                            <option value="banking-finance">Banking & Finance</option>
                                            <option value="carpenter">Carpenter</option>
                                            <option value="cashier">Cashier</option>
                                            <option value="electrician">Electrician</option>
                                            <option value="engineer">Engineer</option>
                                            <option value="general-secretory">General Secretory</option>
                                            <option value="health-medicine-nursing">Health & Medicine & Nursing</option>
                                            <option value="heavy-driver">Heavy Driver</option>
                                            <option value="it-internet-engineer">IT & Internet Engineer</option>
                                            <option value="leisure-tourism">Leisure & Tourism</option>
                                            <option value="light-driver">Light Driver</option>
                                            <option value="mason">Mason</option>
                                            <option value="president">President</option>
                                            <option value="labour">Labour</option>
                                            <option value="plumber">Plumber</option>
                                            <option value="doctor">Doctor</option>
                                            <option value="family">Family</option>
                                            <option value="steel-fixer">Steel Fixer</option>
                                            <option value="aluminum-technician">Aluminum Technician</option>
                                            <option value="nurse">Nurse</option>
                                            <option value="male-nurse">Male Nurse</option>
                                            <option value="ward-boy">Ward Boy</option>
                                            <option value="shovel-operator">Shovel Operator</option>
                                            <option value="dozer-operator">Dozer Operator</option>
                                            <option value="car-mechanic">Car Mechanic</option>
                                            <option value="petrol-mechanic">Petrol Mechanic</option>
                                            <option value="diesel-mechanic">Diesel Mechanic</option>
                                            <option value="student">Student</option>
                                            <option value="accountant">Accountant</option>
                                            <option value="lab-technician">Lab Technician</option>
                                            <option value="draftsman">Drafts man</option>
                                            <option value="auto-cad-operator">Auto-Cad Operator</option>
                                            <option value="painter">Painter</option>
                                            <option value="tailor">Tailor</option>
                                            <option value="welder">Welder</option>
                                            <option value="xray-technician">X-ray Technician</option>
                                            <option value="lecturer">Lecturer</option>
                                            <option value="ac-technician">A.C Technician</option>
                                            <option value="business">Business</option>
                                            <option value="cleaner">Cleaner</option>
                                            <option value="security-guard">Security Guard</option>
                                            <option value="house-maid">House Maid</option>
                                            <option value="manager">Manager</option>
                                            <option value="hospital-cleaning">Hospital Cleaning</option>
                                            <option value="mechanic">Mechanic</option>
                                            <option value="computer-operator">Computer Operator</option>
                                            <option value="house-driver">House Driver</option>
                                            <option value="driver">Driver</option>
                                            <option value="cleaning-labour">Cleaning Labour</option>
                                            <option value="building-electrician">Building Electrician</option>
                                            <option value="salesman">Salesman</option>
                                            <option value="plastermason">Plastermason</option>
                                            <option value="servant">Servant</option>
                                            <option value="barber">Barber</option>
                                            <option value="residence">Residence</option>
                                            <option value="shepherds">Shepherds</option>
                                            <option value="employment">Employment</option>
                                            <option value="fuel-filler">Fuel Filler</option>
                                            <option value="worker">Worker</option>
                                            <option value="house-boy">House Boy</option>
                                            <option value="house-wife">House Wife</option>
                                            <option value="rcc-fitter">RCC Fitter</option>
                                            <option value="clerk">Clerk</option>
                                            <option value="microbiologist">Microbiologist</option>
                                            <option value="teacher">Teacher</option>
                                            <option value="helper">Helper</option>
                                            <option value="hajj-duty">Hajj Duty</option>
                                            <option value="shuttering">Shuttering</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="medical-specialist">Medical Specialist</option>
                                            <option value="office-secretary">Office Secretary</option>
                                            <option value="technician">Technician</option>
                                            <option value="butcher">Butcher</option>
                                            <option value="arabic-food-cook">Arabic Food Cook</option>
                                            <option value="agricultural-worker">Agricultural Worker</option>
                                            <option value="service">Service</option>
                                            <option value="studio-cad-designer">Studio CAD Designer</option>
                                            <option value="financial-analyst">Financial Analyst</option>
                                            <option value="cabin-appearance-air-lines">Cabin Appearance (AIR LINES)</option>
                                            <option value="car-washer">Car Washer</option>
                                            <option value="surveyor">Surveyor</option>
                                            <option value="electrical-technician">Electrical Technician</option>
                                            <option value="waiter">Waiter</option>
                                            <option value="nursing-helper">Nursing helper</option>
                                            <option value="anesthesia-technician">Anesthesia technician</option>
                                            <option value="marvel">Marvel</option>
                                            <option value="construction-worker">Construction worker</option>
                                            <option value="other">Other (Type Manually)</option>
                                        </select>                                       
                                    </div>

                                    <div class="form-group col-md-12 d-none" id="otherFieldGroup">
                                        <label>Enter Profession Manually</label>
                                        <input type="text" class="form-control" id="otherPosition" name="other_position" placeholder="E.g. Crane Operator">
                                    </div>
                                </div>

                                <!-- Agreement -->
                                <div class="bg-light p-3 rounded mb-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="confirm_info" id="confirmInfo" >
                                        <label class="custom-control-label small" for="confirmInfo">
                                            I confirm that my passport details are 100% correct. I understand that if I provide wrong data, I will have to pay the fee again for a new slip.
                                        </label>
                                    </div>
                                </div>

                                <div class="form-buttons">
                                    <a href="{{ route('home') }}" class="btn btn-outline-dark">Cancel</a>
                                    <button type="submit" class="btn btn-dark shadow px-5">Save And Continue <i class="fas fa-arrow-right ml-2"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Instructions & SEO Content -->
                <div class="col-lg-4">
                    
                    <!-- Guide Card -->
                    <div class="card shadow-sm border-0 mb-4 bg-primary-dark text-white">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3">Booking Instructions</h5>
                            <ul class="list-unstyled mb-0" style="font-size: 0.95rem;">
                                <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Fill the form with Passport details.</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Pay the service fee via JazzCash/Bank.</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Upload the payment screenshot.</li>
                                <li><i class="fas fa-check-circle text-success mr-2"></i> Get slip on WhatsApp in 30 mins.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Required Docs -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 font-weight-bold">Documents Required at Center</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush small">
                                <li class="list-group-item px-0"><i class="fas fa-passport text-muted mr-2"></i> Original Passport</li>
                                <li class="list-group-item px-0"><i class="fas fa-id-card text-muted mr-2"></i> Original CNIC</li>
                                <li class="list-group-item px-0"><i class="fas fa-money-bill-wave text-muted mr-2"></i> Cash for Center Fee (~24k)</li>
                                <li class="list-group-item px-0"><i class="fas fa-images text-muted mr-2"></i> 4 Passport Size Photos</li>
                            </ul>
                        </div>
                    </div>

                    <!-- SEO Text Block -->
                    <div class="card shadow-sm border-0 bg-light">
                        <div class="card-body">
                            <h6 class="font-weight-bold">About Wafid Medical</h6>
                            <p class="small text-muted text-justify mb-0">
                                This service allows Pakistani citizens to book their Wafid (formerly GAMCA) medical test appointment online. The test is mandatory for work visas in Saudi Arabia, Dubai, Oman, and Qatar. Our team assists in generating the slip and guiding you to the nearest approved medical center.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Loader -->
        <div id="loaderOverlay">
            <div class="loader-content text-center">
                <div class="spinner-border text-light" role="status" style="width: 4rem; height: 4rem;"></div>
                <div class="text-light mt-3">Processing...</div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Wait for DOM + all scripts to be fully ready
        document.addEventListener('DOMContentLoaded', function () {

            // Apply mask
            $('#phone').inputmask('9999 9999999', {
                clearMaskOnLostFocus: true
            });

        });

        document.addEventListener('DOMContentLoaded', function () {
            const positionSelect = document.getElementById('positionApplied');
            const otherFieldGroup = document.getElementById('otherFieldGroup');

            positionSelect.addEventListener('change', function () {
                if (this.value === 'other') {
                    otherFieldGroup.classList.remove('d-none');
                } else {
                    otherFieldGroup.classList.add('d-none');
                    document.getElementById('otherPosition').value = ''; // reset field
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('appointmentForm');
            const loader = document.getElementById('loaderOverlay');

            const showLoader = () => loader.classList.add('show');
            const hideLoader = () => loader.classList.remove('show');

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                // Remove previous errors
                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

                const formData = new FormData(form);

                // Show loader
                showLoader();

                try {
                    const response = await fetch("{{ route('appointment.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                            "Accept": "application/json",
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.status === 422) {
                        let firstErrorField = null; // To scroll to the first error

                        Object.keys(data.errors).forEach(field => {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('is-invalid');

                                const error = document.createElement('div');
                                error.className = 'invalid-feedback';
                                error.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${data.errors[field][0]}`;

                                input.parentNode.appendChild(error);

                                // Capture the first field with an error
                                if (!firstErrorField) firstErrorField = input;
                            }
                        });

                        // Scroll to the first error smoothly
                        if (firstErrorField) {
                            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            firstErrorField.focus();
                        }

                    } else if (data.status === 'success') {
                        form.reset();
                        window.location.href = data.redirect;
                    }
                } catch (error) {
                    console.error(error);
                    alert('Something went wrong! Please try again.');
                } finally {
                    // Hide loader after request completes
                    hideLoader();
                }
            });
        });

        // Force Uppercase on Passport Inputs for UX
        $('input[name="passport_no"], input[name="confirm_passport_no"]').on('keyup', function(){
            $(this).val($(this).val().toUpperCase());
        });
    </script>
    @endpush

@endsection