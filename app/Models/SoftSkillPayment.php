<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftSkillPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'softskill_id',
        'whatsapp_number',
        'payment_method',
        'proof_image'
    ];

    // Relationship back to Certificate
    public function certificate()
    {
        return $this->belongsTo(SoftSkillCertificate::class, 'softskill_id');
    }
}
