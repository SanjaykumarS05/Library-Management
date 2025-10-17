<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Book_issue;
use Carbon\Carbon;

class MyhistoryController extends Controller
{
    public function borrowingHistory()
    {
        $user = Auth::user();

        // Fetch all book issues for this user
        $bookIssues = Book_issue::with('book')
            ->where('user_id', $user->id)
            ->orderBy('issue_date', 'desc')
            ->get();

        // Calculate summary counts
        $currentlyBorrowed = $bookIssues->where('status','Issued')->count();
        $overdue = $bookIssues->filter(function ($issue) {
            return $issue->status === 'Active' && Carbon::parse($issue->due_date)->isPast();
        })->count();
        $returned = $bookIssues->where('status', 'Returned')->count();
        $totalHistory = $bookIssues->count();

        return view('user.history', compact(
            'bookIssues',
            'currentlyBorrowed',
            'overdue',
            'returned',
            'totalHistory'
        ));
    }
}
