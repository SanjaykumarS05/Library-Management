<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Book_issue;
use App\Models\bookrequest as BookRequest;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BookNotification;
use Illuminate\Support\Facades\DB;

class BookIssueController extends Controller
{
    public function showIssueReturnForm()
    {
        $users = User::all();
        $books = Book::all();
        $book_issues = Book_issue::where('user_id', Auth::id())->get();
        $book_issues1 = Book_issue::whereIn('status', ['Issued', 'Overdue'])->get();

        return view('admin.issue_return', compact('books', 'book_issues', 'users', 'book_issues1'));
    }

    public function issueBook(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'issue_date' => 'required|date',
        ]);

        $book = Book::findOrFail($request->book_id);

        // Check if user already has this book issued
        $alreadyIssued = Book_issue::where('user_id', $request->user_id)
            ->whereHas('book', function ($query) use ($book) {
                $query->where('isbn', $book->isbn);
            })
            ->whereIn('status', ['Issued','Overdue'])
            ->exists();

        if ($alreadyIssued) {
            return back()->with('error', 'User already has this book issued. Return it first.');
        }

        if ($book->stock <= 0) {
            return back()->with('error', 'Book is out of stock!');
        }

        DB::transaction(function () use ($book, $request) {

            Book_issue::create([
                'book_id' => $book->id,
                'user_id' => $request->user_id,
                'issued_id' => Auth::user()->id,
                'issue_date' => $request->issue_date,
                'status' => 'Issued',
            ]);

            $book->decrement('stock');
            $book->update(['availability' => $book->stock > 0 ? 'Yes' : 'No']);

            // Update book_requests table → set to "approved"
            $bookRequest = BookRequest::where('book_id', $book->id)
                ->where('user_id', $request->user_id)
                ->where('status', 'pending')
                ->first();

            if ($bookRequest) {
                $bookRequest->update(['status' => 'approved']);
            }
        });
        $user = User::findOrFail($request->user_id);
        $data = [
            'name' => $user->name,
            'subject' => 'Book Issued Notification',
            'message' => "The book '{$book->title}' has been issued to you on {$request->issue_date}. Please return it on time otherwise late fees may apply.",
            'type' => 'Book Issued',
            'due_date' => now()->addDays(14)->toDateString(),
        ];
        $user->notify(new BookNotification($data));

        return redirect()->route('barcode.index')->with('success', 'Book issued successfully!');
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

        DB::transaction(function () use ($bookIssue, $request) {
            $bookIssue->update([
                'return_date' => $request->return_date,
                'status' => 'Returned',
            ]);

            $book = Book::findOrFail($bookIssue->book_id);
            $book->increment('stock');
            $book->update(['availability' => $book->stock > 0 ? 'Yes' : 'No']);

            $bookRequest = BookRequest::where('book_id', $book->id)
                ->where('user_id', $request->user_id_return)
                ->where('status', 'approved')
                ->first();

            if ($bookRequest) {
                $bookRequest->update(['status' => 'returned']);
            }
        });

        // Fetch the book again for notification
        $book = Book::findOrFail($bookIssue->book_id);
        $user = User::findOrFail($request->user_id_return);

        $data = [
            'name' => $user->name,
            'subject' => 'Book Return Notification',
            'message' => "The book '{$book->title}' has been returned on {$request->return_date}.",
            'type' => 'Book Returned',
        ];

        $user->notify(new BookNotification($data));

        return redirect()->route('barcode.index')->with('success', 'Book returned successfully!');
    }
    public function issueReturn($bookId = null, $userId = null)
    {
        $users = User::all();
        $books = Book::all();
        $book_issues1 = Book_issue::whereIn('status', ['Issued', 'Overdue'])->get();

        $selectedBook = $bookId ? Book::find($bookId) : null;
        $selectedUser = $userId ? User::find($userId) : null;

        return view('admin.issue_return', compact('users', 'books', 'book_issues1', 'selectedBook', 'selectedUser'));
    }
}
