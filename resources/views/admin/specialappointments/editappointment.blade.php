@extends('layouts.admin')

@section('title', 'Wafid - Appointments')

@section('content')

<style>
    /* Reduce spacing between form rows on mobile devices */
    @media (max-width: 991px) {
        .form-group.row {
            margin-bottom: 0.5rem !important;
        }
        
        /* Add top spacing on mobile to prevent card from touching header */
        .d-flex.flex-column-fluid {
            padding-top: 1.5rem !important;
        }
    }
</style>

@php
    $cities = ['Gujranwala', 'Lahore']; // Capitalized to match JS keys
@endphp

<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class=" container ">
		<div class="row">
	        <div class="col-lg-12">
		        <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">
                            Edit Special Appointment
                        </h3>
                    </div>
                    <!--begin::Form-->
                    <form class="form" method="POST" action="{{ route('admin.special.appointments.update', $appointment->id) }}">
                        @csrf

                        <div class="card-body">

                            <div class="form-group row">
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Country:</label>
                                    <select class="form-control" id="country" name="country" required>
                                        <option value="Pakistan" {{ old('country', $appointment->country) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                    </select>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>City:</label>
                                    <select name="city" class="form-control" id="city" required>
                                        @foreach($cities as $city)
                                            <option value="{{ $city }}" {{ old('city', $appointment->city) == $city ? 'selected' : '' }}>
                                                {{ $city }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Medical Center:</label>
                                    <select name="medical_center" id="medical_center" class="form-control" required>
                                        <!-- Options will be populated via JS -->
                                    </select>
                                    @error('medical_center')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Traveling To:</label>
                                    <select name="country_traveling_to" class="form-control" required>
                                        <option value="saudi-arabia" 
                                            {{ old('country_traveling_to', $appointment->country_traveling_to) == 'saudi-arabia' ? 'selected' : '' }}>
                                            Saudi Arabia
                                        </option>

                                        <option value="uae" 
                                            {{ old('country_traveling_to', $appointment->country_traveling_to) == 'uae' ? 'selected' : '' }}>
                                            UAE
                                        </option>

                                        <option value="qatar" 
                                            {{ old('country_traveling_to', $appointment->country_traveling_to) == 'qatar' ? 'selected' : '' }}>
                                            Qatar
                                        </option>

                                        <option value="kuwait" 
                                            {{ old('country_traveling_to', $appointment->country_traveling_to) == 'kuwait' ? 'selected' : '' }}>
                                            Kuwait
                                        </option>

                                        <option value="bahrain" 
                                            {{ old('country_traveling_to', $appointment->country_traveling_to) == 'bahrain' ? 'selected' : '' }}>
                                            Bahrain
                                        </option>

                                        <option value="oman" 
                                            {{ old('country_traveling_to', $appointment->country_traveling_to) == 'oman' ? 'selected' : '' }}>
                                            Oman
                                        </option>

                                    </select>
                                    @error('country_traveling_to')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>First Name:</label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name', $appointment->first_name) }}" required>
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Last Name:</label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name', $appointment->last_name) }}" required>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Date of Birth:</label>
                                    <input type="date" name="date_of_birth" class="form-control"
                                        value="{{ old('date_of_birth', $appointment->date_of_birth) }}" required>
                                    @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">                        

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Nationality:</label>
                                    <select class="form-control" name="nationality" id="nationality" required>
                                        <option value="Pakistan" {{ old('nationality', $appointment->nationality) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                    </select>
                                    @error('nationality')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Gender:</label>
                                    <select name="gender" class="form-control">
                                        <option {{ old('gender', $appointment->gender) == 'Male' ? 'selected':'' }}>Male</option>
                                        <option {{ old('gender', $appointment->gender) == 'Female' ? 'selected':'' }}>Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Marital Status:</label>
                                    <select name="marital_status" class="form-control" required>
                                        <option value="Single" {{ old('marital_status', $appointment->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ old('marital_status', $appointment->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                    </select>
                                    @error('marital_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Passport No:</label>
                                    <input type="text" name="passport_no" class="form-control"
                                        value="{{ old('passport_no', $appointment->passport_no) }}" required>
                                    @error('passport_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Confirm Passport No:</label>
                                    <input type="text" name="confirm_passport_no" class="form-control"
                                        value="{{ old('confirm_passport_no', $appointment->confirm_passport_no) }}" required>
                                    @error('confirm_passport_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Passport Issue Date:</label>
                                    <input type="date" name="passport_issue_date" class="form-control"
                                        value="{{ old('passport_issue_date', $appointment->passport_issue_date) }}" required>
                                    @error('passport_issue_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Passport Issue Place:</label>
                                    <input type="text" name="passport_issue_place" class="form-control"
                                        value="{{ old('passport_issue_place', $appointment->passport_issue_place) }}" required>
                                    @error('passport_issue_place')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Passport Expiry Date:</label>
                                    <input type="date" name="passport_expiry_date" class="form-control"
                                        value="{{ old('passport_expiry_date', $appointment->passport_expiry_date) }}" required>
                                    @error('passport_expiry_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Visa Type:</label>
                                    <select name="visa_type" class="form-control">
                                        <option value="work-visa" {{ old('visa_type', $appointment->visa_type) == 'work-visa' ? 'selected' : '' }}>
                                            Work Visa
                                        </option>

                                        <option value="family-visa" {{ old('visa_type', $appointment->visa_type) == 'family-visa' ? 'selected' : '' }}>
                                            Family Visa
                                        </option>
                                    </select>
                                    @error('visa_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">    
                                
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Email:</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $appointment->email) }}" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>Phone:</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone', $appointment->phone) }}" required>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                        

                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label>National ID:</label>
                                    <input type="text" name="national_id" class="form-control"
                                        value="{{ old('national_id', $appointment->national_id) }}" required>
                                    @error('national_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                        

                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <label>Position Applied:</label>

                                    @php
                                        $positions = [
                                            'banking-finance' => 'Banking & Finance',
                                            'carpenter' => 'Carpenter',
                                            'cashier' => 'Cashier',
                                            'electrician' => 'Electrician',
                                            'engineer' => 'Engineer',
                                            'general-secretory' => 'General Secretory',
                                            'health-medicine-nursing' => 'Health & Medicine & Nursing',
                                            'heavy-driver' => 'Heavy Driver',
                                            'it-internet-engineer' => 'IT & Internet Engineer',
                                            'leisure-tourism' => 'Leisure & Tourism',
                                            'light-driver' => 'Light Driver',
                                            'mason' => 'Mason',
                                            'president' => 'President',
                                            'labour' => 'Labour',
                                            'plumber' => 'Plumber',
                                            'doctor' => 'Doctor',
                                            'family' => 'Family',
                                            'steel-fixer' => 'Steel Fixer',
                                            'aluminum-technician' => 'Aluminum Technician',
                                            'nurse' => 'Nurse',
                                            'male-nurse' => 'Male Nurse',
                                            'ward-boy' => 'Ward Boy',
                                            'shovel-operator' => 'Shovel Operator',
                                            'dozer-operator' => 'Dozer Operator',
                                            'car-mechanic' => 'Car Mechanic',
                                            'petrol-mechanic' => 'Petrol Mechanic',
                                            'diesel-mechanic' => 'Diesel Mechanic',
                                            'student' => 'Student',
                                            'accountant' => 'Accountant',
                                            'lab-technician' => 'Lab Technician',
                                            'draftsman' => 'Drafts man',
                                            'auto-cad-operator' => 'Auto-Cad Operator',
                                            'painter' => 'Painter',
                                            'tailor' => 'Tailor',
                                            'welder' => 'Welder',
                                            'xray-technician' => 'X-ray Technician',
                                            'lecturer' => 'Lecturer',
                                            'ac-technician' => 'A.C Technician',
                                            'business' => 'Business',
                                            'cleaner' => 'Cleaner',
                                            'security-guard' => 'Security Guard',
                                            'house-maid' => 'House Maid',
                                            'manager' => 'Manager',
                                            'hospital-cleaning' => 'Hospital Cleaning',
                                            'mechanic' => 'Mechanic',
                                            'computer-operator' => 'Computer Operator',
                                            'house-driver' => 'House Driver',
                                            'driver' => 'Driver',
                                            'cleaning-labour' => 'Cleaning Labour',
                                            'building-electrician' => 'Building Electrician',
                                            'salesman' => 'Salesman',
                                            'plastermason' => 'Plastermason',
                                            'servant' => 'Servant',
                                            'barber' => 'Barber',
                                            'residence' => 'Residence',
                                            'shepherds' => 'Shepherds',
                                            'employment' => 'Employment',
                                            'fuel-filler' => 'Fuel Filler',
                                            'worker' => 'Worker',
                                            'house-boy' => 'House Boy',
                                            'house-wife' => 'House Wife',
                                            'rcc-fitter' => 'RCC Fitter',
                                            'clerk' => 'Clerk',
                                            'microbiologist' => 'Microbiologist',
                                            'teacher' => 'Teacher',
                                            'helper' => 'Helper',
                                            'hajj-duty' => 'Hajj Duty',
                                            'shuttering' => 'Shuttering',
                                            'supervisor' => 'Supervisor',
                                            'medical-specialist' => 'Medical Specialist',
                                            'office-secretary' => 'Office Secretary',
                                            'technician' => 'Technician',
                                            'butcher' => 'Butcher',
                                            'arabic-food-cook' => 'Arabic Food Cook',
                                            'agricultural-worker' => 'Agricultural Worker',
                                            'service' => 'Service',
                                            'studio-cad-designer' => 'Studio CAD Designer',
                                            'financial-analyst' => 'Financial Analyst',
                                            'cabin-appearance-air-lines' => 'Cabin Appearance (AIR LINES)',
                                            'car-washer' => 'Car Washer',
                                            'surveyor' => 'Surveyor',
                                            'electrical-technician' => 'Electrical Technician',
                                            'waiter' => 'Waiter',
                                            'nursing-helper' => 'Nursing Helper',
                                            'anesthesia-technician' => 'Anesthesia Technician',
                                            'marvel' => 'Marvel',
                                            'construction-worker' => 'Construction Worker',
                                            'other' => 'Other'
                                        ];
                                    @endphp

                                    <select id="positionApplied" name="position_applied" class="form-control" required>
                                        @foreach($positions as $key => $label)
                                            <option value="{{ $key }}" {{ old('position_applied', $appointment->position_applied) == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('position_applied')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror                            
                                </div>

                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <label></label>
                                    <input type="text" id="otherPosition" name="other_position" class="form-control mt-2"
                                        placeholder="Enter position"
                                        value="{{ old('other_position', $appointment->other_position ?? '') }}"
                                        style="{{ old('position_applied', $appointment->position_applied) == 'other' ? '' : 'display:none;' }}">
                                    @error('other_position')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const dropdown = document.getElementById('positionApplied');
                                    const otherInput = document.getElementById('otherPosition');

                                    function toggleOther() {
                                        if(dropdown.value === 'other') {
                                            otherInput.style.display = 'block';
                                            otherInput.required = true;
                                        } else {
                                            otherInput.style.display = 'none';
                                            otherInput.required = false;
                                        }
                                    }

                                    toggleOther();
                                    dropdown.addEventListener('change', toggleOther);
                                });
                                </script>
                            </div>

                            @if($appointment->specialPayment)
                                <hr>
                                <h4 class="text-primary mb-4">Payment Proof</h4>

                                <div class="row bg-light p-4 rounded align-items-center border">
                                    <!-- Method -->
                                    <div class="col-md-3 mb-3 mb-md-0">
                                        <label class="font-weight-bold text-muted text-uppercase small">Method:</label>
                                        <div class="font-weight-bolder text-dark">{{ ucfirst($appointment->specialPayment->payment_method) }}</div>
                                    </div>

                                    <!-- Passport No -->
                                    <div class="col-md-3 mb-3 mb-md-0">
                                        <label class="font-weight-bold text-muted text-uppercase small">Passport No:</label>
                                        <div class="font-weight-bolder text-danger">{{ $appointment->specialPayment->passport_no }}</div>
                                    </div>

                                    <!-- WhatsApp -->
                                    <div class="col-md-3 mb-3 mb-md-0">
                                        <label class="font-weight-bold text-muted text-uppercase small">Mobile/WhatsApp:</label>
                                        <div class="font-weight-bolder">
                                            @php
                                                // Clean the number (remove spaces, dashes, etc.) for the URL
                                                $cleanNumber = preg_replace('/\D/', '', $appointment->specialPayment->mobile_no);
                                            @endphp
                                            
                                            <a href="https://wa.me/{{ $cleanNumber }}" 
                                               target="_blank" 
                                               class="text-dark text-hover-primary d-flex align-items-center" 
                                               title="Chat on WhatsApp">
                                                <i class="fab fa-whatsapp text-success mr-2 font-size-h4"></i>
                                                {{ $appointment->specialPayment->mobile_no }}
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Action Button -->
                                    <div class="col-md-3 text-md-left">
                                        @if($appointment->specialPayment->proof_image)
                                            <button type="button" class="btn btn-info font-weight-bold px-6" data-toggle="modal" data-target="#receiptModal">
                                                <i class="flaticon-eye"></i> View Receipt
                                            </button>
                                        @else
                                            <span class="text-muted italic">No image uploaded</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Modal for Receipt View -->
                                @if($appointment->specialPayment && $appointment->specialPayment->proof_image)
                                <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="receiptModalLabel">Special Payment Proof</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center bg-dark-o-10">
                                                <img src="{{ asset('uploads/special-medical/' . $appointment->specialPayment->proof_image) }}" 
                                                     style="width: 200px; height: auto; border-radius: 5px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ asset('uploads/special-medical/' . $appointment->specialPayment->proof_image) }}" target="_blank" class="btn btn-primary font-weight-bold">Open in New Tab</a>
                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif   
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Update Appointment</button>
                            <a href="{{ route('admin.special.appointments') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
	        </div>
        </div>
	</div>
</div>

@php
    // Calculate the value in PHP first to avoid Blade syntax errors
    $selectedCenter = old('medical_center', $appointment->medical_center ?? '');
@endphp

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const centers = {
            Gujranwala: [
                "Al Falaq Diagnostic Centre",
                "Alaq Medical & Diagnostic Centre",
                "Arsh Diagnostic Centre",
                "CARE PRO DIAGNOSTIC CENTRE",
                "Citi Care Diagnostic Centre",
                "EZCare Medical Center",
                "Health Care Diagnostic Center",
                "Misbah Diagnostic Center",
                "Pacific Diagnostic Centre",
                "Royal Diagnostic Centre"
            ],
            Lahore: [
                "Advanced Medical Diagnostic Center",
                "AL Safa Medical Center",
                "Asslaam Diagnostic Centre",
                "Atlantic Medical Center",
                "Bestway Medical Clinic",
                "Canal View Diagnostic Center",
                "CDC CARE DIAGNOSTIC CENTRE",
                "Everest Diagnostic Center",
                "Fatima Diagnostic Center",
                "Hum Medical & Diagnostic Center",
                "IMC Diagnostic Center",
                "Infinity Diagnostic Center",
                "Iqra Medical Complex",
                "Medcare Diagnostics",
                "National Diagnostic Centre",
                "North Star Medical Diagnostics",
                "Opal Diagnostic Centre",
                "Paramount Medical Clinic",
                "Quest Medical Centre",
                "Ridan diagnostic centre",
                "Taj Medical Travellers Clinic",
                "Wafi Medical Clinic"
            ]
        };

        const cityDropdown = document.getElementById('city');
        const medicalDropdown = document.getElementById('medical_center');
        
        // Pass the pre-calculated PHP variable safely to JS
        const selectedMedicalCenter = @json($selectedCenter);

        function populateMedicalCenters(selectedCity) {
            medicalDropdown.innerHTML = '<option value="">Select Medical Center</option>'; 
            
            if (centers[selectedCity]) {
                centers[selectedCity].forEach(center => {
                    const option = document.createElement('option');
                    option.value = center;
                    option.text = center;

                    // Comparison now works even with symbols like '&'
                    if(center === selectedMedicalCenter) {
                        option.selected = true;
                    }

                    medicalDropdown.appendChild(option);
                });
            }
        }

        // Initial population
        populateMedicalCenters(cityDropdown.value);

        // Update when city changes
        cityDropdown.addEventListener('change', function() {
            populateMedicalCenters(this.value);
        });
    });
</script>

@endsection