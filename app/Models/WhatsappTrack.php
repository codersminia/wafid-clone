<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappTrack extends Model
{
    use HasFactory;
    protected $fillable = ['ip_address', 'user_agent', 'page_url', 'country', 'region', 'city'];
}
