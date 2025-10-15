<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests\UserRequest;

class ManageUserController extends Controller
{
    // List all users
   public function index(Request $request)
{
    $users = User::query();

    // AJAX Search
    if ($request->ajax()) {
        if ($request->search) {
            $search = $request->search;
            $users->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            });
        }

        $users = $users->get();
        return view('admin.users_table', compact('users'))->render();
    }

    $users = $users->get();
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
    public function store(UserRequest $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'Email already exists.'])->withInput();
        }

        // Create User
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Create Profile (optional fields)
        Profile::create([
            'user_id'          => $user->id,
            'secondary_email'  => $request->secondary_email,
            'blood_group'      => $request->blood_group,
            'dob'              => $request->dob,
            'gender'           => $request->gender,
            'designation'      => $request->designation,
            'phone'            => $request->phone,
            'address'          => $request->address,
            'qualification'    => $request->qualification,
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
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:admin,staff,user',
        ]);

        $user = User::findOrFail($id);
        $user->update($data);

        if ($user->profile) {
            $user->profile->update($request->only([
                'secondary_email', 'blood_group', 'dob', 'gender',
                'designation', 'phone', 'address', 'qualification'
            ]));
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
