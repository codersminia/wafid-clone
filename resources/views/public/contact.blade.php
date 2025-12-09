@extends('layouts.public')

@section('title', 'Wafid - Contact Us')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>Contact Us</h1>
            <p class="lead">Get in touch with our support team</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-4 mb-4">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5>Phone</h5>
                        <p>+966 XX XXX XXXX</p>
                        <p class="text-muted small">Available 24/7</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5>Email</h5>
                        <p>info@wafid.com</p>
                        <p class="text-muted small">Response within 24 hours</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5>Address</h5>
                        <p>Multiple Centers Across GCC</p>
                        <p class="text-muted small">Saudi Arabia, UAE, Kuwait, Qatar, Bahrain, Oman</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Send us a Message</h3>
                            <form>
                                <div class="form-group">
                                    <label for="contactName">Full Name</label>
                                    <input type="text" class="form-control" id="contactName" required>
                                </div>
                                <div class="form-group">
                                    <label for="contactEmail">Email Address</label>
                                    <input type="email" class="form-control" id="contactEmail" required>
                                </div>
                                <div class="form-group">
                                    <label for="contactPhone">Phone Number</label>
                                    <input type="tel" class="form-control" id="contactPhone" required>
                                </div>
                                <div class="form-group">
                                    <label for="contactSubject">Subject</label>
                                    <input type="text" class="form-control" id="contactSubject" required>
                                </div>
                                <div class="form-group">
                                    <label for="contactMessage">Message</label>
                                    <textarea class="form-control" id="contactMessage" rows="6" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-dark btn-lg">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Business Hours</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <strong>Saturday - Thursday</strong>
                                    <p class="text-muted mb-0">8:00 AM - 6:00 PM</p>
                                </li>
                                <li>
                                    <strong>Friday</strong>
                                    <p class="text-muted mb-0">10:00 AM - 4:00 PM</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Follow Us</h5>
                            <div class="social-links">
                                <a href="#" class="btn btn-outline-dark btn-sm mr-2"><i class="fab fa-facebook"></i></a>
                                <a href="#" class="btn btn-outline-dark btn-sm mr-2"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn btn-outline-dark btn-sm"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
