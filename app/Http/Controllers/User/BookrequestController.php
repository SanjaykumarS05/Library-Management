<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookRequest;
use App\Models\Book_issue;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookrequestController extends Controller
{
    public function index()
    {
        $userRequests = BookRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $bookIssues = Book_issue::where('user_id', Auth::id())->get();
        $readingBook = $bookIssues->whereIn('status', ['Issued','Overdue'])->count();
        $stats = [
            'pending' => BookRequest::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'approved' => BookRequest::where('user_id', Auth::id())->where('status', 'approved')->count(),
            'rejected' => BookRequest::where('user_id', Auth::id())->where('status', 'rejected')->count(),
            'total' => BookRequest::where('user_id', Auth::id())->count()
        ];
        return view('user.book-request', compact('userRequests', 'stats', 'readingBook'));
    }

  public function requestBook($bookId)
    {
        $book = Book::findOrFail($bookId);

        $stats = [
            'pending' => BookRequest::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'approved' => BookRequest::where('user_id', Auth::id())->where('status', 'approved')->count(),
            'rejected' => BookRequest::where('user_id', Auth::id())->where('status', 'rejected')->count(),
            'total' => BookRequest::where('user_id', Auth::id())->count()
        ];

        $userRequests = BookRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $bookIssues = Book_issue::where('user_id', Auth::id())->get();
        $readingBook = $bookIssues->whereIn('status', ['Issued','Overdue'])->count();
        return view('user.book-request', compact('book', 'stats', 'userRequests', 'readingBook'));
    }
    public function submitBookRequest(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'terms' => 'accepted',
        ]);

        $bookId = $validated['book_id'];
        $userId = Auth::id();

        $existingRequest = BookRequest::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->latest()
            ->first();

        if ($existingRequest) {
            if ($existingRequest->status === 'pending') {
                return redirect()->back()->with('error', 'Your previous request for this book is still pending approval.');
            }

            if ($existingRequest->status === 'approved') {
                return redirect()->back()->with('error', 'This book has already been approved for you.');
            }
        }
        BookRequest::create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'Comments' => $request->input('Comments'),
            'status' => 'pending'
        ]);
        return redirect()->route('book-requests.index')->with('success', 'Book request submitted successfully!');
    }
}

