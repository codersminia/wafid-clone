<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class SpecialAppointment extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'appointment_no',
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
        'country',
        'city',
        'medical_center',
        'country_traveling_to',
        'confirm_info',
        'is_new', 
    ];

    // Dates that should be treated as Carbon instances
    protected $dates = ['deleted_at']; 
    
    public function specialPayment()
    {
        return $this->hasOne(SpecialPayment::class);
    }
}