<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login
        // Total income dan expense
        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');

        // Total balance
        $totalBalance = $totalIncome - $totalExpense;

        return view('dashboard', compact('totalBalance', 'totalIncome', 'totalExpense'));
    }
}
