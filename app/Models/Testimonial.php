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
        'client_position',
        'client_image',
        'rating',
        'content',
        'status',
        'is_featured',
        'display_on_homepage',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'display_on_homepage' => 'boolean',
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
