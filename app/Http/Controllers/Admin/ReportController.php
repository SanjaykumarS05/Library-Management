<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Book_issue;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Filters
        $role = $request->input('role');
        $user_id = $request->input('user_id');
        $time = $request->input('time');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        // Get users by role
        $admin = User::where('role', 'admin')->get();
        $staff = User::where('role', 'staff')->get();
        $users = User::where('role', 'user')->get();

        // Base query for book issues
        $query = Book_issue::query()->with(['book.category', 'user', 'issuedUser']);

        // Filter by role
        if ($role) {
            $query->whereHas('user', function ($q) use ($role) {
                $q->where('role', $role);
            });
        }

        // Filter by user
        if ($user_id) {
            $query->where('user_id', $user_id);
        }

        // Filter by time frame
        if ($time && $time !== 'all') {
            if ($time === 'today') {
                $query->whereDate('issue_date', Carbon::today());
            } elseif ($time === 'this_week') {
                $query->whereBetween('issue_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } elseif ($time === 'this_month') {
                $query->whereMonth('issue_date', Carbon::now()->month);
            } elseif ($time === 'this_year') {
                $query->whereYear('issue_date', Carbon::now()->year);
            } elseif ($time === 'custom' && $from_date && $to_date) {
                $query->whereBetween('issue_date', [$from_date, $to_date]);
            }
        }

        // Execute query
        $book_issues = $query->get();

        return view('admin.report', compact(
            'admin', 'staff', 'users', 'book_issues'
        ));
    }

    public function getUsersByRole(Request $request)
{
    $role = $request->role;

    if (!$role) {
        // Return all users if no specific role selected
        $users = \App\Models\User::select('id', 'name', 'role')->get();
    } else {
        $users = \App\Models\User::where('role', $role)->select('id', 'name', 'role')->get();
    }

    return response()->json($users);
}

}
