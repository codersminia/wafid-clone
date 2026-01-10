<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavtechPayment extends Model
{
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'navtech_payments';

    // Fields that can be filled via the form
    protected $fillable = [
        'navtech_appointment_id',
        'whatsapp_number',
        'payment_method',
        'proof_image'
    ];

    public function appointment()
    {
        return $this->belongsTo(NavtechAppointment::class, 'navtech_appointment_id');
    }
}