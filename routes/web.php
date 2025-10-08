<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'submit'])->name('submit');

Route::get('/register', [UserController::class, 'Registerindex'])->name('register');
Route::post('/register', [UserController::class, 'Registerstore'])->name('store');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Common dashboard redirect
Route::get('/dashboard', function() {
    $role = auth()->user()->role;
    switch ($role) {
        case 'admin': return redirect()->route('admin.dashboard');
        case 'staff': return redirect()->route('staff.dashboard');
        case 'user': default: return redirect()->route('user.dashboard');
    }
})->middleware('auth')->name('dashboard');

// Role-specific dashboards
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function() { return view('admin.dashboard'); })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff', function() { return view('staff.dashboard'); })->name('staff.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', function() { return view('user.dashboard'); })->name('user.dashboard');
});