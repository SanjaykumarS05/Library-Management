<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\library;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return redirect()->route('home')->with('openModal', 'login');
    }

    public function Registerindex()
    {
        return redirect()->route('home')->with('openModal', 'register');
    }


    public function Registerstore(UserRequest $request)
        {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        User::create($data);
            return redirect()->route('home')->with('openModal', 'login') ->with('success', 'Registration successful! Please log in.');
        }

    public function submit(Request $request)
        {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->first();
        
        if(!$user) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Invalid Email'], 401);
            }
            return redirect()->back()->with('error', 'Invalid Email');
        }
        
        if ($user && Hash::check($data['password'], $user->password)) {
            Auth::login($user);
            
            if ($request->ajax()) {
                return response()->json(['success' => 'Login successful!']);
            }
            
            return redirect()->intended(route('dashboard'));
            }
            
            if ($request->ajax()) {
                return response()->json(['error' => 'Invalid Password.'], 401);
            }
            
            return redirect()->back()->with('error', 'Invalid Password.');
        }

    public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home')->with('success', 'Logged out successfully.');
        }

        public function home()
        {
            $libraries = library::first();
            $books = Book::with('category')->latest()->paginate(9);
            return view('index', compact('libraries', 'books'));
        }
}
