<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
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
        return view('staff.issue_return', compact('books', 'book_issues', 'users', 'book_issues1'));
        }

    public function issueBook(Request $request)
{
    $request->validate([
        'book_id' => 'required|exists:books,id',
        'user_id' => 'required|exists:users,id',
        'issue_date' => 'required|date',
    ]);

    $book = Book::findOrFail($request->book_id);

    // Check if the user already has this book issued (same ISBN) and not yet returned
    $alreadyIssued = Book_issue::where('user_id', $request->user_id)
        ->whereHas('book', function($query) use ($book) {
            $query->where('isbn', $book->isbn);
        })
        ->where('status', 'Issued')
        ->exists();

    if ($alreadyIssued) {
        return back()->with('error', 'User already has this book issued! Return it first before issuing again.');
    }

    if ($book->stock <= 0) {
        return back()->with('error', 'Book is out of stock!');
    }

    $issued_id = $request->issued_id ?? Auth::id();

    Book_issue::create([
        'book_id' => $book->id,
        'user_id' => $request->user_id,
        'issued_id' => $issued_id,
        'issue_date' => $request->issue_date,
        'status' => 'Issued',
    ]);

    $book->decrement('stock');
    $book->update(['availability' => $book->stock > 0 ? 'Yes' : 'No']);

    return back()->with('success', 'Book issued successfully!');
}



    public function returnBook(Request $request)
    {
    $request->validate([
        'issue_id' => 'required|exists:book_issues,id',
        'user_id_return' => 'required|exists:users,id',
        'return_date' => 'required|date',
    ]);

    $bookIssue = Book_issue::where('id', $request->issue_id)
                           ->where('user_id', $request->user_id_return)
                           ->first();

    if (!$bookIssue) {
        return back()->with('error', 'Selected user did not issue this book.');
    }

    if ($bookIssue->status === 'Returned') {
        return back()->with('error', 'This book has already been returned.');
    }

    $bookIssue->update([
        'return_date' => $request->return_date,
        'status' => 'Returned',
    ]);

    $book = Book::findOrFail($bookIssue->book_id);
    $book->increment('stock');
    $book->update(['availability' => $book->stock > 0 ? 'Yes' : 'No']);

    return back()->with('success', 'Book returned successfully!');
}


    public function issueReturn($bookId = null)
    {
        $users = User::all();
        $books = Book::all();
        $book_issues1 = Book_issue::whereNull('return_date')->get();

        $selectedBook = null;
        if ($bookId) {
            $selectedBook = Book::find($bookId);
        }
        return view('staff.issue_return', compact('users', 'books', 'book_issues1', 'selectedBook'));
    }
    
        
}
