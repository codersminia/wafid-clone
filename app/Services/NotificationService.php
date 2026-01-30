<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAppointmentMail;
use App\Mail\ContactInquiryMail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Get admin emails from settings.
     */
    protected function getAdminEmails()
    {
        $emailsString = Setting::get('notification_emails');

        if (!$emailsString) {
            return [];
        }

        // Split by comma, trim whitespace, and filter empty values
        return array_filter(array_map('trim', explode(',', $emailsString)));
    }

    /**
     * Notify admin about a new appointment.
     */
    public function notifyAppointment($type, $appointment)
    {
        $emails = $this->getAdminEmails();

        if (empty($emails)) {
            Log::info("No admin notification emails configured for appointment.");
            return;
        }

        try {
            Mail::to($emails)->send(new NewAppointmentMail($type, $appointment));
        } catch (\Exception $e) {
            Log::error("Failed to send appointment notification: " . $e->getMessage());
        }
    }

    /**
     * Notify admin about a new contact inquiry.
     */
    public function notifyContactInquiry($details)
    {
        $emails = $this->getAdminEmails();

        if (empty($emails)) {
            // Fallback for safety if someone expects the hardcoded one, 
            // but user asked to use the notification emails.
            Log::info("No admin notification emails configured for contact inquiry.");
            return;
        }

        try {
            Mail::to($emails)->send(new ContactInquiryMail($details));
        } catch (\Exception $e) {
            Log::error("Failed to send contact inquiry notification: " . $e->getMessage());
        }
    }
}
