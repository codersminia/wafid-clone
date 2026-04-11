@extends('layouts.public')
@section('title', 'Leave a Review | Gulf Medical Consultant')
@section('meta_description', 'Share your experience with Gulf Medical Consultant. Rate our GAMCA, WAFID, NAVTTC, Tasheer, and Soft Skill services.')

@push('head')
<style>
    .lr-hero { background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%); padding:70px 0 55px; }
    .lr-hero h1 { color:#fff; font-size:2rem; font-weight:800; }
    .lr-hero p { color:rgba(255,255,255,.8); }
    .star-row { display:flex; gap:10px; justify-content:center; }
    .star-row i { font-size:2.5rem; color:#FFC654; cursor:pointer; transition:transform .15s; }
    .star-row i:hover { transform:scale(1.15); }
    .star-row i.dim { color:#dee2e6; }
    .service-btn { border:2px solid #e8ecf0; border-radius:10px; padding:12px 16px; cursor:pointer; transition:all .2s; text-align:center; background:#fff; }
    .service-btn:hover, .service-btn.selected { border-color:var(--accent-gold); background:#fff8e1; }
    .service-btn .svc-icon { font-size:1.5rem; margin-bottom:6px; }
    .service-btn .svc-name { font-size:.82rem; font-weight:600; color:#1a252f; }
</style>
@endpush

@section('content')

<section class="lr-hero">
    <div class="container text-center">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 mb-0 justify-content-center" style="font-size:.82rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);">Home</a></li>
                <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">Leave a Review</li>
            </ol>
        </nav>
        <div style="font-size:3rem;">⭐</div>
        <h1 class="mt-2 mb-2">Share Your Experience</h1>
        <p class="mb-0">Your honest review helps thousands of applicants choose the right service.</p>
    </div>
</section>

<section class="py-5" style="background:#f7f8fc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card shadow-sm border-0" style="border-radius:16px;">
                    <div class="card-body p-4 p-md-5">

                        <div id="lrSuccess" class="text-center py-4 d-none">
                            <div style="font-size:4rem;">🎉</div>
                            <h4 class="font-weight-bold mt-3">Thank You!</h4>
                            <p class="text-muted">Your review has been submitted and is pending approval. We appreciate your feedback!</p>
                            <a href="{{ route('home') }}" class="btn btn-dark px-4 mt-2">Back to Home</a>
                        </div>

                        <form id="lrForm" enctype="multipart/form-data">
                            @csrf

                            {{-- Step 1: Pick Service --}}
                            <h5 class="font-weight-bold mb-3">1. Which service did you use?</h5>
                            <input type="hidden" name="service" id="lrService" value="">
                            <div class="row mb-4" id="serviceGrid">
                                @php $services = [
                                    ['icon'=>'🏥','name'=>'GAMCA / WAFID Appointment',    'val'=>'GAMCA / WAFID Appointment'],
                                    ['icon'=>'🎯','name'=>'WAFID Choice Center',           'val'=>'WAFID Choice Center'],
                                    ['icon'=>'📋','name'=>'NAVTTC Takamol Booking',        'val'=>'NAVTTC Takamol Booking'],
                                    ['icon'=>'🇸🇦','name'=>'Tasheer Saudi Visa',           'val'=>'Tasheer Saudi Visa Appointment'],
                                    ['icon'=>'🎓','name'=>'Soft Skill Certificate',        'val'=>'Soft Skill Certificate'],
                                ]; @endphp
                                @foreach($services as $svc)
                                <div class="col-6 col-md-4 mb-3">
                                    <div class="service-btn" data-val="{{ $svc['val'] }}" onclick="selectService(this)">
                                        <div class="svc-icon">{{ $svc['icon'] }}</div>
                                        <div class="svc-name">{{ $svc['name'] }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div id="lrServiceError" class="text-danger small mb-3 d-none">Please select a service.</div>

                            {{-- Step 2: Rating --}}
                            <h5 class="font-weight-bold mb-3">2. Your Rating</h5>
                            <div class="star-row mb-4" id="lrStars">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star" data-val="{{ $i }}"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="lrRating" value="5">

                            {{-- Step 3: Details --}}
                            <h5 class="font-weight-bold mb-3">3. Your Details</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold small">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Your name" maxlength="100" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold small">Email <span class="text-muted">(optional)</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="your@email.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Your Review <span class="text-danger">*</span></label>
                                <textarea name="review" class="form-control" rows="4"
                                    placeholder="Share your experience in detail..." maxlength="255"
                                    style="resize:none;" required></textarea>
                                <small class="text-muted float-right" id="lrCharCount">0 / 255</small>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Your Photo <span class="text-muted">(optional)</span></label>
                                <input type="file" name="photo" class="form-control-file" accept=".jpg,.jpeg,.png">
                                <small class="text-muted">JPG or PNG, max 2MB</small>
                            </div>

                            <button type="submit" id="lrBtn" class="btn btn-block font-weight-bold py-3 mt-2"
                                style="background:var(--accent-gold);color:#0f1923;border:none;border-radius:10px;font-size:1rem;">
                                <span id="lrBtnText"><i class="fas fa-paper-plane mr-2"></i>Submit Review</span>
                                <span id="lrBtnLoader" class="spinner-border spinner-border-sm d-none"></span>
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Service selection
function selectService(el) {
    document.querySelectorAll('.service-btn').forEach(function(b){ b.classList.remove('selected'); });
    el.classList.add('selected');
    document.getElementById('lrService').value = el.dataset.val;
    document.getElementById('lrServiceError').classList.add('d-none');
}

// Pre-select from URL ?service=GAMCA
(function(){
    var params = new URLSearchParams(window.location.search);
    var svc = params.get('service');
    if (svc) {
        document.querySelectorAll('.service-btn').forEach(function(b){
            if (b.dataset.val === svc) { b.click(); }
        });
    }
})();

// Stars
var stars = document.querySelectorAll('#lrStars i');
var ratingIn = document.getElementById('lrRating');
stars.forEach(function(s){
    s.addEventListener('click', function(){
        var val = parseInt(this.dataset.val);
        ratingIn.value = val;
        stars.forEach(function(st,i){ st.classList.toggle('dim', i >= val); });
    });
    s.addEventListener('mouseover', function(){
        var val = parseInt(this.dataset.val);
        stars.forEach(function(st,i){ st.classList.toggle('dim', i >= val); });
    });
    s.addEventListener('mouseout', function(){
        var val = parseInt(ratingIn.value)||5;
        stars.forEach(function(st,i){ st.classList.toggle('dim', i >= val); });
    });
});

// Char counter
document.querySelector('textarea[name="review"]').addEventListener('input', function(){
    document.getElementById('lrCharCount').textContent = this.value.length + ' / 255';
});

// Submit
document.getElementById('lrForm').addEventListener('submit', async function(e){
    e.preventDefault();
    if (!document.getElementById('lrService').value) {
        document.getElementById('lrServiceError').classList.remove('d-none');
        document.getElementById('serviceGrid').scrollIntoView({behavior:'smooth',block:'center'});
        return;
    }
    var btn = document.getElementById('lrBtn');
    var txt = document.getElementById('lrBtnText');
    var ldr = document.getElementById('lrBtnLoader');
    btn.disabled = true; txt.classList.add('d-none'); ldr.classList.remove('d-none');
    this.querySelectorAll('.is-invalid').forEach(function(el){el.classList.remove('is-invalid');});
    this.querySelectorAll('.invalid-feedback').forEach(function(el){el.remove();});
    try {
        var res  = await fetch('{{ route("review.store") }}', {
            method:'POST',
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},
            body: new FormData(this)
        });
        var data = await res.json();
        if (res.status === 422) {
            Object.keys(data.errors).forEach(function(field){
                var input = document.querySelector('#lrForm [name="'+field+'"]');
                if (input) {
                    input.classList.add('is-invalid');
                    var err = document.createElement('div');
                    err.className = 'invalid-feedback';
                    err.textContent = data.errors[field][0];
                    input.parentNode.appendChild(err);
                }
            });
        } else if (data.status === 'success') {
            document.getElementById('lrForm').classList.add('d-none');
            document.getElementById('lrSuccess').classList.remove('d-none');
            window.scrollTo({top:0,behavior:'smooth'});
        }
    } catch(err) { alert('Something went wrong. Please try again.'); }
    finally { btn.disabled=false; txt.classList.remove('d-none'); ldr.classList.add('d-none'); }
});
</script>
@endpush
