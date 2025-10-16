<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TemplateController;

// ================= ADMIN CONTROLLERS =================
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\ManageUserController as AdminManageUserController;
use App\Http\Controllers\Admin\AdminController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SearchController as AdminSearchController;
use App\Http\Controllers\Admin\BookIssueController as AdminBookIssueController;
use App\Http\Controllers\Admin\BarcodeController as AdminBarcodeController;
use App\Http\Controllers\Admin\OverallbookController as AdminOverallbookController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;

// ================= STAFF CONTROLLERS =================
use App\Http\Controllers\Staff\BookController as StaffBookController;
use App\Http\Controllers\Staff\ManageUserController as StaffManageUserController;
use App\Http\Controllers\Staff\StaffController as StaffDashboardController;
use App\Http\Controllers\Staff\CategoryController as StaffCategoryController;
use App\Http\Controllers\Staff\SearchController as StaffSearchController;
use App\Http\Controllers\Staff\BookIssueController as StaffBookIssueController;
use App\Http\Controllers\Staff\BarcodeController as StaffBarcodeController;
use App\Http\Controllers\Staff\OverallbookController as StaffOverallbookController;
use App\Http\Controllers\Staff\ReportController as StaffReportController;
use App\Http\Controllers\Staff\SettingController as StaffSettingController;
use App\Http\Controllers\Staff\NotificationController as StaffNotificationController;

// ================= TEMPLATE ROUTES =================
Route::get('/template', [TemplateController::class, 'index'])->name('template');
Route::post('/logout', [TemplateController::class, 'logout'])->name('logout');

// ================= AUTHENTICATION =================
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'submit'])->name('submit');
Route::get('/register', [UserController::class, 'Registerindex'])->name('register');
Route::post('/register', [UserController::class, 'Registerstore'])->name('store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// ================= DASHBOARD REDIRECT BASED ON ROLE =================
Route::get('/dashboard', function() {
    $role = auth()->user()->role;
    switch ($role) {
        case 'admin': return redirect()->route('admin.dashboard');
        case 'staff': return redirect()->route('staff.dashboard');
        case 'user': default: return redirect()->route('user.dashboard');
    }
})->middleware('auth')->name('dashboard');



// ================= ADMIN ROUTES =================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Manage Users
    Route::get('/manage_users', [AdminManageUserController::class, 'index'])->name('users');
    Route::get('/manage_users/create', [AdminManageUserController::class, 'create'])->name('users.create');
    Route::post('/manage_users', [AdminManageUserController::class, 'store'])->name('users.store');
    Route::get('/manage_users/{id}/edit', [AdminManageUserController::class, 'edit'])->name('users.edit');
    Route::put('/manage_users/{id}', [AdminManageUserController::class, 'update'])->name('users.update');
    Route::delete('/manage_users/{id}', [AdminManageUserController::class, 'delete'])->name('users.delete');

    // Books
    Route::get('/books', [AdminBookController::class, 'index'])->name('books');
    Route::get('/books/create', [AdminBookController::class, 'create'])->name('books.create');
    Route::post('/books', [AdminBookController::class, 'store'])->name('books.add');
    Route::get('/books/{id}/edit', [AdminBookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [AdminBookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [AdminBookController::class, 'delete'])->name('books.delete');

    // Categories
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'delete'])->name('categories.delete');

    // Search & Reports
    Route::get('/search', [AdminSearchController::class, 'index'])->name('search');


    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export/csv', [AdminReportController::class, 'exportCSV'])->name('reports.exportCSV');
    Route::get('reports/export/pdf', [AdminReportController::class, 'exportPDF'])->name('reports.exportPDF');
    Route::get('/reports/users-by-role', [AdminReportController::class, 'usersByRole'])->name('reports.usersByRole');

    // Issue/Return Books
    Route::get('/issue-return', [AdminBookIssueController::class, 'showIssueReturnForm'])->name('books.issue_return');
    Route::get('/books/issue-return/{bookId?}', [AdminBookIssueController::class, 'issueReturn'])->name('books.issue_return1');
    Route::post('/issue-book', [AdminBookIssueController::class, 'issueBook'])->name('book.issue');
    Route::post('/return-book', [AdminBookIssueController::class, 'returnBook'])->name('book.return');

    // Barcode Actions
    Route::get('/books/issue/{issueId}', [AdminBookIssueController::class, 'issueFromBarcode'])->name('books.issue_from_barcode');
    Route::get('/books/return/{issueId}', [AdminBookIssueController::class, 'returnFromBarcode'])->name('books.return_from_barcode');
    // Redirect to book info by barcode (for scanning)


    // Overall Book & Barcode
    Route::get('/overallbook', [AdminOverallbookController::class, 'index'])->name('overallbook.index');
    Route::get('/overallbooks/search', [AdminOverallbookController::class, 'search'])->name('overallbooks.search');
    Route::get('/barcode', [AdminBarcodeController::class, 'index'])->name('barcode.index');
    Route::get('/barcode/book-info/{barcode}', [AdminBarcodeController::class, 'getBookInfo'])->name('barcode.book.info');

    // Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings');
    Route::put('/settings/profile', [AdminSettingController::class, 'updateProfile'])->name('settings.update');
    Route::put('/settings/library', [AdminSettingController::class, 'updateLibrary'])->name('library.update');
    Route::post('/settings/theme', [AdminSettingController::class, 'updateTheme'])->name('settings.updateTheme');
    Route::put('/settings/theme', [AdminSettingController::class, 'updateTheme'])->name('settings.updateTheme');
    Route::put('/settings/password', [AdminSettingController::class, 'updatePassword'])->name('settings.password');

    Route::get('/admin/notifications', [AdminNotificationController::class, 'index'])->name('notifications');
    Route::post('/admin/notifications/send', [AdminNotificationController::class, 'store'])->name('notification.store');
    Route::post('/admin/notifications/dynamic', [AdminNotificationController::class, 'dynamic'])->name('notification.dynamic');



});

