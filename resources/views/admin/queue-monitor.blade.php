@extends('layouts.admin')
@section('title', 'Queue Monitor')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            {{-- Stats --}}
            <div class="row mb-6">
                <div class="col-md-4">
                    <div class="card card-custom bg-primary text-white">
                        <div class="card-body py-4 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="font-size-h2 font-weight-boldest">{{ $pending->total() }}</div>
                                <div class="font-size-sm opacity-75">Pending Jobs</div>
                            </div>
                            <i class="fas fa-clock fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom bg-danger text-white">
                        <div class="card-body py-4 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="font-size-h2 font-weight-boldest">{{ $failed->total() }}</div>
                                <div class="font-size-sm opacity-75">Failed Jobs</div>
                            </div>
                            <i class="fas fa-times-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom bg-success text-white">
                        <div class="card-body py-4 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="font-size-sm opacity-75 mb-1">Queue Worker</div>
                                <code class="text-white" style="font-size:.8rem;">php artisan queue:work</code>
                            </div>
                            <i class="fas fa-terminal fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Jobs --}}
            <div class="card card-custom mb-6">
                <div class="card-header">
                    <h3 class="card-title">Pending Jobs</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Queue</th>
                                    <th>Job Class</th>
                                    <th>Attempts</th>
                                    <th>Available At</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pending as $job)
                                @php
                                    $payload = json_decode($job->payload, true);
                                    $jobClass = $payload['displayName'] ?? $payload['job'] ?? 'Unknown';
                                @endphp
                                <tr>
                                    <td>{{ $job->id }}</td>
                                    <td><span class="label label-inline label-light-primary font-weight-bold">{{ $job->queue }}</span></td>
                                    <td><code style="font-size:.8rem;">{{ class_basename($jobClass) }}</code></td>
                                    <td>{{ $job->attempts }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimestamp($job->available_at)->format('d M Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimestamp($job->created_at)->format('d M Y H:i') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center text-muted py-4">No pending jobs.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($pending->hasPages())
                    <div class="p-4">{{ $pending->appends(['failed_page' => request('failed_page')])->links() }}</div>
                    @endif
                </div>
            </div>

            {{-- Failed Jobs --}}
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Failed Jobs</h3>
                    <div class="card-toolbar">
                        @if($failed->total() > 0)
                        <button class="btn btn-sm btn-light-primary font-weight-bold mr-2" id="retryAllBtn">
                            <i class="fas fa-redo mr-1"></i> Retry All
                        </button>
                        <button class="btn btn-sm btn-light-danger font-weight-bold" id="clearAllBtn">
                            <i class="fas fa-trash mr-1"></i> Clear All
                        </button>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Queue</th>
                                    <th>Job Class</th>
                                    <th>Failed At</th>
                                    <th>Error</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($failed as $job)
                                @php
                                    $payload   = json_decode($job->payload, true);
                                    $jobClass  = $payload['displayName'] ?? 'Unknown';
                                    $exception = \Illuminate\Support\Str::limit($job->exception, 120);
                                @endphp
                                <tr id="failed-row-{{ $job->id }}">
                                    <td>{{ $job->id }}</td>
                                    <td><span class="label label-inline label-light-danger font-weight-bold">{{ $job->queue }}</span></td>
                                    <td><code style="font-size:.8rem;">{{ class_basename($jobClass) }}</code></td>
                                    <td>{{ \Carbon\Carbon::parse($job->failed_at)->format('d M Y H:i') }}</td>
                                    <td>
                                        <span class="text-muted small" title="{{ $job->exception }}" style="cursor:help;">
                                            {{ $exception }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-clean btn-icon retry-btn" data-id="{{ $job->id }}" title="Retry">
                                            <i class="fas fa-redo text-primary"></i>
                                        </button>
                                        <button class="btn btn-sm btn-clean btn-icon delete-failed-btn" data-id="{{ $job->id }}" title="Delete">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center text-muted py-4">No failed jobs.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($failed->hasPages())
                    <div class="p-4">{{ $failed->appends(['pending_page' => request('pending_page')])->links() }}</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
var csrf = '{{ csrf_token() }}';

// Retry single
$(document).on('click', '.retry-btn', function () {
    var id  = $(this).data('id');
    var row = $(this);
    $.post('{{ url("admin/queue-monitor/retry") }}/' + id, { _token: csrf }, function (res) {
        toastr.success(res.message);
        row.closest('tr').fadeOut();
    }).fail(function () { toastr.error('Failed to retry job.'); });
});

// Delete single failed
$(document).on('click', '.delete-failed-btn', function () {
    var id  = $(this).data('id');
    var row = $(this);
    Swal.fire({ title: 'Delete this job?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Yes' })
    .then(function (r) {
        if (!r.isConfirmed) return;
        $.ajax({ url: '{{ url("admin/queue-monitor/failed") }}/' + id, type: 'DELETE', data: { _token: csrf },
            success: function (res) { toastr.success(res.message); row.closest('tr').fadeOut(); },
            error:   function ()    { toastr.error('Failed to delete.'); }
        });
    });
});

// Retry all
$('#retryAllBtn').on('click', function () {
    $.post('{{ route("admin.queue.retry.all") }}', { _token: csrf }, function (res) {
        toastr.success(res.message);
        setTimeout(function () { location.reload(); }, 1500);
    });
});

// Clear all failed
$('#clearAllBtn').on('click', function () {
    Swal.fire({ title: 'Clear all failed jobs?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Yes, clear all' })
    .then(function (r) {
        if (!r.isConfirmed) return;
        $.ajax({ url: '{{ route("admin.queue.clear.failed") }}', type: 'DELETE', data: { _token: csrf },
            success: function (res) { toastr.success(res.message); setTimeout(function () { location.reload(); }, 1000); },
            error:   function ()    { toastr.error('Failed to clear.'); }
        });
    });
});
</script>
@endpush
