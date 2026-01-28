<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhatsappTrack;
use App\Models\VisitorLog;

class AnalyticsController extends Controller
{
    public function index()
    {
        $stats = [
            'total_visitors' => VisitorLog::count(),
            'today_visitors' => VisitorLog::whereDate('created_at', today())->count(),
            'total_whatsapp' => WhatsappTrack::count(),
            'today_whatsapp' => WhatsappTrack::whereDate('created_at', today())->count(),
        ];

        return view('admin.analytics.index', compact('stats'));
    }

    public function visitorsData(Request $request)
    {
        $query = VisitorLog::orderBy('created_at', 'desc');

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%{$search}%")
                    ->orWhere('page_url', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('referrer', 'like', "%{$search}%");
            });
        }

        $total = $query->count();
        $logs = $query->skip($request->start)->take($request->length)->get();

        $data = [];
        foreach ($logs as $log) {
            $location = $log->country
                ? '<div>' . $log->city . ', ' . $log->region . '</div><div class="text-muted small">' . $log->country . '</div>'
                : '<span class="text-muted small">Location Unknown</span>';

            $data[] = [
                $log->created_at->format('d M, h:i A'),
                '<a href="' . $log->page_url . '" target="_blank" class="text-primary small text-truncate d-block" style="max-width: 250px;" title="' . $log->page_url . '">' . (str_replace(url('/'), '', $log->page_url) ?: '/') . '</a>',
                $location . '<span class="label label-light-info label-inline font-weight-bold mt-1">' . $log->ip_address . '</span>',
                '<span class="text-muted small text-truncate d-block" style="max-width: 150px;" title="' . $log->referrer . '">' . ($log->referrer ?: 'Direct') . '</span>',
                $log->id
            ];
        }

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $data
        ]);
    }

    public function whatsappData(Request $request)
    {
        $query = WhatsappTrack::orderBy('created_at', 'desc');

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%{$search}%")
                    ->orWhere('page_url', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('user_agent', 'like', "%{$search}%");
            });
        }

        $total = $query->count();
        $tracks = $query->skip($request->start)->take($request->length)->get();

        $data = [];
        foreach ($tracks as $track) {
            $location = $track->country
                ? '<div>' . $track->city . ', ' . $track->region . '</div><div class="text-muted small">' . $track->country . '</div>'
                : '<span class="text-muted small">Location Unknown</span>';

            $data[] = [
                '<span class="text-info">' . $track->created_at->format('d M, h:i A') . '</span>',
                '<a href="' . $track->page_url . '" target="_blank" class="text-primary small text-truncate d-block" style="max-width: 250px;" title="' . $track->page_url . '">' . (str_replace(url('/'), '', $track->page_url) ?: '/') . '</a>',
                $location . '<span class="label label-light-dark label-inline font-weight-bold mt-1">' . $track->ip_address . '</span>',
                '<span class="text-muted small text-truncate d-block" style="max-width: 200px;" title="' . $track->user_agent . '">' . $track->user_agent . '</span>',
                $track->id
            ];
        }

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $data
        ]);
    }
}
