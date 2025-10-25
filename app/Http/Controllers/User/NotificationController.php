<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\email_log as EmailLog;
use App\Models\library;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserMessageService;

class NotificationController extends Controller
{
    protected $userMessageService;

    public function __construct(UserMessageService $userMessageService)
    {
        $this->userMessageService = $userMessageService;
    }

    public function index()
    {
        $logs = EmailLog::where('recipient_id', auth()->id())->latest()->paginate(20);
        $sentLogIds = EmailLog::where('sender_id', auth()->id())
        ->selectRaw('MIN(id) as id') // pick first log for each timestamp
        ->groupBy('sent_at')
        ->pluck('id'); // get the IDs

        $sentLogs = EmailLog::whereIn('id', $sentLogIds)
        ->with('recipient') // eager load recipient relation
        ->latest() // order by latest sent
        ->paginate(20);

        return view('user.notification', compact('logs', 'sentLogs'));
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'type'    => 'required|string',
        ]);

        $library = library::first();
        $user = auth()->user();
        $type = $request->type === 'other' ? $request->other_type : $request->type;

        // Get all users with role admin or staff
        $recipients = User::whereIn('role', ['admin', 'staff'])->get();
        foreach ($recipients as $user) {
            $this->userMessageService->sendMessage([
                'recipient_id' => $user->id,
                'subject'      => $request->subject .' from User ',
                'message'      => $request->message,
                'type'         => $type .' Notification from '.$user->name,
                'name'         => $user->name,
            ]);
        }

        return back()->with('success', 'Notification queued successfully.');
    }
}
