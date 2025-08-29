<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\SubmissionController; // Added this

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::redirect('/', '/login');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // New Submission Routes
    Route::get('/submission/create', [SubmissionController::class, 'create'])->name('submission.create');
    Route::post('/submission', [SubmissionController::class, 'store'])->name('submission.store');
    Route::get('/submissions', [SubmissionController::class, 'index'])->name('submission.index');
    Route::get('/submissions/{submission}/edit', [SubmissionController::class, 'edit'])->name('submission.edit');
    Route::put('/submissions/{submission}', [SubmissionController::class, 'update'])->name('submission.update');
    Route::delete('/submissions/{submission}', [SubmissionController::class, 'destroy'])->name('submission.destroy');
});

// Admin Routes
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // User Management
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // ITSID Management
    Route::get('/admin/users/import', [UserController::class, 'showImportForm'])->name('admin.users.import');
    Route::post('/admin/users/import', [UserController::class, 'handleImport'])->name('admin.users.handle_import');
    Route::get('/admin/itsids', [UserController::class, 'showItsids'])->name('admin.itsids.index');
    Route::post('/admin/itsids/{itsidImport}/fetch', [UserController::class, 'fetchItsidDetails'])->name('admin.itsids.fetch');
    Route::post('/admin/itsids/send-credentials', [UserController::class, 'sendCredentials'])->name('admin.itsids.send');

    // Currency Management
    Route::delete('/admin/currencies', [CurrencyController::class, 'bulkDestroy'])->name('currencies.bulkDestroy');
    Route::resource('/admin/currencies', CurrencyController::class);
});

require __DIR__.'/auth.php';