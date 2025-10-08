<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_issue extends Model
{
    use HasFactory;
    Protected $fillable = [
        'user_id',
        'book_id',
        'issue_date',
        'return_date',
        'status',
    ];
}
