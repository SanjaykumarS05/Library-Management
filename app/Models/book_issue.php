<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class book_issue extends Model
{
    use HasFactory;

    protected $table = 'book_issues';

    protected $fillable = [
        'book_id',
        'user_id',     // received by
        'issued_id',   // issued by
        'issue_date',
        'status',
        'fine'
    ];

    protected $casts = [
        'issue_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    protected $appends = ['fine_amount'];

    public function getFineAmountAttribute()
    {
        if (!$this->issue_date) {
            return 0;
        }

        $dueDate = Carbon::parse($this->issue_date)->addDays(15);
        $today = $this->return_date ? Carbon::parse($this->return_date) : Carbon::today();

        if ($today->gt($dueDate)) {
            $daysLate = $today->diffInDays($dueDate);
            return $daysLate * 100; // ₹100 per day fine
        }

        return 0;
    }
}
