<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'client_name',
        'client_email',
        'client_company',
        'client_position',
        'client_image',
        'rating',
        'title',
        'content',
        'office_city',
        'review_date',
        'status',
        'is_featured',
        'display_on_homepage',
        'published_at'
    ];

    protected $casts = [
        'review_date' => 'datetime',
        'is_featured' => 'boolean',
        'display_on_homepage' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeOnHomepage($query)
    {
        return $query->where('display_on_homepage', true);
    }
}
