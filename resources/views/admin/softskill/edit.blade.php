@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">Edit Softskill Registration #SKL-{{ $appointment->id }}</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.softskill.appointments.update', $appointment->id) }}">
            @csrf
            <div class="card-body">
                <!-- General Information -->
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="whatsapp_number">WhatsApp Number:</label>
                        <input required type="tel" name="whatsapp_number" class="form-control" id="whatsapp_number" 
                            value="{{ $appointment->whatsapp_number }}" placeholder="03xx xxxxxxx">
                    </div>
                </div>

                <hr>
                <h5>Submitted Documents</h5>
                <div class="row text-center">
                    <!-- 1. ID Card Front -->
                    <div class="col-md-6 mb-4">
                        <label class="d-block font-weight-bold">ID Card Front</label>                     
                        <img src="{{ asset('uploads/softskill/' . $appointment->id_card_front) }}" 
                            class="img-thumbnail view-image" 
                            style="height: 150px; cursor: pointer;" 
                            data-toggle="modal" 
                            data-target="#imgModal" 
                            data-src="{{ asset('uploads/softskill/' . $appointment->id_card_front) }}">
                        <div class="mt-2">
                            <a href="{{ asset('uploads/softskill/' . $appointment->id_card_front) }}" download="id_front_{{ $appointment->id }}" class="btn btn-sm btn-light-primary font-weight-bold">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    </div>

                    <!-- 2. Passport Copy -->
                    <div class="col-md-6 mb-4">
                        <label class="d-block font-weight-bold">Passport Copy</label>
                        <img src="{{ asset('uploads/softskill/' . $appointment->passport_pic) }}" 
                            class="img-thumbnail view-image" 
                            style="height: 150px; cursor: pointer;" 
                            data-toggle="modal" 
                            data-target="#imgModal" 
                            data-src="{{ asset('uploads/softskill/' . $appointment->passport_pic) }}">
                        <div class="mt-2">
                            <a href="{{ asset('uploads/softskill/' . $appointment->passport_pic) }}" download="passport_{{ $appointment->id }}" class="btn btn-sm btn-light-primary font-weight-bold">
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
                            <div class="col-md-4">
                                <p class="mb-1 text-muted">Payment Method</p>
                                <h6 class="font-weight-bold">{{ $appointment->payment->payment_method }}</h6>
                            </div>
                            <div class="col-md-4">
                                <label class="font-weight-bold text-muted text-uppercase small">Mobile/WhatsApp:</label>
                                <div class="font-weight-bolder">
                                    @php
                                        $cleanNumber = preg_replace('/\D/', '', $appointment->payment->whatsapp_number);
                                    @endphp
                                    
                                    <a href="https://wa.me/{{ $cleanNumber }}" 
                                    target="_blank" 
                                    class="text-dark text-hover-primary d-flex align-items-center" 
                                    title="Chat on WhatsApp">
                                        <i class="fab fa-whatsapp text-success mr-2 font-size-h4"></i>
                                        {{ $appointment->payment->whatsapp_number }}
                                    </a>
                                </div>
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
                                    <img src="{{ asset('uploads/payments/' . $appointment->payment->proof_image) }}" style="width: 200px; height: auto; border-radius: 5px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ asset('uploads/payments/' . $appointment->payment->proof_image) }}" target="_blank" class="btn btn-primary font-weight-bold">Open in New Tab</a>
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
                <a href="{{ route('admin.softskill.appointments') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Documents -->
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
            <div class="modal-footer">                
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.view-image').on('click', function() {
            var imageSrc = $(this).attr('data-src');
            $('#modalImg').attr('src', imageSrc);
        });

        $('#imgModal').on('hidden.bs.modal', function () {
            $('#modalImg').attr('src', '');
        });
    });
</script>
@endpush