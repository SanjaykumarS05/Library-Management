<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Library;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RegisterNotification;
use App\Notifications\OtpNotification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

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

    // STEP 1: Register - store temporarily & send OTP
    public function Registerstore(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        // Check if user already exists
        if (User::where('email', $data['email'])->exists()) {
            return redirect()->route('home')
                ->with('openModal', 'register')
                ->with('error', 'This email is already registered.');
        }

        // Generate OTP and store in session with expiration
        $otp = rand(100000, 999999);
        $library = Library::first();
        // Store session data properly
        Session::put([
            'temp_user_data' => $data,
            'otp' => $otp,
            'otp_created_at' => now()->timestamp
        ]);

        // Send OTP via email
        try {
            Mail::send([], [], function ($message) use ($data, $otp, $library) {
                $message->to($data['email'])
                        ->subject("Your {$library->library_name} Registration OTP Code")
                        ->text("Your OTP code for completing registration is: $otp\nThis code will expire in 10 minutes.");
            });
        } catch (\Exception $e) {
            \Log::error('OTP email failed: ' . $e->getMessage());
            // Continue anyway for development
        }

        return redirect()->route('home')
            ->with('openModal', 'otp')
            ->with('success', 'OTP has been sent to your email. Please verify it to complete registration.');
    }

    // STEP 2: Verify OTP and save user
    public function otp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        // Get session data using Session facade
        $sessionOtp = Session::get('otp');
        $tempData = Session::get('temp_user_data');
        $otpCreatedAt = Session::get('otp_created_at');

        // Check if session data exists
        if (!$sessionOtp || !$tempData) {
            return redirect()->route('home')
                ->with('openModal', 'register')
                ->with('error', 'Session expired. Please register again.');
        }

        // Check OTP expiration (10 minutes)
        if ($otpCreatedAt && (now()->timestamp - $otpCreatedAt) > 600) {
            Session::forget(['otp', 'temp_user_data', 'otp_created_at']);
            return redirect()->route('home')
                ->with('openModal', 'otp')
                ->with('error', 'OTP has expired. Please request a new one.');
        }

        if ($request->otp != $sessionOtp) {
            return redirect()->back()
                ->with('openModal', 'otp')
                ->with('error', 'Invalid OTP. Please try again.');
        }

        // OTP is correct → Save user permanently
        try {
            $user = User::create($tempData);
            
            // Send welcome email
            try {
                $user->notify(new RegisterNotification($user));
            } catch (\Exception $e) {
                \Log::error('Welcome email failed: ' . $e->getMessage());
            }
            // Clear session data
            Session::forget(['otp', 'temp_user_data', 'otp_created_at']);

            return redirect()->route('home')
                ->with('openModal', 'login')
                ->with('success', 'Registration successful! Please log in.');

        } catch (\Exception $e) {
            \Log::error('User creation failed: ' . $e->getMessage());
            return redirect()->route('home')
                ->with('openModal', 'register')
                ->with('error', 'Registration failed. Please try again.');
        }
    }

    // LOGIN (unchanged)
    public function submit(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return $request->ajax()
                ? response()->json(['error' => 'Invalid Email'], 401)
                : redirect()->back()->with('error', 'Invalid Email');
        }

        if ($user->status === 'disabled') {
            return redirect()->back()->with('error', 'Your account has been disabled. Please contact support.');
        }

        if (Hash::check($data['password'], $user->password)) {
            Auth::login($user);
            return $request->ajax()
                ? response()->json(['success' => 'Login successful!'])
                : redirect()->intended(route('dashboard'));
        }

        return $request->ajax()
            ? response()->json(['error' => 'Invalid Password.'], 401)
            : redirect()->back()->with('error', 'Invalid Password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logged Out.');
    }

    public function home()
    {
        $libraries = Library::first();
        $books = Book::with('category')->latest()->paginate(9);
        return view('index', compact('libraries', 'books'));
    }

    public function resendOtp()
    {
        $tempData = Session::get('temp_user_data');

        if (!$tempData) {
            return redirect()->route('home')
                ->with('error', 'Session expired. Please register again.');
        }

        $otp = rand(100000, 999999);
        $library = Library::first();
        // Update session data
        Session::put([
            'otp' => $otp,
            'otp_created_at' => now()->timestamp
        ]);

        // Resend OTP email
        try {
            Mail::send([], [], function ($message) use ($tempData, $otp, $library) {
                $message->to($tempData['email'])
                        ->subject("Your {$library->library_name} Registration OTP Code")
                        ->text("Your new OTP code for completing registration is: $otp\nThis code will expire in 10 minutes.");
            });
        } catch (\Exception $e) {
            \Log::error('Resend OTP email failed: ' . $e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'A new OTP has been sent to your email.']);
    }
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Reset link sent to your email.')
            : back()->with('error', 'Email not found.');
    }

    public function showResetPasswordForm($token, $email)
        {
            $user = User::where('email', $email)->first();

            // If user doesn't exist → stop
            if (!$user) {
                return redirect('/')->with('error', 'Invalid or expired reset link.')
                                    ->with('openModal', 'forgot');
            }

            // Check token validity
            if (!Password::tokenExists($user, $token)) {
                return redirect('/')->with('error', 'Reset link has expired. Please request a new one.')
                                    ->with('openModal', 'forgot');
            }

            // Token is valid → open reset password modal
            return redirect('/')->with([
                'openModal' => 'reset',
                'resetToken' => $token,
                'resetEmail' => $email,
            ])->withInput();
        }
   public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        // If validation fails → return back to reset modal
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with([
                    'openModal' => 'reset',
                    'resetToken' => $request->token,
                    'resetEmail' => $request->email,
                ]);
        }
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password)
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('home')
                ->with('openModal', 'login')
                ->with('success', 'Password reset successful! Please login.');
        }

        return back()
            ->withInput()
            ->with([
                'error' => 'Invalid token or email.',
                'openModal' => 'reset',
                'resetToken' => $request->token,
                'resetEmail' => $request->email,
            ]);
    }
}