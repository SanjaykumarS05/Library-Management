<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            switch ($user->role) {
                case 'admin': return redirect()->route('admin.dashboard');
                case 'staff': return redirect()->route('staff.dashboard');
                case 'user':
                default: return redirect()->route('user.dashboard');
            }
        }
        return $next($request);
    }
}
