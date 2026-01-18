<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 1. Add this

class NavtechAppointment extends Model
{
    use HasFactory, SoftDeletes; // 2. Add SoftDeletes here

    // Explicitly define the table name
    protected $table = 'navtech_appointments';

    // Fields that can be filled via the form
    protected $fillable = [
        'country',
        'whatsapp_number',
        'occupation',
        'passport_pic',
        'id_card_front',
        'user_pic',
        'is_new'
    ];

    // Ensure is_new is treated as a boolean in code
    protected $casts = [
        'is_new' => 'boolean',
    ];

    public function payment()
    {
        return $this->hasOne(NavtechPayment::class, 'navtech_appointment_id');
    }
}