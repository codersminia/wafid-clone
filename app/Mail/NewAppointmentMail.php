<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;

class NewAppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $appointment;
    public $logo;
    public $adminLink;

    /**
     * Create a new message instance.
     */
    public function __construct($type, $appointment)
    {
        $this->type = $type;
        $this->appointment = $appointment;

        // Fetch logo and prepare admin link
        $logoPath = Setting::get('logo');
        $this->logo = $logoPath ? asset($logoPath) : null;
        $this->adminLink = 'https://gamcawafidonline.com/admin/login';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $name = '';
        if (isset($this->appointment->first_name)) {
            $name = $this->appointment->first_name . ' ' . ($this->appointment->last_name ?? '');
        } elseif (isset($this->appointment->whatsapp_number)) {
            $name = $this->appointment->whatsapp_number;
        }

        return $this->subject("New {$this->type} Appointment Booked - " . trim($name))
            ->view('emails.new-appointment');
    }
}
