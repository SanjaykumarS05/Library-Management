<?php

namespace App\Http\Controllers\Admin;

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
    
    public function index()
    {
        $admin = Auth::user();
        $profile = $admin->profile;
        $settings = Library::first();

        return view('admin.setting', compact('admin', 'profile', 'settings'));
    }

   
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

      
        $profileImagePath = optional($user->profile)->profile_image_path;
        if ($request->hasFile('profile_image')) {
            if ($profileImagePath && Storage::disk('public')->exists($profileImagePath)) {
                Storage::disk('public')->delete($profileImagePath);
            }
            $profileImagePath = $request->file('profile_image')->store('Profile', 'public');
        }

  
        $user->update($request->only('name', 'email'));

     
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

    public function updateLibrary(Request $request)
    {
        $request->validate([
            'library_name' => 'required|string|max:255',
            'address' => 'required|string|min:10|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|min:10|max:20',
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

        return redirect()->back()->with('success', 'Library settings updated successfully!');
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


   
   public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();


    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json(['message' => 'Current password is incorrect.'], 422);
    }

    if (Hash::check($request->new_password, $user->password)) {
        return response()->json(['message' => 'New password cannot be the same as the current password.'], 422);
    }


    $user->update(['password' => Hash::make($request->new_password)]);

    return response()->json(['message' => 'Password updated successfully!']);
}
}
