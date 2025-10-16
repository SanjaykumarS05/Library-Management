<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Library;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        return view('staff.setting', compact('admin', 'profile', 'settings'));
    }

    // =====================
    // Update Profile (AJAX)
    // =====================
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'secondary_email' => 'nullable|email|max:255',
            'blood_group' => 'nullable|string|max:5',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'designation' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'theme' => 'nullable|string|in:light,dark',
        ]);

        $user = Auth::user();

        // Handle profile image
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

        return response()->json(['message' => 'Profile updated successfully!']);
    }

    // =====================
    // Update Library (AJAX)
    // =====================
    public function updateLibrary(Request $request)
    {
        $request->validate([
            'library_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'website' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'working_hours' => 'required|string|max:50',
        ]);

        Library::updateOrCreate([], $request->only([
            'library_name', 'address', 'contact_email', 'contact_phone', 'website',
            'instagram', 'facebook', 'twitter', 'linkedin', 'youtube', 'working_hours'
        ]));

        return response()->json(['message' => 'Library settings updated successfully!']);
    }

    // =====================
    // Update Theme (AJAX)
    // =====================
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

    // =====================
    // Update Password (AJAX)
    // =====================
   public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed', // confirmed expects new_password_confirmation
    ]);

    $user = Auth::user();

    // Check if current password matches
    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json(['message' => 'Current password is incorrect.'], 422);
    }

    // Prevent using the same password
    if (Hash::check($request->new_password, $user->password)) {
        return response()->json(['message' => 'New password cannot be the same as the current password.'], 422);
    }

    // Update password
    $user->update(['password' => Hash::make($request->new_password)]);

    return response()->json(['message' => 'Password updated successfully!']);
}
}
