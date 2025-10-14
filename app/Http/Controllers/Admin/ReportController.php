<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\book_issue; // Make sure class name is correct with uppercase "B" and "I"

class ReportController extends Controller
{
    public function index()
    {
        $admin = User::where('role', 'admin')->get();
        $staff = User::where('role', 'staff')->get();
        $users = User::where('role', 'user')->get();
        $categories = Category::all();
        $book_issues = book_issue::with(['user','book','issuedUser','book.category'])->get(); // initial load

        return view('admin.report', compact('admin','staff','users','categories','book_issues'));
    }

    public function fetchUsersByRole(Request $request)
    {
        $role = $request->role;
        $users = $role 
            ? User::where('role', $role)->get(['id', 'name'])
            : User::all(['id', 'name']);
        return response()->json($users);
    }

    public function fetchReport(Request $request)
    {
        $query = BookIssue::with(['user', 'book', 'issuedUser','book.category']);

        if($request->role){
            $query->whereHas('user', fn($q)=> $q->where('role', $request->role));
        }
        if($request->user_id) $query->where('user_id', $request->user_id);
        if($request->category_id){
            $query->whereHas('book', fn($q)=> $q->where('category_id', $request->category_id));
        }
        if($request->availability){
            $available = $request->availability == 'Yes' ? 1 : 0;
            $query->whereHas('book', fn($q)=> $q->where('availability', $available));
        }
        if($request->status) $query->where('status', $request->status);
        if($request->isbn) $query->whereHas('book', fn($q)=> $q->where('isbn','like','%'.$request->isbn.'%'));

        if($request->time){
            $now = now();
            switch($request->time){
                case 'today': $query->whereDate('issue_date', $now); break;
                case 'this_week': $query->whereBetween('issue_date', [$now->startOfWeek(), $now->endOfWeek()]); break;
                case 'this_month': $query->whereMonth('issue_date', $now->month)->whereYear('issue_date', $now->year); break;
                case 'this_year': $query->whereYear('issue_date', $now->year); break;
                case 'custom':
                    if($request->from_date && $request->to_date)
                        $query->whereBetween('issue_date', [$request->from_date, $request->to_date]);
                    break;
            }
        }

        $book_issues = $query->get();

        $data = $book_issues->map(fn($issue)=> [
            'user_name' => $issue->user->name ?? 'UNKNOWN',
            'user_role' => $issue->user->role ?? 'UNKNOWN',
            'book_title' => $issue->book->title ?? 'UNKNOWN',
            'book_isbn' => $issue->book->isbn ?? 'UNKNOWN',
            'book_author' => $issue->book->author ?? 'UNKNOWN',
            'category' => $issue->book->category->name ?? 'UNKNOWN',
            'publish_year' => $issue->book->publish_year ?? 'UNKNOWN',
            'issued_by' => $issue->issuedUser->name ?? 'UNKNOWN',
            'issued_to' => $issue->user->name ?? 'UNKNOWN',
            'issue_date' => $issue->issue_date ?? 'UNKNOWN',
            'status' => $issue->status ?? 'UNKNOWN',
        ]);

        return response()->json($data);
    }
}
