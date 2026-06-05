<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhatsappTrack;
use App\Models\VisitorLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $stats = [
            // Total visit-sessions (unique IP per day) — matches table row count
            'total_visitors' => VisitorLog::selectRaw('COUNT(DISTINCT ip_address, DATE(created_at)) as cnt')
                                    ->value('cnt'),

            // Unique IPs today
            'today_visitors' => VisitorLog::distinct('ip_address')
                                    ->whereDate('created_at', Carbon::today())
                                    ->count('ip_address'),

            // Total unique IPs ever (unique people)
            'unique_ips'     => VisitorLog::distinct('ip_address')->count('ip_address'),

            'total_whatsapp' => WhatsappTrack::count(),
            'today_whatsapp' => WhatsappTrack::whereDate('created_at', Carbon::today())->count(),
        ];

        return view('admin.analytics.index', compact('stats'));
    }

    public function visitorsData(Request $request)
    {
        // Group visitor_logs by ip_address + date ONLY to form one row per visitor per day
        $query = VisitorLog::selectRaw('
                ip_address,
                MIN(country)     as country,
                MIN(region)      as region,
                MIN(city)        as city,
                MIN(referrer)    as referrer,
                DATE(created_at) as visit_date,
                MIN(created_at)  as started_at,
                COUNT(*)         as page_count
            ')
            ->groupBy('ip_address', DB::raw('DATE(created_at)'))
            ->orderBy('started_at', 'desc');

        // Date filter
        if ($request->filled('date_from')) {
            $from = Carbon::parse($request->date_from)->startOfDay();
            $to   = $request->filled('date_to')
                        ? Carbon::parse($request->date_to)->endOfDay()
                        : Carbon::parse($request->date_from)->endOfDay();
            $query->whereBetween('created_at', [$from, $to]);
        }

        // Search
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%{$search}%")
                  ->orWhere('city',     'like', "%{$search}%")
                  ->orWhere('country',  'like', "%{$search}%")
                  ->orWhere('page_url', 'like', "%{$search}%");
            });
        }

        // Count total grouped rows (subquery for accurate pagination)
        $total   = DB::table(DB::raw("({$query->toSql()}) as sub"))
                     ->mergeBindings($query->getQuery())
                     ->count();

        $records = $query->skip((int)$request->start)
                         ->take((int)$request->length)
                         ->get();

        $data = [];
        foreach ($records as $row) {

            // Location cell
            $location = $row->country
                ? '<div class="font-weight-bold">' . e($row->city) . ', ' . e($row->region) . '</div>
                   <div class="text-muted small">' . e($row->country) . '</div>'
                : '<span class="text-muted small">Unknown</span>';
            $location .= '<span class="label label-light-info label-inline font-weight-bold mt-1 d-inline-block">'
                       . e($row->ip_address) . '</span>';

            // Fetch all pages this IP visited on that date (ordered) = journey
            $pages = VisitorLog::where('ip_address', $row->ip_address)
                        ->whereDate('created_at', $row->visit_date)
                        ->orderBy('created_at', 'asc')
                        ->get(['page_url', 'created_at'])
                        ->map(fn($log) => [
                            'path' => str_replace(url('/'), '', $log->page_url) ?: '/',
                            'time' => Carbon::parse($log->created_at)->format('h:i A'),
                        ])
                        ->unique('path')
                        ->values();

            $count = $pages->count();

            // Clean vertical stepper journey
            $maxVisible = 3; // show first 3 + always show exit
            $hasMore    = $count > ($maxVisible + 1);

            $journey = '<div class="vj-stepper">';
            foreach ($pages as $i => $step) {
                $isFirst   = $i === 0;
                $isLast    = $i === $count - 1;
                $isHidden  = $hasMore && $i >= $maxVisible && !$isLast;
                $isCollapse = $hasMore && $i === $maxVisible && !$isLast; // first hidden = anchor

                if ($isFirst)    $dotClass = 'vj-dot-start';
                elseif ($isLast) $dotClass = 'vj-dot-end';
                else             $dotClass = 'vj-dot-mid';

                $label = $isFirst ? 'Entry' : ($isLast && $count > 1 ? 'Exit' : '');

                $hiddenAttr = $isHidden ? ' class="vj-step vj-step-hidden"' : ' class="vj-step' . ($isLast ? ' vj-step-last' : '') . '"';

                $journey .= '<div' . $hiddenAttr . '>';
                $journey .=   '<div class="vj-line-wrap"><div class="vj-dot ' . $dotClass . '"></div>'
                           .   ($isLast ? '' : '<div class="vj-connector"></div>')
                           . '</div>';
                $journey .=   '<div class="vj-content">';
                $journey .=     '<span class="vj-page" title="' . e($step['path']) . '">' . e($step['path']) . '</span>';
                if ($label) {
                    $journey .= '<span class="vj-tag vj-tag-' . ($isFirst ? 'start' : 'end') . '">' . $label . '</span>';
                }
                $journey .=   '</div>';
                $journey .= '</div>';

                // Insert "show more" toggle after maxVisible steps
                if ($hasMore && $i === $maxVisible - 1) {
                    $hidden = $count - $maxVisible - 1; // excludes exit which is always shown
                    $journey .= '<div class="vj-step vj-more-toggle">'
                              . '<div class="vj-line-wrap"><div class="vj-connector"></div></div>'
                              . '<div class="vj-content">'
                              . '<button class="vj-expand-btn" onclick="vjToggle(this)">+'
                              . $hidden . ' more pages</button>'
                              . '</div></div>';
                }
            }
            $journey .= '</div>';
            $journey .= '<div class="vj-meta">'
                      . '<i class="la la-file-alt mr-1"></i>' . $count . ' page' . ($count > 1 ? 's' : '')
                      . ' &nbsp;·&nbsp; <i class="la la-clock-o mr-1"></i>'
                      . Carbon::parse($row->started_at)->format('h:i A')
                      . '</div>';

            // Referrer cell
            $referrer = $row->referrer
                ? '<span class="text-muted small text-truncate d-block" style="max-width:140px;" title="' . e($row->referrer) . '">'
                  . e($row->referrer) . '</span>'
                : '<span class="label label-light-success label-inline font-weight-bold">Direct</span>';

            $data[] = [
                '<div class="font-weight-bold small">' . Carbon::parse($row->started_at)->format('d M Y') . '</div>
                 <div class="text-muted" style="font-size:.75rem;">' . Carbon::parse($row->started_at)->format('h:i A') . '</div>',
                $journey,
                $location,
                $referrer,
            ];
        }

        return response()->json([
            'draw'            => intval($request->draw),
            'recordsTotal'    => $total,
            'recordsFiltered' => $total,
            'data'            => $data,
        ]);
    }

    public function whatsappData(Request $request)
    {
        $query = WhatsappTrack::orderBy('created_at', 'desc');

        if ($request->filled('date_from')) {
            $from = Carbon::parse($request->date_from)->startOfDay();
            $to   = $request->filled('date_to')
                        ? Carbon::parse($request->date_to)->endOfDay()
                        : Carbon::parse($request->date_from)->endOfDay();
            $query->whereBetween('created_at', [$from, $to]);
        }

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%{$search}%")
                  ->orWhere('page_url',  'like', "%{$search}%")
                  ->orWhere('city',      'like', "%{$search}%")
                  ->orWhere('country',   'like', "%{$search}%")
                  ->orWhere('user_agent','like', "%{$search}%");
            });
        }

        $total  = $query->count();
        $tracks = $query->skip((int)$request->start)->take((int)$request->length)->get();

        $data = [];
        foreach ($tracks as $track) {
            $location = $track->country
                ? '<div>' . e($track->city) . ', ' . e($track->region) . '</div>
                   <div class="text-muted small">' . e($track->country) . '</div>'
                : '<span class="text-muted small">Unknown</span>';
            $location .= '<span class="label label-light-dark label-inline font-weight-bold mt-1 d-inline-block">'
                       . e($track->ip_address) . '</span>';

            $data[] = [
                '<span class="text-info font-weight-bold">' . $track->created_at->format('d M Y') . '</span>
                 <div class="text-muted small">' . $track->created_at->format('h:i A') . '</div>',
                '<a href="' . e($track->page_url) . '" target="_blank"
                    class="text-primary small text-truncate d-block" style="max-width:250px;"
                    title="' . e($track->page_url) . '">'
                    . e(str_replace(url('/'), '', $track->page_url) ?: '/') . '</a>',
                $location,
                '<span class="text-muted small text-truncate d-block" style="max-width:200px;"
                    title="' . e($track->user_agent) . '">' . e($track->user_agent) . '</span>',
            ];
        }

        return response()->json([
            'draw'            => intval($request->draw),
            'recordsTotal'    => $total,
            'recordsFiltered' => $total,
            'data'            => $data,
        ]);
    }
}
