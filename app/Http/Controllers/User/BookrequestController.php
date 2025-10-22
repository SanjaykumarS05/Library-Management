<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookrequestController extends Controller
{
    public function index()
    {
        $userRequests = BookRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'pending' => BookRequest::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'approved' => BookRequest::where('user_id', Auth::id())->where('status', 'approved')->count(),
            'rejected' => BookRequest::where('user_id', Auth::id())->where('status', 'rejected')->count(),
            'total' => BookRequest::where('user_id', Auth::id())->count()
        ];

        return view('user.book-request', compact('userRequests', 'stats'));
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

        return view('user.book-request', compact('book', 'stats', 'userRequests'));
    }

    public function submitBookRequest(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'terms' => 'accepted',
        ]);
        BookRequest::create([
            'user_id' => Auth::id(),
            'book_id' => $validated['book_id'],
            'Comments' => $request->input('Comments'),
            'status' => 'pending'
        ]);

    return redirect()->route('book-requests.index')->with('success', 'Book request submitted successfully!');
    }
}
