@extends('layouts.public')

@section('title', 'Find Approved GAMCA / WAFID Medical Centers in Pakistan 2026')
@section('meta_description', 'Search approved GAMCA/WAFID medical centers in Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Gujranwala, Sialkot, Multan, Peshawar & Quetta. Find address, phone & map.')
@section('meta_keywords', 'GAMCA medical center Pakistan, WAFID approved centers, GAMCA center Lahore, GAMCA center Karachi, GCC medical center Pakistan 2026')

@push('schema')
,{
    "@type": "WebPage",
    "@id": "{{ url()->current() }}#webpage",
    "name": "Find Approved GAMCA / WAFID Medical Centers in Pakistan 2026",
    "url": "{{ url()->current() }}",
    "description": "Search approved GAMCA/WAFID medical centers in all major cities of Pakistan. Find address, phone number, and map location.",
    "isPartOf": { "@id": "{{ url('/') }}#website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
            { "@type": "ListItem", "position": 2, "name": "Medical Center Search", "item": "{{ url()->current() }}" }
        ]
    }
}
,{
    "@type": "FAQPage",
    "@id": "{{ url()->current() }}#faqpage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "How do I know which GAMCA center to visit?",
            "acceptedAnswer": { "@type": "Answer", "text": "Your assigned center is mentioned on your appointment slip. Always follow that." }
        },
        {
            "@type": "Question",
            "name": "Can I visit any GAMCA center?",
            "acceptedAnswer": { "@type": "Answer", "text": "No. Only the assigned center is allowed unless you book a choice service." }
        },
        {
            "@type": "Question",
            "name": "Are all centers listed here approved?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes. We only show WAFID-approved clinics listed by the GCC Health Council." }
        },
        {
            "@type": "Question",
            "name": "What are the working hours of GAMCA centers?",
            "acceptedAnswer": { "@type": "Answer", "text": "Most centers operate between 9:00 AM to 5:00 PM, but it is best to confirm before visiting." }
        }
    ]
}
@endpush

