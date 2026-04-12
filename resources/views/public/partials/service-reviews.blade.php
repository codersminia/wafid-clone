{{--
    Include with: @include('public.partials.service-reviews', ['service' => 'GAMCA / WAFID Appointment'])
--}}
@php
    $totalReviews = \App\Models\ServiceReview::where('service', $service)->where('status', 'approved')->count();
    $avgRating    = \App\Models\ServiceReview::where('service', $service)->where('status', 'approved')->avg('rating') ?? 0;
@endphp

<section class="py-5" id="reviews" style="background:#fff;">
    <div class="container">

        {{-- Header --}}
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-5" style="gap:16px;">
            <div>
                <span style="display:block;color:var(--accent-gold);font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:6px;">Client Reviews</span>
                <h2 class="font-weight-bold mb-1" style="font-size:1.7rem;color:#1a252f;">What Our Clients Say</h2>
                @if($totalReviews > 0)
                <div class="d-flex align-items-center" style="gap:8px;">
                    <div>
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa{{ $i <= round($avgRating) ? 's' : 'r' }} fa-star" style="color:#FFC654;font-size:1rem;"></i>
                        @endfor
                    </div>
                    <span class="font-weight-bold" style="color:#1a252f;">{{ number_format($avgRating, 1) }}</span>
                    <span class="text-muted small">based on {{ $totalReviews }} review{{ $totalReviews > 1 ? 's' : '' }}</span>
                </div>
                @endif
            </div>
            <button type="button" data-toggle="modal" data-target="#writeReviewModal"
                class="btn font-weight-bold px-4 py-2"
                style="background:var(--accent-gold);color:#0f1923;border:none;border-radius:8px;">
                <i class="fas fa-star mr-2"></i>Write a Review
            </button>
        </div>

        {{-- Review Cards --}}
        <div class="row" id="svcReviewsGrid">
            <div class="col-12 text-center py-4">
                <div class="spinner-border text-warning" role="status"></div>
            </div>
        </div>

        {{-- Pagination --}}
        <div id="svcReviewsPagination" class="d-flex justify-content-center align-items-center mt-4" style="gap:6px;"></div>

    </div>
</section>

{{-- Write Review Modal --}}
<div class="modal fade" id="writeReviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:500px;">
        <div class="modal-content border-0" style="border-radius:16px;overflow:hidden;">

            <div class="modal-header border-0 pb-0" style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);">
                <div class="w-100 text-center py-3">
                    <h5 class="font-weight-bold text-white mb-1">Share Your Experience</h5>
                    <p class="mb-0" style="color:rgba(255,255,255,.7);font-size:.85rem;">{{ $service }}</p>
                </div>
                <button type="button" class="close position-absolute" data-dismiss="modal"
                    style="top:12px;right:16px;color:#fff;opacity:.7;">&times;</button>
            </div>

            <div class="modal-body p-4">
                <div id="svcReviewSuccess" class="text-center py-3 d-none">
                    <div style="font-size:3rem;">🎉</div>
                    <h5 class="font-weight-bold mt-2">Thank you!</h5>
                    <p class="text-muted small">Your review is pending approval and will appear shortly.</p>
                </div>

                <form id="svcReviewForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="service" value="{{ $service }}">

                    {{-- Stars --}}
                    <div class="text-center mb-4">
                        <div id="svcStars" class="d-inline-flex" style="gap:8px;">
                            @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star svc-star" data-val="{{ $i }}"
                               style="font-size:2.2rem;color:#FFC654;cursor:pointer;transition:color .15s;"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="svcRating" value="5">
                    </div>

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
                        <textarea name="review" class="form-control" rows="3"
                            placeholder="Share your experience..." maxlength="255"
                            style="resize:none;" required></textarea>
                        <small class="text-muted float-right" id="svcCharCount">0 / 255</small>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold small">Your Photo <span class="text-muted">(optional)</span></label>
                        <input type="file" name="photo" class="form-control-file" accept=".jpg,.jpeg,.png">
                        <small class="text-muted">JPG or PNG, max 2MB</small>
                    </div>

                    <button type="submit" id="svcReviewBtn" class="btn btn-block font-weight-bold py-2"
                        style="background:var(--accent-gold);color:#0f1923;border:none;border-radius:8px;">
                        <span id="svcReviewBtnText"><i class="fas fa-paper-plane mr-2"></i>Submit Review</span>
                        <span id="svcReviewBtnLoader" class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@push('head')
