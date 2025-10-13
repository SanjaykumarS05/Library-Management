<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return view('login'); 
    }

    public function Registerindex()
    {
        return view('register');
    }

    public function Registerstore(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return redirect()->route('login')->with('success', 'User registered successfully.');
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->first();
        if(!$user)
            return redirect()->back()->with('error', 'Invalid Email');
        if ($user && Hash::check($data['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Invalid Password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
