<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Inquiry</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .wrapper {
            width: 100%;
            background-color: #f7f9fc;
            padding: 40px 10px;
        }

        .main-table {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .top-accent {
            height: 8px;
            background-color: #28a745;
        }

        /* Green accent for contact */
        .header {
            padding: 40px 30px;
            text-align: center;
            background-color: #1a1a1a;
        }

        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
            filter: brightness(0) invert(1);
        }

        .title-box {
            padding: 0 30px 40px;
            text-align: center;
        }

        .title {
            font-size: 24px;
            font-weight: 800;
            color: #1a1a1a;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .content-card {
            padding: 0 30px 40px;
        }

        .message-panel {
            background-color: #f4faf6;
            border: 1px solid #d4edda;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .section-header {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }

        .data-list {
            width: 100%;
            border-collapse: collapse;
        }

        .data-item {
            padding: 12px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        }

        .label {
            font-size: 13px;
            font-weight: 600;
            color: #555;
            width: 120px;
            vertical-align: top;
        }

        .value {
            font-size: 14px;
            color: #111;
            font-weight: 500;
        }

        .message-text {
            font-size: 15px;
            line-height: 1.8;
            color: #333;
            font-style: italic;
            white-space: pre-line;
        }

        .footer {
            text-align: center;
            padding: 30px;
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .footer p {
            margin: 5px 0;
            font-size: 12px;
            opacity: 0.7;
        }

        .footer-logo {
            max-width: 120px;
            opacity: 0.8;
            margin-bottom: 15px;
            filter: brightness(0) invert(1);
        }

        .btn-container {
            text-align: center;
            padding-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 16px 45px;
            background-color: #28a745;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
        }
    </style>
</head>

<body>
    <center class="wrapper">
        <table class="main-table" width="100%">
            <tr>
                <td class="top-accent"></td>
            </tr>
            <!-- Header -->
            <tr>
                <td class="header">
                    @if($logo)
                        <img src="{{ $logo }}" alt="Site Logo" class="logo">
                    @endif
                </td>
            </tr>

            <tr>
                <td class="title-box">
                    <h1 class="title">New Message</h1>
                    <div class="subtitle">Contact Inquiry</div>
                </td>
            </tr>

            <!-- Content -->
            <tr>
                <td class="content-card">
                    <div class="section-header">Inquiry Info</div>
                    <table class="data-list" width="100%">
                        <tr>
                            <td class="data-item">
                                <table width="100%">
                                    <tr>
                                        <td class="label">Sender Name</td>
                                        <td class="value">{{ $details['name'] }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="data-item">
                                <table width="100%">
                                    <tr>
                                        <td class="label">Email Address</td>
                                        <td class="value"><a href="mailto:{{ $details['email'] }}"
                                                style="color: #28a745;">{{ $details['email'] }}</a></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="data-item">
                                <table width="100%">
                                    <tr>
                                        <td class="label">Phone/Mobile</td>
                                        <td class="value">{{ $details['phone'] }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="data-item" style="border-bottom:none;">
                                <table width="100%">
                                    <tr>
                                        <td class="label">Subjet Line</td>
                                        <td class="value">{{ $details['subject'] }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <div class="section-header" style="margin-top: 30px;">Message Content</div>
                    <div class="message-panel">
                        <div class="message-text">"{!! nl2br(e($details['message'])) !!}"</div>
                    </div>

                    <div class="btn-container">
                        <a href="{{ $adminLink }}" class="button">REPLY IN ADMIN PANEL</a>
                    </div>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td class="footer">
                    @if($logo)
                        <img src="{{ $logo }}" alt="Logo" class="footer-logo">
                    @endif
                    <p style="font-weight: bold; opacity: 1;">Gamca Wafid Online</p>
                    <p>&copy; {{ date('Y') }} All Rights Reserved.</p>
                    <p>This inquiry was sent from the website contact form.</p>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>