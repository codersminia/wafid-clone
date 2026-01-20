<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactInquiry extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'phone', 'email', 'subject', 'message', 'ip_address', 'status', 'is_new'];
}