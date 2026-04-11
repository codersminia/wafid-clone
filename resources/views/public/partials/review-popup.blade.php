{{-- Review Popup — include on thank you pages with @include('public.partials.review-popup', ['service' => 'Service Name']) --}}

<div class="modal fade" id="reviewPopupModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:480px;">
        <div class="modal-content border-0" style="border-radius:16px;overflow:hidden;">

            {{-- Header --}}
            <div class="modal-header border-0 pb-0" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
                <div class="w-100 text-center py-3">
                    <div style="font-size:2.5rem;">⭐</div>
                    <h5 class="font-weight-bold text-white mb-1">How was your experience?</h5>
                    <p class="mb-0" style="color:rgba(255,255,255,.7);font-size:.85rem;">Your feedback helps us improve our service</p>
                </div>
                <button type="button" class="close position-absolute" data-dismiss="modal" style="top:12px;right:16px;color:#fff;opacity:.7;">&times;</button>
            </div>

            {{-- Body --}}
            <div class="modal-body p-4">
                <div id="reviewPopupSuccess" class="text-center py-3 d-none">
                    <div style="font-size:3rem;">🎉</div>
                    <h5 class="font-weight-bold mt-2">Thank you!</h5>
                    <p class="text-muted small">Your review has been submitted.</p>
                </div>

                <form id="reviewPopupForm" class="d-block">
                    @csrf
                    <input type="hidden" name="service" value="{{ $service ?? 'General' }}">

                    {{-- Star Rating --}}
                    <div class="text-center mb-4">
                        <div id="popupStars" class="d-inline-flex" style="gap:8px;">
                            @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star popup-star" data-val="{{ $i }}"
                               style="font-size:2.2rem;color:#FFC654;cursor:pointer;transition:color .15s;"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="popupRating" value="5">
                        <div id="popupRatingError" class="text-danger small mt-1 d-none">Please select a rating.</div>
                    </div>

                    {{-- Name --}}
                    <div class="form-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Your name *" maxlength="100" required style="border-radius:8px;">
                    </div>

                    {{-- Review (optional) --}}
                    <div class="form-group mb-4">
                        <textarea name="review" class="form-control" rows="3"
                            placeholder="Share your experience (optional, max 255 characters)"
                            maxlength="255" style="border-radius:8px;resize:none;"></textarea>
                        <small class="text-muted float-right" id="reviewCharCount">0 / 255</small>
                    </div>

                    <button type="submit" id="reviewPopupBtn" class="btn btn-block font-weight-bold py-2"
                        style="background:var(--accent-gold);color:#0f1923;border-radius:8px;">
                        <span id="reviewPopupBtnText"><i class="fas fa-paper-plane mr-2"></i>Submit Review</span>
                        <span id="reviewPopupBtnLoader" class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </form>
            </div>

            {{-- Skip --}}
            <div class="text-center pb-3">
                <button type="button" data-dismiss="modal" class="btn btn-link text-muted small p-0">
                    Skip for now
                </button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    // Auto-open after 3 seconds if not already submitted this session
    if (!sessionStorage.getItem('review_submitted_{{ Str::slug($service ?? "general") }}')) {
        setTimeout(function () {
            $('#reviewPopupModal').modal('show');
        }, 3000);
    }

    // Star interaction
    const stars = document.querySelectorAll('.popup-star');
    const ratingInput = document.getElementById('popupRating');

    stars.forEach(function (star) {
        star.addEventListener('click', function () {
            const val = parseInt(this.dataset.val);
            ratingInput.value = val;
            stars.forEach(function (s, i) {
                s.style.color = i < val ? '#FFC654' : '#dee2e6';
            });
            document.getElementById('popupRatingError').classList.add('d-none');
        });
        star.addEventListener('mouseover', function () {
            const val = parseInt(this.dataset.val);
            stars.forEach(function (s, i) {
                s.style.color = i < val ? '#FFC654' : '#dee2e6';
            });
        });
        star.addEventListener('mouseout', function () {
            const val = parseInt(ratingInput.value) || 0;
            stars.forEach(function (s, i) {
                s.style.color = i < val ? '#FFC654' : '#dee2e6';
            });
        });
    });

    // Char counter
    const reviewTA = document.querySelector('#reviewPopupForm textarea[name="review"]');
    if (reviewTA) {
        reviewTA.addEventListener('input', function () {
            document.getElementById('reviewCharCount').textContent = this.value.length + ' / 255';
        });
    }

    // Form submit
    document.getElementById('reviewPopupForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        if (!ratingInput.value) {
            document.getElementById('popupRatingError').classList.remove('d-none');
            return;
        }

        const btn     = document.getElementById('reviewPopupBtn');
        const btnText = document.getElementById('reviewPopupBtnText');
        const loader  = document.getElementById('reviewPopupBtnLoader');
        btn.disabled  = true;
        btnText.classList.add('d-none');
        loader.classList.remove('d-none');

        try {
            const res  = await fetch('{{ route("review.store") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: new FormData(this),
            });
            const data = await res.json();

            if (data.status === 'success') {
                sessionStorage.setItem('review_submitted_{{ Str::slug($service ?? "general") }}', '1');
                document.getElementById('reviewPopupForm').classList.add('d-none');
                document.getElementById('reviewPopupSuccess').classList.remove('d-none');
                setTimeout(function () { $('#reviewPopupModal').modal('hide'); }, 2500);
            }
        } catch (err) {
            // silent fail — don't block the user
            $('#reviewPopupModal').modal('hide');
        } finally {
            btn.disabled = false;
            btnText.classList.remove('d-none');
            loader.classList.add('d-none');
        }
    });
})();
</script>
@endpush
