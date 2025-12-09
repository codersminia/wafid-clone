<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'city',
        'country_traveling_to',
        'first_name',
        'last_name', 
        'date_of_birth', 
        'nationality', 
        'gender', 
        'marital_status', 
        'passport_no',
        'confirm_passport_no',
        'passport_issue_date', 
        'passport_issue_place',
        'passport_expiry_date',
        'visa_type',
        'email', 
        'phone', 
        'national_id',
        'position_applied',
        'other_position', 
        'confirm_info'
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
