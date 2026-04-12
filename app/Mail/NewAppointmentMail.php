<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;

class NewAppointmentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $type;
    public $appointment;
    public $logo;
    public $adminLink;
    public $fileAttachments;

    public function __construct($type, $appointment, array $attachments = [])
    {
        $this->type             = $type;
        $this->appointment      = $appointment;
        $this->fileAttachments  = $attachments;

        $logoPath        = Setting::get('logo');
        $this->logo      = $logoPath ? asset($logoPath) : null;
        $this->adminLink = 'https://gamcawafidonline.com/admin/login';
    }

    public function build()
    {
        $name = '';
        if (isset($this->appointment->first_name)) {
            $name = $this->appointment->first_name . ' ' . ($this->appointment->last_name ?? '');
        } elseif (isset($this->appointment->whatsapp_number)) {
            $name = $this->appointment->whatsapp_number;
        }

        $mail = $this->subject("New {$this->type} Appointment Booked - " . trim($name))
                     ->view('emails.new-appointment');

        foreach ($this->fileAttachments as $path) {
            if ($path && file_exists($path)) {
                $mail->attach($path, [
                    'as'   => basename($path),
                    'mime' => mime_content_type($path),
                ]);
            }
        }

        return $mail;
    }
}
