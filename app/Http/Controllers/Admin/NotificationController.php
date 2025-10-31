<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\bookrequest as BookRequest;
use App\Models\email_log as EmailLog;
use App\Models\User;
use App\Models\books;
use App\Models\library;
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
    $logs = EmailLog::where('recipient_id', auth()->id())->latest()->paginate(20);
    $sentLogs = EmailLog::where('sender_id', auth()->id())->latest()->paginate(20);
    $hasPendingRequests = $bookRequests->where('status', 'pending')->count();

    return view('admin.notification', compact('bookRequests', 'statusOptions', 'recipients', 'logs', 'users', 'sentLogs', 'hasPendingRequests'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $bookRequest = BookRequest::findOrFail($id);

      
            if ($request->status === 'rejected')
            {
             $bookRequest->status = 'rejected'; 
             $bookRequest->save();
             return back()->with('success', 'Request rejected.');
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
            'subject'      => 'required|string|max:255',
            'message'      => 'required|string',
            'type'         => 'required|string',
        ]);

        $library = Library::first();
        $libraryName = $library->library_name ?? 'Library';

        
        $type = $request->type === 'other'
                ? $request->other_type
                : $request->type;

        
        if ($request->recipient_id === 'all') {
            $allUsers = User::all();
            foreach ($allUsers as $user) {
                $this->messageService->sendMessage([
                    'recipient_id' => $user->id,
                    'subject'      => $request->subject .' from '. $libraryName,
                    'message'      => $request->message,
                    'type'         => $type . ' from ' . $libraryName,
                    'name'         => $user->name,
                ]);
            }
        }
        
        else {
            $user = User::findOrFail($request->recipient_id);

            $this->messageService->sendMessage([
                'recipient_id' => $user->id,
                'subject'      => $request->subject . ' from ' . $libraryName,
                'message'      => $request->message,
                'type'         => $type . ' from ' . $libraryName,
                'name'         => $user->name,
            ]);
        }

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }
}