<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\book_issue as BookIssue;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 100;
        $allUsers = User::all();
        $categories = Category::all();
        $staffs = User::whereIn('role', ['admin', 'staff'])->get();
        $bookIssues = BookIssue::with(['user', 'book.category', 'issuedBy']);
        if ($request->role) {
            $bookIssues->whereHas('user', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        if ($request->user_id) {
            $bookIssues->where('user_id', $request->user_id);
        }
        if ($request->category_id) {
            $bookIssues->whereHas('book.category', function($q) use ($request) {
                $q->where('id', $request->category_id);
            });
        }

        if ($request->status) {
            $bookIssues->where('status', $request->status);
        }

        if ($request->isbn) {
            $bookIssues->whereHas('book', function($q) use ($request) {
                $q->where('isbn', 'like', '%' . $request->isbn . '%');
            });
        }
        if($request->author){
            $bookIssues->whereHas('book', function($q) use ($request) {
                $q->where('author', 'like', '%' . $request->author . '%');
            });
        }
        if ($request->issue_by) {
            $bookIssues->where('issued_id', $request->issue_by);
        }
        if ($request->fine) {
            $bookIssues->where('fine_amount', '>=', $request->fine);
        }
        
        if ($request->time && $request->time !== 'all') {
            switch ($request->time) {
                case 'today':
                    $bookIssues->whereDate('issue_date', today());
                    break;

                case 'this_week':
                    $bookIssues->whereBetween('issue_date', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;

                case 'this_month':
                    $bookIssues->whereMonth('issue_date', now()->month);
                    break;

                case 'this_year':
                    $bookIssues->whereYear('issue_date', now()->year);
                    break;

                case 'custom':
                    if ($request->from_date && $request->to_date) {
                        $bookIssues->whereBetween('issue_date', [$request->from_date, $request->to_date]);
                    }
                    break;
            }
        }

        $bookIssues = $bookIssues->paginate($perPage)->withQueryString();

        return view('admin.report', compact('bookIssues', 'allUsers', 'categories', 'staffs'));
    }


    public function usersByRole(Request $request)
    {
        $users = User::where('role', $request->role)->get();
        return response()->json($users);
    }
}
