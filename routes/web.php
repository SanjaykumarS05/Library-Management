<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ManageUserController;

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

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/books', [BookController::class, 'index'])->name('admin.books');
    Route::get('/admin/books/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::post('/admin/books', [BookController::class, 'store'])->name('admin.books.add');
    Route::get('/admin/books/{id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/admin/books/{id}', [BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/admin/books/{id}', [BookController::class, 'delete'])->name('admin.books.delete');

    Route::get('/admin/manage_users', [ManageUserController::class, 'index'])->name('admin.manage_users');
    Route::get('/admin/manage_users/create', [ManageUserController::class, 'create'])->name('admin.manage_users.create');
    Route::post('/admin/manage_users', [ManageUserController::class, 'store'])->name('admin.manage_users.store');
    Route::get('/admin/manage_users/{id}/edit', [ManageUserController::class, 'edit'])->name('admin.manage_users.edit');
    Route::put('/admin/manage_users/{id}', [ManageUserController::class, 'update'])->name('admin.manage_users.update');
    Route::delete('/admin/manage_users/{id}', [ManageUserController::class, 'delete'])->name('admin.manage_users.delete');
});