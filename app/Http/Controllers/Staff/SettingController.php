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
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class SettingController extends Controller
{
    // =====================
    // Show Settings Page
    // =====================
    public function index()
    {
        $admin = Auth::user();
        $profile = $admin->profile;
        $settings = Library::first();

        return view('staff.setting', compact('admin', 'profile', 'settings'));
    }

    // =====================
    // Update Profile
    // =====================
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'secondary_email' => [
                'required',
                'email',
                'different:email',
                Rule::unique('profiles', 'secondary_email')->ignore($user->id, 'user_id')
            ],
            'blood_group' => 'nullable|string|max:5',
            'dob' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $age = Carbon::parse($value)->age;
                    if ($age < 10) {
                        $fail('User must be at least 10 years old.');
                    }
                },
            ],
            'gender' => 'required|string|in:male,female,other',
            'designation' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:20',
            'address' => 'required|string|min:10|max:255',
            'qualification' => 'required|string|max:255',
            'theme' => 'nullable|string|in:light,dark',
        ]);

        // Handle profile image
        $profileImagePath = optional($user->profile)->profile_image_path;
        if ($request->hasFile('profile_image')) {
            if ($profileImagePath && Storage::disk('public')->exists($profileImagePath)) {
                Storage::disk('public')->delete($profileImagePath);
            }
            $profileImagePath = $request->file('profile_image')->store('Profile', 'public');
        }

        // Update user
        $user->update($request->only('name', 'email'));

        // Update or create profile
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

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    // =====================
    // Update Theme
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
