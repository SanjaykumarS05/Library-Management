<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Book_issue;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalIssued = Book_issue::where('user_id', $userId)->count();
        $returnedCount = Book_issue::where('user_id', $userId)->where('status', 'returned')->count();
        $pendingCount = Book_issue::where('user_id', $userId)->where('status', 'issued')->count();

        $recentBooks = Book_issue::with('book')
            ->where('user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get()
            ->map(function ($issue) {
                return (object)[
                    'book' => $issue->book,
                    'status' => $issue->status,
                    'time_ago' => $issue->updated_at->diffForHumans(),
                ];
            });

        $totalBooks = Book::sum('stock'); // in stock only
        $categoriesCount = Category::count();
        $booksCount = Book::count();
        $availableBooks = Book::where('availability', 'Yes')->count();
        $issuedBooks = Book_issue::where('status', 'issued')->count();
        $outOfStockBooks = Book::where('stock', '<=', 0)->count();

        $issuedPercentage = $totalBooks + $issuedBooks > 0
            ? round(($issuedBooks / ($totalBooks + $issuedBooks)) * 100, 2) : 0;

        $lowStockBooks = Book::where('stock', '<', 5)->get();
        return view('user.dashboard', compact(
            'totalIssued', 'returnedCount', 'pendingCount', 
            'recentBooks', 'totalBooks', 'booksCount', 'categoriesCount',
            'availableBooks', 'issuedBooks', 'outOfStockBooks',
            'issuedPercentage', 'lowStockBooks'
        ));
    }
}
