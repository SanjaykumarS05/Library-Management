<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\bookrequest as BookRequest;
use App\Models\email_log as EmailLog;
use App\Models\User;
use App\Models\books;
use Illuminate\Http\Request;
use App\Services\MessageService;


class NotificationController extends Controller
{
 public function index()
{
    $bookRequests = BookRequest::whereIn('status', ['pending', 'approved',])
        ->with('user')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
    $statusOptions = ['pending', 'approved', 'rejected'];
    $users = User::all();
    $recipients = User::all();
    $logs = EmailLog::latest()->paginate(20);

    return view('admin.notification', compact('bookRequests', 'statusOptions', 'recipients', 'logs', 'users'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $bookRequest = BookRequest::findOrFail($id);

      // Only update if the new status is 'rejected'
        if ($request->status === 'rejected') {
            $bookRequest->status = 'rejected';
            $bookRequest->save();
        }
        if ($request->status === 'approved') {
            return redirect()->route('notification.issue_return1', [
                $bookRequest->book_id,
                $bookRequest->user_id
            ])->with('success', 'Ready to issue.');
        }
        return back()->with('success', 'Status updated successfully.');
    }

    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }
     public function sendNotification(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required',
        ]);

        $type = $request->type === 'other' ? $request->other_type : 'other';

        if ($request->recipient_id === 'all') {
            $users = User::all();
            foreach ($users as $user) {
                $this->messageService->sendMessage([
                    'recipient_id' => $user->id,
                    'subject' => $request->subject,
                    'message' => $request->message,
                    'type' => $type,
                    'name' => $user->name,
                ]);

            }
        } else {
            $this->messageService->sendMessage([
                'recipient_id' => $request->recipient_id,
                'subject' => $request->subject,
                'message' => $request->message,
                'type' => $type,
                'name' => User::find($request->recipient_id)->name,
            ]);
        }

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }

}
