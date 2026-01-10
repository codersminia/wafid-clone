<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'appointment_id',
        'payment_method',
        'passport_no',
        'mobile_no',
        'proof_image',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
