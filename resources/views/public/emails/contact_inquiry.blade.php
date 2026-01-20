<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Inquiry</title>
    <style>
        body { margin: 0; padding: 0; background-color: #f8f9fa; font-family: 'Arial', sans-serif; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f8f9fa; padding-bottom: 40px; }
        .main-table { background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; font-family: sans-serif; color: #333333; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-top: 5px solid #28a745; }
        .header { padding: 30px 20px; text-align: center; background-color: #ffffff; border-bottom: 1px solid #eeeeee; }
        .content { padding: 30px 20px; }
        .data-row { padding: 10px 0; border-bottom: 1px solid #f0f0f0; }
        .label { font-weight: bold; color: #555; width: 120px; display: inline-block; }
        .value { color: #333; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #888; background-color: #f8f9fa; }
        .button { display: inline-block; padding: 10px 20px; background-color: #28a745; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <center class="wrapper">
        <table class="main-table" width="100%">
            <!-- Header -->
            <tr>
                <td class="header">
                    <h2 style="margin: 0; color: #333;">New Contact Inquiry</h2>
                    <p style="margin: 5px 0 0; color: #777;">You have received a new message from the website.</p>
                </td>
            </tr>
            
            <!-- Content -->
            <tr>
                <td class="content">
                    
                    <div class="data-row">
                        <span class="label">Name:</span>
                        <span class="value">{{ $details['name'] }}</span>
                    </div>

                    <div class="data-row">
                        <span class="label">Email:</span>
                        <span class="value"><a href="mailto:{{ $details['email'] }}" style="color: #28a745;">{{ $details['email'] }}</a></span>
                    </div>

                    <div class="data-row">
                        <span class="label">Phone:</span>
                        <span class="value">{{ $details['phone'] }}</span>
                    </div>

                    <div class="data-row">
                        <span class="label">Subject:</span>
                        <span class="value">{{ $details['subject'] }}</span>
                    </div>

                    <div style="margin-top: 20px; padding-top: 15px; border-top: 2px solid #eee;">
                        <span class="label" style="display:block; margin-bottom: 8px;">Message:</span>
                        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #ddd; font-style: italic; color: #555; line-height: 1.6;">
                            {!! nl2br(e($details['message'])) !!}
                        </div>
                    </div>

                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td class="footer">
                    &copy; {{ date('Y') }} Gulf Medical Consultant. All rights reserved.<br>
                    This is an automated email.
                </td>
            </tr>
        </table>
    </center>
</body>
</html>