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
        $userRequests = BookRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $categories = Category::all();
        $books = Book::with('category'); // eager load for efficiency

        // Search by title, author, ISBN, or category name
        if ($query) {
            $books->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('author', 'LIKE', "%{$query}%")
                  ->orWhere('isbn', 'LIKE', "%{$query}%")
                  ->orWhere('publish_year', 'LIKE', "%{$query}%")
                  ->orWhereHas('category', fn($q2) => $q2->where('name', 'LIKE', "%{$query}%"));
            });
        }

        // Filter by category
        if ($category) {
            $books->whereHas('category', fn($q) => $q->where('name', $category));
        }

        // Filter by availability
        if ($availability) {
            $books->where('stock', $availability === 'Yes' ? '>' : '=', 0);
        }

        $books = $books->get();

        // ✅ Mark whether the current user has already borrowed this book
        $userId = Auth::id();
        foreach ($books as $book) {
            $book->is_issued = Book_issue::where('book_id', $book->id)
                ->where('user_id', $userId)
                ->where('status', 'Issued')
                ->exists();
        }

        // Return AJAX partial
        if ($request->ajax()) {
            return view('user.partials.search_results', compact('books'))->render();
        }

        return view('user.search', compact('books', 'categories', 'query', 'category', 'availability', 'userRequests'));
    }
}
