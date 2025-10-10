<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Book_issue;

class AdminController extends Controller
{
    public function index()
    {
        $totalBooks = Book::sum('stock');

        $categoriesCount = Category::count();

        $availableBooks = Book::where('availability', 'Yes')->count();
        $issuedBooks = Book_issue::where('status', 'issued')->count();

        $outOfStockBooks = Book::where('stock', '<=', 0)->count();

        $activeStaff = User::where('role', 'staff')->count();
        $activeUsers = User::where('role', 'user')->count();
        
        $issuedPercentage = $totalBooks > 0
            ? round(($issuedBooks / ($totalBooks + $issuedBooks)) * 100, 2)
            : 0;

        $lowStockBooks = Book::where('stock', '<', 5)->get();

        $recentActivities = Book_issue::with(['book', 'user'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($issue) {
                return (object)[
                    'type' => ucfirst($issue->status),
                    'book_title' => $issue->book->title ?? 'Unknown',
                    'user_name' => ucfirst($issue->user->name ?? 'Unknown'),
                    'time_ago' => $issue->created_at->diffForHumans(),
                ];
            });

        return view('admin.dashboard', [
            'admin' => auth()->user(),
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
