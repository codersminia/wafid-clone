<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentFee extends Model
{
    use HasFactory;

    protected $fillable = ['fee_key', 'label', 'amount'];
}