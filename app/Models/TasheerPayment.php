<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasheerPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tasheer_appointment_id',
        'whatsapp_number',
        'payment_method',
        'transaction_no',
        'proof_image'
    ];


    public function appointment()
    {
        return $this->belongsTo(TasheerAppointment::class, 'tasheer_appointment_id');
    }
}