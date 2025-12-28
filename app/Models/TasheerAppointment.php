<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TasheerAppointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'embassy',
        'whatsapp_number',
        'passport_pic',
        'is_new'
    ];

    protected $casts = [
        'is_new' => 'boolean',
    ];

    public function payment()
    {
        return $this->hasOne(TasheerPayment::class, 'tasheer_appointment_id');
    }
}