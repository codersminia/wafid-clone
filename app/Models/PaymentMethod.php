<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {
    
    protected $fillable = [
        'account_name',
        'account_title',
        'account_number',
        'iban',
        'qr_code',
        'status'
    ];
}