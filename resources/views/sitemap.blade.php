<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Core pages --}}
    <url><loc>{{ url('/') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>
    <url><loc>{{ route('medicalExamination') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>{{ route('special.appointment') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>{{ route('navtechform') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>{{ route('tasheer.form') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>{{ route('softskill.form') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>
    <url><loc>{{ route('ViewMedicalCenters') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>
    <url><loc>{{ route('ViewMedicalReport') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ route('public.blogs') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>daily</changefreq><priority>0.9</priority></url>
    <url><loc>{{ route('faq') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>weekly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ route('about') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ route('contact') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ route('review.page') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>
    <url><loc>{{ route('privacy.policy') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>yearly</changefreq><priority>0.3</priority></url>
    <url><loc>{{ route('terms.conditions') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>yearly</changefreq><priority>0.3</priority></url>
    <url><loc>{{ route('refund.policy') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>yearly</changefreq><priority>0.3</priority></url>
    <url><loc>{{ route('disclaimer') }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>yearly</changefreq><priority>0.3</priority></url>

    {{-- GCC Country pages --}}
    @foreach($gccCountries as $country)
    <url><loc>{{ route('public.gcc.country', $country) }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>monthly</changefreq><priority>0.8</priority></url>
    @endforeach

    {{-- City medical center pages --}}
    @foreach($cities as $city)
    <url><loc>{{ url("/{$city}-medical-centers") }}</loc><lastmod>{{ now()->toDateString() }}</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>
    @endforeach

    {{-- Blog posts --}}
    @foreach($blogs as $blog)
    <url>
        <loc>{{ route('public.blogs.details', $blog->slug) }}</loc>
        <lastmod>{{ $blog->updated_at->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

</urlset>
