<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAppointmentMail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send notification to admin emails defined in settings.
     *
     * @param string $type The type of appointment (e.g., 'Wafid', 'Special', 'Tasheer')
     * @param mixed $appointment
     * @return void
     */
    public function notifyAdmin($type, $appointment)
    {
        $emailsString = Setting::get('notification_emails');

        if (!$emailsString) {
            Log::info("No admin notification emails configured.");
            return;
        }

        // Split by comma, trim whitespace, and filter empty values
        $emails = array_filter(array_map('trim', explode(',', $emailsString)));

        if (empty($emails)) {
            Log::info("Admin notification emails list is empty.");
            return;
        }

        try {
            Mail::to($emails)->send(new NewAppointmentMail($type, $appointment));
        } catch (\Exception $e) {
            Log::error("Failed to send admin notification email: " . $e->getMessage());
        }
    }
}
