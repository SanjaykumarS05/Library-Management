<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookRequest;
use Illuminate\Support\Facades\Auth;

class BookrequestController extends Controller
{
    public function index()
    {
        $userRequests = BookRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'pending' => BookRequest::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'approved' => BookRequest::where('user_id', Auth::id())->where('status', 'approved')->count(),
            'rejected' => BookRequest::where('user_id', Auth::id())->where('status', 'rejected')->count(),
            'total' => BookRequest::where('user_id', Auth::id())->count()
        ];

        return view('user.book-request', compact('userRequests', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500'
        ]);

        BookRequest::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'author' => $validated['author'],
            'category' => $validated['category'],
            'notes' => $validated['notes'],
            'status' => 'pending',
            'request_date' => now()
        ]);

        return redirect()->route('book-requests.index')->with('success', 'Book request submitted successfully!');
    }

}
