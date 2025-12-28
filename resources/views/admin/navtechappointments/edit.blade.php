@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header"><h3 class="card-title">Edit Navtech Appointment</h3></div>
        <form method="POST" action="{{ route('admin.navtech.appointments.update', $appointment->id) }}">
            @csrf
            <div class="card-body">
                <!-- General Information -->
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="country">Country:</label>
                        <select required class="form-control" id="country" name="country">
                            <option value="Pakistan" {{ $appointment->country == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>                                            
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="city">City:</label>
                        <select required name="city" class="form-control" id="city">
                            <option value="">Select City</option>
                            @php
                                $cities = ['Islamabad', 'Karachi', 'Lahore', 'Peshawar', 'Quetta', 'Multan', 'Sialkot', 'Faisalabad'];
                            @endphp
                            @foreach($cities as $city)
                                <option value="{{ $city }}" {{ $appointment->city == $city ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="whatsapp_number">WhatsApp Number:</label>
                        <input required type="tel" name="whatsapp_number" class="form-control" id="whatsapp_number" 
                            value="{{ $appointment->whatsapp_number }}" placeholder="03xx xxxxxxx">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="occupation">Occupation:</label>
                        <select required name="occupation" class="form-control" id="occupation">
                            <option value="">Select Occupation</option>
                            @php
                                $occupations = [
                                    'Electrician' => 'Building Electrician',
                                    'Plumber' => 'Plumber',
                                    'Carpenter' => 'Carpenter',
                                    'Mason' => 'Mason',
                                    'Welder' => 'Welder',
                                    'Painter' => 'Painter',
                                    'AC Technician' => 'AC Technician',
                                    'Other' => 'Other'
                                ];
                            @endphp
                            @foreach($occupations as $value => $label)
                                <option value="{{ $value }}" {{ $appointment->occupation == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr>
                <h5>Documents</h5>
                <div class="row text-center">
                    <div class="col-md-4">
                        <label class="d-block font-weight-bold">Passport</label>                     
                        <img src="{{ asset('uploads/' . $appointment->passport_pic) }}" 
                             class="img-thumbnail view-image" 
                             style="height: 150px; cursor: pointer;" 
                             data-toggle="modal" 
                             data-target="#imgModal" 
                             data-src="{{ asset('uploads/' . $appointment->passport_pic) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="d-block font-weight-bold">ID Card Front</label>
                        <img src="{{ asset('uploads/' . $appointment->id_card_front) }}" 
                             class="img-thumbnail view-image" 
                             style="height: 150px; cursor: pointer;" 
                             data-toggle="modal" 
                             data-target="#imgModal" 
                             data-src="{{ asset('uploads/' . $appointment->id_card_front) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="d-block font-weight-bold">User Photo</label>
                        <img src="{{ asset('uploads/' . $appointment->user_pic) }}" 
                             class="img-thumbnail view-image" 
                             style="height: 150px; cursor: pointer;" 
                             data-toggle="modal" 
                             data-target="#imgModal" 
                             data-src="{{ asset('uploads/' . $appointment->user_pic) }}">
                    </div>
                </div>

                @if($appointment->payment)
                    <hr>
                    <div class="mt-4">
                        <h3 class="mb-3 text-primary">Payment Information</h3>
                        <div class="row bg-light p-4 rounded">
                            <div class="col-md-4">
                                <p class="mb-1 text-muted">Payment Method</p>
                                <h6 class="font-weight-bold">{{ $appointment->payment->payment_method }}</h6>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-1 text-muted">Transaction ID / TRX</p>
                                <h6 class="font-weight-bold text-danger">{{ $appointment->payment->transaction_no }}</h6>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-1 text-muted">Payment Proof</p>
                                @if($appointment->payment->proof_image)
                                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#paymentProofModal">
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
                                    <img src="{{ asset('uploads/' . $appointment->payment->proof_image) }}" style="max-width: 100%; height: auto;">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Close</button>
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
                <img id="modalImg" src="" style="max-width: 200px; height: auto; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Use a specific class 'view-image' to avoid conflicts
        $('.view-image').on('click', function() {
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