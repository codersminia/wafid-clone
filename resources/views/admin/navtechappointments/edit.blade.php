@extends('layouts.admin')
@section('title', 'Navtech Appointments')
@section('content')

    <style>
        /* Reduce spacing between form rows on mobile devices */
        @media (max-width: 991px) {

            .form-group.row,
            .row.bg-light {
                margin-bottom: 0.5rem !important;
            }

            /* Add top spacing on mobile to prevent card from touching header */
            .container {
                padding-top: 1.5rem !important;
            }
        }
    </style>
    <div class="container">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Edit NAVTTC Appointment</h3>
            </div>
            <form method="POST" action="{{ route('admin.navtech.appointments.update', $appointment->id) }}">
                @csrf
                <div class="card-body">
                    <!-- General Information -->
                    <div class="form-group row">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <label for="country">Country:</label>
                            <select required class="form-control" id="country" name="country">
                                <option value="Pakistan" {{ $appointment->country == 'Pakistan' ? 'selected' : '' }}>Pakistan
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <label for="whatsapp_number">WhatsApp Number:</label>
                            <input required type="tel" name="whatsapp_number" class="form-control" id="whatsapp_number"
                                value="{{ $appointment->whatsapp_number }}" placeholder="03xx xxxxxxx">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <label for="occupation">Occupation:</label>
                            <select required name="occupation" class="form-control" id="occupation">
                                <option value="">Select Occupation</option>
                                @php
                                    // Same list as frontend
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
                                    <option value="{{ $job }}" {{ $appointment->occupation == $job ? 'selected' : '' }}>
                                        {{ $job }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>
                    <h5>Documents</h5>
                    <div class="row text-center">
                        <div class="col-md-4 mb-4">
                            <label class="d-block font-weight-bold">Passport</label>
                            <img src="{{ asset('uploads/navtech/' . $appointment->passport_pic) }}"
                                class="img-thumbnail view-image" style="height: 150px; cursor: pointer;" data-toggle="modal"
                                data-target="#imgModal"
                                data-src="{{ asset('uploads/navtech/' . $appointment->passport_pic) }}">
                            <div class="mt-2">
                                <a href="{{ asset('uploads/navtech/' . $appointment->passport_pic) }}"
                                    download="passport_{{ $appointment->id }}"
                                    class="btn btn-sm btn-light-primary font-weight-bold">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="d-block font-weight-bold">ID Card Front</label>
                            <img src="{{ asset('uploads/navtech/' . $appointment->id_card_front) }}"
                                class="img-thumbnail view-image" style="height: 150px; cursor: pointer;" data-toggle="modal"
                                data-target="#imgModal"
                                data-src="{{ asset('uploads/navtech/' . $appointment->id_card_front) }}">
                            <div class="mt-2">
                                <a href="{{ asset('uploads/navtech/' . $appointment->id_card_front) }}"
                                    download="id_front_{{ $appointment->id }}"
                                    class="btn btn-sm btn-light-primary font-weight-bold">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="d-block font-weight-bold">User Photo</label>
                            <img src="{{ asset('uploads/navtech/' . $appointment->user_pic) }}"
                                class="img-thumbnail view-image" style="height: 150px; cursor: pointer;" data-toggle="modal"
                                data-target="#imgModal" data-src="{{ asset('uploads/navtech/' . $appointment->user_pic) }}">
                            <div class="mt-2">
                                <a href="{{ asset('uploads/navtech/' . $appointment->user_pic) }}"
                                    download="user_photo_{{ $appointment->id }}"
                                    class="btn btn-sm btn-light-primary font-weight-bold">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>

                    @if($appointment->payment)
                        <hr>
                        <div class="mt-4">
                            <h5 class="mb-3">Payment Information</h5>
                            <div class="row bg-light p-4 rounded">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <p class="mb-1 text-muted">Payment Method</p>
                                    <h6 class="font-weight-bold">{{ $appointment->payment->payment_method }}</h6>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="font-weight-bold text-muted text-uppercase small">Mobile/WhatsApp:</label>
                                    <div class="font-weight-bolder">
                                        @php
                                            // Clean the number (remove spaces, dashes, etc.) for the URL
                                            $cleanNumber = preg_replace('/\D/', '', $appointment->payment->whatsapp_number);
                                        @endphp

                                        <a href="https://wa.me/{{ $cleanNumber }}" target="_blank"
                                            class="text-dark text-hover-primary d-flex align-items-center"
                                            title="Chat on WhatsApp">
                                            <i class="fab fa-whatsapp text-success mr-2 font-size-h4"></i>
                                            {{ $appointment->payment->whatsapp_number }}
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <p class="mb-1 text-muted">Payment Proof</p>
                                    @if($appointment->payment->proof_image)
                                        <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal"
                                            data-target="#paymentProofModal">
                                            <i class="fas fa-eye"></i> View Receipt
                                        </button>
                                    @else
                                        <span class="text-muted">No image uploaded</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Modal for Payment Proof -->
                        <div class="modal fade" id="paymentProofModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Payment Receipt Preview</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        {{-- Note: User controller logic saves proof as filename only in 'uploads' --}}
                                        <img src="{{ asset('uploads/navtech/' . $appointment->payment->proof_image) }}"
                                            style="width: 200px; height: auto; border-radius: 5px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ asset('uploads/navtech/' . $appointment->payment->proof_image) }}"
                                            target="_blank" class="btn btn-primary font-weight-bold">Open in New Tab</a>
                                        <button type="button" class="btn btn-secondary font-weight-bold"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <hr>
                        <div class="alert alert-custom alert-light-warning fade show mb-5" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text font-weight-bold">This applicant has not submitted payment proof yet.</div>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.navtech.appointments') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Document Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImg" src=""
                        style="max-width: 200px; height: auto; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            // Initialize Select2
            $('#occupation').select2({
                placeholder: "Select Occupation",
                allowClear: true,
                width: '100%'
            });

            // Also apply it to City and Country if you want consistency
            $('#city').select2({ width: '100%' });
            $('#country').select2({ width: '100%' });

            // Use a specific class 'view-image' to avoid conflicts
            $('.view-image').on('click', function () {
                var imageSrc = $(this).attr('data-src');
                $('#modalImg').attr('src', imageSrc);
            });

            // Clear the source when modal is closed to prevent showing old image next time
            $('#imgModal').on('hidden.bs.modal', function () {
                $('#modalImg').attr('src', '');
            });
        });
    </script>
@endpush