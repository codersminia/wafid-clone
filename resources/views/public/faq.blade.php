@extends('layouts.public')

@section('title', 'Wafid - FAQ')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>Frequently Asked Questions</h1>
            <p class="lead">Find answers to common questions</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="faqAccordion">
                        <div class="card mb-3">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne">
                                        What is Wafid?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Wafid is a comprehensive platform providing employment and residency services for individuals seeking opportunities in Gulf Cooperation Council States. We facilitate medical examinations, documentation, and accreditation processes.
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo">
                                        How do I book a medical examination?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    You can book a medical examination through our online portal. Visit the Medical Examinations page, fill out the appointment form with your preferred date and time, and submit. You'll receive a confirmation email with appointment details.
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree">
                                        What documents do I need for employment?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Required documents include: valid passport, birth certificate, educational certificates, medical examination report, employment contract, and sponsor letter. Please refer to our Guidelines page for a complete checklist.
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour">
                                        How long does the medical examination take?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    A typical medical examination takes 1-2 hours. This includes health assessment, blood tests, chest X-ray, and vaccination verification. Results are usually available within 3-5 business days.
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header" id="headingFive">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive">
                                        What is the cost of medical examination?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFive" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Medical examination costs vary depending on the type of examination and location. Please contact our support team for specific pricing information for your location.
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header" id="headingSix">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSix">
                                        How do I apply for medical center accreditation?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseSix" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Visit the Medical Centers page and complete the accreditation application form. Provide details about your facility, staff qualifications, and equipment. Our team will review your application and contact you within 5-10 business days.
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header" id="headingSeven">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSeven">
                                        How long is residency valid?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseSeven" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Residency permits are typically valid for 1-3 years depending on the country and employment contract. Renewal should be initiated 30 days before expiration.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingEight">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEight">
                                        How can I contact support?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseEight" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    You can reach our support team via phone at +966 XX XXX XXXX, email at info@wafid.com, or through the contact form on our website. We're available 24/7 to assist you.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
