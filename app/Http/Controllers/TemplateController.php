<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\library;
use App\Models\Bookrequest;
use App\Models\emai_lLog;
use App\Http\Controllers\Controller;
class TemplateController extends Controller
{
    public function index()
    {
        $users = User::all();
        $profile = Profile::first();
        $hasPendingRequests = Bookrequest::where('status', 'pending')->count();
        $hasReceivedNotifications = email_log::where('recipient_id', auth()->id())->where('read', '0')->count();

        return view('layout.template', compact('users','profile', 'hasPendingRequests', 'hasReceivedNotifications'));
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}
