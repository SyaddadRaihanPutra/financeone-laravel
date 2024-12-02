<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/dashboard',  [DashboardController::class, 'getApi'])->name('dashboard.getApi')->middleware('web');
Route::get('/trasanctions/recent', [TransactionController::class, 'getApi'])->name(('transactions.getApi'))->middleware('web');
