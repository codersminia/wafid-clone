<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;

class AppointmentConfirmationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $appointment;
    public $proofImagePath; // full filesystem path to the uploaded proof image
    public $logo;
    public $siteName;

    public function __construct($appointment, $proofImagePath = null)
    {
        $this->appointment    = $appointment;
        $this->proofImagePath = $proofImagePath;

        $logoPath       = Setting::get('logo');
        $this->logo     = $logoPath ? asset($logoPath) : null;
        $this->siteName = Setting::get('site_name') ?? 'Gulf Medical Consultants';
    }

    public function build()
    {
        $name = trim(($this->appointment->first_name ?? '') . ' ' . ($this->appointment->last_name ?? ''));

        $mail = $this->subject('Booking Confirmation – ' . $this->siteName)
                     ->view('emails.appointment-confirmation');

        if ($this->proofImagePath && file_exists($this->proofImagePath)) {
            $mail->attach($this->proofImagePath, [
                'as'   => 'payment-proof.' . pathinfo($this->proofImagePath, PATHINFO_EXTENSION),
                'mime' => mime_content_type($this->proofImagePath),
            ]);
        }

        return $mail;
    }
}
