<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\BookIssueController;
use App\Http\Controllers\Admin\BarcodeController;
use App\Http\Controllers\Admin\OverallbookController;
use App\Http\Controllers\Admin\ReportController;


// Template routes
Route::get('/template', [TemplateController::class, 'index'])->name('template');
Route::post('/logout', [TemplateController::class, 'logout'])->name('logout');

// Authentication
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'submit'])->name('submit');
Route::get('/register', [UserController::class, 'Registerindex'])->name('register');
Route::post('/register', [UserController::class, 'Registerstore'])->name('store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Dashboard redirect based on role
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
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff', function() { return view('staff.dashboard'); })->name('staff.dashboard');
});
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', function() { return view('user.dashboard'); })->name('user.dashboard');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Users
    Route::get('/manage_users', [ManageUserController::class, 'index'])->name('users');
    Route::get('/manage_users/create', [ManageUserController::class, 'create'])->name('users.create');
    Route::post('/manage_users', [ManageUserController::class, 'store'])->name('users.store');
    Route::get('/manage_users/{id}/edit', [ManageUserController::class, 'edit'])->name('users.edit');
    Route::put('/manage_users/{id}', [ManageUserController::class, 'update'])->name('users.update');
    Route::delete('/manage_users/{id}', [ManageUserController::class, 'delete'])->name('users.delete');

    // Books
    Route::get('/books', [BookController::class, 'index'])->name('books');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.add');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'delete'])->name('books.delete');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

    // Search
    Route::get('/search', [SearchController::class, 'index'])->name('search');

     Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
     Route::get('/get-users-by-role', [App\Http\Controllers\ReportController::class, 'getUsersByRole'])->name('reports.getUsersByRole');

    // Book Issue/Return
    Route::get('/issue-return', [BookIssueController::class, 'showIssueReturnForm'])->name('books.issue_return');
    Route::get('/books/issue-return/{bookId?}', [BookIssueController::class, 'issueReturn'])->name('books.issue_return1');
    Route::post('/issue-book', [BookIssueController::class, 'issueBook'])->name('book.issue');
    Route::post('/return-book', [BookIssueController::class, 'returnBook'])->name('book.return');

    Route::get('/books/issue/{issueId}', [BookIssueController::class, 'issueFromBarcode'])->name('books.issue_from_barcode');
    Route::get('/books/return/{issueId}', [BookIssueController::class, 'returnFromBarcode'])->name('books.return_from_barcode');
    // Overall Book and Reports
    Route::get('/overallbook', [OverallbookController::class, 'index'])->name('overallbook.index');
   

});

// Barcode scanner routes (frontend)
Route::get('/barcode', [BarcodeController::class, 'index'])->name('barcode.index');
Route::get('/barcode/book-info/{barcode}', [BarcodeController::class, 'getBookInfo'])->name('barcode.book.info');
