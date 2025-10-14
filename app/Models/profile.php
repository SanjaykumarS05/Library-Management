<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $fillable = [
        'profile_image_path',
        'user_id',
        'secondary_email',
        'blood_group',
        'dob',
        'gender',
        'designation',
        'phone',
        'address',
        'qualification',
        'theme',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
