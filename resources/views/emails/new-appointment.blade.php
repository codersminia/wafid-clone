<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .header {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .details {
            margin-bottom: 20px;
        }

        .footer {
            font-size: 0.8em;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>New {{ $type }} Appointment Booked</h2>
        </div>

        <div class="details">
            <p>A new appointment has been booked on the website.</p>

            <h3>Appointment Details:</h3>
            <ul>
                @if(isset($appointment->appointment_no))
                    <li><strong>Appointment No:</strong> {{ $appointment->appointment_no }}</li>
                @endif

                @if(isset($appointment->first_name))
                    <li><strong>Name:</strong> {{ $appointment->first_name }} {{ $appointment->last_name ?? '' }}</li>
                @endif

                @if(isset($appointment->passport_no))
                    <li><strong>Passport:</strong> {{ $appointment->passport_no }}</li>
                @endif

                @if(isset($appointment->phone))
                    <li><strong>Phone:</strong> {{ $appointment->phone }}</li>
                @endif

                @if(isset($appointment->whatsapp_number))
                    <li><strong>WhatsApp:</strong> {{ $appointment->whatsapp_number }}</li>
                @endif

                @if(isset($appointment->country))
                    <li><strong>Country:</strong> {{ $appointment->country }}</li>
                @endif

                @if(isset($appointment->city))
                    <li><strong>City:</strong> {{ $appointment->city }}</li>
                @endif

                @if(isset($appointment->occupation))
                    <li><strong>Occupation:</strong> {{ $appointment->occupation }}</li>
                @endif

                @if(isset($appointment->visa_type))
                    <li><strong>Visa Type:</strong> {{ $appointment->visa_type }}</li>
                @endif

                <li><strong>Booked At:</strong> {{ now()->format('d M Y, h:i A') }}</li>
            </ul>
        </div>

        <p>Please log in to the admin panel to view full details and verification status.</p>

        <div class="footer">
            <p>This is an automated notification from Wafid Clone Admin.</p>
        </div>
    </div>
</body>

</html>