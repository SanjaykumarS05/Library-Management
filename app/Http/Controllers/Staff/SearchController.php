<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $availability = $request->input('availability');

        $categories = Category::all();
        $books = Book::query();

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

        $books = $books->latest()->paginate(10);

        // Return AJAX partial
        if ($request->ajax()) {
            return view('staff.search_results', compact('books'))->render();
        }

        return view('staff.search', compact('books', 'categories', 'query', 'category', 'availability'));
    }
}
