<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoftSkillCertificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'whatsapp_number',
        'id_card_front',
        'id_card_back',
        'user_pic',
        'is_new',
        'passport_pic',
    ];

    protected $dates = ['deleted_at'];

    public function payment()
    {
        return $this->hasOne(SoftSkillPayment::class, 'softskill_id');
    }
}