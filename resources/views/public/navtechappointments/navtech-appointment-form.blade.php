@extends('layouts.public')

@section('title', 'NAVTTC Takamol Booking Pakistan | Saudi Skill Verification Program (SVP)')
@section('meta_description', 'Book your NAVTTC Takamol trade test online in Pakistan for the Saudi Arabia Skill Verification Program (SVP). Step-by-step guidance, document verification, and WhatsApp support.')
@section('meta_keywords', 'NAVTTC Takamol booking Pakistan, Saudi skill verification program Pakistan, Takamol test booking, SVP test Pakistan, NAVTTC trade test Saudi Arabia')

@section('content')

    <!-- Add Select2 CSS locally in the view or in your layout -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* Fix Select2 height to match Bootstrap inputs */
        .select2-container .select2-selection--single {
            height: 38px !important;
            border: 1px solid #ced4da !important;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }

        .stepper-wrapper {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .stepper-wrapper::before {
            content: "";
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #e0e0e0;
            z-index: 1;
        }

        .stepper-item {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: white;
            padding: 0 10px;
        }

        .step-counter {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: white;
            border: 2px solid #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: #999;
            margin-bottom: 5px;
        }

        .stepper-item.active .step-counter {
            border-color: #2c3e50;
            color: #2c3e50;
        }

        .stepper-item.completed .step-counter {
            background-color: #2c3e50;
            border-color: #2c3e50;
            color: white;
        }

        .step-name {
            font-size: 12px;
            color: #999;
        }

        .stepper-item.active .step-name {
            color: #2c3e50;
            font-weight: bold;
        }

        .instruction-list li {
            margin-bottom: 12px;
            font-size: 14px;
            color: #555;
        }

        .comparison-box img {
            max-width: 100%;
            height: auto;
            border: 1px solid #f0f0f0;
        }

        #passportModal .btn-info:disabled {
            background-color: #a0cece !important;
        }

        /* Custom Upload Widget Styling */
        .custom-upload-widget {
            background: #fff;
            padding: 10px 0;
        }

        .upload-subtitle {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .btn-custom-upload {
            background-color: transparent;
            border: 1px solid #ced4da;
            color: #2c3e50;
            /* Teal color from image */
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 5px;
            transition: all 0.3s ease;
            width: fit-content;
            margin-bottom: 6px;
        }

        .btn-custom-upload:hover {
            background-color: #f8f9fa;
            border-color: #2c3e50;
            color: #146e6e;
        }

        .upload-format-info {
            font-size: 12px;
            color: #888;
            line-height: 1.4;
            margin-top: 5px;
        }

        .upload-status-text {
            font-size: 0.85rem;
            color: #28a745;
            font-weight: bold;
            margin-top: 5px;
        }

        /* Add specific mobile responsiveness tweaks */
        @media (max-width: 768px) {
            .stepper-item .step-name {
                display: none;
            }

            /* Hide text on small screens */
        }

        .trust-badges img {
            height: 50px;
            margin: 0 10px;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: 0.3s;
        }

        .trust-badges img:hover {
            filter: grayscale(0%);
            opacity: 1;
        }
    </style>

    <!-- Page Header -->
    <section class="page-header text-white py-5" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:.82rem;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">NAVTTC Takamol Booking</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center flex-wrap" style="gap:12px;">
                <div>
                    <span style="display:inline-block;background:#e74c3c;color:#fff;font-size:.72rem;font-weight:700;padding:4px 14px;border-radius:20px;letter-spacing:.5px;text-transform:uppercase;margin-bottom:10px;">
                        <i class="fas fa-exclamation-circle mr-1"></i> Mandatory for Saudi Visa
                    </span>
                    <h1 class="font-weight-bold mb-1">NAVTTC Takamol Booking Pakistan</h1>
                    <p class="lead mb-2" style="color:rgba(255,255,255,.8);">Saudi Skill Verification Program (SVP) — Book your trade test online.</p>
                </div>
                <div class="ml-auto">
                    <div class="bg-white p-2 rounded shadow-sm d-inline-flex align-items-center" style="gap:8px;">
                        <img src="{{ asset('assets/public/images/navttc-logo.png') }}" alt="NAVTTC" style="height:40px;">
                        <span class="text-muted font-weight-bold">×</span>
                        <img src="{{ asset('assets/public/images/takamol-logo.svg') }}" alt="Takamol" style="height:40px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Warning Strip -->
    <div style="background:var(--accent-gold);padding:12px 0;">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap:8px;">
                <p class="mb-0 font-weight-bold" style="color:#0f1923;font-size:.9rem;">
                    <i class="fas fa-exclamation-triangle mr-2"></i><strong>Requirement:</strong> This test is mandatory for 12 technical trades traveling to Saudi Arabia on a new Work Visa.
                </p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+NAVTTC+Takamol+booking." target="_blank" class="btn btn-dark btn-sm font-weight-bold px-4 flex-shrink-0">
                    <i class="fab fa-whatsapp mr-1"></i>Get Help
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">

            {{-- ── TOP SEO SECTION ── --}}
            <div class="row mb-5">
                <div class="col-lg-8">
                    <span class="nt-seo-badge">NAVTTC Takamol SVP 2026</span>
                    <h2 class="nt-seo-title">NAVTTC Takamol Booking Pakistan – Saudi Skill Verification Program (SVP)</h2>
                    <p class="text-muted mb-3">Book your NAVTTC Takamol trade test online in Pakistan for the Saudi Arabia Skill Verification Program (SVP). This test is mandatory for workers in technical trades applying for a Saudi work visa.</p>
                    <p class="text-muted mb-4">Our guided service helps you complete your Takamol booking, document verification, and application submission without errors. We ensure your details are correctly entered so your application is accepted on the official system.</p>
                    <div class="row">
                        @php $whyNt = [
                            'Easy online NAVTTC Takamol booking',
                            'Document verification before submission',
                            'Avoid rejection due to wrong uploads',
                            'WhatsApp support for quick updates',
                            'Step-by-step guidance for test process',
                        ]; @endphp
                        @foreach($whyNt as $pt)
                        <div class="col-md-6 mb-2">
                            <div class="nt-check-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ $pt }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="nt-info-card">
                        <div class="nt-info-card-header">
                            <i class="fas fa-certificate mr-2"></i>What is NAVTTC Takamol (SVP)?
                        </div>
                        <div class="p-4">
                            <p class="small text-muted mb-3">The NAVTTC Takamol Skill Verification Program (SVP) is a mandatory requirement for selected technical professions going to Saudi Arabia. It verifies your skills, trade experience, and job category before visa processing.</p>
                            <p class="small font-weight-bold mb-2" style="color:#1a252f;">Applies to trades like:</p>
                            <div class="row">
                                @php $trades = ['Electrician','Plumber','Welder','Mason','Carpenter','Technician']; @endphp
                                @foreach($trades as $t)
                                <div class="col-6 mb-1">
                                    <div class="nt-mini-item"><i class="fas fa-tools" style="color:var(--accent-gold);font-size:.75rem;"></i><span class="small">{{ $t }}</span></div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-3 p-2 rounded text-center" style="background:#fff3cd;border:1px solid #ffe082;">
                                <p class="small mb-0 font-weight-bold" style="color:#856404;"><i class="fas fa-exclamation-circle mr-1"></i>Without passing this test, your Saudi work visa cannot proceed.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── DOCS STRIP ── --}}
            <div class="nt-docs-strip mb-5">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-clipboard-list mr-2" style="color:var(--accent-gold);font-size:1.2rem;"></i>
                    <h5 class="font-weight-bold mb-0">Documents Required for Takamol Booking</h5>
                </div>
                <div class="row">
                    @php $docs = [
                        ['icon'=>'fas fa-passport',      'text'=>'Passport (front page with photo)'],
                        ['icon'=>'fas fa-id-card',       'text'=>'CNIC (front side)'],
                        ['icon'=>'fas fa-user-circle',   'text'=>'Recent photo (white background)'],
                        ['icon'=>'fab fa-whatsapp',      'text'=>'WhatsApp number (active)'],
                        ['icon'=>'fas fa-briefcase',     'text'=>'Trade mentioned on your visa'],
                    ]; @endphp
                    @foreach($docs as $doc)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="nt-doc-pill">
                            <i class="{{ $doc['icon'] }}"></i>
                            <span class="small">{{ $doc['text'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="small text-muted mb-0 mt-1"><i class="fas fa-exclamation-triangle mr-1" style="color:var(--accent-gold);"></i>Upload clear and readable images to avoid delays or rejection.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="appointment-form-wrapper shadow-lg">
                        <form id="appointmentForm" class="appointment-form" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Section 1: Job Details -->
                            <div class="form-section">
                                <h5 class="section-title"><i class="fas fa-briefcase text-dark"></i> Job Details</h5>
                                <div class="form-row">
                                    <!-- Changed to col-md-6 -->
                                    <div class="form-group col-md-6">
                                        <label for="country">Country</label>
                                        <select class="form-control" id="country" name="country">
                                            <option value="Pakistan">Pakistan</option>
                                        </select>
                                    </div>

                                    <!-- Changed to col-md-6 -->
                                    <div class="form-group col-md-6">
                                        <label>WhatsApp Number <span class="text-danger">*</span></label>
                                        <input type="tel" name="whatsapp_number" class="form-control" id="whatsapp_number"
                                            placeholder="0300 1234567">
                                        <!-- Removed duplicate hidden country input to prevent array issues -->
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Select Your Occupation <span class="text-danger">*</span></label>
                                        <select name="occupation" class="form-control" id="occupation">
                                            <option value="">-- Choose Occupation --</option>
                                            @php
                                                $occupations = [
                                                    "Agricultural equipment mechanic",
                                                    "A sharpener and a metal tool grinder",
                                                    "Asphalt roofing agent and synthetic components",
                                                    "Auto Electrician",
                                                    "Auto Glazier",
                                                    "Auto Mechanic",
                                                    "Auto plumber",
                                                    "Baker",
                                                    "Barber",
                                                    "Barista",
                                                    "Blacksmith",
                                                    "Boiler smith",
                                                    "Brick and tile kiln operator",
                                                    "Brick mason",
                                                    "Builder",
                                                    "Building Electrician",
                                                    "Building Facade Cleaner",
                                                    "Build stacks",
                                                    "Bus Driver",
                                                    "Bus Mechanic",
                                                    "Butcher",
                                                    "Car Driver",
                                                    "Carpenter",
                                                    "Carpet and rug Cleaner",
                                                    "Carpet rug and plastic flooring installer",
                                                    "Chef",
                                                    "Clay mason",
                                                    "Clothes Seller",
                                                    "Compressor mechanic",
                                                    "Concrete Finisher",
                                                    "Concrete Mix Worker",
                                                    "Constructing Worker",
                                                    "Construction formwork Carpenter",
                                                    "Construction Worker",
                                                    "Copper Blacksmith",
                                                    "Cosmetics and Toiletries Seller",
                                                    "Craftsman of wooden products",
                                                    "Crusher operator",
                                                    "Curtain washer",
                                                    "Decorative Painter",
                                                    "Demolition worker",
                                                    "Drilling and shell carpenter",
                                                    "Drilling ground wells",
                                                    "Drilling Rig Electrician",
                                                    "Drilling Rig Mechanic",
                                                    "Drilling worker",
                                                    "Electrical Devices Maintenance Technician",
                                                    "Electrical Equipment Assembler",
                                                    "Electrical transformer assembly",
                                                    "Electric Devices Assembler",
                                                    "Electro mechanic",
                                                    "Electronic equipment mechanic",
                                                    "Electronic Exchange Assembler",
                                                    "Electronic Mechanical Equipment Assembler",
                                                    "Elevator mechanic",
                                                    "Excavator Operator",
                                                    "Explosive agent",
                                                    "Fast food maker",
                                                    "Fiber processing machine operator",
                                                    "Flame cutting machine operator",
                                                    "Food and Beverage Seller",
                                                    "Food & Beverage's Counter Server",
                                                    "Food Peddler",
                                                    "Forged press blacksmith",
                                                    "Fur Clothing & Bisht Tailor",
                                                    "Furniture Assembling Worker",
                                                    "Furniture Carpenter",
                                                    "Furniture Seller",
                                                    "Garden clean worker",
                                                    "Gas Station Attendant",
                                                    "Grocer",
                                                    "Gypsum Worker",
                                                    "Haddad blades",
                                                    "Hairdresser",
                                                    "Hardwood floor installer",
                                                    "Heavy Equipment Mechanic",
                                                    "Heavy truck Driver",
                                                    "Hospital Cleaner",
                                                    "HVAC mechanic",
                                                    "ICT Lines Installer",
                                                    "ICT Services Technician",
                                                    "Inflatable Musical Instruments Maker & Repairer",
                                                    "Ironer",
                                                    "Jeweler precious metal ornament and enameler",
                                                    "Jewelry Seller",
                                                    "Kitchen Worker",
                                                    "Labeling worker",
                                                    "Lathe operator",
                                                    "Laundryman",
                                                    "Light equipment mechanic",
                                                    "Lingerie Female Seller",
                                                    "Load and Unload Worker",
                                                    "Locksmith",
                                                    "Manufacturing Officer",
                                                    "Marble finishing machine operator",
                                                    "Market Seller",
                                                    "Meal Maker For a Food Cart",
                                                    "Measuring Instruments Repairer",
                                                    "Mechanical Equipment Assembler",
                                                    "Mechanical hammer smith",
                                                    "Men's Clothing Tailor",
                                                    "Metal boring machine operator",
                                                    "Metal caster",
                                                    "Metal casting machine operator",
                                                    "Metal Construction Assembler",
                                                    "Metal extrusion machine operator",
                                                    "Metal finisher",
                                                    "Metal forging machine operator",
                                                    "Metal galvanizing machine operator",
                                                    "Metal grinding and polishing equipment operator",
                                                    "Metal heat treatment machine operator",
                                                    "Metal mold maker",
                                                    "Metal rolling machine operator",
                                                    "Military Tailor",
                                                    "Mine machines operator",
                                                    "Miner",
                                                    "Mine roofing installer",
                                                    "Mining equipment mechanic",
                                                    "Mining worker",
                                                    "Minitruck driver",
                                                    "Mosaic composite",
                                                    "Mosaic molding agent",
                                                    "Motorcycle Driver",
                                                    "Motorcycle mechanic",
                                                    "Nail Care Specialist",
                                                    "Naval Construction Diver",
                                                    "Newspaper Seller",
                                                    "NMVs Repairer",
                                                    "Offices and Facilities Cleaning Worker",
                                                    "Offshore drilling rig",
                                                    "Optical Instruments Repairer",
                                                    "Ore smelter operator",
                                                    "Packaging worker",
                                                    "Packing the shelves worker",
                                                    "Painter",
                                                    "Peddler",
                                                    "Peddler-Green Grocer",
                                                    "Percussion Musical Instruments Maker & Repairer",
                                                    "Perfume Seller",
                                                    "Pipe and Boiler Insulation Worker",
                                                    "Pipe installer",
                                                    "Plasterer",
                                                    "Plumber",
                                                    "Power Cable Connector",
                                                    "Power Distribution Boards Assembler",
                                                    "Power Lines Operator",
                                                    "Precision instrument repairer",
                                                    "Products Spray Painter",
                                                    "Quarry worker",
                                                    "Readymix concrete construction",
                                                    "Refrigeration assembler",
                                                    "Refrigeration mechanic",
                                                    "Riveting worker",
                                                    "Road maintenance worker",
                                                    "Roofing Sheet metal worker",
                                                    "Roofs Cleaner",
                                                    "Roof slate and tiles worker",
                                                    "Scaffold Laborer",
                                                    "Seller",
                                                    "Seller of Agricultural Supplies",
                                                    "Seller of Building Materials",
                                                    "Seller of Flowers and Plants",
                                                    "Seller of Fuelwood and Coal",
                                                    "Seller of Household Appliances and Tools",
                                                    "Seller of Musical Instruments",
                                                    "Seller of Vehicles Spare Parts",
                                                    "Seller of Vehicles Supplies",
                                                    "Sewing and Knitting Supplies Seller",
                                                    "Ship carpenter",
                                                    "Shoes and Bags Seller",
                                                    "Sifting machine operator",
                                                    "Slaughterer",
                                                    "Spice Seller",
                                                    "Spray Painter",
                                                    "Stall seller",
                                                    "Stone cutter",
                                                    "Stone engraver",
                                                    "Stone mason",
                                                    "Stones",
                                                    "Store Keeper",
                                                    "Street clean worker",
                                                    "String Musical Instruments Maker & Repairer",
                                                    "Tailor",
                                                    "Taxi Driver",
                                                    "Textile Seller",
                                                    "Tile making machine operator",
                                                    "Tile setter",
                                                    "Timber and mud roofing worker",
                                                    "Tinsmith",
                                                    "Tire Installer",
                                                    "Tool and kit maker",
                                                    "Trailer Truck Driver",
                                                    "Transport car worker",
                                                    "Truck Driver",
                                                    "Underwater welder",
                                                    "Unique Occupation Worker",
                                                    "Used tires reconstruction worker",
                                                    "Vehicle Assembler",
                                                    "Vehicles Oiler and Greaser",
                                                    "Vehicles Seller",
                                                    "Veneer making machine operator",
                                                    "Waiter",
                                                    "Wallpaper Hanger",
                                                    "Warehouse Worker",
                                                    "Watch Repairer",
                                                    "Watch Seller",
                                                    "Weaving Canes, Bamboo, Fronds & Wicker Artificer",
                                                    "Welder",
                                                    "Windows cleaner",
                                                    "Wire Robe Technician",
                                                    "Women's Clothing Tailor",
                                                    "Wood cutting machine operator",
                                                    "Wood Drying Oven Operator",
                                                    "Wooden formwork carpenter",
                                                    "Wood planing machine operator",
                                                    "Wood Press Machine Operator",
                                                    "Wood Processor",
                                                    "Wood Product Manufacturing Machine Operator",
                                                    "Wood saw operator",
                                                    "Wood Shaping Machine Operator",
                                                    "Woodworking Machines and Tools Operator and Preparer",
                                                    "Workshop Worker"
                                                ];
                                            @endphp

                                            @foreach($occupations as $job)
                                                <option value="{{ $job }}" {{ old('occupation') == $job ? 'selected' : '' }}>
                                                    {{ $job }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Select the trade written on your visa.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Documents -->
                            <div class="form-section">
                                <h5 class="section-title"><i class="fas fa-file-upload text-dark"></i> Document Upload</h5>
                                <p class="small text-muted mb-4">Please upload clear photos. We will crop and resize them
                                    for the official portal.</p>

                                <div class="row">
                                    <!-- Passport -->
                                    <div class="col-md-4 mb-4">
                                        <div
                                            class="custom-upload-widget border text-center p-4 rounded bg-light hover-shadow">
                                            <i class="fas fa-passport fa-3x text-muted mb-3"></i>
                                            <h6 class="font-weight-bold">1. Passport</h6>
                                            <p class="small text-muted">Front page with photo</p>

                                            <button type="button" class="btn btn-outline-dark btn-sm btn-block"
                                                data-toggle="modal" data-target="#passportModal">
                                                Upload Passport
                                            </button>

                                            <input type="file" name="passport_pic" id="main_passport_input" class="d-none">
                                            <div id="passport_name_display" class="upload-status-text mt-2"></div>
                                        </div>
                                    </div>

                                    <!-- ID Card -->
                                    <div class="col-md-4 mb-4">
                                        <div
                                            class="custom-upload-widget border text-center p-4 rounded bg-light hover-shadow">
                                            <i class="fas fa-id-card fa-3x text-muted mb-3"></i>
                                            <h6 class="font-weight-bold">2. CNIC</h6>
                                            <p class="small text-muted">Front side of ID Card</p>

                                            <button type="button" class="btn btn-outline-dark btn-sm btn-block"
                                                data-toggle="modal" data-target="#idCardModal">
                                                Upload CNIC
                                            </button>

                                            <input type="file" name="id_card_front" id="main_id_card_input" class="d-none">
                                            <div id="id_status_display" class="upload-status-text mt-2"></div>
                                        </div>
                                    </div>

                                    <!-- User Photo -->
                                    <div class="col-md-4 mb-4">
                                        <div
                                            class="custom-upload-widget border text-center p-4 rounded bg-light hover-shadow">
                                            <i class="fas fa-user-circle fa-3x text-muted mb-3"></i>
                                            <h6 class="font-weight-bold">3. Your Photo</h6>
                                            <p class="small text-muted">White background selfie</p>

                                            <button type="button" class="btn btn-outline-dark btn-sm btn-block"
                                                data-toggle="modal" data-target="#photoModal">
                                                Upload Photo
                                            </button>

                                            <input type="file" name="user_pic" id="main_user_pic_input" class="d-none">
                                            <div id="photo_status_display" class="upload-status-text mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Box -->
                            <div class="alert alert-info border-0 small">
                                <i class="fas fa-info-circle"></i> <strong>Note:</strong> By clicking Submit, you agree to
                                our service terms. Our team will manually review your documents before applying to the
                                official Takamol system to prevent rejection.
                            </div>

                            <div class="form-buttons mt-4">
                                <button type="submit" class="btn btn-dark px-5 shadow">Next Step: Payment <i
                                        class="fas fa-arrow-right ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Passport Upload Modal -->
        <div class="modal fade" id="passportModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-weight-bold">Instructions for uploading Passport</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Stepper Header -->
                        <div class="stepper-wrapper mb-4">
                            <div class="stepper-item active" id="step-1-tab">
                                <div class="step-counter">1</div>
                                <div class="step-name">General</div>
                            </div>
                            <div class="stepper-item" id="step-2-tab">
                                <div class="step-counter">2</div>
                                <div class="step-name">Color</div>
                            </div>
                            <div class="stepper-item" id="step-3-tab">
                                <div class="step-counter">3</div>
                                <div class="step-name">Quality</div>
                            </div>
                            <div class="stepper-item" id="step-4-tab">
                                <div class="step-counter">4</div>
                                <div class="step-name">Scan</div>
                            </div>
                            <div class="stepper-item" id="step-5-tab">
                                <div class="step-counter">5</div>
                                <div class="step-name">Cropping</div>
                            </div>
                            <div class="stepper-item" id="step-6-tab">
                                <div class="step-counter">6</div>
                                <div class="step-name">Upload</div>
                            </div>
                        </div>

                        <!-- Step Content Container -->
                        <div id="passport-steps-content">

                            <!-- Step 1: General -->
                            <div class="step-content active" id="step-1">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="far fa-image mr-2"></i> Only <strong>PNG, JPEG or JPG</strong> images must
                                        be used</li>
                                    <li><i class="fas fa-file-alt mr-2"></i> The <strong>size</strong> of the photo should
                                        not exceed <strong>2 MBs</strong></li>
                                    <li><i class="far fa-user mr-2"></i> If your <strong>last name is blank</strong>, please
                                        provide <strong>your father's name</strong> as the last name</li>
                                    <li><i class="fas fa-barcode mr-2"></i> The <strong>MRZ code</strong> should be
                                        <strong>clearly visible</strong></li>
                                </ul>
                                <div class="comparison-box text-center mt-3">
                                    <img src="{{ asset('assets/public/images/generalDocumentsFormat.13061148.webp') }}"
                                        class="img-fluid rounded" alt="Passport Guide">
                                </div>
                            </div>

                            <!-- Step 2: Color -->
                            <div class="step-content d-none" id="step-2">
                                <p><i class="fas fa-th mr-2"></i> Please make sure to upload the document <strong>in full
                                        color</strong>.</p>
                                <div class="comparison-box text-center mt-3">
                                    <img src="{{ asset('assets/public/images/documentsColor.8793867e.webp') }}"
                                        class="img-fluid rounded" alt="Color Guide">
                                </div>
                            </div>

                            <!-- Step 3: Quality -->
                            <div class="step-content d-none" id="step-3">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-star mr-2"></i> <strong>No glare</strong> or stain over the scan.
                                    </li>
                                    <li><i class="fas fa-moon mr-2"></i> <strong>No shadows</strong> over the scan.</li>
                                </ul>
                                <div class="comparison-box text-center mt-3">
                                    <img src="{{ asset('assets/public/images/documentsQuality.1df57e31.webp') }}"
                                        class="img-fluid rounded" alt="Quality Guide">
                                </div>
                            </div>

                            <!-- Step 4: Scan -->
                            <div class="step-content d-none" id="step-4">
                                <p><i class="fas fa-copy mr-2"></i> Double pages of scanned copies are not allowed.
                                    <strong>Only a single page</strong> should be uploaded.</p>
                                <div class="comparison-box text-center mt-3">
                                    <img src="{{ asset('assets/public/images/documentsScan.68ba3262.webp') }}"
                                        class="img-fluid rounded" alt="Scan Guide">
                                </div>
                            </div>

                            <!-- Step 5: Cropping -->
                            <div class="step-content d-none" id="step-5">
                                <p><i class="fas fa-crop mr-2"></i> Crop the document so that <strong>no information is
                                        missed</strong>.</p>
                                <div class="comparison-box text-center mt-3 mb-3">
                                    <img src="{{ asset('assets/public/images/documentsCrop.3a15f38c.webp') }}"
                                        class="img-fluid rounded" alt="Crop Guide">
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="reviewCheck">
                                    <label class="form-check-label" for="reviewCheck">I have reviewed the instructions on
                                        how to upload the photo.</label>
                                </div>
                            </div>

                            <!-- Step 6: Upload -->
                            <div class="step-content d-none" id="step-6">
                                <h6 class="font-weight-bold">Upload your passport</h6>
                                <div class="upload-area text-center p-5 border rounded" id="drop-zone"
                                    style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-info mb-3"></i>
                                    <p>Click, or <span class="text-info">Browse</span> to upload</p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 5MB)</small>
                                    <input type="file" id="real-passport-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>

                                <div id="passport-modal-error" class="text-danger small mt-2 font-weight-bold"></div>
                                <div id="file-name-display" class="mt-2 text-success font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-back">Back</button>
                        <button type="button" class="btn btn-info text-white px-4" id="btn-continue"
                            style="background-color: #2c3e50;">Continue</button>
                        <button type="button" class="btn btn-info text-white px-4 d-none" id="btn-upload-finish"
                            style="background-color: #2c3e50;">Upload file</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ID Card Modal -->
        <div class="modal fade" id="idCardModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-weight-bold">Instructions for ID Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="stepper-wrapper mb-4" id="stepper-id">
                            <div class="stepper-item active" data-step="1">
                                <div class="step-counter">1</div>
                                <div class="step-name">Front</div>
                            </div>
                            <div class="stepper-item" data-step="2">
                                <div class="step-counter">2</div>
                                <div class="step-name">Quality</div>
                            </div>
                            <div class="stepper-item" data-step="3">
                                <div class="step-counter">3</div>
                                <div class="step-name">Edges</div>
                            </div>
                            <div class="stepper-item" data-step="4">
                                <div class="step-counter">4</div>
                                <div class="step-name">Upload</div>
                            </div>
                        </div>

                        <div class="id-steps-content">
                            <div class="step-content active" id="id-step-1">
                                <p>Upload the <strong>Front Side</strong> of your original ID card. Photocopies are not
                                    accepted.</p>
                                <div class="text-center"><img
                                        src="{{ asset('assets/public/images/documentsColor.8793867e.webp') }}"
                                        class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="id-step-2">
                                <p>Ensure there is <strong>no glare</strong> from lights and all text is readable.</p>
                                <div class="text-center"><img
                                        src="{{ asset('assets/public/images/documentsQuality.1df57e31.webp') }}"
                                        class="img-fluid rounded"></div>
                            </div>
                            <div class="step-content d-none" id="id-step-3">
                                <p>Make sure all <strong>four corners</strong> of the card are visible in the photo.</p>
                                <div class="text-center"><img
                                        src="{{ asset('assets/public/images/documentsCrop.3a15f38c.webp') }}"
                                        class="img-fluid rounded"></div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="idReviewCheck">
                                    <label class="form-check-label" for="idReviewCheck">I have confirmed the card is clear
                                        and fully visible.</label>
                                </div>
                            </div>
                            <div class="step-content d-none" id="id-step-4">
                                <div class="upload-area text-center p-5 border rounded" id="id-drop-zone"
                                    style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-id-card fa-3x text-info mb-3"></i>
                                    <p>Click to upload <strong>ID Card Front</strong></p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 5MB)</small>
                                    <input type="file" id="real-id-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>
                                <div id="id-modal-error" class="text-danger small mt-2 font-weight-bold"></div>
                                <div id="id-file-name" class="mt-2 text-success font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-id-back">Back</button>
                        <button type="button" class="btn btn-info text-white" id="btn-id-continue"
                            style="background-color: #2c3e50;">Continue</button>
                        <button type="button" class="btn btn-info text-white d-none" id="btn-id-finish"
                            style="background-color: #2c3e50;">Finish</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Passport Photo Modal -->
        <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title font-weight-bold">Personal Photo Standard Requirements</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Expanded Stepper Header -->
                        <div class="stepper-wrapper mb-4" id="stepper-photo">
                            <div class="stepper-item active" data-step="1">
                                <div class="step-counter">1</div>
                                <div class="step-name">General</div>
                            </div>
                            <div class="stepper-item" data-step="2">
                                <div class="step-counter">2</div>
                                <div class="step-name">Quality</div>
                            </div>
                            <div class="stepper-item" data-step="3">
                                <div class="step-counter">3</div>
                                <div class="step-name">Pose</div>
                            </div>
                            <div class="stepper-item" data-step="4">
                                <div class="step-counter">4</div>
                                <div class="step-name">Glasses</div>
                            </div>
                            <div class="stepper-item" data-step="5">
                                <div class="step-counter">5</div>
                                <div class="step-name">Headdress</div>
                            </div>
                            <div class="stepper-item" data-step="6">
                                <div class="step-counter">6</div>
                                <div class="step-name">Upload</div>
                            </div>
                        </div>

                        <div class="photo-steps-content">
                            <!-- Step 1: General -->
                            <div class="step-content active" id="photo-step-1">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="far fa-image mr-2"></i> Photo must <strong>both show a close up of your
                                            face and the top of the shoulders</strong>.</li>
                                    <li><i class="far fa-smile mr-2"></i> Your <strong>face</strong> must take up
                                        <strong>70% to 80%</strong> of the photo.</li>
                                    <li><i class="fas fa-file-alt mr-2"></i> The size of the photo should not be more than
                                        <strong>2 MBs</strong>.</li>
                                    <li><i class="fas fa-file-image mr-2"></i> Only <strong>PNG, JPEG or JPG</strong> images
                                        must be used.</li>
                                    <li><i class="fas fa-expand-arrows-alt mr-2"></i> Photo must be in dimension of
                                        <strong>40 (height) x 30 (width)</strong>. Min resolution <strong>720px</strong>.
                                    </li>
                                    <li><i class="far fa-calendar-alt mr-2"></i> Your photo must be taken <strong>less than
                                            6 months</strong> ago.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/1.webp') }}" class="img-fluid rounded"
                                        alt="General Guide">
                                </div>
                            </div>

                            <!-- Step 2: Quality -->
                            <div class="step-content d-none" id="photo-step-2">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="fas fa-palette mr-2"></i> <strong>Colored</strong>.</li>
                                    <li><i class="far fa-square mr-2"></i> Taken against a <strong>plain white or light grey
                                            background</strong>.</li>
                                    <li><i class="fas fa-sun mr-2"></i> <strong>Clear</strong>, have high resolution and
                                        with <strong>balanced light</strong>.</li>
                                    <li><i class="fas fa-adjust mr-2"></i> Have a <strong>good color balance</strong>,
                                        natural tones and without 'red eye'.</li>
                                    <li><i class="fas fa-low-vision mr-2"></i> No shadows or glare in the Photo or in the
                                        background.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/2.webp') }}" class="img-fluid rounded"
                                        alt="Quality Guide">
                                </div>
                            </div>

                            <!-- Step 3: Pose -->
                            <div class="step-content d-none" id="photo-step-3">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="far fa-user mr-2"></i> <strong>Your face must be centered</strong>. You
                                        must look directly at the camera.</li>
                                    <li><i class="fas fa-arrows-alt-v mr-2"></i> <strong>Do not tilt or turn</strong> your
                                        head in any way.</li>
                                    <li><i class="far fa-meh mr-2"></i> Your <strong>expression must be neutral</strong>. No
                                        smiling or frowning.</li>
                                    <li><i class="far fa-eye mr-2"></i> Your eyes must be <strong>opened</strong> and your
                                        mouth <strong>closed</strong>.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/3.webp') }}" class="img-fluid rounded"
                                        alt="Pose Guide">
                                </div>
                            </div>

                            <!-- Step 4: Glasses -->
                            <div class="step-content d-none" id="photo-step-4">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="fas fa-glasses mr-2"></i> Do <strong>not wear sunglasses</strong> or
                                        tinted/colored glasses.</li>
                                    <li><i class="far fa-eye mr-2"></i> If you wear glasses, your <strong>eyes must be
                                            clearly visible</strong>.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/4.webp') }}" class="img-fluid rounded"
                                        alt="Glasses Guide">
                                </div>
                            </div>

                            <!-- Step 5: Headdress -->
                            <div class="step-content d-none" id="photo-step-5">
                                <ul class="instruction-list list-unstyled">
                                    <li><i class="fas fa-graduation-cap mr-2"></i> Do <strong>not wear a head
                                            covering</strong> (hats, caps, headbands).</li>
                                    <li><i class="fas fa-kaaba mr-2"></i> Except if you wear it for <strong>religious
                                            reasons</strong>, face must be visible.</li>
                                </ul>
                                <div class="text-center mt-3 bg-light p-3 rounded">
                                    <img src="{{ asset('assets/public/images/5.webp') }}" class="img-fluid rounded"
                                        alt="Headdress Guide">
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="photoReviewCheck">
                                    <label class="form-check-label" for="photoReviewCheck">I have reviewed the instructions
                                        on how to upload the photo.</label>
                                </div>
                            </div>

                            <!-- Step 6: Upload -->
                            <div class="step-content d-none" id="photo-step-6">
                                <div class="upload-area text-center p-5 border rounded" id="photo-drop-zone"
                                    style="border: 2px dashed #ddd !important; cursor: pointer;">
                                    <i class="fas fa-camera fa-3x text-info mb-3"></i>
                                    <p>Click to upload <strong>Your Photo</strong></p>
                                    <small class="text-muted">PNG, JPG or JPEG (Max 5MB)</small>
                                    <input type="file" id="real-photo-input" accept=".jpg, .jpeg, .png" class="d-none">
                                </div>
                                <div id="photo-modal-error" class="text-danger small mt-2 font-weight-bold"></div>
                                <div id="photo-file-name" class="mt-2 text-success font-weight-bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary d-none" id="btn-photo-back">Back</button>
                        <button type="button" class="btn btn-info text-white" id="btn-photo-continue"
                            style="background-color: #2c3e50;">Continue</button>
                        <button type="button" class="btn btn-info text-white d-none" id="btn-photo-finish"
                            style="background-color: #2c3e50;">Finish</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loader -->
        <div id="loaderOverlay">
            <div class="loader-content text-center">
                <div class="spinner-border text-light" style="width: 4rem; height: 4rem;"></div>
                <div class="text-light mt-3">Uploading Documents...</div>
            </div>
        </div>
    </section>

    @push('scripts')

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>

            document.addEventListener('DOMContentLoaded', function () {

                // Initialize Select2 on the occupation dropdown
                $('#occupation').select2({
                    placeholder: "-- Choose Occupation --",
                    allowClear: false,
                    width: '100%' // Fixes responsiveness issues
                });

                // --- GENERIC MODAL HANDLER FUNCTION ---
                function setupStepper(config) {
                    let currentStep = 1;
                    const modal = document.getElementById(config.modalId);
                    const btnContinue = document.getElementById(config.btnContinue);
                    const btnBack = document.getElementById(config.btnBack);
                    const btnFinish = document.getElementById(config.btnFinish);
                    const reviewCheck = config.checkId ? document.getElementById(config.checkId) : null;
                    const realInput = document.getElementById(config.realInput);
                    const dropZone = document.getElementById(config.dropZone);
                    const statusDisplay = document.getElementById(config.statusDisplay);
                    const fileNameDisplay = document.getElementById(config.fileNameDisplay);
                    const mainFormInput = document.getElementById(config.mainFormInput);

                    // Target the new error div
                    const modalErrorDiv = document.getElementById(config.modalErrorId);

                    function goToStep(step) {
                        modal.querySelectorAll('.step-content').forEach(el => el.classList.add('d-none'));
                        modal.querySelector(`#${config.stepPrefix}${step}`).classList.remove('d-none');

                        modal.querySelectorAll('.stepper-item').forEach((item, index) => {
                            const stepIdx = index + 1;
                            item.classList.toggle('completed', stepIdx < step);
                            item.classList.toggle('active', stepIdx === step);
                        });

                        currentStep = step;
                        btnBack.classList.toggle('d-none', step === 1);
                        btnContinue.classList.toggle('d-none', step === config.totalSteps);
                        btnFinish.classList.toggle('d-none', step !== config.totalSteps);

                        if (step === config.checkStep && reviewCheck) {
                            btnContinue.disabled = !reviewCheck.checked;
                        } else if (step === config.totalSteps) {
                            btnFinish.disabled = !realInput.files.length;
                        } else {
                            btnContinue.disabled = false;
                        }
                    }

                    if (reviewCheck) {
                        reviewCheck.addEventListener('change', () => {
                            if (currentStep === config.checkStep) btnContinue.disabled = !reviewCheck.checked;
                        });
                    }

                    btnContinue.addEventListener('click', () => { if (currentStep < config.totalSteps) goToStep(currentStep + 1); });
                    btnBack.addEventListener('click', () => goToStep(currentStep - 1));

                    dropZone.addEventListener('click', () => realInput.click());

                    realInput.addEventListener('change', function () {
                        // Reset state
                        modalErrorDiv.innerText = "";
                        fileNameDisplay.innerText = "";
                        btnFinish.disabled = true;

                        if (this.files.length > 0) {
                            const file = this.files[0];

                            // 1. Validation: Size
                            if (file.size > 5 * 1024 * 1024) {
                                modalErrorDiv.innerText = "Error: File exceeds 2MB limit.";
                                this.value = ""; // Clear input
                                return;
                            }

                            // 2. Validation: Type
                            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                            if (!allowedTypes.includes(file.type)) {
                                modalErrorDiv.innerText = "Error: Only JPG, JPEG, and PNG are allowed.";
                                this.value = ""; // Clear input
                                return;
                            }

                            // If valid
                            fileNameDisplay.innerText = "Selected: " + file.name;
                            btnFinish.disabled = false;
                        }
                    });

                    btnFinish.addEventListener('click', function () {
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(realInput.files[0]);
                        mainFormInput.files = dataTransfer.files;

                        statusDisplay.innerHTML = `<i class="fas fa-check-circle"></i> ${realInput.files[0].name} attached`;
                        $(modal).modal('hide');
                    });
                }

                // --- INITIALIZE THE THREE MODALS ---

                // 1. Passport
                setupStepper({
                    modalId: 'passportModal',
                    modalErrorId: 'passport-modal-error', // Added
                    stepPrefix: 'step-',
                    totalSteps: 6,
                    checkStep: 5,
                    checkId: 'reviewCheck',
                    btnContinue: 'btn-continue',
                    btnBack: 'btn-back',
                    btnFinish: 'btn-upload-finish',
                    realInput: 'real-passport-input',
                    dropZone: 'drop-zone',
                    fileNameDisplay: 'file-name-display',
                    statusDisplay: 'passport_name_display',
                    mainFormInput: 'main_passport_input'
                });

                // 2. ID Card
                setupStepper({
                    modalId: 'idCardModal',
                    modalErrorId: 'id-modal-error', // Added
                    stepPrefix: 'id-step-',
                    totalSteps: 4,
                    checkStep: 3,
                    checkId: 'idReviewCheck',
                    btnContinue: 'btn-id-continue',
                    btnBack: 'btn-id-back',
                    btnFinish: 'btn-id-finish',
                    realInput: 'real-id-input',
                    dropZone: 'id-drop-zone',
                    fileNameDisplay: 'id-file-name',
                    statusDisplay: 'id_status_display',
                    mainFormInput: 'main_id_card_input'
                });

                // 3. Photo (Modified for 6 steps)
                setupStepper({
                    modalId: 'photoModal',
                    modalErrorId: 'photo-modal-error',
                    stepPrefix: 'photo-step-',
                    totalSteps: 6,         // Changed from 3 to 6
                    checkStep: 5,          // Review checkbox is now on Step 5 (Headdress)
                    checkId: 'photoReviewCheck',
                    btnContinue: 'btn-photo-continue',
                    btnBack: 'btn-photo-back',
                    btnFinish: 'btn-photo-finish',
                    realInput: 'real-photo-input',
                    dropZone: 'photo-drop-zone',
                    fileNameDisplay: 'photo-file-name',
                    statusDisplay: 'photo_status_display',
                    mainFormInput: 'main_user_pic_input'
                });
            });

            document.addEventListener('DOMContentLoaded', function () {
                // Phone Mask for WhatsApp
                if (typeof $.fn.inputmask !== 'undefined') {
                    $('#whatsapp_number').inputmask('9999 9999999');
                }

                // Update file name label on select
                $('.custom-file-input').on('change', function () {
                    let fileName = $(this).val().split('\\').pop();
                    $(this).next('.custom-file-label').addClass("selected").html(fileName);
                });

                const form = document.getElementById('appointmentForm');
                const loader = document.getElementById('loaderOverlay');

                // Helper to show errors on custom widgets
                function setWidgetError(inputId, message) {
                    const input = document.getElementById(inputId);

                    // Safety Check 1: Ensure the hidden input exists
                    if (!input) {
                        console.error("Input not found: " + inputId);
                        return;
                    }

                    const widget = input.closest('.custom-upload-widget');

                    // Safety Check 2: Ensure the widget container exists
                    if (!widget) {
                        console.error("Widget container not found for: " + inputId);
                        return;
                    }

                    // Safety Check 3: Check if button exists before trying to style it
                    const btn = widget.querySelector('.btn-custom-upload');
                    if (btn) {
                        btn.style.borderColor = '#dc3545';
                        btn.style.color = '#dc3545';
                    }

                    // Remove any existing error messages in this widget to prevent duplicates
                    const existingError = widget.querySelector('.invalid-feedback');
                    if (existingError) existingError.remove();

                    // Append the error message text
                    const error = document.createElement('div');
                    error.className = 'invalid-feedback d-block';
                    error.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${message}`;
                    widget.appendChild(error);
                }

                form.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    // 1. Reset previous errors
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                    form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                    form.querySelectorAll('.btn-custom-upload').forEach(el => {
                        el.style.borderColor = '#2c3e50';
                        el.style.color = '#2c3e50';
                    });

                    // 2. Submit via AJAX
                    const formData = new FormData(form);
                    loader.classList.add('show');

                    try {
                        const response = await fetch("{{ route('navtechform.store') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                                "Accept": "application/json",
                            },
                            body: formData
                        });

                        const data = await response.json();

                        if (response.status === 422) {
                            // Server-side validation errors
                            Object.keys(data.errors).forEach(field => {
                                const input = form.querySelector(`[name="${field}"]`);
                                const errorMessage = data.errors[field][0];

                                // A. Handle Custom File Widgets (Check these fields specifically)
                                if (['passport_pic', 'id_card_front', 'user_pic'].includes(field)) {
                                    let targetInputId = '';
                                    if (field === 'passport_pic') targetInputId = 'main_passport_input';
                                    if (field === 'id_card_front') targetInputId = 'main_id_card_input';
                                    if (field === 'user_pic') targetInputId = 'main_user_pic_input';

                                    if (targetInputId) setWidgetError(targetInputId, errorMessage);
                                }
                                // B. Handle Standard Inputs (City, WhatsApp, etc)
                                else if (input) {
                                    input.classList.add('is-invalid');
                                    const errorDiv = document.createElement('div');
                                    errorDiv.className = 'invalid-feedback';
                                    errorDiv.innerHTML = `<i class="fas fa-times-circle mr-1"></i> ${errorMessage}`;
                                    input.closest('.form-group').appendChild(errorDiv);
                                }
                            });

                            // Scroll to the first error
                            const firstError = document.querySelector('.is-invalid, .invalid-feedback');
                            if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });

                        } else if (data.status === 'success') {
                            window.location.href = data.redirect;
                        }
                    } catch (error) {
                        console.error(error);
                        // alert('A connection error occurred. Please try again.');
                    } finally {
                        loader.classList.remove('show');
                    }
                });

            });
        </script>

        @push('schema')
            ,{
                "@type": "Service",
                "@id": "{{ url('/') }}#navttc-service",
                "name": "NAVTTC Takamol Skill Verification Program",
                "serviceType": "Educational Occupational Credential",
                "description": "Skill verification test booking for technical trades traveling to Saudi Arabia. Required for 12
                technical occupations including electrician, plumber, welder, HVAC mechanic, and more.",
                "provider": {
                    "@id": "{{ url('/') }}#organization"
                },
                "areaServed": {
                    "@type": "Country",
                    "name": "Pakistan"
                },
                "availableChannel": {
                    "@type": "ServiceChannel",
                    "serviceUrl": "{{ route('navtechform') }}",
                    "serviceType": "Online booking"
                }
            }
        @endpush
    @endpush

{{-- ── BOTTOM SEO SECTIONS ── --}}
<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="nt-section-label">How It Works</span>
            <h2 class="nt-section-title">Step-by-Step Takamol Booking Process</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    @php $steps = [
                        ['num'=>'1','title'=>'Fill the Form',          'desc'=>'Enter your personal details and WhatsApp number accurately.'],
                        ['num'=>'2','title'=>'Select Your Trade',      'desc'=>'Choose the trade as written on your visa.'],
                        ['num'=>'3','title'=>'Upload Documents',       'desc'=>'Upload passport, CNIC, and your photo clearly.'],
                        ['num'=>'4','title'=>'Submit Request',         'desc'=>'Submit your application through our secure form.'],
                        ['num'=>'5','title'=>'Document Review',        'desc'=>'Our team reviews and verifies your documents.'],
                        ['num'=>'6','title'=>'Receive Confirmation',   'desc'=>'Application submitted to Takamol system. Receive test details on WhatsApp.'],
                    ]; @endphp
                    @foreach($steps as $step)
                    <div class="col-md-4 mb-4">
                        <div class="nt-step-card">
                            <div class="nt-step-circle">{{ $step['num'] }}</div>
                            <h6 class="font-weight-bold mb-2">{{ $step['title'] }}</h6>
                            <p class="text-muted small mb-0">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="nt-section-label">Avoid These Errors</span>
                <h2 class="nt-section-title">Common Mistakes to Avoid</h2>
                <p class="text-muted mb-4">Even small mistakes can cause rejection or delays:</p>
                @php $mistakes = [
                    'Uploading blurry passport or CNIC images',
                    'Selecting wrong trade',
                    'Mismatch between visa and application',
                    'Incorrect WhatsApp number',
                    'Missing required documents',
                ]; @endphp
                @foreach($mistakes as $m)
                <div class="nt-mistake-item">
                    <i class="fas fa-times-circle mr-3" style="color:#e74c3c;font-size:1.1rem;flex-shrink:0;"></i>
                    <span class="text-muted">{{ $m }}</span>
                </div>
                @endforeach
                <div class="mt-4 p-3 rounded" style="background:#fff8e1;border-left:4px solid var(--accent-gold);">
                    <p class="small mb-0"><i class="fas fa-lightbulb mr-2" style="color:var(--accent-gold);"></i><strong>Tip:</strong> We manually review your documents before applying to ensure maximum success rate.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="nt-section-label">Why It Matters</span>
                <h2 class="nt-section-title">Benefits of Skill Verification (SVP)</h2>
                <p class="text-muted mb-4">Completing the Takamol SVP test gives you:</p>
                @php $benefits = [
                    ['icon'=>'fas fa-check-circle','text'=>'Required for Saudi work visa approval'],
                    ['icon'=>'fas fa-star',         'text'=>'Confirms your professional skills'],
                    ['icon'=>'fas fa-thumbs-up',    'text'=>'Improves job credibility'],
                    ['icon'=>'fas fa-bolt',         'text'=>'Faster visa processing'],
                ]; @endphp
                @foreach($benefits as $b)
                <div class="nt-benefit-item">
                    <div class="nt-benefit-icon"><i class="{{ $b['icon'] }}"></i></div>
                    <span class="text-muted">{{ $b['text'] }}</span>
                </div>
                @endforeach
                <div class="mt-4 p-3 rounded" style="background:#f7f8fc;border:1px solid #e8ecf0;">
                    <p class="small font-weight-bold mb-2">Who Needs This Test?</p>
                    <p class="small text-muted mb-0">Workers applying for Saudi Arabia work visa in technical or skilled trades whose job category falls under SVP-approved professions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="nt-section-label">Quick Answers</span>
                    <h2 class="nt-section-title">NAVTTC Takamol FAQs</h2>
                </div>
                <div id="ntFaqAccordion">
                    @php $ntFaqs = [
                        ['q'=>'Is Takamol test mandatory for Saudi Arabia?',  'a'=>'Yes, for selected technical trades, it is required under the Skill Verification Program (SVP). Without passing this test, your Saudi work visa cannot proceed.'],
                        ['q'=>'How long does booking take?',                  'a'=>'Most applications are processed within 24–48 hours after document verification and submission.'],
                        ['q'=>'Can I change my trade after submission?',      'a'=>'It depends on the system. Contact support immediately via WhatsApp if changes are needed.'],
                        ['q'=>'What happens if my documents are rejected?',   'a'=>'You will be asked to re-upload correct documents before resubmission. Our team will guide you through the process.'],
                    ]; @endphp
                    @foreach($ntFaqs as $i => $faq)
                    <div class="nt-faq-item">
                        <button class="nt-faq-btn {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#ntfaq{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                            {{ $faq['q'] }}
                            <div class="nt-faq-icon"><i class="fas fa-chevron-down" style="font-size:.75rem;"></i></div>
                        </button>
                        <div id="ntfaq{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}" data-parent="#ntFaqAccordion">
                            <div class="nt-faq-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('faq') }}" class="btn btn-outline-dark px-4 font-weight-bold">View All FAQs →</a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.partials.service-reviews', ['service' => 'NAVTTC Takamol Booking'])

<section style="background:linear-gradient(135deg,var(--accent-gold) 0%,#f4b942 100%);padding:50px 0;">
    <div class="container text-center">
        <h2 class="font-weight-bold mb-3" style="color:#0f1923;">Need Help with Your Takamol Booking?</h2>
        <p class="mb-4" style="color:#1a252f;max-width:600px;margin:0 auto 24px;">Our team is ready to assist with trade selection, document verification, application submission, and test preparation tips.</p>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '923000000000') }}?text=Hi%2C+I+need+help+with+NAVTTC+Takamol+booking." target="_blank" class="btn btn-dark btn-lg px-5 py-3 font-weight-bold">
            <i class="fab fa-whatsapp mr-2"></i>Get Help on WhatsApp
        </a>
    </div>
</section>

@push('head')
<style>
    .nt-seo-badge {
        display: inline-block;
        background: var(--accent-gold);
        color: #0f1923;
        font-size: .72rem;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 20px;
        letter-spacing: .5px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }
    .nt-seo-title { font-size: 1.6rem; font-weight: 800; color: #1a252f; margin-bottom: 14px; }
    .nt-check-item { display: flex; align-items: flex-start; gap: 10px; font-size: .9rem; color: #495057; }
    .nt-check-item i { color: #28a745; margin-top: 2px; flex-shrink: 0; }
    .nt-info-card { background: #fff; border: 1px solid #e8ecf0; border-radius: 14px; overflow: hidden; }
    .nt-info-card-header { background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%); color: var(--accent-gold); font-weight: 700; font-size: .95rem; padding: 16px 20px; }
    .nt-mini-item { display: flex; align-items: center; gap: 8px; padding: 4px 0; }
    .nt-docs-strip { background: #f7f8fc; border: 1px solid #e8ecf0; border-radius: 14px; padding: 24px; }
    .nt-doc-pill { display: flex; align-items: center; gap: 10px; background: #fff; border: 1px solid #e8ecf0; border-radius: 10px; padding: 10px 14px; }
    .nt-doc-pill i { color: var(--accent-gold); }
    .nt-section-label { display: block; color: var(--accent-gold); font-size: .8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; }
    .nt-section-title { font-size: 1.7rem; font-weight: 800; color: #1a252f; margin-bottom: 1rem; }
    .nt-step-card { background: #fff; border: 1px solid #e8ecf0; border-radius: 14px; padding: 24px; text-align: center; height: 100%; transition: all .3s ease; }
    .nt-step-card:hover { transform: translateY(-5px); box-shadow: 0 12px 28px rgba(0,0,0,.08); border-color: var(--accent-gold); }
    .nt-step-circle { width: 52px; height: 52px; background: linear-gradient(135deg, #0f1923 0%, #1a252f 100%); color: var(--accent-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; font-weight: 800; margin: 0 auto 16px; }
    .nt-mistake-item { display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #f0f4f8; }
    .nt-mistake-item:last-child { border-bottom: none; }
    .nt-benefit-item { display: flex; align-items: center; gap: 14px; padding: 14px 0; border-bottom: 1px solid #f0f4f8; }
    .nt-benefit-item:last-child { border-bottom: none; }
    .nt-benefit-icon { width: 42px; height: 42px; background: #fff8e1; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--accent-gold); flex-shrink: 0; }
    .nt-faq-item { background: #fff; border: 1px solid #e8ecf0; border-radius: 12px; margin-bottom: 12px; overflow: hidden; transition: border-color .3s; }
    .nt-faq-item:hover { border-color: var(--accent-gold); }
    .nt-faq-btn { width: 100%; text-align: left; background: transparent; border: none; padding: 20px 24px; font-weight: 600; font-size: .95rem; color: #1a252f; display: flex; justify-content: space-between; align-items: center; cursor: pointer; }
    .nt-faq-icon { width: 30px; height: 30px; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-gold); flex-shrink: 0; margin-left: 12px; transition: all .3s ease; }
    .nt-faq-btn[aria-expanded="true"] .nt-faq-icon { background: var(--accent-gold); color: #fff; transform: rotate(180deg); }
    .nt-faq-body { padding: 0 24px 20px; color: #6c757d; font-size: .9rem; line-height: 1.8; }
</style>
@endpush

@endsection

@push('schema')
,{
    "@type": "WebPage",
    "@id": "{{ url()->current() }}#webpage",
    "name": "NAVTTC Takamol Booking Pakistan | Saudi Skill Verification Program (SVP)",
    "url": "{{ url()->current() }}",
    "description": "Book your NAVTTC Takamol trade test online in Pakistan for the Saudi Arabia Skill Verification Program (SVP). Step-by-step guidance and WhatsApp support.",
    "isPartOf": { "@id": "{{ url('/') }}#website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
            { "@type": "ListItem", "position": 2, "name": "NAVTTC Takamol Booking", "item": "{{ url()->current() }}" }
        ]
    }
}
@endpush

@push('schema')
@php
    $svcRatings = \App\Models\ServiceReview::where('service', 'NAVTTC Takamol Booking')->where('status', 'approved')->pluck('rating')->filter(fn($r) => is_numeric($r));
@endphp
@if($svcRatings->count() > 0)
,{
    "@type": "Service",
    "@id": "{{ url('/') }}#navttc-service-rating",
    "name": "NAVTTC Takamol Skill Verification",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ round($svcRatings->avg(), 1) }}",
        "reviewCount": {{ $svcRatings->count() }},
        "bestRating": 5,
        "worstRating": 1
    }
}
@endif
,{
    "@type": "FAQPage",
    "@id": "{{ url()->current() }}#faqpage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "Is Takamol test mandatory for Saudi Arabia?",
            "acceptedAnswer": { "@type": "Answer", "text": "Yes, for selected technical trades, it is required under the Skill Verification Program (SVP). Without passing this test, your Saudi work visa cannot proceed." }
        },
        {
            "@type": "Question",
            "name": "How long does NAVTTC Takamol booking take?",
            "acceptedAnswer": { "@type": "Answer", "text": "Most applications are processed within 24-48 hours after document verification and submission." }
        },
        {
            "@type": "Question",
            "name": "What happens if my documents are rejected?",
            "acceptedAnswer": { "@type": "Answer", "text": "You will be asked to re-upload correct documents before resubmission. Our team will guide you through the process." }
        }
    ]
}
@endpush
