<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;

class ContactInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $logo;
    public $adminLink;

    public function __construct($details)
    {
        $this->details = $details;

        // Fetch logo and prepare admin link
        $logoPath = Setting::get('logo');
        $this->logo = $logoPath ? asset($logoPath) : null;
        $this->adminLink = 'https://gamcawafidonline.com/admin/login';
    }

    public function build()
    {
        return $this->subject('New Contact Inquiry: ' . $this->details['subject'])
            ->view('public.emails.contact_inquiry');
    }
}
