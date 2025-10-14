<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MessageService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\email_log;

class NotificationController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index()
    {
        $recipients = User::all();
        $logs = email_log::latest()->paginate(20);
        return view('admin.notification', compact('recipients', 'logs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'recipient_id' => 'required|exists:users,id',
            'message' => 'required|string|min:5',
            'subject' => 'nullable|string|max:255',
        ]);

        $this->messageService->sendMessage($validated);

        return redirect()->back()->with('success', 'Notification sent successfully!');
    }
}
