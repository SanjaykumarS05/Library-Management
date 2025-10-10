<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BooksRequest;
use App\Models\Book;
use App\Models\book_issue;
use App\Models\category as Category;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(100);
        $book_issues = book_issue::all();
        $categories = Category::all();
        return view('admin.manage_books', compact('books', 'book_issues', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.addbook', compact('categories'));
    }

    public function store(BooksRequest $request)
    {
        Book::create($request->validated());
        return redirect()->route('books')->with('success', 'Book added successfully.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.editbook', compact('book', 'categories'));
    }

    public function update(BooksRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $data = $request->validated();
        
        $book_stock = (int) $data['stock'];
        if ($book_stock <= 0) {
            $data['availability'] = 'No';
        } else {
            $data['availability'] = 'Yes';
        }

        $book->update($data);

            return redirect()->route('books')->with('success', 'Book updated successfully.');
        }


    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books')->with('success', 'Book deleted successfully.');
    }
}