@section('content')

    <style>
        /* Loader Styles */
        #loaderOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        #loaderOverlay.show {
            display: flex;
        }

        /* --- TABLE STYLES --- */
        .table-responsive {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-radius: 4px;
            margin-top: 20px;
            border: 1px solid #dee2e6;
        }

        .table {
            margin-bottom: 0;
            font-size: 0.8rem;
            /* Slightly smaller font to fit content */
            width: 100%;
        }

        /* --- DESKTOP SPECIFIC (No Scroll) --- */
        @media (min-width: 992px) {
            .table-responsive {
                overflow-x: visible;
                /* Disable scroll on desktop */
            }

            .table {
                table-layout: fixed;
                /* Forces table to fit screen exactly */
            }

            .table td {
                word-wrap: break-word;
                /* Wraps text to next line */
                white-space: normal;
                overflow-wrap: break-word;
            }
        }

        /* --- MOBILE SPECIFIC (Scrollable) --- */
        @media (max-width: 991px) {
            .table-responsive {
                overflow-x: auto;
                /* Enable scroll on mobile */
            }

            .table thead th {
                white-space: nowrap;
                /* Keep headers in one line on mobile */
            }
        }

        /* Header Styling */
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            padding: 12px 8px;
            font-size: 0.8rem;
        }

        .table thead th:hover {
            background-color: #e2e6ea;
        }

        .table td {
            vertical-align: top;
            padding: 8px;
        }

        /* Column Widths (Percentages to ensure fit on Desktop) */
        .col-name {
            width: 18%;
        }

        .col-country {
            width: 8%;
            text-align: center;
        }

        .col-city {
            width: 10%;
        }

        .col-address {
            width: 16%;
        }

        /* Wider for address */
        .col-phone {
            width: 12%;
        }

        .col-email {
            width: 14%;
        }

        .col-web {
            width: 8%;
        }

        .col-rating {
            width: 14%;
        }

        /* Sort Icons */
        .sort-icon {
            font-size: 0.7rem;
            margin-left: 3px;
            color: #ccc;
            float: right;
            margin-top: 3px;
        }

        .sort-active {
            color: #333;
        }

        /* Links & Extras */
        .map-link {
            color: #212529;
            text-decoration: underline;
            font-weight: 600;
        }

        .map-link:hover {
            color: #0056b3;
        }

        .country-flag {
            width: 18px;
            display: block;
            margin: 0 auto 3px auto;
        }

        .star-gold {
            color: #ffc107;
        }

        .star-grey {
            color: #e4e5e9;
        }

        /* Rating stars wrapper to prevent breaking */
        .star-rating {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .rating-number {
            font-size: 0.7rem;
            color: #777;
            margin-left: 3px;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 15px;
            background: #fff;
            border-top: 1px solid #dee2e6;
        }

        .page-link {
            cursor: pointer;
            color: #333;
        }

        .page-item.active .page-link {
            background-color: #333;
            border-color: #333;
            color: #fff;
        }

        /* New SEO Content Styles */
        .seo-content h3 {
            font-weight: 700;
            color: #343a40;
            margin-top: 1.5rem;
        }

        .seo-content p {
            color: #6c757d;
            line-height: 1.7;
        }

        .city-badge {
            background: #e9ecef;
            color: #495057;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-right: 5px;
            margin-bottom: 5px;
            display: inline-block;
        }
    </style>

    <!-- Page Header -->
    <section class="page-header text-white py-5" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">Medical Center Search</li>
                </ol>
            </nav>
            <span style="display:inline-block;background:var(--accent-gold);color:#0f1923;font-size:.72rem;font-weight:700;padding:4px 14px;border-radius:20px;letter-spacing:.5px;text-transform:uppercase;margin-bottom:12px;">
                <i class="fas fa-search mr-1"></i> WAFID Approved Centers
            </span>
            <h1 class="font-weight-bold mb-2">Find Approved GAMCA / WAFID Medical Centers in Pakistan</h1>
            <p class="lead mb-0" style="color:rgba(255,255,255,.8);">Search authorized laboratories and clinics in Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Gujranwala, Sialkot, Multan, Peshawar & Quetta.</p>
        </div>
    </section>

    <!-- Intro Strip -->
    <div style="background:var(--accent-gold);padding:14px 0;">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap:8px;">
                <p class="mb-0 font-weight-bold" style="color:#0f1923;font-size:.9rem;">
                    <i class="fas fa-exclamation-triangle mr-2"></i>You must visit the <strong>exact center assigned</strong> on your GAMCA/WAFID appointment slip — not any random hospital.
                </p>
                <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-sm font-weight-bold px-4 flex-shrink-0">
                    <i class="fas fa-calendar-check mr-1"></i>Book Appointment
                </a>
            </div>
        </div>
    </div>

    <!-- Top SEO Section -->
    <section class="py-5" style="background:#fff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <span style="display:block;color:var(--accent-gold);font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;">GAMCA / WAFID Center Guide</span>
                    <h2 class="font-weight-bold mb-3" style="font-size:1.7rem;color:#1a252f;">Find Approved GAMCA Medical Centers in Pakistan</h2>
                    <p class="text-muted mb-3">Looking for an approved GAMCA medical center in Pakistan? This page helps you quickly find authorized WAFID (GAMCA) laboratories and clinics in major cities. If you are applying for a work visa for <strong>Saudi Arabia, UAE, Qatar, Oman, Kuwait, or Bahrain</strong>, you must complete your medical test from an officially approved center.</p>
                    <p class="text-muted mb-4">Use the search tool below to find the nearest clinic with accurate details including address, phone number, and map location.</p>
                    <div class="row">
                        @php $centerFeatures = [
                            'All WAFID-approved centers listed',
                            'Address, phone & map for each center',
                            'Search by city or clinic name',
                            'Updated 2026 center database',
                            'Covers all major cities in Pakistan',
                        ]; @endphp
                        @foreach($centerFeatures as $f)
                        <div class="col-md-6 mb-2">
                            <div class="d-flex align-items-center" style="gap:10px;">
                                <i class="fas fa-check-circle" style="color:#28a745;flex-shrink:0;"></i>
                                <span class="small text-muted">{{ $f }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="background:#f7f8fc;border:1px solid #e8ecf0;border-radius:14px;overflow:hidden;">
                        <div style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);color:var(--accent-gold);font-weight:700;font-size:.95rem;padding:16px 20px;">
                            <i class="fas fa-hospital mr-2"></i>What is a GAMCA / WAFID Center?
                        </div>
                        <div class="p-4">
                            <p class="small text-muted mb-3">A GAMCA (now WAFID) approved medical center is a licensed clinic authorized by the GCC Health Council to conduct medical examinations for GCC visa applicants.</p>
                            <p class="small font-weight-bold mb-2" style="color:#1a252f;">Tests performed include:</p>
                            @php $tests = [
                                ['icon'=>'fas fa-tint',        'text'=>'Blood tests (HIV, Hepatitis B & C)'],
                                ['icon'=>'fas fa-x-ray',       'text'=>'Chest X-ray (tuberculosis)'],
                                ['icon'=>'fas fa-stethoscope', 'text'=>'Physical examination'],
                                ['icon'=>'fas fa-heartbeat',   'text'=>'General health screening'],
                            ]; @endphp
                            @foreach($tests as $t)
                            <div class="d-flex align-items-center mb-2" style="gap:10px;">
                                <i class="{{ $t['icon'] }}" style="color:var(--accent-gold);font-size:.8rem;flex-shrink:0;"></i>
                                <span class="small text-muted">{{ $t['text'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <!-- Search Form -->
                    <div class="appointment-form-wrapper" style="max-width: 1140px; margin: 0 auto;">
                        <form id="appointmentForm" class="appointment-form">
                            @csrf
                            <div class="form-section">
                                <h5 class="section-title"><i class="fas fa-hospital-alt"></i> Find a Center</h5>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="country">Country</label>
                                        <select class="form-control" id="country" name="country">
                                            <option value="Pakistan">Pakistan</option>
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
                                        <label for="center_name">Search by Name</label>
                                        <input type="text" class="form-control" name="center_name" id="center_name"
                                            placeholder="E.g. Al-Hilal">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <button type="submit" class="btn btn-dark shadow"><i class="fas fa-search"></i>
                                        Search</button>
                                    <button type="reset" id="resetBtn" class="btn btn-outline-dark ml-2">Reset</button>
                                </div>

                                <!-- CTA for Booking -->
                                <a href="{{ route('medicalExamination') }}" class="btn btn-success text-white shadow">
                                    <i class="fas fa-calendar-check"></i> Book Appointment
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Dynamic Results Area -->
                    <div id="resultsArea" style="display:none;">

                        <h5 class="mt-4 mb-3 font-weight-bold text-dark">Search Results:</h5>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="resultsTable">
                                <thead>
                                    <tr>
                                        <th class="col-name" data-col="medical_center">
                                            Center Name <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-country" data-col="country">
                                            Country <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-city" data-col="city">
                                            City <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-address" data-col="address_line_1">
                                            Address <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-phone" data-col="phone">
                                            Phone <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-email" data-col="email">
                                            E-mail <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-web" data-col="website">
                                            Web <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-rating" data-col="rating">
                                            Rating <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="resultsTableBody">
                                    <!-- Rows injected via JS -->
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="pagination-wrapper d-flex justify-content-between align-items-center flex-wrap">
                                <div class="text-muted small mb-2 mb-md-0" id="entriesInfo"></div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0" id="paginationLinks"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- No Results -->
                    <div id="noResults" class="alert alert-warning text-center mt-4" style="display:none;">
                        <i class="fas fa-exclamation-circle"></i> No medical centers found matching your criteria.
                    </div>

                </div>
            </div>
        </div>

        <!-- Loader -->
        <div id="loaderOverlay">
            <div class="loader-content text-center">
                <div class="spinner-border text-light" role="status" style="width: 4rem; height: 4rem;"></div>
                <div class="text-light mt-3">Searching Database...</div>
            </div>
        </div>
    </section>

    <!-- Bottom SEO Content -->
    <section class="py-5" style="background:#f7f8fc;border-top:1px solid #e8ecf0;">
        <div class="container">
            <div class="row">

                <!-- Left: How it works + Cities + Mistakes -->
                <div class="col-lg-8 mb-4 mb-lg-0">

                    <!-- How to find -->
                    <div style="background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:28px;margin-bottom:20px;">
                        <span style="display:block;color:var(--accent-gold);font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;">Step-by-Step</span>
                        <h3 class="font-weight-bold mb-3" style="font-size:1.2rem;color:#1a252f;">How to Find the Nearest GAMCA Center</h3>
                        <div class="row">
                            @php $steps = [
                                ['num'=>'1','text'=>'Select your country (Pakistan)'],
                                ['num'=>'2','text'=>'Choose your city from the dropdown'],
                                ['num'=>'3','text'=>'Enter clinic name (optional)'],
                                ['num'=>'4','text'=>'Click Search to view results'],
                                ['num'=>'5','text'=>'View map, contact number & details'],
                                ['num'=>'6','text'=>'Call to confirm timing before visiting'],
                            ]; @endphp
                            @foreach($steps as $step)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center" style="gap:12px;background:#f7f8fc;border:1px solid #e8ecf0;border-radius:10px;padding:10px 14px;">
                                    <span style="width:28px;height:28px;background:var(--accent-gold);color:#0f1923;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;flex-shrink:0;">{{ $step['num'] }}</span>
                                    <span class="small text-muted">{{ $step['text'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Popular Cities -->
                    <div style="background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:28px;margin-bottom:20px;">
                        <span style="display:block;color:var(--accent-gold);font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;">Popular Locations</span>
                        <h3 class="font-weight-bold mb-3" style="font-size:1.2rem;color:#1a252f;">Popular Cities for GAMCA Medical in Pakistan</h3>
                        <div class="d-flex flex-wrap mb-3" style="gap:8px;">
                            @php $cities = [
                                ['name'=>'Karachi',    'slug'=>'karachi',    'note'=>'Largest number of approved clinics'],
                                ['name'=>'Lahore',     'slug'=>'lahore',     'note'=>'High demand for Saudi visa medical'],
                                ['name'=>'Islamabad',  'slug'=>'islamabad',  'note'=>'Twin city access'],
                                ['name'=>'Rawalpindi', 'slug'=>'rawalpindi', 'note'=>'Twin city access'],
                                ['name'=>'Sialkot',    'slug'=>'sialkot',    'note'=>'Northern Punjab coverage'],
                                ['name'=>'Gujranwala', 'slug'=>'gujranwala', 'note'=>'Northern Punjab coverage'],      
                                ['name'=>'Multan',     'slug'=>'multan',     'note'=>'South Punjab'],
                                ['name'=>'Peshawar',   'slug'=>'peshawar',   'note'=>'KPK region'],
                            ]; @endphp
                            @foreach($cities as $city)
                            <a href="{{ route('public.medical.city', $city['slug']) }}" style="display:inline-flex;align-items:center;gap:5px;background:#f0f4f8;border:1px solid #dde3ea;border-radius:20px;padding:6px 14px;font-size:.82rem;font-weight:600;color:#1a252f;text-decoration:none;transition:all .2s ease;">
                                📍 {{ $city['name'] }}
                            </a>
                            @endforeach
                        </div>
                        <p class="small text-muted mb-0"><i class="fas fa-info-circle mr-1" style="color:var(--accent-gold);"></i>Click any city to view a dedicated page with all approved GAMCA centers and booking guidance.</p>
                    </div>

                    <!-- How assignment works -->
                    <div style="background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:28px;margin-bottom:20px;">
                        <span style="display:block;color:var(--accent-gold);font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;">Center Assignment</span>
                        <h3 class="font-weight-bold mb-3" style="font-size:1.2rem;color:#1a252f;">How GAMCA Center Assignment Works</h3>
                        <p class="text-muted small mb-3">When you book a standard GAMCA appointment, the system automatically assigns a medical center based on your selected city and availability.</p>
                        <div style="background:#fff8e1;border-left:4px solid var(--accent-gold);border-radius:8px;padding:14px 16px;">
                            <p class="small font-weight-bold mb-1" style="color:#1a252f;"><i class="fas fa-crown mr-2" style="color:var(--accent-gold);"></i>Want more control?</p>
                            <p class="small text-muted mb-2">Use the <strong>Choice Appointment Service</strong> to select your preferred medical center manually — ideal if you want a nearby clinic, prefer a specific hospital, or need better timing.</p>
                            <a href="{{ route('special.appointment') }}" class="btn btn-dark btn-sm font-weight-bold">
                                <i class="fas fa-hospital mr-1"></i>Use Choice Center Service
                            </a>
                        </div>
                    </div>

                    <!-- Common Mistakes -->
                    <div style="background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:28px;margin-bottom:20px;">
                        <span style="display:block;color:var(--accent-gold);font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;">Avoid These Errors</span>
                        <h3 class="font-weight-bold mb-3" style="font-size:1.2rem;color:#1a252f;">Common Mistakes to Avoid</h3>
                        @php $mistakes = [
                            'Visiting the wrong medical center',
                            'Mismatch between passport and slip details',
                            'Arriving late or missing appointment time',
                            'Not bringing required documents',
                        ]; @endphp
                        @foreach($mistakes as $m)
                        <div class="d-flex align-items-center mb-3" style="gap:12px;padding:10px 0;border-bottom:1px solid #f0f4f8;">
                            <i class="fas fa-times-circle" style="color:#e74c3c;font-size:1rem;flex-shrink:0;"></i>
                            <span class="small text-muted">{{ $m }}</span>
                        </div>
                        @endforeach
                    </div>

                    <!-- FAQs -->
                    <div style="background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:28px;">
                        <span style="display:block;color:var(--accent-gold);font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;">Quick Answers</span>
                        <h3 class="font-weight-bold mb-4" style="font-size:1.2rem;color:#1a252f;">FAQs – Medical Center Search</h3>
                        @php $mcFaqs = [
                            ['q'=>'How do I know which GAMCA center to visit?',    'a'=>'Your assigned center is mentioned on your appointment slip. Always follow that.'],
                            ['q'=>'Can I visit any GAMCA center?',                 'a'=>'No. Only the assigned center is allowed unless you book a choice service.'],
                            ['q'=>'Are all centers listed here approved?',         'a'=>'Yes. We only show WAFID-approved clinics listed by the GCC Health Council.'],
                            ['q'=>'What are the working hours?',                   'a'=>'Most centers operate between 9:00 AM to 5:00 PM, but it\'s best to confirm before visiting.'],
                        ]; @endphp
                        <div id="mcFaqAccordion">
                            @foreach($mcFaqs as $i => $faq)
                            <div style="background:#f7f8fc;border:1px solid #e8ecf0;border-radius:12px;margin-bottom:10px;overflow:hidden;">
                                <button class="{{ $i > 0 ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#mcfaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}"
                                    style="width:100%;text-align:left;background:transparent;border:none;padding:16px 20px;font-weight:600;font-size:.9rem;color:#1a252f;display:flex;justify-content:space-between;align-items:center;cursor:pointer;">
                                    {{ $faq['q'] }}
                                    <i class="fas fa-chevron-down" style="font-size:.75rem;color:var(--accent-gold);flex-shrink:0;margin-left:10px;"></i>
                                </button>
                                <div id="mcfaq{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}" data-parent="#mcFaqAccordion">
                                    <div style="padding:0 20px 16px;color:#6c757d;font-size:.88rem;line-height:1.8;">{{ $faq['a'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('faq') }}" class="btn btn-outline-dark px-4 font-weight-bold">View All FAQs →</a>
                        </div>
                    </div>

                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-4">

                    <!-- Documents to bring -->
                    <div style="background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:24px;margin-bottom:20px;">
                        <h5 class="font-weight-bold mb-3" style="font-size:.95rem;border-bottom:2px solid var(--accent-gold);padding-bottom:10px;">Before Visiting a Center</h5>
                        @php $docs = [
                            ['icon'=>'fas fa-passport',        'text'=>'Original Passport'],
                            ['icon'=>'fas fa-id-card',         'text'=>'Original CNIC'],
                            ['icon'=>'fas fa-file-alt',        'text'=>'Printed appointment slip (QR code)'],
                            ['icon'=>'fas fa-images',          'text'=>'4 passport-size photos'],
                            ['icon'=>'fas fa-money-bill-wave', 'text'=>'Cash for center fee (~PKR 25,000)'],
                        ]; @endphp
                        @foreach($docs as $doc)
                        <div class="d-flex align-items-center mb-3" style="gap:12px;">
                            <i class="{{ $doc['icon'] }}" style="color:var(--accent-gold);flex-shrink:0;"></i>
                            <span class="small text-muted">{{ $doc['text'] }}</span>
                        </div>
                        @endforeach
                        <div style="background:#f7f8fc;border-radius:8px;padding:12px;margin-top:4px;">
                            <p class="small mb-0 text-muted"><i class="fas fa-clock mr-1" style="color:var(--accent-gold);"></i>Arrive early — most centers open at <strong>9:00 AM</strong>. Call ahead to confirm timing.</p>
                        </div>
                    </div>

                    <!-- Related Services -->
                    <div style="background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:24px;margin-bottom:20px;">
                        <h5 class="font-weight-bold mb-3" style="font-size:.95rem;border-bottom:2px solid var(--accent-gold);padding-bottom:10px;">Related Services</h5>
                        <div class="d-flex flex-column" style="gap:8px;">
                            <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-block font-weight-bold btn-sm text-left">
                                <i class="fas fa-calendar-check mr-2"></i>GAMCA Appointment Booking
                            </a>
                            <a href="{{ route('special.appointment') }}" class="btn btn-outline-dark btn-block font-weight-bold btn-sm text-left">
                                <i class="fas fa-hospital mr-2"></i>WAFID Choice Center
                            </a>
                            <a href="{{ route('ViewMedicalReport') }}" class="btn btn-outline-dark btn-block font-weight-bold btn-sm text-left">
                                <i class="fas fa-search mr-2"></i>Check Medical Status
                            </a>
                        </div>
                    </div>

                    <!-- GCC Country Guides -->
                    <div style="background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:24px;margin-bottom:20px;">
                        <h5 class="font-weight-bold mb-3" style="font-size:.95rem;border-bottom:2px solid var(--accent-gold);padding-bottom:10px;">GCC Country Guides</h5>
                        <div class="d-flex flex-wrap" style="gap:8px;">
                            @foreach([['flag'=>'🇸🇦','name'=>'Saudi Arabia','slug'=>'saudi-arabia'],['flag'=>'🇦🇪','name'=>'UAE','slug'=>'uae'],['flag'=>'🇶🇦','name'=>'Qatar','slug'=>'qatar'],['flag'=>'🇴🇲','name'=>'Oman','slug'=>'oman'],['flag'=>'🇰🇼','name'=>'Kuwait','slug'=>'kuwait'],['flag'=>'🇧🇭','name'=>'Bahrain','slug'=>'bahrain']] as $c)
                            <a href="{{ route('public.gcc.country', $c['slug']) }}" style="display:inline-flex;align-items:center;gap:5px;background:#f0f4f8;border:1px solid #dde3ea;border-radius:20px;padding:5px 12px;font-size:.78rem;font-weight:600;color:#1a252f;text-decoration:none;">
                                {{ $c['flag'] }} {{ $c['name'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- WhatsApp CTA -->
                    <div style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);border-radius:14px;padding:24px;">
                        <div class="d-flex align-items-center mb-3" style="gap:12px;">
                            <div style="width:48px;height:48px;background:rgba(255,198,84,.15);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <i class="fab fa-whatsapp" style="color:var(--accent-gold);font-size:1.5rem;"></i>
                            </div>
                            <h6 class="text-white font-weight-bold mb-0">Need Booking Help?</h6>
                        </div>
                        <p class="small mb-3" style="color:rgba(255,255,255,.8);">Get step-by-step guidance for your GAMCA/WAFID medical booking via WhatsApp.</p>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+finding+a+GAMCA+medical+center." target="_blank" class="btn btn-warning btn-block font-weight-bold" style="color:#0f1923;">
                            <i class="fab fa-whatsapp mr-2"></i>Chat on WhatsApp
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section style="background:linear-gradient(135deg,var(--accent-gold) 0%,#f4b942 100%);padding:50px 0;">
        <div class="container text-center">
            <h2 class="font-weight-bold mb-3" style="color:#0f1923;">Find Your Nearest GAMCA Center & Book Now</h2>
            <p class="mb-4" style="color:#1a252f;max-width:600px;margin:0 auto 24px;">Use the search tool above to get accurate center details and avoid delays in your visa process.</p>
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center" style="gap:12px;">
                <a href="{{ route('medicalExamination') }}" class="btn btn-dark btn-lg px-5 py-3 font-weight-bold">
                    <i class="fas fa-calendar-check mr-2"></i>Book Appointment Now
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+GAMCA+medical+center." target="_blank" class="btn btn-outline-dark btn-lg px-5 py-3 font-weight-bold">
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp Support
                </a>
            </div>
        </div>
    </section>

    @push('scripts')

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('appointmentForm');
                const loader = document.getElementById('loaderOverlay');
                const resultsArea = document.getElementById('resultsArea');
                const tableBody = document.getElementById('resultsTableBody');
                const noResults = document.getElementById('noResults');
                const resetBtn = document.getElementById('resetBtn');
                const paginationLinks = document.getElementById('paginationLinks');
                const entriesInfo = document.getElementById('entriesInfo');
                const headers = document.querySelectorAll('#resultsTable th[data-col]');

                let state = {
                    page: 1,
                    sortBy: 'medical_center',
                    sortOrder: 'asc'
                };

                const showLoader = () => loader.classList.add('show');
                const hideLoader = () => loader.classList.remove('show');

                async function fetchResults() {
                    showLoader();

                    const formData = new FormData(form);
                    formData.append('page', state.page);
                    formData.append('sort_by', state.sortBy);
                    formData.append('sort_order', state.sortOrder);

                    try {
                        const response = await fetch("{{ route('medical.search') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                                "Accept": "application/json"
                            },
                            body: formData
                        });

                        const json = await response.json();

                        if (json.status === 'success') {
                            renderTable(json.data);
                        } else {
                            alert('Error retrieving data.');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Network error.');
                    } finally {
                        hideLoader();
                    }
                }

                function renderTable(paginator) {
                    tableBody.innerHTML = '';
                    paginationLinks.innerHTML = '';

                    if (paginator.data.length > 0) {
                        resultsArea.style.display = 'block';
                        noResults.style.display = 'none';

                        entriesInfo.innerText = `Showing ${paginator.from} to ${paginator.to} of ${paginator.total} entries`;

                        paginator.data.forEach(center => {
                            const row = document.createElement('tr');
                            const flagUrl = 'https://flagcdn.com/w40/pk.png';

                            // Google Maps Link
                            const mapQuery = encodeURIComponent(center.medical_center + ' ' + center.city);
                            const mapLink = `https://www.google.com/maps/search/?api=1&query=${mapQuery}`;

                            let fullAddress = center.address_line_1 || '';
                            if (center.address_line_2) fullAddress += ', ' + center.address_line_2;

                            row.innerHTML = `
                                    <td>
                                        <a href="${mapLink}" target="_blank" class="map-link" title="View on Map">
                                            ${center.medical_center}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <img src="${flagUrl}" class="country-flag" alt="PK">
                                    </td>
                                    <td>${center.city}</td>
                                    <td>${fullAddress || '-'}</td>
                                    <td>${center.phone || '-'}</td>
                                    <td style="word-break: break-all;">${center.email || '-'}</td>
                                    <td>
                                        ${center.website ? `<a href="${center.website}" target="_blank" style="color:#007bff;"><i class="fas fa-link"></i></a>` : '-'}
                                    </td>
                                    <td>${getStarRatingHtml(center.rating)}</td>
                                `;
                            tableBody.appendChild(row);
                        });

                        renderPagination(paginator);
                        resultsArea.scrollIntoView({ behavior: 'smooth', block: 'start' });

                    } else {
                        resultsArea.style.display = 'none';
                        noResults.style.display = 'block';
                    }
                }

                function renderPagination(data) {
                    let html = '';
                    html += `<li class="page-item ${data.prev_page_url ? '' : 'disabled'}">
                                    <a class="page-link" onclick="changePage(${data.current_page - 1})">Prev</a>
                                 </li>`;

                    for (let i = 1; i <= data.last_page; i++) {
                        if (i == 1 || i == data.last_page || (i >= data.current_page - 1 && i <= data.current_page + 1)) {
                            const active = i === data.current_page ? 'active' : '';
                            html += `<li class="page-item ${active}">
                                            <a class="page-link" onclick="changePage(${i})">${i}</a>
                                          </li>`;
                        } else if (i == data.current_page - 2 || i == data.current_page + 2) {
                            html += `<li class="page-item disabled"><a class="page-link">...</a></li>`;
                        }
                    }

                    html += `<li class="page-item ${data.next_page_url ? '' : 'disabled'}">
                                    <a class="page-link" onclick="changePage(${data.current_page + 1})">Next</a>
                                 </li>`;

                    paginationLinks.innerHTML = html;
                }

                function getStarRatingHtml(rating) {
                    let html = '<div class="star-rating">';
                    const score = parseFloat(rating) || 0;
                    for (let i = 1; i <= 5; i++) {
                        html += (i <= score)
                            ? '<i class="fas fa-star star-gold" style="font-size:0.7rem;"></i>'
                            : '<i class="fas fa-star star-grey" style="font-size:0.7rem;"></i>';
                    }
                    html += `<span class="rating-number">(${score})</span></div>`;
                    return html;
                }

                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    state.page = 1;
                    fetchResults();
                });

                resetBtn.addEventListener('click', function () {
                    resultsArea.style.display = 'none';
                    noResults.style.display = 'none';
                    state.page = 1;
                    state.sortBy = 'medical_center';
                    state.sortOrder = 'asc';
                    updateHeaderVisuals();
                });

                headers.forEach(th => {
                    th.addEventListener('click', function () {
                        const col = this.getAttribute('data-col');
                        if (state.sortBy === col) {
                            state.sortOrder = state.sortOrder === 'asc' ? 'desc' : 'asc';
                        } else {
                            state.sortBy = col;
                            state.sortOrder = 'asc';
                        }
                        updateHeaderVisuals();
                        fetchResults();
                    });
                });

                function updateHeaderVisuals() {
                    headers.forEach(th => {
                        const icon = th.querySelector('.sort-icon');
                        icon.className = 'fas sort-icon fa-sort';
                        icon.classList.remove('sort-active');
                        if (th.getAttribute('data-col') === state.sortBy) {
                            icon.classList.add('sort-active');
                            icon.className = state.sortOrder === 'asc'
                                ? 'fas sort-icon fa-sort-up sort-active'
                                : 'fas sort-icon fa-sort-down sort-active';
                        }
                    });
                }

                window.changePage = function (page) {
                    if (page < 1) return;
                    state.page = page;
                    fetchResults();
                };
            });
        </script>
    @endpush

@endsection