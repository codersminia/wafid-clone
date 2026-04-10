<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
    .container { max-width: 700px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
    .header { background: #c0392b; color: #fff; padding: 20px 30px; }
    .header h1 { margin: 0; font-size: 1.3rem; }
    .header p { margin: 4px 0 0; opacity: .85; font-size: .9rem; }
    .body { padding: 24px 30px; }
    .row { margin-bottom: 16px; }
    .label { font-size: .75rem; font-weight: 700; text-transform: uppercase; color: #888; margin-bottom: 4px; }
    .value { font-size: .95rem; color: #222; word-break: break-all; }
    .badge { display: inline-block; background: #c0392b; color: #fff; font-size: .75rem; padding: 2px 10px; border-radius: 20px; }
    .trace { background: #1e1e1e; color: #d4d4d4; font-family: monospace; font-size: .78rem; padding: 16px; border-radius: 6px; white-space: pre-wrap; word-break: break-all; line-height: 1.6; }
    .footer { background: #f9f9f9; padding: 14px 30px; font-size: .8rem; color: #aaa; border-top: 1px solid #eee; }
    hr { border: none; border-top: 1px solid #eee; margin: 20px 0; }
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🚨 Application Error Detected</h1>
        <p>{{ $occurredAt }} &nbsp;|&nbsp; <span style="opacity:.9;">{{ $appEnv }}</span></p>
    </div>
    <div class="body">

        <div class="row">
            <div class="label">Exception Type</div>
            <div class="value"><span class="badge">{{ $errorClass }}</span></div>
        </div>

        <div class="row">
            <div class="label">Error Message</div>
            <div class="value">{{ $errorMessage }}</div>
        </div>

        <div class="row">
            <div class="label">Request</div>
            <div class="value">
                <strong>{{ $requestMethod }}</strong> &nbsp;
                <a href="{{ $requestUrl }}" style="color:#c0392b;">{{ $requestUrl }}</a>
            </div>
        </div>

        <div class="row">
            <div class="label">File</div>
            <div class="value">{{ $errorFile }} <strong>: line {{ $errorLine }}</strong></div>
        </div>

        <hr>

        <div class="row">
            <div class="label">Stack Trace (first 15 lines)</div>
            <div class="trace">{{ $errorTrace }}</div>
        </div>

    </div>
    <div class="footer">
        This alert was sent automatically by {{ config('app.name') }} error monitoring.
    </div>
</div>
</body>
</html>
