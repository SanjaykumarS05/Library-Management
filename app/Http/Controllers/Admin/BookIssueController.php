<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Book_issue;
use App\Models\Library;
use App\Models\BookRequest;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BookNotification;

class BookIssueController extends Controller
{
    // Show Issue/Return Form
    public function showIssueReturnForm()
    {
        $users = User::all();
        $books = Book::all();
        $book_issues = Book_issue::where('user_id', Auth::id())->get();
        $book_issues1 = Book_issue::whereIn('status', ['Issued', 'Overdue'])->get();

        return view('admin.issue_return', compact('books', 'book_issues', 'users', 'book_issues1'));
    }

    // Issue a Book
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
            ->where('book_id', $book->id)
            ->whereIn('status', ['Issued', 'Overdue'])
            ->exists();

        if ($alreadyIssued) {
            return back()->with('error', 'User already has this book issued. Return it first.');
        }

        if ($book->stock <= 0) {
            return back()->with('error', 'Book is out of stock!');
        }

        // Create Book Issue
        $bookIssue = Book_issue::create([
            'book_id' => $book->id,
            'user_id' => $request->user_id,
            'issued_id' => Auth::id(),
            'issue_date' => $request->issue_date,
            'status' => 'Issued',
        ]);

        // Update Book stock and availability
        $book->stock -= 1;
        $book->availability = $book->stock > 0 ? 'Yes' : 'No';
        $book->save();

        // Approve Book Request if exists
        $bookRequest = BookRequest::where('book_id', $book->id)
            ->where('user_id', $request->user_id)
            ->where('status', 'pending')
            ->first();

        if ($bookRequest) {
            $bookRequest->status = 'approved';
            $bookRequest->save();
        }

        // Send Notification
        $user = User::findOrFail($request->user_id);
        $library = Library::first();
        $data = [
            'name' => $user->name,
            'subject' => 'Book Issued Notification from ' . ($library->library_name ?? 'Library'),
            'message' => "The book '{$book->title}' has been issued to you on {$request->issue_date}. Please return it on time to avoid late fees.",
            'type' => 'Book Issued Notification',
            'due_date' => now()->addDays(14)->toDateString(),
        ];
        $user->notify(new BookNotification($data));

        return redirect()->route('barcode.index')->with('success', 'Book issued successfully!');
    }

    // Return a Book
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

        $overdue= Book_issue::where('id', $request->issue_id)
            ->where('user_id', $request->user_id_return)
            ->where('status', 'Overdue')
            ->get();
        if ($overdue->count() > 0) {
            return view('admin.overdue', compact('overdue'));
        }

        // Update Book Issue Status
        $bookIssue->status = 'Returned';
        $bookIssue->return_date = $request->return_date;
        $bookIssue->save();

        // Update Book stock and availability
        $book = Book::findOrFail($bookIssue->book_id);
        $book->stock += 1;
        $book->availability = $book->stock > 0 ? 'Yes' : 'No';
        $book->save();

        // Update Book Request status if exists
        $bookRequest = BookRequest::where('book_id', $book->id)
            ->where('user_id', $request->user_id_return)
            ->where('status', 'approved')
            ->first();

        if ($bookRequest) {
            $bookRequest->status = 'returned';
            $bookRequest->save();
        }

        // Send Notification
        $user = User::findOrFail($request->user_id_return);
        $library = Library::first();
        $data = [
            'name' => $user->name,
            'subject' => 'Book Return Notification from ' . ($library->library_name ?? 'Library'),
            'message' => "The book '{$book->title}' has been returned on {$request->return_date}.",
            'type' => 'Book Returned Notification',
        ];
        $user->notify(new BookNotification($data));

        return redirect()->route('barcode.index')->with('success', 'Book returned successfully!');
    }

    // Issue/Return Page with optional selected book/user
    public function issueReturn($bookId = null, $userId = null)
    {
        $users = User::all();
        $books = Book::all();
        $book_issues1 = Book_issue::whereIn('status', ['Issued', 'Overdue'])->get();

        $selectedBook = $bookId ? Book::find($bookId) : null;
        $selectedUser = $userId ? User::find($userId) : null;

        return view('admin.issue_return', compact('users', 'books', 'book_issues1', 'selectedBook', 'selectedUser'));
    }

   public function returnBookPayment(Request $request)
{
    // Validate payment
    $request->validate([
        'issue_id' => 'required',
        'user_id_return' => 'required',
        'fine_amount' => 'required|numeric',
        'payment_method' => 'required'
    ]);

    // Fetch overdue book entry
    $bookIssue = Book_issue::where('id', $request->issue_id)
        ->where('user_id', $request->user_id_return)
        ->where('status', 'Overdue')
        ->firstOrFail();

    // Update Issue Status
    $bookIssue->status = 'Returned';
    $bookIssue->return_date = now();
    $bookIssue->save();

    $bookIssue->fine_amount = (int)$request->fine_amount;
    $bookIssue->save();

    // Update Book stock
    $book = Book::findOrFail($bookIssue->book_id);
    $book->stock += 1;
    $book->availability = $book->stock > 0 ? 'Yes' : 'No';
    $book->save();

    // Update User Fine
    $user = User::findOrFail($request->user_id_return);
    $user->fine += (int)$request->fine_amount;
    $user->save();

    return redirect()->route('barcode.index')->with('success', 'Payment processed successfully!');
}

}
