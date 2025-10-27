<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\library;
use App\Http\Controllers\Controller;
class TemplateController extends Controller
{
    public function index()
    {
        $users = User::all();
        $profile = Profile::first();
        return view('layout.template', compact('users','profile'));
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}
