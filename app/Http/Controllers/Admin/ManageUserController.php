<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use Carbon\Carbon;

class ManageUserController extends Controller
{
    // List all users
   public function index(Request $request)
    {
        $users = User::query();

        // AJAX Search / Filter
        if ($request->ajax()) {
             if ($request->name) {
            $search = $request->name;
            $users->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
            if ($request->role) {
                $users->where('role', $request->role);
            }

            $users = $users->latest()->paginate(25);
            return view('admin.users_table', compact('users'))->render();
        }

        $users = $users->latest()->paginate(25);
        return view('admin.manage_users', compact('users'));
    }


    // Show Add User form
    public function create()
    {
        $admin = Auth::user();
        $profile = $admin->profile;
        return view('admin.adduser', compact('admin', 'profile'));
    }

    // Store new user + optional profile
     public function store(Request $request)
    {
        // ✅ Common Validation
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|string|min:6',
            'role'             => 'required|in:admin,staff,user',
            'secondary_email'  => 'required|email|different:email|unique:profiles,secondary_email',
            'blood_group'      => 'required|string|max:3',
            'dob'              => ['required', 'date', function ($attribute, $value, $fail) {
                $age = Carbon::parse($value)->age;
                if ($age < 10) {
                    $fail('User must be at least 10 years old.');
                }
            }],
            'gender'           => 'required|in:male,female,other',
            'designation'      => 'required|string|min:2|max:255',
            'phone'            => 'required|string|regex:/^[0-9]{10,15}$/',
            'address'          => 'required|string|min:10|max:500',
            'qualification'    => 'required|string|min:2|max:255',
        ]);

        // ✅ Create User
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        // ✅ Create Profile
        Profile::create([
            'user_id'         => $user->id,
            'secondary_email' => $validated['secondary_email'],
            'blood_group'     => $validated['blood_group'],
            'dob'             => $validated['dob'],
            'gender'          => $validated['gender'],
            'designation'     => $validated['designation'],
            'phone'           => $validated['phone'],
            'address'         => $validated['address'],
            'qualification'   => $validated['qualification'],
        ]);

        return redirect()->route('users')->with('success', 'User created successfully.');
    }

    // Edit User
    public function edit($id)
    {   
        $user = User::with('profile')->findOrFail($id);
        return view('admin.edituser', compact('user'));
    }

    // Update User
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // ✅ Validate everything together
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $id,
            'role'             => 'required|in:admin,staff,user',
            'secondary_email'  => 'required|email|different:email|unique:profiles,secondary_email,' . $user->id . ',user_id',
            'blood_group'      => 'required|string|max:3',
            'dob'              => ['required', 'date', function ($attribute, $value, $fail) {
                if ($value) {
                    $age = Carbon::parse($value)->age;
                    if ($age < 10) {
                        $fail('User must be at least 10 years old.');
                    }
                }
            }],
            'gender'           => 'required|in:male,female,other',
            'designation'      => 'required|string|min:2|max:255',
            'phone'            => 'required|string|regex:/^[0-9]{10,15}$/',
            'address'          => 'required|string|min:10|max:500',
            'qualification'    => 'required|string|min:2|max:255',
        ]);

        // ✅ Update main user table
        $user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'role'  => $validated['role'],
        ]);

        // ✅ Update or create profile
        if ($user->profile) {
            $user->profile->update([
                'secondary_email' => $validated['secondary_email'] ?? $user->profile->secondary_email,
                'blood_group'     => $validated['blood_group'] ?? $user->profile->blood_group,
                'dob'             => $validated['dob'] ?? $user->profile->dob,
                'gender'          => $validated['gender'] ?? $user->profile->gender,
                'designation'     => $validated['designation'] ?? $user->profile->designation,
                'phone'           => $validated['phone'] ?? $user->profile->phone,
                'address'         => $validated['address'] ?? $user->profile->address,
                'qualification'   => $validated['qualification'] ?? $user->profile->qualification,
            ]);
        } else {
            $user->profile()->create([
                'secondary_email' => $validated['secondary_email'] ?? null,
                'blood_group'     => $validated['blood_group'] ?? null,
                'dob'             => $validated['dob'] ?? null,
                'gender'          => $validated['gender'] ?? null,
                'designation'     => $validated['designation'] ?? null,
                'phone'           => $validated['phone'] ?? null,
                'address'         => $validated['address'] ?? null,
                'qualification'   => $validated['qualification'] ?? null,
            ]);
        }

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }


    // Delete User
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
