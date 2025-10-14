<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BooksRequest;
use App\Models\Book;
use App\Models\book_issue;
use App\Models\Category;

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
        $data = $request->validated();

        // Handle single image upload
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('books', 'public');
        }

        // Set availability based on stock
        $data['availability'] = ((int)$data['stock'] > 0) ? 'Yes' : 'No';

        Book::create($data);

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
    $data['availability'] = ((int)$data['stock'] > 0) ? 'Yes' : 'No';
    
    if ($request->hasFile('image_path')) {
        if ($book->image_path && \Storage::disk('public')->exists($book->image_path)) {
            \Storage::disk('public')->delete($book->image_path);
        }
        $data['image_path'] = $request->file('image_path')->store('books', 'public');
    }
    $book->update($data);

    return redirect()->route('books')->with('success', 'Book updated successfully.');
    }


    public function delete($id)
    {
        $book = Book::findOrFail($id);

        // Delete image if exists
        if ($book->image_path && \Storage::disk('public')->exists($book->image_path)) {
            \Storage::disk('public')->delete($book->image_path);
        }

        $book->delete();

        return redirect()->route('books')->with('success', 'Book deleted successfully.');
    }
}
