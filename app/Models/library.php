<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class library extends Model
{
    use HasFactory;
    protected $table = 'libraries';
    protected $fillable = [
        'library_name',
        'address',
        'contact_email',
        'contact_phone',
        'website',
        'instagram',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
        'working_hours',
    ];

}
