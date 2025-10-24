<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookRequest;
use App\Models\Category;
use App\Models\Book_issue;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $availability = $request->input('availability');
        $userId = Auth::id();

        $userRequests = BookRequest::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $categories = Category::all();
        $booksQuery = Book::with('category');

        // Search by title, author, ISBN, publish year, category
        if ($query) {
            $booksQuery->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('author', 'LIKE', "%{$query}%")
                  ->orWhere('isbn', 'LIKE', "%{$query}%")
                  ->orWhere('publish_year', 'LIKE', "%{$query}%")
                  ->orWhereHas('category', fn($q2) => $q2->where('name', 'LIKE', "%{$query}%"));
            });
        }

        // Filter by category
        if ($category) {
            $booksQuery->whereHas('category', fn($q) => $q->where('name', $category));
        }

        // Filter by availability
        if ($availability) {
            $booksQuery->where('stock', $availability === 'Yes' ? '>' : '=', 0);
        }

        $books = $booksQuery->get();

        // --- Check each book's status for the current user ---
        foreach ($books as $book) {
            // Currently borrowed
            $book->is_issued = Book_issue::where('book_id', $book->id)
                ->where('user_id', $userId)
                ->whereIn('status', ['Issued','Overdue'])
                ->exists();

            $book->available_stock = $book->stock ?? 0;

            // Latest request
            $latestRequest = BookRequest::where('user_id', $userId)
                ->where('book_id', $book->id)
                ->latest()
                ->first();

            if ($book->is_issued) {
                $book->can_request = false;
                $book->request_message = 'Currently borrowed';
            } elseif ($latestRequest) {
                if ($latestRequest->status === 'rejected') {
                    $book->can_request = true;
                    $book->request_message = '';
                } elseif ($latestRequest->status === 'returned') {
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

        // AJAX response
        if ($request->ajax()) {
            return view('user.partials.search_results', compact('books'))->render();
        }

        return view('user.search', compact('books', 'categories', 'query', 'category', 'availability', 'userRequests'));
    }
}
