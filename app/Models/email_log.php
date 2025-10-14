<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class email_log extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_id',
        'email',
        'subject',
        'message',
        'status',
        'type',
        'sent_at',
    ];

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
