<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_issue extends Model
{
    use HasFactory;

    protected $table = 'book_issues';

    protected $fillable = [
        'user_id',
        'book_id',
        'issue_date',
        'return_date',
        'status',
    ];

    // Cast dates to Carbon
    protected $dates = ['issue_date', 'return_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function books()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
