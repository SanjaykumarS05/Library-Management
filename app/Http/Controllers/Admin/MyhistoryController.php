<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Book_issue;
use Carbon\Carbon;

class MyhistoryController extends Controller
{
    public function borrowingHistory()
    {
        $user = Auth::user();

       
        $bookIssues = Book_issue::with('book')
            ->where('user_id', $user->id)
            ->orderBy('issue_date', 'desc')
            ->paginate(20);

        
        $allIssues = Book_issue::where('user_id', $user->id)->get();

        
        $currentlyBorrowed = $allIssues->where('status', 'Issued')->count();
        $allIssues = Book_issue::where('user_id', $user->id)->get();
        $overalldue = $allIssues->where('status', 'Overdue')->count();
        $overdue = $allIssues->filter(function ($issue) {
            $dueDate = Carbon::parse($issue->issue_date)->addDays(15);
            return $issue->status === 'Overdue' && now()->greaterThan($dueDate);
        })->count();

        $returned = $allIssues->where('status', 'Returned')->count();
        $totalHistory = $allIssues->count();

        return view('admin.history', compact(
            'bookIssues',
            'currentlyBorrowed',
            'overdue',
            'returned',
            'totalHistory',
            'overalldue'
        ));
    }
}
