@extends('layouts.public')

{{-- Dynamic SEO Tags --}}
@section('title', 'Contact Support - Gulf Medical Consultant')
@section('meta_description', 'Need help with GAMCA Wafid appointments, NAVTTC tests, or Tasheer bookings? Contact our support team in Pakistan via WhatsApp or Email.')
@section('meta_keywords', 'contact gamca consultant, wafid support number, navttc helpline pakistan, gamca appointment complaint, gulf visa medical help')

@section('content')

    <style>
        /* Location Tabs */
        .custom-location-tabs .nav-link {
            background-color: #fff;
            color: #333;
            transition: all 0.3s;
            border-left: 5px solid transparent;
        }

        .custom-location-tabs .nav-link.active {
            background-color: #f8f9fa;
            border-left: 5px solid #d9534f; /* Your red theme color */
            transform: translateX(5px);
        }

        .custom-location-tabs .nav-link:hover {
            background-color: #f8f9fa;
        }
    </style>

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1 class="font-weight-bold">Contact Our Experts</h1>
            <p class="lead">Having trouble booking? We are here to help you 24/7.</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5 bg-light-grey">
        <div class="container">
            
            <!-- Contact Cards -->
            <div class="row mb-5">
                <!-- WhatsApp (Primary Channel) -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center py-4">
                        <div class="card-body">
                            <div class="icon-circle bg-light-green text-success mx-auto mb-3" style="width: 60px; height: 60px; line-height: 60px; border-radius: 50%; background: #e6fffa;">
                                <i class="fab fa-whatsapp fa-2x"></i>
                            </div>
                            <h5 class="font-weight-bold">WhatsApp Support</h5>
                            <p class="text-muted small">Fastest response for booking issues.</p>
                            <a href="https://wa.me/92xxxxxxxxxx" class="btn btn-success btn-sm px-4">Chat Now</a>
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
                            <a href="mailto:support@gamcawafidonline.com" class="text-dark font-weight-bold">support@gamcawafidonline.com</a>
                        </div>
                    </div>
                </div>

                <!-- Location / Hours -->
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
                            <h3 class="card-title font-weight-bold mb-4">Send a Message</h3>
                            
                            {{-- Add Form Action --}}
                            <form action="#" method="POST"> 
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="contactName">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="contactName" placeholder="As per passport" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="contactPhone">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" name="phone" id="contactPhone" placeholder="0300-1234567" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contactEmail">Email Address</label>
                                    <input type="email" class="form-control" name="email" id="contactEmail" required>
                                </div>

                                <div class="form-group">
                                    <label for="contactSubject">Select Service Issue <span class="text-danger">*</span></label>
                                    <select class="form-control" name="subject" id="contactSubject" required>
                                        <option value="" selected disabled>Choose a topic...</option>
                                        <option value="Wafid Appointment">Wafid (GAMCA) Appointment Issue</option>
                                        <option value="NAVTTC Booking">NAVTTC / Takamol Registration</option>
                                        <option value="Tasheer/Visa">Tasheer Visa Center Appointment</option>
                                        <option value="Payment">Payment Verification (JazzCash/Easypaisa)</option>
                                        <option value="Report Status">Check Medical Report Status</option>
                                        <option value="Other">Other Inquiry</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="contactMessage">Message Details <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="message" id="contactMessage" rows="5" placeholder="Please describe your issue or paste your passport number here..." required></textarea>
                                </div>

                                <button type="submit" class="btn btn-dark btn-lg px-5 mt-2">Submit Query</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Information -->
                <div class="col-lg-4 mt-4 mt-lg-0">
                    
                    <!-- Quick Help Box -->
                    <div class="card bg-white border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Common Questions</h5>
                            <div class="accordion" id="faqAccordion">
                                <ul class="list-unstyled mt-3">
                                    <li class="mb-3">
                                        <a href="{{ route('faq') }}" class="text-dark d-flex justify-content-between align-items-center">
                                            How to pay via JazzCash? <i class="fas fa-chevron-right small"></i>
                                        </a>
                                    </li>
                                    <li class="mb-3">
                                        <a href="{{ route('faq') }}" class="text-dark d-flex justify-content-between align-items-center">
                                            Can I change my Medical Center? <i class="fas fa-chevron-right small"></i>
                                        </a>
                                    </li>
                                    <li class="mb-3">
                                        <a href="{{ route('faq') }}" class="text-dark d-flex justify-content-between align-items-center">
                                            How long does NAVTTC take? <i class="fas fa-chevron-right small"></i>
                                        </a>
                                    </li>
                                </ul>
                                <a href="{{ route('faq') }}" class="btn btn-outline-dark btn-block btn-sm">View All FAQs</a>
                            </div>
                        </div>
                    </div>

                    <!-- Trust Box -->
                    <div class="card bg-primary-dark text-white border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="card-title"><i class="fas fa-shield-alt mr-2"></i> Secure Service</h5>
                            <p class="small mb-0">
                                We value your privacy. Your passport data is only used for booking purposes on official Wafid/Tasheer portals and is automatically deleted from our local records after 30 days.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<!-- ... Previous Contact Form Section ... -->

    <!-- Office Locations Section -->
    <section class="py-5 bg-white" id="locations">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-accent-red font-weight-bold text-uppercase">Find Us</h6>
                <h2 class="font-weight-bold text-dark">Visit Our Offices</h2>
                <p class="text-muted">We have physical presence in 4 major cities for your convenience.</p>
                <div class="theme-divider"></div>
            </div>

            <div class="row">
                <!-- Location Tabs (Left Side) -->
                <div class="col-md-4 mb-4">
                    <div class="nav flex-column nav-pills custom-location-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        
                        <!-- Office 1 -->
                        <a class="nav-link active p-4 shadow-sm mb-3 border rounded" id="v-pills-lahore-tab" data-toggle="pill" href="#v-pills-lahore" role="tab" aria-controls="v-pills-lahore" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-light-red text-danger rounded-circle mr-3" style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 font-weight-bold text-dark">Lahore (Head Office)</h5>
                                    <small class="text-muted">Ferozepur Road</small>
                                </div>
                            </div>
                        </a>

                        <!-- Office 2 -->
                        <a class="nav-link p-4 shadow-sm mb-3 border rounded" id="v-pills-karachi-tab" data-toggle="pill" href="#v-pills-karachi" role="tab" aria-controls="v-pills-karachi" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-light-blue text-primary rounded-circle mr-3" style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 font-weight-bold text-dark">Karachi Branch</h5>
                                    <small class="text-muted">Shahrah-e-Faisal</small>
                                </div>
                            </div>
                        </a>

                        <!-- Office 3 -->
                        <a class="nav-link p-4 shadow-sm mb-3 border rounded" id="v-pills-islamabad-tab" data-toggle="pill" href="#v-pills-islamabad" role="tab" aria-controls="v-pills-islamabad" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-light-green text-success rounded-circle mr-3" style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-landmark"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 font-weight-bold text-dark">Islamabad Branch</h5>
                                    <small class="text-muted">Blue Area</small>
                                </div>
                            </div>
                        </a>

                         <!-- Office 4 -->
                         <a class="nav-link p-4 shadow-sm border rounded" id="v-pills-peshawar-tab" data-toggle="pill" href="#v-pills-peshawar" role="tab" aria-controls="v-pills-peshawar" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-light-orange text-warning rounded-circle mr-3" style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 font-weight-bold text-dark">Peshawar Branch</h5>
                                    <small class="text-muted">University Road</small>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <!-- Map Content (Right Side) -->
                <div class="col-md-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        
                        <!-- Lahore Content -->
                        <div class="tab-pane fade show active" id="v-pills-lahore" role="tabpanel">
                            <div class="card border-0 shadow-lg">
                                <div class="card-body p-0">
                                    <!-- Embedded Map (Replace src with your actual Embed Link) -->
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3399.04021200923!2d74.300!3d31.500!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzHCsDMwJzAwLjAiTiA3NMKwMTgnMDAuMCJF!5e0!3m2!1sen!2s!4v1645555555555" 
                                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    
                                    <div class="p-4 bg-light">
                                        <h4 class="font-weight-bold">Lahore Office</h4>
                                        <p><i class="fas fa-map-pin text-danger mr-2"></i> Office No 123, Plaza Name, Ferozepur Road, Lahore.</p>
                                        <p><i class="fas fa-phone text-success mr-2"></i> 042-35123456</p>
                                        <a href="https://goo.gl/maps/exampleLink1" target="_blank" class="btn btn-outline-dark btn-sm">
                                            <i class="fas fa-directions"></i> Get Directions
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Karachi Content -->
                        <div class="tab-pane fade" id="v-pills-karachi" role="tabpanel">
                            <div class="card border-0 shadow-lg">
                                <div class="card-body p-0">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.04021200923!2d67.000!3d24.860!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzHCsDMwJzAwLjAiTiA3NMKwMTgnMDAuMCJF!5e0!3m2!1sen!2s!4v1645555555555" 
                                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    <div class="p-4 bg-light">
                                        <h4 class="font-weight-bold">Karachi Office</h4>
                                        <p><i class="fas fa-map-pin text-danger mr-2"></i> Suite 405, Business Center, Shahrah-e-Faisal, Karachi.</p>
                                        <p><i class="fas fa-phone text-success mr-2"></i> 021-35123456</p>
                                        <a href="https://goo.gl/maps/exampleLink2" target="_blank" class="btn btn-outline-dark btn-sm">
                                            <i class="fas fa-directions"></i> Get Directions
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Islamabad Content -->
                        <div class="tab-pane fade" id="v-pills-islamabad" role="tabpanel">
                            <div class="card border-0 shadow-lg">
                                <div class="card-body p-0">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3319.04021200923!2d73.000!3d33.680!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzHCsDMwJzAwLjAiTiA3NMKwMTgnMDAuMCJF!5e0!3m2!1sen!2s!4v1645555555555" 
                                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    <div class="p-4 bg-light">
                                        <h4 class="font-weight-bold">Islamabad Office</h4>
                                        <p><i class="fas fa-map-pin text-danger mr-2"></i> Office 10, Blue Area, Islamabad.</p>
                                        <p><i class="fas fa-phone text-success mr-2"></i> 051-35123456</p>
                                        <a href="https://goo.gl/maps/exampleLink3" target="_blank" class="btn btn-outline-dark btn-sm">
                                            <i class="fas fa-directions"></i> Get Directions
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Peshawar Content -->
                        <div class="tab-pane fade" id="v-pills-peshawar" role="tabpanel">
                            <div class="card border-0 shadow-lg">
                                <div class="card-body p-0">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3319.04021200923!2d71.500!3d34.000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzHCsDMwJzAwLjAiTiA3NMKwMTgnMDAuMCJF!5e0!3m2!1sen!2s!4v1645555555555" 
                                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    <div class="p-4 bg-light">
                                        <h4 class="font-weight-bold">Peshawar Office</h4>
                                        <p><i class="fas fa-map-pin text-danger mr-2"></i> University Road, Opposite KFC, Peshawar.</p>
                                        <p><i class="fas fa-phone text-success mr-2"></i> 091-35123456</p>
                                        <a href="https://goo.gl/maps/exampleLink4" target="_blank" class="btn btn-outline-dark btn-sm">
                                            <i class="fas fa-directions"></i> Get Directions
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection