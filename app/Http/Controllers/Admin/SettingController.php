<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Library;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
   public function index()
{
    $admin = Auth::user();
    $profile = $admin->profile;
    $settings = Library::first(); // fetch from DB

    return view('admin.setting', compact('admin', 'profile', 'settings'));
}


    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'user_id' => 'nullable|string|max:50|unique:users,employee_id,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'secondary_email' => 'nullable|email|max:255|unique:profiles,secondary_email,' . $user->id . ',user_id',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'designation' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $profileImagePath = $user->profile?->profile_image_path;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => $request->user_id, // use the correct DB column
        ]);

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
                'qualification' => $request->qualification,
                'phone' => $request->phone,
                'address' => $request->address,
            ]
        );


        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function library(Request $request)
{
    $request->validate([
        'library_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'contact_email' => 'required|email|max:255',
        'contact_phone' => 'required|string|max:20',
        'web_site' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'facebook' => 'nullable|string|max:255',
        'twitter' => 'nullable|string|max:255',
        'linkedin' => 'nullable|string|max:255',
        'youtube' => 'nullable|string|max:255',
        'working_hours' => 'required|string|max:255',
    ]);

    Library::updateOrCreate(
        ['id' => 1],
        $request->only([
            'library_name', 'address', 'contact_email', 'contact_phone', 
            'web_site', 'instagram', 'facebook', 'twitter', 
            'linkedin', 'youtube', 'working_hours'
        ])
    );

    return response()->json(['message' => 'Library settings updated successfully.']);
}

}
