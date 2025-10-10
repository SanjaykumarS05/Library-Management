<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Book_issue;
use Illuminate\Support\Facades\Auth;

class BookIssueController extends Controller
{
    public function showIssueReturnForm()
    {
        $users = User::all();
        $books = Book::all();

        $book_issues = Book_issue::where('user_id', Auth::id())->get();
        $book_issues1 = Book_issue::where(['status' => 'issued'])->get();
        return view('admin.issue_return', compact('books', 'book_issues', 'users', 'book_issues1'));
        }

    
    public function issue($bookId)
    {
        $book = Book::findOrFail($bookId);

        if ($book->stock <= 0) {
            return back()->with('error', 'Book is out of stock!');
        }

        Book_issue::create([
            'book_id' => $book->id,
            'user_id' => Auth::id(),
            'issued_id' => Auth::id(),
            'issue_date' => now(),
            'status' => 'Issued',
        ]);

        $book->decrement('stock');
            if ($book->stock <= 0) {
                $book->update(['availability' => 'No']);
            }

        return back()->with('success', 'Book issued successfully!');
    }

    public function issuebook(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'issue_date' => 'required|date',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock <= 0) {
            return back()->with('error', 'Book is out of stock!');
        }

        Book_issue::create([
            'book_id' => $book->id,
            'user_id' => $request->user_id,
            'issued_id' => Auth::id(),
            'issue_date' => $request->issue_date,
            'status' => 'Issued',
        ]);

        $book->decrement('stock');
            if ($book->stock <= 0) {
                $book->update(['availability' => 'No']);
            }

        return back()->with('success', 'Book issued successfully!');
    }


    public function returnBook(Request $request)
    {
        $request->validate([
            'issue_id' => 'required|exists:book_issues,id',
            'return_date' => 'required|date|after_or_equal:issue_date',
        ]);

        $bookIssue = Book_issue::findOrFail($request->issue_id);

        if ($bookIssue->status === 'Returned') {
            return back()->with('error', 'This book has already been returned.');
        }

        $bookIssue->update([
            'return_date' => $request->return_date,
            'status' => 'Returned',
        ]);

        $book = Book::findOrFail($bookIssue->book_id);
        $book->increment('stock');
            if ($book->stock > 0) {
                $book->update(['availability' => 'Yes']);
            }

        return back()->with('success', 'Book returned successfully!');
    }

    public function issueReturn($bookId = null)
{
    $users = User::all();
    $books = Book::all();
    $book_issues = Book_issue::whereNull('return_date')->get();

    $selectedBook = null;
    if ($bookId) {
        $selectedBook = Book::find($bookId);
    }
    return view('admin.issue_return', compact('users', 'books', 'book_issues', 'selectedBook'));
}

}