<style>
    .svc-review-card { background:#fff;border:1px solid #e8ecf0;border-radius:14px;padding:22px;height:100%;transition:all .3s ease; }
    .svc-review-card:hover { box-shadow:0 10px 24px rgba(0,0,0,.08);transform:translateY(-4px); }
    .svc-review-card p { overflow:hidden;display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;word-break:break-word; }
    .svc-review-avatar { width:48px;height:48px;border-radius:50%;object-fit:cover;flex-shrink:0; }
    .svc-review-avatar-placeholder { width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#0f1923,#1a252f);display:flex;align-items:center;justify-content:center;color:var(--accent-gold);font-weight:700;font-size:1.1rem;flex-shrink:0; }
</style>
@endpush

@push('scripts')
<script>
(function () {
    var service     = '{{ addslashes($service) }}';
    var csrfToken   = '{{ csrf_token() }}';

    function fetchReviews(page) {
        var grid = document.getElementById('svcReviewsGrid');
        grid.style.transition = 'opacity .25s ease';
        grid.style.opacity = '0';
        fetch('/reviews/load?page=' + page, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify({ service: service })
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            renderReviews(data);
            grid.style.opacity = '1';
        });
    }

    function stars(rating) {
        var html = '';
        for (var i = 1; i <= 5; i++) {
            html += '<i class="fa' + (i <= rating ? 's' : 'r') + ' fa-star" style="color:#FFC654;font-size:.75rem;"></i>';
        }
        return html;
    }

    function avatar(r) {
        if (r.photo) {
            return '<img src="' + r.photo + '" class="svc-review-avatar" alt="' + r.name + '">';
        }
        return '<div class="svc-review-avatar-placeholder">' + r.name.charAt(0).toUpperCase() + '</div>';
    }

    function renderReviews(data) {
        var grid = document.getElementById('svcReviewsGrid');
        if (!data.reviews.length) {
            grid.innerHTML = '<div class="col-12 text-center py-4 text-muted">' +
                '<i class="fas fa-star fa-2x mb-3 d-block" style="color:#dee2e6;"></i>' +
                '<p>No reviews yet. Be the first to share your experience!</p></div>';
            document.getElementById('svcReviewsPagination').innerHTML = '';
            return;
        }

        var html = '';
        data.reviews.forEach(function (r) {
            html += '<div class="col-lg-4 col-md-6 mb-4">' +
                '<div class="svc-review-card">' +
                '<div class="d-flex align-items-center mb-3" style="gap:12px;">' +
                avatar(r) +
                '<div><div class="font-weight-bold" style="color:#1a252f;font-size:.95rem;">' + r.name + '</div>' +
                '<div>' + stars(r.rating) + '</div></div></div>' +
                (r.review ? '<p class="text-muted small mb-0" style="line-height:1.7;">"' + r.review + '"</p>' : '') +
                '</div></div>';
        });
        grid.innerHTML = html;

        renderPagination(data.current_page, data.last_page);
    }

    function renderPagination(current, last) {
        var el = document.getElementById('svcReviewsPagination');
        if (last <= 1) { el.innerHTML = ''; return; }

        var html = '';
        var btnStyle = 'border:1px solid #e8ecf0;background:#fff;border-radius:6px;padding:6px 12px;cursor:pointer;font-size:.85rem;color:#1a252f;';
        var activeStyle = 'border:1px solid var(--accent-gold);background:var(--accent-gold);border-radius:6px;padding:6px 12px;font-size:.85rem;font-weight:700;color:#0f1923;';

        html += '<button style="' + btnStyle + '" onclick="svcLoadPage(' + (current - 1) + ')" ' + (current === 1 ? 'disabled' : '') + '>‹</button>';
        for (var i = 1; i <= last; i++) {
            html += '<button style="' + (i === current ? activeStyle : btnStyle) + '" onclick="svcLoadPage(' + i + ')">' + i + '</button>';
        }
        html += '<button style="' + btnStyle + '" onclick="svcLoadPage(' + (current + 1) + ')" ' + (current === last ? 'disabled' : '') + '>›</button>';

        el.innerHTML = html;
    }

    window.svcLoadPage = function (page) {
        if (page < 1) return;
        fetchReviews(page);
    };

    // Initial load
    fetchReviews(1);

    // ── Write Review Modal JS ──
    const svcStars  = document.querySelectorAll('.svc-star');
    const ratingIn  = document.getElementById('svcRating');
    const charCount = document.getElementById('svcCharCount');
    const textarea  = document.querySelector('#svcReviewForm textarea[name="review"]');

    svcStars.forEach(function (s) {
        s.addEventListener('click', function () {
            const val = parseInt(this.dataset.val);
            ratingIn.value = val;
            svcStars.forEach(function (st, i) { st.style.color = i < val ? '#FFC654' : '#dee2e6'; });
        });
        s.addEventListener('mouseover', function () {
            const val = parseInt(this.dataset.val);
            svcStars.forEach(function (st, i) { st.style.color = i < val ? '#FFC654' : '#dee2e6'; });
        });
        s.addEventListener('mouseout', function () {
            const val = parseInt(ratingIn.value) || 5;
            svcStars.forEach(function (st, i) { st.style.color = i < val ? '#FFC654' : '#dee2e6'; });
        });
    });

    if (textarea) {
        textarea.addEventListener('input', function () {
            charCount.textContent = this.value.length + ' / 255';
        });
    }

    document.getElementById('svcReviewForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const btn    = document.getElementById('svcReviewBtn');
        const text   = document.getElementById('svcReviewBtnText');
        const loader = document.getElementById('svcReviewBtnLoader');
        btn.disabled = true; text.classList.add('d-none'); loader.classList.remove('d-none');
        this.querySelectorAll('.is-invalid').forEach(function (el) { el.classList.remove('is-invalid'); });
        this.querySelectorAll('.invalid-feedback').forEach(function (el) { el.remove(); });
        try {
            const res  = await fetch('{{ route("review.store") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: new FormData(this),
            });
            const data = await res.json();
            if (res.status === 422) {
                Object.keys(data.errors).forEach(function (field) {
                    const input = document.querySelector('#svcReviewForm [name="' + field + '"]');
                    if (input) {
                        input.classList.add('is-invalid');
                        const err = document.createElement('div');
                        err.className = 'invalid-feedback';
                        err.textContent = data.errors[field][0];
                        input.parentNode.appendChild(err);
                    }
                });
            } else if (data.status === 'success') {
                document.getElementById('svcReviewForm').setAttribute('style', 'display:none !important');
                document.getElementById('svcReviewSuccess').classList.remove('d-none');
                setTimeout(function () { $('#writeReviewModal').modal('hide'); }, 2500);
            }
        } catch (err) { $('#writeReviewModal').modal('hide'); }
        finally { btn.disabled = false; text.classList.remove('d-none'); loader.classList.add('d-none'); }
    });

    document.getElementById('writeReviewModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('svcReviewForm').removeAttribute('style');
        document.getElementById('svcReviewSuccess').classList.add('d-none');
        document.getElementById('svcReviewForm').reset();
        svcStars.forEach(function (s) { s.style.color = '#FFC654'; });
        ratingIn.value = 5;
        if (charCount) charCount.textContent = '0 / 255';
    });
})();
</script>
@endpush
