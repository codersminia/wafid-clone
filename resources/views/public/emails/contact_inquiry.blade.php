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
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f7f6;
            padding: 40px 0;
        }

        .main-table {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            color: #333333;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #28a745;
        }

        .header {
            padding: 30px;
            text-align: center;
            background-color: #ffffff;
            border-bottom: 1px solid #eeeeee;
        }

        .logo {
            max-width: 180px;
            height: auto;
            margin-bottom: 15px;
        }

        .content {
            padding: 40px 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-row td {
            padding: 12px 0;
            border-bottom: 1px solid #f8f8f8;
            font-size: 15px;
        }

        .label {
            font-weight: 600;
            color: #666;
            width: 150px;
        }

        .value {
            color: #1a1a1a;
        }

        .message-box {
            background-color: #f9f9f9;
            padding: 20px;
            border-left: 4px solid #28a745;
            font-style: italic;
            color: #444;
            line-height: 1.6;
            margin-top: 15px;
            border-radius: 0 4px 4px 0;
        }

        .footer {
            text-align: center;
            padding: 30px;
            font-size: 13px;
            color: #888;
            background-color: #fdfdfd;
        }

        .btn-container {
            text-align: center;
            padding-top: 30px;
        }

        .button {
            display: inline-block;
            padding: 14px 35px;
            background-color: #28a745;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <center class="wrapper">
        <table class="main-table" width="100%">
            <!-- Header -->
            <tr>
                <td class="header">
                    @if($logo)
                        <img src="{{ $logo }}" alt="Site Logo" class="logo">
                    @else
                        <h2 style="margin: 0; color: #333;">New Contact Inquiry</h2>
                    @endif
                </td>
            </tr>

            <!-- Content -->
            <tr>
                <td class="content">
                    <p style="margin-top: 0; font-size: 16px; line-height: 1.6;">Hello Admin, you have received a new
                        message from the website contact form.</p>

                    <div class="section-title">Inquiry Details</div>
                    <table class="data-table">
                        <tr class="data-row">
                            <td class="label">Name:</td>
                            <td class="value">{{ $details['name'] }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class="label">Email:</td>
                            <td class="value"><a href="mailto:{{ $details['email'] }}"
                                    style="color: #28a745;">{{ $details['email'] }}</a></td>
                        </tr>
                        <tr class="data-row">
                            <td class="label">Phone:</td>
                            <td class="value">{{ $details['phone'] }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class="label">Subject:</td>
                            <td class="value">{{ $details['subject'] }}</td>
                        </tr>
                    </table>

                    <div style="margin-top: 25px;">
                        <span class="label">Message:</span>
                        <div class="message-box">
                            {!! nl2br(e($details['message'])) !!}
                        </div>
                    </div>

                    <div class="btn-container">
                        <a href="{{ $adminLink }}" class="button">Login to Admin Panel</a>
                    </div>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td class="footer">
                    &copy; {{ date('Y') }} Gamca Wafid Online. All rights reserved.<br>
                    This is an automated notification.
                </td>
            </tr>
        </table>
    </center>
</body>

</html>