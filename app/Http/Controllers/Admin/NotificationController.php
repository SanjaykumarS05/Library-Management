<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\bookrequest as BookRequest;
use App\Models\email_log as EmailLog;
use App\Models\User;
use App\Models\books;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
 public function index()
{
    $bookRequests = BookRequest::whereIn('status', ['pending', 'approved'])
        ->with('user')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
    $statusOptions = ['pending', 'approved', 'rejected'];
    return view('admin.notification', compact('bookRequests', 'statusOptions'));
}
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,approved,rejected',
    ]);

    $bookRequest =bookrequest::findOrFail($id);
    $bookRequest->status = $request->status;

    if ($request->status === 'approved') {
        return redirect()->route('notification.issue_return1', [
            $bookRequest->book_id,
            $bookRequest->user_id
        ])->with('success', 'Ready to issue.');
    }

    return back()->with('success', 'tatus updated successfully.');
}

}
