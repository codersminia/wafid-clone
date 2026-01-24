<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateFeedback extends Model
{
    use HasFactory;

    protected $table = 'private_feedback';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'office_city',
        'rating',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function testimonial()
    {
        return $this->belongsTo(Testimonial::class);
    }
}
