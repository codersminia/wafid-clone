<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhatsappTrack;
use App\Models\VisitorLog;

class AnalyticsController extends Controller
{
    public function index()
    {
        $visitor_logs = VisitorLog::orderBy('created_at', 'desc')->paginate(50);
        $whatsapp_tracks = WhatsappTrack::orderBy('created_at', 'desc')->paginate(50);

        $stats = [
            'total_visitors' => VisitorLog::count(),
            'today_visitors' => VisitorLog::whereDate('created_at', today())->count(),
            'total_whatsapp' => WhatsappTrack::count(),
            'today_whatsapp' => WhatsappTrack::whereDate('created_at', today())->count(),
        ];

        return view('admin.analytics.index', compact('visitor_logs', 'whatsapp_tracks', 'stats'));
    }
}
