<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Bookrequest;
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

        // Library stats
        $totalBooks = Book::count();
        $availableBooks = Book::where('availability', 'Yes')->count();
        $userBooks = Book_issue::where('user_id', $userId)->count();
        $categoriesCount = Category::count();
        $categories = Category::withCount('books')->get();

        $booksQuery = Book::with('category');

        // Category filter
        if ($request->filled('category')) {
            $booksQuery->whereHas('category', fn($q) => $q->where('name', $request->category));
        }

        $filterType = $request->get('filter', 'featured');
        switch ($filterType) {
            case 'popular':
                $booksQuery->withCount(['bookIssues as issue_count' => fn($q) => $q->whereIn('status', ['Issued','Overdue'])])
                    ->orderBy('issue_count', 'desc');
                break;
            case 'all':
                $booksQuery->latest();
                break;
            case 'featured':
            default:
                $booksQuery->latest();
                break;
        }

        $books = $filterType === 'featured' ? $booksQuery->take(8)->get() : $booksQuery->get();

        // Check previous requests per book
        foreach ($books as $book) {
    // Check if user currently has this book issued or overdue
    $book->is_issued = Book_issue::where('book_id', $book->id)
        ->where('user_id', $userId)
        ->whereIn('status', ['Issued','Overdue'])
        ->exists();

    $book->available_stock = $book->stock ?? 0;

    // Get latest request for this book
    $latestRequest = Bookrequest::where('user_id', $userId)
        ->where('book_id', $book->id)
        ->latest()
        ->first();

    if ($book->is_issued) {
        // Cannot request if currently borrowed
        $book->can_request = false;
        $book->request_message = 'Currently borrowed';
    } elseif ($latestRequest) {
        // Check previous request status
        if ($latestRequest->status === 'rejected') {
            $book->can_request = true;
            $book->request_message = '';
        } elseif ($latestRequest->status === 'pending') {
            $book->can_request = false;
            $book->request_message = 'Pending approval';
        } elseif ($latestRequest->status === 'approved') {
            $book->can_request = false;
            $book->request_message = 'Already approved';
        }
    } else {
        $book->can_request = true;
        $book->request_message = '';
    }
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

    // === Check previous requests per book for AJAX ===
    foreach ($books as $book) {
    // Check if user currently has this book issued or overdue
    $book->is_issued = Book_issue::where('book_id', $book->id)
        ->where('user_id', $userId)
        ->whereIn('status', ['Issued','Overdue'])
        ->exists();

    $book->available_stock = $book->stock ?? 0;

    // Get latest request for this book
    $latestRequest = Bookrequest::where('user_id', $userId)
        ->where('book_id', $book->id)
        ->latest()
        ->first();

    if ($book->is_issued) {
        // Cannot request if currently borrowed
        $book->can_request = false;
        $book->request_message = 'Currently borrowed';
    } elseif ($latestRequest) {
        // Check previous request status
        if ($latestRequest->status === 'rejected') {
            $book->can_request = true;
            $book->request_message = '';
        } elseif ($latestRequest->status === 'pending') {
            $book->can_request = false;
            $book->request_message = 'Pending approval';
        } elseif ($latestRequest->status === 'approved') {
            $book->can_request = false;
            $book->request_message = 'Already approved';
        }
    } else {
        $book->can_request = true;
        $book->request_message = '';
    }
}

    return response()->json([
        'books' => $books,
        'html' => view('user.partials.book_grid', compact('books'))->render()
    ]);
}

}