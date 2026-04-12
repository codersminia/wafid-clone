<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Confirmation</title>
</head>
<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8;padding:30px 0;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.08);max-width:600px;width:100%;">

        {{-- Header --}}
        <tr>
          <td style="background:linear-gradient(135deg,#0f1923 0%,#1a252f 100%);padding:28px 32px;text-align:center;">
            @if($logo)
              <img src="{{ $logo }}" alt="{{ $siteName }}" style="max-height:50px;margin-bottom:12px;display:block;margin-left:auto;margin-right:auto;">
            @endif
            <h1 style="color:#FFC654;font-size:20px;margin:0;font-weight:700;">Booking Confirmation</h1>
            <p style="color:rgba(255,255,255,.7);font-size:13px;margin:6px 0 0;">{{ $siteName }}</p>
          </td>
        </tr>

        {{-- Body --}}
        <tr>
          <td style="padding:32px;">

            <p style="color:#1a252f;font-size:15px;margin:0 0 20px;">
              Dear <strong>{{ trim(($appointment->first_name ?? '') . ' ' . ($appointment->last_name ?? '')) }}</strong>,
            </p>
            <p style="color:#555;font-size:14px;line-height:1.7;margin:0 0 24px;">
              Thank you for submitting your booking request. We have received your details and payment proof. Our team will verify your payment and process your appointment shortly.
            </p>

            {{-- Details Table --}}
            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f7f8fc;border-radius:8px;overflow:hidden;margin-bottom:24px;">
              <tr style="background:#0f1923;">
                <td colspan="2" style="padding:10px 16px;color:#FFC654;font-size:13px;font-weight:700;letter-spacing:.5px;">BOOKING DETAILS</td>
              </tr>
              @if(!empty($appointment->appointment_no))
              <tr>
                <td style="padding:10px 16px;color:#6c757d;font-size:13px;border-bottom:1px solid #e8ecf0;width:45%;">Tracking ID</td>
                <td style="padding:10px 16px;color:#1a252f;font-size:13px;font-weight:700;border-bottom:1px solid #e8ecf0;">{{ $appointment->appointment_no }}</td>
              </tr>
              @endif
              <tr>
                <td style="padding:10px 16px;color:#6c757d;font-size:13px;border-bottom:1px solid #e8ecf0;">Passport No</td>
                <td style="padding:10px 16px;color:#1a252f;font-size:13px;font-weight:700;border-bottom:1px solid #e8ecf0;">{{ $appointment->passport_no ?? '-' }}</td>
              </tr>
              @if(!empty($appointment->country_traveling_to))
              <tr>
                <td style="padding:10px 16px;color:#6c757d;font-size:13px;border-bottom:1px solid #e8ecf0;">Destination</td>
                <td style="padding:10px 16px;color:#1a252f;font-size:13px;font-weight:700;border-bottom:1px solid #e8ecf0;">{{ $appointment->country_traveling_to }}</td>
              </tr>
              @endif
              <tr>
                <td style="padding:10px 16px;color:#6c757d;font-size:13px;">WhatsApp / Phone</td>
                <td style="padding:10px 16px;color:#1a252f;font-size:13px;font-weight:700;">{{ $appointment->phone ?? '-' }}</td>
              </tr>
            </table>

            {{-- Next Steps --}}
            <p style="color:#1a252f;font-size:14px;font-weight:700;margin:0 0 12px;">What happens next?</p>
            <table width="100%" cellpadding="0" cellspacing="0">
              @foreach([
                ['1', 'Admin verifies your payment (approx 10–30 mins).'],
                ['2', 'We generate your official WAFID/GAMCA slip.'],
                ['3', 'You receive the PDF on WhatsApp at ' . ($appointment->phone ?? 'your number') . '.'],
              ] as $step)
              <tr>
                <td style="padding:6px 0;vertical-align:top;width:32px;">
                  <span style="display:inline-block;width:24px;height:24px;background:#0f1923;color:#FFC654;border-radius:50%;text-align:center;line-height:24px;font-size:12px;font-weight:700;">{{ $step[0] }}</span>
                </td>
                <td style="padding:6px 0;color:#555;font-size:13px;line-height:1.6;">{{ $step[1] }}</td>
              </tr>
              @endforeach
            </table>

            @if($proofImagePath)
            <p style="color:#555;font-size:13px;margin:20px 0 0;padding:12px 16px;background:#fff8e1;border-left:4px solid #FFC654;border-radius:0 6px 6px 0;">
              <strong>Your payment proof</strong> has been attached to this email for your records.
            </p>
            @endif

          </td>
        </tr>

        {{-- Footer --}}
        <tr>
          <td style="background:#f7f8fc;padding:20px 32px;text-align:center;border-top:1px solid #e8ecf0;">
            <p style="color:#aaa;font-size:12px;margin:0;">This is an automated confirmation. Please do not reply to this email.</p>
            <p style="color:#aaa;font-size:12px;margin:6px 0 0;">© {{ date('Y') }} {{ $siteName }}</p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
</body>
</html>