// ================= STAFF ROUTES =================
Route::prefix('staff')->middleware(['auth', 'role:staff'])->group(function () {

   // Dashboard
    Route::get('/', [StaffDashboardController::class, 'index'])->name('staff.dashboard');

    // Manage Users
    Route::get('/manage_users', [StaffManageUserController::class, 'index'])->name('staff.users');
    Route::get('/manage_users/create', [StaffManageUserController::class, 'create'])->name('staff.users.create');
    Route::post('/manage_users', [StaffManageUserController::class, 'store'])->name('staff.users.store');
    Route::get('/manage_users/{id}/edit', [StaffManageUserController::class, 'edit'])->name('staff.users.edit');
    Route::put('/manage_users/{id}', [StaffManageUserController::class, 'update'])->name('staff.users.update');
    Route::delete('/manage_users/{id}', [StaffManageUserController::class, 'delete'])->name('staff.users.delete');

    // Books
    Route::get('/books', [StaffBookController::class, 'index'])->name('staff.books');
    Route::get('/books/create', [StaffBookController::class, 'create'])->name('staff.books.create');
    Route::post('/books', [StaffBookController::class, 'store'])->name('staff.books.add');
    Route::get('/books/{id}/edit', [StaffBookController::class, 'edit'])->name('staff.books.edit');
    Route::put('/books/{book}', [StaffBookController::class, 'update'])->name('staff.books.update');
    Route::delete('/books/{id}', [StaffBookController::class, 'delete'])->name('staff.books.delete');

    // Categories
    Route::get('/categories', [StaffCategoryController::class, 'index'])->name('staff.categories.index');
    Route::get('/categories/create', [StaffCategoryController::class, 'create'])->name('staff.categories.create');
    Route::post('/categories', [StaffCategoryController::class, 'store'])->name('staff.categories.store');
    Route::get('/categories/{id}/edit', [StaffCategoryController::class, 'edit'])->name('staff.categories.edit');
    Route::put('/categories/{id}', [StaffCategoryController::class, 'update'])->name('staff.categories.update');
    Route::delete('/categories/{id}', [StaffCategoryController::class, 'delete'])->name('staff.categories.delete');

    // Search & Reports
    Route::get('/search', [StaffSearchController::class, 'index'])->name('staff.search');


    Route::get('/reports', [StaffReportController::class, 'index'])->name('staff.reports.index');
    Route::get('reports/export/csv', [StaffReportController::class, 'exportCSV'])->name('staff.reports.exportCSV');
    Route::get('reports/export/pdf', [StaffReportController::class, 'exportPDF'])->name('staff.reports.exportPDF');
    Route::get('/reports/users-by-role', [StaffReportController::class, 'usersByRole'])->name('staff.reports.usersByRole');

    // Issue/Return Books
    Route::get('/issue-return', [StaffBookIssueController::class, 'showIssueReturnForm'])->name('staff.books.issue_return');
    Route::get('/books/issue-return/{bookId?}', [StaffBookIssueController::class, 'issueReturn'])->name('staff.books.issue_return1');
    Route::post('/issue-book', [StaffBookIssueController::class, 'issueBook'])->name('staff.book.issue');
    Route::post('/return-book', [StaffBookIssueController::class, 'returnBook'])->name('staff.book.return');

    // Barcode Actions
    Route::get('/books/issue/{issueId}', [StaffBookIssueController::class, 'issueFromBarcode'])->name('staff.books.issue_from_barcode');
    Route::get('/books/return/{issueId}', [StaffBookIssueController::class, 'returnFromBarcode'])->name('staff.books.return_from_barcode');
    // Redirect to book info by barcode (for scanning)


    // Overall Book & Barcode
    Route::get('/overallbook', [StaffOverallbookController::class, 'index'])->name('staff.overallbook.index');
    Route::get('/overallbooks/search', [StaffOverallbookController::class, 'search'])->name('staff.overallbooks.search');
    Route::get('/barcode', [StaffBarcodeController::class, 'index'])->name('staff.barcode.index');
    Route::get('/barcode/book-info/{barcode}', [StaffBarcodeController::class, 'getBookInfo'])->name('staff.barcode.book.info');

    // Settings
    Route::get('/settings', [StaffSettingController::class, 'index'])->name('staff.settings');
    Route::put('/settings/profile', [StaffSettingController::class, 'updateProfile'])->name('staff.settings.update');
    Route::post('/settings/theme', [StaffSettingController::class, 'updateTheme'])->name('staff.settings.updateTheme');
    Route::put('/settings/theme', [StaffSettingController::class, 'updateTheme'])->name('staff.settings.updateTheme');
    Route::put('/settings/password', [StaffSettingController::class, 'updatePassword'])->name('staff.settings.password');

    Route::get('/notifications', [StaffNotificationController::class, 'index'])->name('staff.notifications');
    Route::post('/notification/store', [StaffNotificationController::class, 'store'])->name('staff.notification.store');
});

// ================= USER ROUTE =================
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', function () { 
        return view('user.dashboard'); 
    })->name('user.dashboard');
});
