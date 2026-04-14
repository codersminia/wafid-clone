<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\MedicalCenter;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $blogs = Blog::where('status', 'published')
            ->select('slug', 'updated_at')
            ->orderByDesc('published_at')
            ->get();

        $cities = MedicalCenter::select('city')
            ->distinct()
            ->pluck('city')
            ->map(fn($c) => strtolower(str_replace(' ', '-', $c)))
            ->filter()
            ->values();

        $gccCountries = [
            'saudi-arabia', 'uae', 'qatar', 'oman', 'kuwait', 'bahrain',
        ];

        $xml = view('sitemap', compact('blogs', 'cities', 'gccCountries'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
