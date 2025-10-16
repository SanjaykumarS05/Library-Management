<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\bookrequest as BookRequest;
use App\Models\email_log as EmailLog;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('admin.notification'); // initial blade, content loaded via AJAX
    }

    public function dynamic(Request $request)
    {
        $html = '';

        // ===== Book Requests =====
        if ($request->has('book_requests')) {
            $bookRequests = BookRequest::with('user', 'book')->latest()->get();
            $html .= view('admin.partials.book_requests', compact('bookRequests'))->render();
        }

        // ===== Received Emails =====
        if ($request->has('received_emails')) {
            $emails = EmailLog::where('status', 'received')->latest()->take(10)->get();
            $html .= view('admin.partials.received_emails', compact('emails'))->render();
        }

        // ===== Sent Notifications =====
        if ($request->has('sent_notifications')) {
            $sentNotifications = EmailLog::where('status', 'sent')->latest()->take(10)->get();
            $html .= view('admin.partials.sent_notifications', compact('sentNotifications'))->render();
        }

        return response()->json(['html' => $html]);
    }
}
