<?php

namespace App\Http\Controllers;

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

        if ($query) {
            $books->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('author', 'LIKE', "%{$query}%")
                  ->orWhere('isbn', 'LIKE', "%{$query}%")
                  ->orWhereHas('category', function ($q2) use ($query) {
                      $q2->where('name', 'LIKE', "%{$query}%");
                  });
            });
        }

        if ($category) {
            $books->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        if ($availability) {
            $books->where('availability', $availability);
        }

        $books = $books->get();

      
        return view('admin.search', compact('books', 'query', 'categories', 'category', 'availability'));
    }


    public function issueReturn($bookId = null)
    {
    $users = User::all();
    $books = Book::all();
    $book_issues1 = Book_issue::whereNull('return_date')->get(); // only issued but not returned

    $selectedBook = null;
    if ($bookId) {
        $selectedBook = Book::find($bookId);
    }

    return view('books.issue_return', compact('users', 'books', 'book_issues1', 'selectedBook'));
    }
}
