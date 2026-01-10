@extends('layouts.admin')

@section('content')

<style>
    #imageModalImg {
        cursor: zoom-in;
        transition: transform .3s ease;
    }

    #imageModalImg.zoomed {
        transform: scale(1.8);
        cursor: zoom-out;
    }
</style>

<div class="container">
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <h3 class="card-title">Edit Registration #SKL-{{ $appointment->id }}</h3>
        </div>

        <form method="POST" action="{{ route('admin.softskill.appointments.update', $appointment->id) }}">
            @csrf

            <div class="card-body">

                {{-- WhatsApp --}}
                <div class="form-group">
                    <label>WhatsApp Number</label>
                    <input type="text"
                           name="whatsapp_number"
                           class="form-control"
                           value="{{ $appointment->whatsapp_number }}">
                </div>

                <hr>
                <h5 class="mb-4">Submitted Documents</h5>

                <div class="row text-center">
                    {{-- ID Card Front --}}
                    <div class="col-md-4">
                        <label class="font-weight-bold">ID Card Front</label>
                        <img src="{{ asset('uploads/softskill/'.$appointment->id_card_front) }}"
                             class="img-thumbnail view-image"
                             style="height:150px; cursor:pointer;"
                             data-title="ID Card Front"
                             data-src="{{ asset('uploads/softskill/'.$appointment->id_card_front) }}">
                    </div>

                    {{-- ID Card Back --}}
                    <div class="col-md-4">
                        <label class="font-weight-bold">ID Card Back</label>
                        <img src="{{ asset('uploads/softskill/'.$appointment->id_card_back) }}"
                             class="img-thumbnail view-image"
                             style="height:150px; cursor:pointer;"
                             data-title="ID Card Back"
                             data-src="{{ asset('uploads/softskill/'.$appointment->id_card_back) }}">
                    </div>

                    {{-- User Photo --}}
                    <div class="col-md-4">
                        <label class="font-weight-bold">User Photo</label>
                        <img src="{{ asset('uploads/softskill/'.$appointment->user_pic) }}"
                             class="img-thumbnail view-image"
                             style="height:150px; cursor:pointer;"
                             data-title="User Photo"
                             data-src="{{ asset('uploads/softskill/'.$appointment->user_pic) }}">
                    </div>
                </div>

                {{-- Payment Proof --}}
                @if($appointment->payment)
                    <hr>
                    <h4 class="text-primary mb-3">Payment Proof</h4>

                    <div class="row bg-light p-4 rounded align-items-center">
                        <div class="col-md-3">
                            <strong>Method:</strong><br>
                            {{ $appointment->payment->payment_method }}
                        </div>

                        <div class="col-md-3">
                            <strong>TRX ID:</strong><br>
                            <span class="text-danger font-weight-bold">
                                {{ $appointment->payment->transaction_no }}
                            </span>
                        </div>

                        <div class="col-md-3">
                            <strong>WhatsApp:</strong><br>
                            {{ $appointment->payment->whatsapp_number }}
                        </div>

                        <div class="col-md-3 text-center">
                            <button type="button"
                                    class="btn btn-sm btn-info view-image"
                                    data-title="Payment Proof"
                                    data-src="{{ asset('uploads/payments/'.$appointment->payment->proof_image) }}">
                                View Receipt
                            </button>
                        </div>
                    </div>
                @endif

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>
            </div>

        </form>
    </div>
</div>

{{-- ONE UNIVERSAL IMAGE MODAL --}}
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle">Preview</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body d-flex justify-content-center align-items-center">
                <img id="imageModalImg" class="img-fluid">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary" data-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle">Preview</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body p-2">
                <div class="image-wrapper">
                    <img id="imageModalImg">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary" data-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).on('click', '.view-image', function () {
        $('#imageModalTitle').text($(this).data('title'));
        $('#imageModalImg').attr('src', $(this).data('src'));
        $('#imageModal').modal('show');
    });
    
    $('#imageModalImg').on('click', function () {
        $(this).toggleClass('zoomed');
    });
</script>

@endpush
