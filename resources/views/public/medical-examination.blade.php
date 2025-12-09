@extends('layouts.public')

@section('title', 'Wafid - Medical Examination')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>Medical Examinations</h1>
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
                        <form id="appointmentForm" class="appointment-form" method="POST">
                            @csrf
                            <!-- Appointment Location Section -->
                            <div class="form-section">
                                <h5 class="section-title">Appointment Information</h5>
                                
                                <div class="form-section-label">Appointment Location</div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="country">Country</label>
                                        <select class="form-control" id="country" name="country">
                                            <option>Pakistan</option>                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="city">City</label>
                                        <select name="city" class="form-control" id="city">
                                            <option value="">Select City</option>
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
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="countryTravelingTo">Country Traveling To</label>
                                        <select id="countryTravelingTo" name="country_traveling_to" class="form-control">
                                            <option value="">Select Country Traveling To</option>
                                            <option value="saudi-arabia">Saudi Arabia</option>
                                            <option value="uae">UAE</option>
                                            <option value="qatar">Qatar</option>
                                            <option value="kuwait">Kuwait</option>
                                            <option value="bahrain">Bahrain</option>
                                            <option value="oman">Oman</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Candidate Information Section -->
                            <div class="form-section">
                                <div class="form-section-label">Candidate Information</div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="firstName">First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="dateOfBirth">Date of Birth</label>
                                        <input type="date" name="date_of_birth" class="form-control" id="dateOfBirth">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="nationality">Nationality</label>
                                        <select class="form-control" name="nationality" id="nationality">
                                            <option>Pakistan</option>                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="">—</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="maritalStatus">Marital Status</label>
                                        <select class="form-control" name="marital_status" id="maritalStatus">
                                            <option value="">—</option>
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="passportNo">Passport number No</label>
                                        <input name="passport_no" type="text" class="form-control" id="passportNo">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="confirmPassportNo">Confirm Passport No</label>
                                        <input type="text" class="form-control" id="confirmPassportNo" name="confirm_passport_no">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="passportIssueDate">Passport Issue Date</label>
                                        <input type="date" class="form-control" name="passport_issue_date" id="passportIssueDate" >
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="passportIssuePlace">Passport Issue Place</label>
                                        <input class="form-control" name="passport_issue_place" type="text" id="passportIssuePlace">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="passportExpiryDate">Passport Expiry Date</label>
                                        <input type="date" class="form-control" name="passport_expiry_date" type="date" id="passportExpiryDate">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="visaType">Visa Type</label>
                                        <select name="visa_type" class="form-control" id="visaType">
                                            <option value="">Select Visa Type</option>
                                            <option value="work-visa">Work Visa</option>
                                            <option value="family-visa">Family Visa</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="your@example.com">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone">Phone No</label>
                                        <input type="tel" name="phone" class="form-control" id="phone">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nationalId">National ID</label>
                                        <input type="text" name="national_id" id="nationalId" class="form-control">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="positionApplied">Position applied for</label>
                                        <select name="position_applied" class="form-control" id="positionApplied">
                                            <option value="">—</option>
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
                                            <option value="other">Other</option>
                                        </select>                                       
                                    </div>

                                    <div class="form-group col-md-6 d-none" id="otherFieldGroup">
                                        <label for="otherPosition">Other</label>
                                        <div class="d-flex align-items-center">    
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="otherCheckbox" checked disabled>     
                                            </div>
                                            <input type="text" class="form-control mr-2" id="otherPosition" name="other_position" placeholder="Enter position">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Confirmation Checkbox -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="confirm_info" id="confirmInfo">
                                <label class="form-check" for="confirmInfo">
                                    I confirm that the information given in this form is true, complete, and accurate
                                </label>
                            </div>

                            <!-- Buttons -->
                            <div class="form-buttons">
                                <button type="reset" class="btn btn-outline-dark">Cancel</button>
                                <button type="submit" class="btn btn-dark">Save And Continue</button>
                            </div>
                        </form>
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

</script>
@endpush


@endsection
