<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavtechAppointment extends Model
{
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'navtech_appointments';

    // Fields that can be filled via the form
    protected $fillable = [
        'country',
        'city',
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
}