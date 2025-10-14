<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Library;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // =====================
    // Show Settings Page
    // =====================
    public function index()
    {
        $admin = Auth::user();
        $profile = $admin->profile;
        $settings = Library::first(); // fetch library settings from DB

        return view('admin.setting', compact('admin', 'profile', 'settings'));
    }

    // =====================
    // Update Profile (AJAX)
    // =====================
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'secondary_email' => 'nullable|email',
            'blood_group' => 'nullable|string',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'designation' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'qualification' => 'nullable|string',
            'theme' => 'nullable|string',
        ]);

        $user = Auth::user();

        $profileImagePath = $user->profile->profile_image_path ?? null;
        if ($request->hasFile('profile_image')) {
            if ($profileImagePath && Storage::disk('public')->exists($profileImagePath)) {
                Storage::disk('public')->delete($profileImagePath); // delete old image
            }
            $profileImagePath = $request->file('profile_image')->store('Profile', 'public');
        }

        // Update user basic info
        $user->update($request->only('name', 'email'));

        // Update or create profile record
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'profile_image_path' => $profileImagePath,
                'secondary_email' => $request->secondary_email,
                'blood_group' => $request->blood_group,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'designation' => $request->designation,
                'phone' => $request->phone,
                'address' => $request->address,
                'qualification' => $request->qualification,
                'theme' => $request->theme ?? 'light',
            ]
        );

        // Return JSON for AJAX
        return response()->json(['message' => 'Profile updated successfully!']);
    }

    // =====================
    // Update Library (AJAX)
    // =====================
    public function updateLibrary(Request $request)
    {
        $request->validate([
            'library_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:15',
            'website' => 'nullable|string',
            'instagram' => 'nullable|string',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'youtube' => 'nullable|string',
            'working_hours' => 'required|string',
        ]);

        // Store or update library settings
        Library::updateOrCreate([], $request->only([
            'library_name', 'address', 'contact_email', 'contact_phone', 'website',
            'instagram', 'facebook', 'twitter', 'linkedin', 'youtube', 'working_hours'
        ]));

        // Return JSON for AJAX
        return response()->json(['message' => 'Library settings updated successfully!']);
    }

    public function updateTheme(Request $request)
{
    $request->validate([
        'theme' => 'required|string|in:light,dark'
    ]);

    $user = Auth::user();
    $user->profile()->updateOrCreate(
        ['user_id' => $user->id],
        ['theme' => $request->theme]
    );

    return response()->json(['message' => 'Theme updated successfully!']);
}
}
