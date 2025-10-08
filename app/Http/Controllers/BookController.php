<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $book_issues = BookIssue::all();
        $categories = Category::all();
        return view('admin.dashboard', compact('books', 'book_issues', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.addbook', compact('categories'));
    }

    public function store(BookRequest $request)
    {
        Book::create($request->validated());
        return redirect()->route('admin.dashboard')->with('success', 'Book added successfully.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.editbook', compact('book', 'categories'));
    }

    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->validated());
        return redirect()->route('admin.dashboard')->with('success', 'Book updated successfully.');
    }   

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Book deleted successfully.');
    }

}
