<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Book_issue;
use Illuminate\Support\Facades\Auth;

class BrowseLibraryController extends Controller
{
    /**
     * Display the user's library dashboard.
     */
    public function index()
    {
        $userId = Auth::id();

        // === Library stats ===
        $totalBooks = Book::count();
        $availableBooks = Book::where('availability', 'Yes')->count();
        $userBooks = Book_issue::where('user_id', $userId)->count();
        $categoriesCount = Category::count();

        // === Categories with count ===
        $categories = Category::withCount('books')->get();

        // === Featured books (latest 8) ===
        $books = Book::with('category')
            ->latest()
            ->take(8)
            ->get();

        // === Mark issued books for current user ===
        foreach ($books as $book) {
            $book->is_issued = Book_issue::where('book_id', $book->id)
                ->where('user_id', $userId)
                ->where('status', 'issued')
                ->exists();

            $book->available_stock = $book->stock ?? 0;

        }

        // === Send data to view ===
        return view('user.browse_library', compact(
            'totalBooks',
            'availableBooks',
            'userBooks',
            'categoriesCount',
            'categories',
            'books'
        ));
    }
}
