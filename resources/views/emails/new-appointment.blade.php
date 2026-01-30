<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New {{ $type }} Appointment</title>
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
        }

        .header {
            padding: 30px;
            text-align: center;
            background-color: #ffffff;
            border-bottom: 4px solid #FFC654;
        }

        .logo {
            max-width: 180px;
            height: auto;
            margin-bottom: 15px;
        }

        .type-badge {
            display: inline-block;
            padding: 5px 15px;
            background-color: #FFC654;
            color: #000;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            margin-top: 10px;
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
            background-color: #2b2b2b;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s;
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
                        <h1 style="margin:0; color:#1a1a1a;">GAMCA WAFID</h1>
                    @endif
                    <div class="type-badge">New {{ $type }} Appointment</div>
                </td>
            </tr>

            <!-- Content -->
            <tr>
                <td class="content">
                    <p style="margin-top: 0; font-size: 16px; line-height: 1.6;">Hello Admin, you have received a new
                        <strong>{{ $type }}</strong> appointment booking. Below are the details:</p>

                    <div class="section-title">Appointment Details</div>
                    <table class="data-table">
                        @php
                            $fields = [
                                'appointment_no' => 'Appointment No',
                                'first_name' => 'First Name',
                                'last_name' => 'Last Name',
                                'passport_no' => 'Passport No',
                                'phone' => 'Phone',
                                'whatsapp_number' => 'WhatsApp',
                                'email' => 'Email',
                                'country' => 'Country',
                                'city' => 'City',
                                'occupation' => 'Occupation',
                                'visa_type' => 'Visa Type',
                                'medical_center' => 'Medical Center',
                                'nationality' => 'Nationality',
                                'gender' => 'Gender',
                                'marital_status' => 'Marital Status',
                            ];
                        @endphp

                        @foreach($fields as $key => $label)
                            @if(isset($appointment->$key) && !empty($appointment->$key))
                                <tr class="data-row">
                                    <td class="label">{{ $label }}:</td>
                                    <td class="value">
                                        @if($key === 'email')
                                            <a href="mailto:{{ $appointment->$key }}"
                                                style="color: #0066cc;">{{ $appointment->$key }}</a>
                                        @else
                                            {{ $appointment->$key }}
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        <tr class="data-row">
                            <td class="label">Booked At:</td>
                            <td class="value">{{ now()->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>

                    <div class="btn-container">
                        <a href="{{ $adminLink }}" class="button">Login to Admin Panel</a>
                    </div>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td class="footer">
                    &copy; {{ date('Y') }} Gamca Wafid Online. All rights reserved.<br>
                    This is an automated notification. Please do not reply to this email.
                </td>
            </tr>
        </table>
    </center>
</body>

</html>