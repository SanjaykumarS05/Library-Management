<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Book_issue;
use App\MOdels\Profile;

class AdminController extends Controller
{
    public function index()
    {
        $totalBooks = Book::sum('stock');

        $categoriesCount = Category::count();

        $booksCount = Book::count();

        $availableBooks = Book::where('availability', 'Yes')->count();
        $issuedBooks = Book_issue::where('status', 'issued')->count();

        $outOfStockBooks = Book::where('stock', '<=', 0)->count();

        $activeStaff = User::where('role', 'staff')->count();
        $activeUsers = User::where('role', 'user')->count();
        
        $issuedPercentage = $totalBooks > 0
            ? round(($issuedBooks / ($totalBooks + $issuedBooks)) * 100, 2): 0;

        $lowStockBooks = Book::where('stock', '<', 5)->get();

        $recentActivities = Book_issue::with(['book', 'user'])
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($issue) {
                return (object)[
                    'type' => ucfirst($issue->status),
                    'book_title' => $issue->book->title,
                    'user_name' => ucfirst($issue->user->name),
                    'time_ago' => $issue->created_at->diffForHumans(),
                ];
            });

        return view('admin.dashboard', [
            'admin' => auth()->user(),  
            'booksCount' => $booksCount,
            'totalBooks' => $totalBooks,
            'categoriesCount' => $categoriesCount,
            'availableBooks' => $availableBooks,
            'issuedBooks' => $issuedBooks,
            'outOfStockBooks' => $outOfStockBooks,
            'activeStaff' => $activeStaff,
            'activeUsers' => $activeUsers,
            'issuedPercentage' => $issuedPercentage,
            'lowStockBooks' => $lowStockBooks,
            'recentActivities' => $recentActivities,
        ]);
    }
}
