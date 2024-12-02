<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('auth/google', [\App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [\App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);

Route::get('/test-conn', function () {
    try {
        DB::connection()->getPdo();
        echo "Connected successfully to: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        die("Could not connect to the database. Please check your configuration. error:" . $e);
    }
});


Route::view('/', 'home')->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::get('/transactions/export-pdf', [TransactionController::class, 'exportPdf'])->name('transactions.export-pdf');

    Route::resource('budgets', BudgetController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    Route::get('reports/{report}', [ReportController::class, 'show'])->name('reports.show');
});
