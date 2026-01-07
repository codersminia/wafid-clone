@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card card-custom gutter-b">
        <div class="card-header"><h3 class="card-title">Edit Tasheer Appointment #TSH-{{ $appointment->id }}</h3></div>
        <form method="POST" action="{{ route('admin.tasheer.appointments.update', $appointment->id) }}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Embassy Center:</label>
                        <select name="embassy" class="form-control">
                            <option value="Karachi" {{ $appointment->embassy == 'Karachi' ? 'selected' : '' }}>Karachi</option>
                            <option value="Lahore" {{ $appointment->embassy == 'Lahore' ? 'selected' : '' }}>Lahore</option>
                            <option value="Islamabad" {{ $appointment->embassy == 'Islamabad' ? 'selected' : '' }}>Islamabad</option>
                            <option value="Peshawar" {{ $appointment->embassy == 'Peshawar' ? 'selected' : '' }}>Peshawar</option>
                            <option value="Quetta" {{ $appointment->embassy == 'Quetta' ? 'selected' : '' }}>Quetta</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>WhatsApp:</label>
                        <input type="text" name="whatsapp_number" class="form-control" value="{{ $appointment->whatsapp_number }}">
                    </div>
                </div>

                <hr><h5>Documents</h5>
                <div class="text-center">
                    <label class="d-block font-weight-bold">Passport Copy</label>
                    <img src="{{ asset('uploads/' . $appointment->passport_pic) }}" class="img-thumbnail view-image" style="height: 180px; cursor: pointer;" data-toggle="modal" data-target="#imgModal" data-src="{{ asset('uploads/' . $appointment->passport_pic) }}">
                </div>

                @if($appointment->payment)
                <hr><h3 class="mb-3 text-primary">Payment Information (PKR 500)</h3>
                <div class="row bg-light p-4 rounded">
                    <div class="col-md-4"><strong>Method:</strong> {{ $appointment->payment->payment_method }}</div>
                    <div class="col-md-4"><strong>TRX ID:</strong> <span class="text-danger">{{ $appointment->payment->transaction_no }}</span></div>
                    <div class="col-md-4"><button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#payModal">View Receipt</button></div>
                </div>
                @endif
            </div>
            <div class="card-footer"><button type="submit" class="btn btn-primary">Update</button></div>
        </form>
    </div>
</div>

<!-- Modals for Documents and Payment Receipts (Re-use your existing ones) -->
<div class="modal fade" id="imgModal" tabindex="-1" role="dialog"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-body text-center"><img id="modalImg" style="max-width: 100%;"></div></div></div></div>
<div class="modal fade" id="payModal" tabindex="-1" role="dialog"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-body text-center"><img src="{{ $appointment->payment ? asset('uploads/'.$appointment->payment->proof_image) : '' }}" style="max-width: 100%;"></div></div></div></div>

<script>
    $('.view-image').click(function(){ $('#modalImg').attr('src', $(this).data('src')); });
</script>
@endsection