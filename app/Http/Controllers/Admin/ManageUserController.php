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
   
    public function index(Request $request)
    {
        $users = User::query();

        
        if ($request->ajax()) {
            if ($request->search) {
                $search = $request->search;
                $users->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }
            if ($request->fine) {
                $users->where('fine', '>=', $request->fine);
            }  
            if ($request->status) {
                $users->where('status', $request->status);
            }  
            if ($request->role) {
                $users->where('role', $request->role);
            }

            $users = $users->latest()->paginate(10);

            return view('admin.users_table', compact('users'))->render();
        }

        
        $users = $users->latest()->paginate(10);
        return view('admin.manage_users', compact('users'));
    }

   
    public function create()
    {
        $admin = Auth::user();
        $profile = $admin->profile;
        return view('admin.adduser', compact('admin', 'profile'));
    }

  
    public function store(Request $request)
    {
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

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

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

   
    public function edit($id)
    {
        $user = User::with('profile')->findOrFail($id);
        return view('admin.edituser', compact('user'));
    }

   
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email' => 'required|string|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i|unique:users,email,' . $id,
            'role'             => 'required|in:admin,staff,user',
            'status'          => 'required|in:active,disabled',
            'secondary_email'  => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i|different:email|unique:profiles,secondary_email,' . $user->id . ',user_id',
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

        $user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'role'  => $validated['role'],
            'status'=> $validated['status'],
        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'secondary_email' => $validated['secondary_email'],
                'blood_group'     => $validated['blood_group'],
                'dob'             => $validated['dob'],
                'gender'          => $validated['gender'],
                'designation'     => $validated['designation'],
                'phone'           => $validated['phone'],
                'address'         => $validated['address'],
                'qualification'   => $validated['qualification'],
            ]
        );

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
