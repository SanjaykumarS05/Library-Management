<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Requests\UserRequest;

class ManageUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.manage_users', compact('users'));
    }

    public function create()
    {
        return view('admin.createuser');
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('admin.manage_users')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edituser', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return redirect()->route('admin.manage_users')->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.manage_users')->with('success', 'User deleted successfully.');
    }
}
