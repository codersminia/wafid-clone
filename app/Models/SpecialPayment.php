<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'special_payments';

    protected $fillable = [
        'special_appointment_id',
        'passport_no',
        'mobile_no',
        'transaction_no',
        'payment_method',
        'proof_image',
    ];
}
