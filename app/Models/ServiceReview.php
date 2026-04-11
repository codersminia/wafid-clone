<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
    protected $table = 'service_reviews';

    protected $fillable = [
        'name', 'email', 'phone', 'service', 'rating',
        'review', 'photo', 'status', 'is_featured',
        'display_on_homepage', 'admin_note', 'ip_address',
    ];
}
