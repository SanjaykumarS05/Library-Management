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
     * Display the user's library dashboard with filtering.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        // === Library stats ===
        $totalBooks = Book::count();
        $availableBooks = Book::where('availability', 'Yes')->count();
        $userBooks = Book_issue::where('user_id', $userId)->count();
        $categoriesCount = Category::count();

        // === Categories with book count ===
        $categories = Category::withCount('books')->get();

        // === Books query with filters ===
        $booksQuery = Book::with('category');

        // Category filter
        if ($request->filled('category')) {
            $booksQuery->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->category);
            });
        }

        // Filter type (Featured, Popular, All)
        $filterType = $request->get('filter', 'featured');

        switch ($filterType) {
            case 'popular':
                // Books with most issues (using book_issues count)
                $booksQuery->withCount(['bookIssues as issue_count' => function ($query) {
                    $query->where('status', 'Issued');
                }])->orderBy('issue_count', 'desc');
                break;

            case 'all':
                $booksQuery->latest();
                break;

            case 'featured':
            default:
                $booksQuery->latest();
                break;
        }

        // Get books
        $books = $filterType === 'featured'
            ? $booksQuery->take(8)->get()
            : $booksQuery->get();

        // === Mark issued books for current user ===
        foreach ($books as $book) {
            $book->is_issued = Book_issue::where('book_id', $book->id)
                ->where('user_id', $userId)
                ->where('status', 'Issued')
                ->exists();

            $book->available_stock = $book->stock ?? 0;
        }

        return view('user.browse_library', compact(
            'totalBooks',
            'availableBooks',
            'userBooks',
            'categoriesCount',
            'categories',
            'books',
            'filterType'
        ));
    }

    /**
     * AJAX endpoint for filtering books.
     */
    public function filterBooks(Request $request)
    {
        $userId = Auth::id();
        $booksQuery = Book::with('category');

        if ($request->filled('category')) {
            $booksQuery->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->category);
            });
        }

        $filterType = $request->get('filter', 'featured');

        switch ($filterType) {
            case 'popular':
                $booksQuery->withCount(['bookIssues as borrow_count' => function ($query) {
                    $query->where('status', 'Issued');
                }])->orderBy('borrow_count', 'desc');
                break;

            case 'all':
                $booksQuery->latest();
                break;

            case 'featured':
            default:
                $booksQuery->latest();
                break;
        }

        $books = $filterType === 'featured'
            ? $booksQuery->take(8)->get()
            : $booksQuery->get();

        foreach ($books as $book) {
            $book->is_issued = Book_issue::where('book_id', $book->id)
                ->where('user_id', $userId)
                ->where('status', 'Issued')
                ->exists();

            $book->available_stock = $book->stock ?? 0;
        }

        return response()->json([
            'books' => $books,
            'html' => view('user.partials.book_grid', compact('books'))->render()
        ]);
    }
}
