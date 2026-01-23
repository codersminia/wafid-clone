@extends('layouts.public')

@section('title', 'About Us - Gulf Medical Consultant')
@section('meta_description', 'Learn about Gulf Medical Consultant. We are Pakistan\'s leading agency for GAMCA/Wafid medical appointments, NAVTTC registration, and Visa assistance.')

@section('content')

    <!-- Page Header -->
    <section class="inner-page-hero" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('assets/public/images/hero-bg.jpg') }}') center/cover no-repeat;">
        <div class="container">
            <h1 class="font-weight-bold">About Gulf Medical Consultants</h1>
            <p class="lead">Simplifying GCC Visa Medicals & Skill Tests since 2018.</p>
        </div>
    </section>

    <!-- Who We Are -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                        alt="Our Team" class="img-fluid rounded shadow-lg">
                </div>
                <div class="col-lg-6 pl-lg-5">
                    <h6 class="text-accent-red font-weight-bold text-uppercase">Who We Are</h6>
                    <h2 class="font-weight-bold text-dark mb-4">Bridging the Gap Between You and Your Dream Job</h2>
                    <p class="text-muted mb-4">
                        <strong>Gulf Medical Consultant</strong> is a private consultancy firm based in Pakistan. We
                        specialize in assisting workers, students, and travelers in navigating the complex digital
                        requirements for Gulf Cooperation Council (GCC) countries.
                    </p>
                    <p class="text-muted mb-4">
                        We noticed that many skilled workers face difficulties in booking <strong>Wafid (GAMCA)
                            appointments</strong> or registering for <strong>NAVTTC tests</strong> due to technical
                        barriers, lack of credit cards, or confusing forms. We established this platform to solve those
                        problems.
                    </p>

                    <div class="row mt-4">
                        <div class="col-6">
                            <h2 class="font-weight-bold text-primary">4+</h2>
                            <p class="small text-muted text-uppercase">Physical Offices</p>
                        </div>
                        <div class="col-6">
                            <h2 class="font-weight-bold text-primary">50k+</h2>
                            <p class="small text-muted text-uppercase">Happy Clients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Pay Us? (The Transparency Section) -->
    <section class="py-5 bg-light-grey">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-accent-red font-weight-bold text-uppercase">Our Value</h6>
                <h2 class="font-weight-bold text-dark">Why Use Our Service?</h2>
                <p class="text-muted w-75 mx-auto">
                    You can book directly on official government websites, but here is why thousands of clients choose to
                    pay our service fee instead.
                </p>
                <div class="theme-divider"></div>
            </div>

            <div class="row">
                <!-- Reason 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 p-3">
                        <div class="card-body text-center">
                            <i class="fas fa-file-invoice-dollar fa-3x text-accent-green mb-3"></i>
                            <h5 class="font-weight-bold">Local Payment Solutions</h5>
                            <p class="text-muted small">Official sites require International Credit Cards. We accept
                                JazzCash, Easypaisa, and Local Bank Transfers.</p>
                        </div>
                    </div>
                </div>

                <!-- Reason 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 p-3">
                        <div class="card-body text-center">
                            <i class="fas fa-user-shield fa-3x text-primary-dark mb-3"></i>
                            <h5 class="font-weight-bold">Error-Free Processing</h5>
                            <p class="text-muted small">One wrong digit in your passport number on the Wafid site means
                                paying the fee again. Our experts verify your data twice.</p>
                        </div>
                    </div>
                </div>

                <!-- Reason 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 p-3">
                        <div class="card-body text-center">
                            <i class="fas fa-hospital-user fa-3x text-accent-red mb-3"></i>
                            <h5 class="font-weight-bold">Center Selection</h5>
                            <p class="text-muted small">We know the availability of medical centers. We help you book
                                "Choice" appointments if you need a specific city.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-5 bg-primary-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0 border-right border-white-50">
                    <h3 class="font-weight-bold mb-3"><i class="fas fa-bullseye mr-2"></i> Our Mission</h3>
                    <p class="lead" style="opacity: 0.9">
                        To remove the technical hurdles for Pakistani workers going abroad by providing a secure, fast, and
                        accessible booking platform.
                    </p>
                </div>
                <div class="col-md-6 pl-md-5">
                    <h3 class="font-weight-bold mb-3"><i class="fas fa-eye mr-2"></i> Our Vision</h3>
                    <p class="lead" style="opacity: 0.9">
                        To become the most trusted "One-Stop Solution" for all Gulf visa-related medical and technical
                        requirements in Pakistan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 bg-white text-center">
        <div class="container">
            <h2 class="font-weight-bold mb-4">Need Assistance?</h2>
            <p class="text-muted mb-4">Our team is sitting in 4 offices across Pakistan, ready to help you.</p>
            <a href="{{ route('contact') }}" class="btn btn-dark btn-lg px-5">Contact Us Today</a>
        </div>
    </section>

@endsection