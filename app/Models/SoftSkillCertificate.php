<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftSkillCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'whatsapp_number', 
        'id_card_front', 
        'id_card_back', 
        'user_pic'
    ];

    // Relationship to Payment
    public function payment()
    {
        return $this->hasOne(SoftSkillPayment::class, 'softskill_id');
    }
}